<?php
//Grid A. All groups + group headers + SD data. Called from each of the layouts.
function abcfsl_cnt_groups_all_groups_all_parts( $layout, $grpType, $postIDs, $tplateOptns, $itemPar, $itemCntrDiv, $gridColsQty ){

    $out['itemsHTML'] = '';
    $out['sdProperties'] = array();
 
    //GRPCAT GRPTXT GRPABC
    switch ( $grpType . '_' . $layout ) {
        case 'GRPCAT_A':
            $out = abcfsl_cnt_grid_a_all_groups_all_parts_cat( $postIDs, $tplateOptns, $itemPar, $itemCntrDiv );
            break;
        case 'GRPTXT_A':
        case 'GRPABC_A': 
            $out = abcfsl_cnt_grid_a_all_groups_all_parts_txt( $grpType, $postIDs, $tplateOptns, $itemPar, $itemCntrDiv );           
            break;         
        case 'GRPCAT_B':
            $out = abcfsl_cnt_grid_b_all_groups_all_parts_cat( $postIDs, $tplateOptns, $itemPar, $gridColsQty );
            break;
        case 'GRPTXT_B':
        case 'GRPABC_B': 
            $out = abcfsl_cnt_grid_b_all_groups_all_parts_txt( $grpType, $postIDs, $tplateOptns, $itemPar, $gridColsQty );           
            break;
        case 'GRPCAT_L':
            $out = abcfsl_cnt_list_all_groups_all_parts_cat( $postIDs, $tplateOptns, $itemPar );
            break;
        case 'GRPTXT_L':
        case 'GRPABC_L': 
            $out = abcfsl_cnt_list_all_groups_all_parts_txt( $grpType, $postIDs, $tplateOptns, $itemPar );           
            break;
        default:
            break;
    }
    return $out;
}

//===============================================================
//== ALL LAYOUTS - START ========================================

// CATEGORIES. Staff IDs grouped by slugs. Includes none group.
function abcfsl_cnt_groups_data_categories( $postIDs, $grpID ){

    //Slugs > Category name pairs. Included only saved slugs.
    $out['slugNamePairs'] = array();
     //Staff IDs grouped by slugs. Includes none group. 
    $out['groupedIDs'] = array();

    //-----------------------------
    // Comma delimited string for IN clause. $grpID = 7961;
    $slugsSaved = abcfsl_cnt_groups_saved_grp_values_to_in( $grpID );
    $slugsIN = $slugsSaved['slugsIN'];
    $slugsDistinct = $slugsSaved['slugsDistinct'];
    if( empty( $slugsIN ) ) { return $out; }

    //Associative array of StaffID > Slug. Only saved slugs. Removed duplicate IDs. [6356] => administrators
    //$staffIDSlug = abcfsl_cnt_groups_staff_ids_slugs_cat( $slugsIN );
    $staffIDSlug = abcfsl_cnt_groups_staff_ids_slugs( 'GRPCAT', 0, 0, $slugsIN );

    //Slugs > Category name pairs ( [faculty] => Faculty ). Included only saved slugs.
    $slugNamePairs = abcfsl_cnt_groups_cat_slug_name_pairs( $slugsIN, $slugsDistinct );

    //-----------------------------
    // Staff IDs grouped by slugs.  Includes none group.  
    $groupedIDs = array();
    $slug = '';

    foreach ( $postIDs as $staffID ) {
        $slug = abcfsl_cnt_groups_slug_for_id( $staffID, $staffIDSlug );
        $groupedIDs[$slug][] = $staffID;
    }

    //-----------------------------
    $out['slugNamePairs'] = $slugNamePairs;
    $out['groupedIDs'] = $groupedIDs;

    return $out;

    // Staff IDs grouped by slugs. Includes none group.
    // [administrators] => Array
    //     (
    //         [0] => 6371
    //         [1] => 7340
    //     )
    // [faculty] => Array
    //     (
    //         [0] => 6337
    //         [1] => 7376
    //     )
}

//Slugs > Category names pairs. Included only reqested slugs (saved in Groups cutom post).
function abcfsl_cnt_groups_cat_slug_name_pairs( $slugsIN, $slugsDistinct ) {

    //Slugs > Category names pairs from DB.
    $slugsNames = abcfsl_db_groups_cat_slug_name_pairs( $slugsIN );

    $slugNamePairs = array();
    $slugNamePairsSorted = array();
    $catName = '';

    foreach ($slugsNames as $value) {
        $slugNamePairs[$value->slug] = $value->name;       
    }

    foreach ($slugsDistinct as $slug) {
        $catName = abcfsl_cnt_groups_cat_name_for_slug( $slugNamePairs, $slug );
        if( !empty( $catName) ) {
            $slugNamePairsSorted[$slug] = $catName;
        }      
    }
    return $slugNamePairsSorted;
}

//Get slug for specific ID. 
function abcfsl_cnt_groups_cat_name_for_slug( $slugNamePairs, $slug ){
    $catName = '';
    if ( !empty( $slugNamePairs[$slug]) ) {
        $catName = $slugNamePairs[$slug];
    }
    return $catName;
}

// ALL LAYOUTS - TXT. Staff IDs grouped by slugs. Includes none group?.
function abcfsl_cnt_groups_data_txt( $grpType, $postIDs, $grpID, $parentID, $tplateOptns, $itemPar ){
    
    //Slugs > Category name pairs. Included only saved slugs.
    //$out['slugNamePairs'] = array();
    $out['grpNames'] = array();
    //Staff IDs grouped by slugs. Includes none group. 
    $out['groupedIDs'] = array();
    //-----------------------------
    // Comma delimited string for IN clause.
    $slugsSaved = abcfsl_cnt_groups_saved_grp_values_to_in( $grpID );
    $slugsIN = $slugsSaved['slugsIN'];
    $grpNames = $slugsSaved['slugsDistinct'];
    if( empty( $slugsIN ) ) { return $out; }

    //Array of StaffID > Slug ( [6356] => administrators ). Only saved slugs. Removed duplicate IDs. 
    $staffIDSlug = abcfsl_cnt_groups_staff_ids_slugs( $grpType, $parentID, $grpID, $slugsIN );
    //-----------------------------
    // Staff IDs grouped by slugs.  Includes none group.  
    $groupedIDs = array();
    $slug = '';

    foreach ( $postIDs as $staffID ) {
        $slug = abcfsl_cnt_groups_slug_for_id( $staffID, $staffIDSlug );
        $groupedIDs[$slug][] = $staffID;
    }
    //-----------------------------
    $out['grpNames'] = $grpNames;
    $out['groupedIDs'] = $groupedIDs;

    return $out;

    // OUTPUT: Group names.
    //[0] => A
    //[1] => B

    // OUTPUT: Staff IDs grouped by slugs. Includes none group.
    // [administrators] => Array
    //     (
    //         [0] => 6371
    //         [1] => 7340
    //     )
    // [faculty] => Array
    //     (
    //         [0] => 6337
    //         [1] => 7376
    //     )       
}

function abcfsl_cnt_groups_grp_header( $grpID, $grpName, $pfix ){

    $grpOptns = get_post_custom( $grpID );
    
    $grpCntrMT = isset( $grpOptns['_grpCntrMT'] ) ? $grpOptns['_grpCntrMT'][0] : 'N';
    $grpCntrMB = isset( $grpOptns['_grpCntrMB'] ) ? $grpOptns['_grpCntrMB'][0] : 'N';
    $grpCntrCustCls = isset( $grpOptns['_grpCntrCustCls'] ) ? esc_attr( $grpOptns['_grpCntrCustCls'][0] ) : '';

    $grpItemML = isset( $grpOptns['_grpItemML'] ) ? $grpOptns['_grpItemML'][0] : 'N';
    $grpFontSize = isset( $grpOptns['_grpFontSize'] ) ? esc_attr( $grpOptns['_grpFontSize'][0] ) : 'D';
    $grpFontColor = isset( $grpOptns['_grpFontColor'] ) ? esc_attr( $grpOptns['_grpFontColor'][0] ) : 'D';
    $upCase = isset( $grpOptns['_upCase'] ) ? esc_attr( $grpOptns['_upCase'][0] ) : 'N';
    $grpNameCustCls = isset( $grpOptns['_grpNameCustCls'] ) ? esc_attr( $grpOptns['_grpNameCustCls'][0] ) : '';

    $grpHLine = isset( $grpOptns['_grpHLine'] ) ? esc_attr( $grpOptns['_grpHLine'][0] ) : '';

    //--------------------------------------------------
    $clsMT = abcfsls_util_cls_name_bldr_ncd( 'MT', $grpCntrMT, $pfix );
    $clsMB = abcfsls_util_cls_name_bldr_ncd( 'MB', $grpCntrMB, $pfix );
    $clsGrpCntr = abcfsl_util_merge_custom_cls( $clsMT . abcfsl_util_lead_space( $clsMB ), $grpCntrCustCls );
    

    //Group name div + content
    //if( !empty( $grpName) ) {
    $clsMl = abcfsls_util_cls_name_bldr_ncd( 'ML', $grpItemML, $pfix ); //abcfslMLPc2
    $clsFontSize = abcfsls_util_cls_name_bldr_ncd( 'F', $grpFontSize, $pfix );
    $clsFontColor = abcfsls_util_cls_name_bldr_ncd( 'Color', $grpFontColor, $pfix );
    $clsUpCase = abcfsl_util_upper_cls( $upCase, $pfix );
    $clsAll = $clsMl . abcfsl_util_lead_space( $clsFontSize ) . abcfsl_util_lead_space( $clsFontColor ) . abcfsl_util_lead_space( $clsUpCase );
    $clsGrpName = abcfsl_util_merge_custom_cls( $clsAll, $grpNameCustCls );
    //}

    $divGrpCntrS = abcfl_html_tag_cls( 'div', $clsGrpCntr );
    $divGrpName = abcfl_html_tag_with_content( $grpName, 'div', '',  $clsGrpName );
    
    $divGrpHLine = '';
    if( !empty( $grpHLine ) ) {
        $divGrpHLine = abcfl_html_tag_cls( 'div', $grpHLine, true );
    }
    $divGrpCntrE = abcfl_html_tag_end( 'div' );

    return $divGrpCntrS . $divGrpName . $divGrpHLine . $divGrpCntrE;
}

//Get slug for specific ID. 
function abcfsl_cnt_groups_slug_for_id( $staffID, $staffIDSlug ){
    $slug = 'none';
    if ( !empty( $staffIDSlug[$staffID]) ) {
        $slug = $staffIDSlug[$staffID];
    }
    return $slug;
}

// OUT - comma delimited,single quotes string for IN clause.
function abcfsl_cnt_groups_saved_grp_values_to_in( $grpID ) {

    $slugs = array();
    //Get slugs from staff groups. Remove duplicates. Ordered by staff groups setup. Array of arrays
    $savedSlugs = get_post_meta( $grpID, '_grpSlugs', true );
    if( empty( $savedSlugs )) { return ''; }

    foreach ($savedSlugs as $value) {
        $slugs[] = $value['grpSlugs'];        
    }
    $slugsDistinct = array_unique( $slugs );
    //----------------------------------------

    //'physics','administrators','coach','faculty'
    $slugsIN = "'" . implode( $slugsDistinct, "','" ) . "'";

    $out['slugsIN'] = $slugsIN;
    $out['slugsDistinct'] = $slugsDistinct;

    return $out;
}

// IN : Comma delimited list od group names (or category slugs)
// OUT - Associative array of StaffID - Slug. 
function abcfsl_cnt_groups_staff_ids_slugs( $grpType, $parentID, $grpID, $slugsIN ) {

    //Multidimensional array array of StaffID - Slug. Data comes from DB.
    $results = array();
    //[6337] => faculty
    $staffIDSlug = array();

    //GRPCAT GRPTXT GRPABC
    switch ( $grpType ) {
        case 'GRPCAT':
            $results = abcfsl_db_groups_staff_ids_slugs_cat( $slugsIN );
            break;
        case 'GRPTXT': 
            $results = abcfsl_db_groups_staff_ids_slugs_txt( $parentID, $grpID, $slugsIN );           
            break;
        case 'GRPABC': 
            $results = abcfsl_db_groups_staff_ids_slugs_abc( $parentID, $grpID, $slugsIN );          
            break;
        default:
            break;
    }

    // Remove duplicate staff IDs
    $resultsUnique = abcfsl_cnt_groups_unique_key( $results,'staffID' );

     //Convert multidimensional array into Associative array. 
     foreach ($resultsUnique as $value) {
        $staffIDSlug[$value['staffID']] = $value['slug']; 
    }

    //OUT: StaffID => meta_value or slug. [6337] => faculty
    return $staffIDSlug;
}

function abcfsl_cnt_groups_unique_key( $array, $keyname){

    $new_array = array();
    foreach($array as $key=>$value){
   
      if(!isset($new_array[$value[$keyname]])){
        $new_array[$value[$keyname]] = $value;
      }
   
    }
    $new_array = array_values($new_array);
    return $new_array;
   }

//== ALL LAYOUTS - END =========================================
//==============================================================
<?php
//var_dump( $wpdb->last_query );

//Called from: abcfsl_paginator_post_ids
function abcfsl_db_staff_member_ids( $optns, $menu, $filters ){
    
    //Filters are populated with no Ajax
    $optns['filtersEmpty'] = abcfsl_cnt_filters_empty( $filters );
    $parentID = $optns['parentID'];
    $scodeCat = $optns['scodeCat'];
    //$scodeOrder = strtoupper($optns['scodeOrder']);
    $scodeOrder = $optns['scodeOrder'];

    $orderPar['scodeOrder'] = $scodeOrder;
    $orderPar['cSort'] = $optns['cSort'];
    $orderPar['cSortOrder'] = $optns['cSortOrder'];

    $menuType = $menu['menuType'];
    $filterField = $menu['filterField'];
    $qryFilter = $menu['qryFilter'];
    $first = $menu['first'];

    //-------------------------------------
    $datePlus = $optns['datePlus'];
    if( !empty( $datePlus )) {
        if( empty( $menuType ) || $menuType == 'NONE' ) { $menuType = 'DATEPLUS'; }
     }

    $postIDs = array();
    switch ( $menuType ) {
        case 'CAT':
            $postIDs = abcfsl_db_staff_ids_menu_cat( $parentID, $scodeCat, $qryFilter, $first, $orderPar );
            break;
        case 'AZM':
            $postIDs = abcfsl_db_staff_ids_menu_az( $parentID, $filterField, $scodeCat, $qryFilter, $first, $orderPar );
            break;
        case 'MTF':
            $postIDs = abcfsl_db_mf_MTF( $parentID, $scodeCat, $optns, $menu, $filters, $orderPar );
            break;
        case 'MFP': 
        // SLSN
            if ( function_exists( 'abcfsls_db_mf_MFP_NEW' ) ){
                $postIDs = abcfsls_db_mf_MFP_NEW( $parentID, $scodeCat, $scodeOrder, $optns, $menu, $filters, $orderPar );
            }
            else{
                $optns['menu'] = $menu;
                $optns['filters'] = $filters;  
                //calls abcfsl_db_mf_run_no_filters( $parentID, $scodeCat, $scodeOrder ); 
                //calls abcfsl_db_staff_ids_no_menu( $parentID, $scodeCat, $scodeOrder );     
                $postIDs = abcfsls_db_mf_MFP( $parentID, $scodeCat, $optns, $scodeOrder );        
            }
            break;
        case 'DATEPLUS':
            $postIDs = abcfsl_cnt_date_staff_ids_DATEPLUS( $parentID, $scodeCat, $datePlus );
            break;
        default:
            //All records unless limited by shortcode option - categories.
            $postIDs = abcfsl_db_staff_ids_sorted_all_or_cat( $parentID, $scodeCat, $orderPar );
            break;
    }

    return $postIDs;
}

// function abcfsl_cnt_filters_empty( $filters ){

//     //Array ( [1] => * [2] => * [3] => [4] => [5] => [6] => [btn] => search [frmType] => ) 
//     //Check only first 6 items.
//     $empty = true;
//     for ($x = 1; $x <= 6; $x++) {        
//         if( !empty( $filters[$x] ) ){ 
//             if( $filters[$x] == '*' ) { continue; }           
//             $empty = false;
//             break;
//         }
//     }
//     return $empty;
// }

//== CATEGORIES MENU START ================================
function abcfsl_db_staff_ids_menu_cat( $parentID, $scodeCat, $qryFilter, $first, $orderPar ) {

    $outIDs = abcfsl_db_staff_ids_sorted_all_or_cat( $parentID, $scodeCat, $orderPar );

    if( empty( $qryFilter ) ) { $qryFilter = $first; }
    //Menu ALL selected
    if( empty( $qryFilter ) ) { return $outIDs; }
    if( $qryFilter == '*' ) {  return $outIDs; }    

    $catsIDs = abcfsl_db_staff_ids_not_sorted_cats( $parentID, $qryFilter );
    return array_intersect( $outIDs, $catsIDs );
}

//Staff IDs. Filtered by category or categories. category="slug1,slug2,slug3,"
function abcfsl_db_staff_ids_not_sorted_cats( $parentID, $scodeCat ) {

    if( empty( $scodeCat ) ) { return array(); }

    $scodeCat = str_replace(' ', '', $scodeCat);
    $scodeCat = rtrim(trim($scodeCat), ',');

    //Single category
    if( strpos($scodeCat, ',') === false ){
        return abcfsl_db_staff_ids_not_sorted_cat( $parentID, $scodeCat );
    }

    $catIDs = array();
    $uniqueIDs = array();
    $cats = explode( ',', $scodeCat );

    foreach ( $cats as $catValue ) {
        $catIDs = abcfsl_db_staff_ids_not_sorted_cat( $parentID, $catValue );

        //Remove duplicate values (staff IDs) from an array
        $uniqueIDs = array_unique (array_merge ($uniqueIDs, $catIDs));
    }

    return $uniqueIDs;
}
//== CATEGORIES MENU END =========================

//== AZ MENU START ================================
function abcfsl_db_staff_ids_menu_az( $parentID, $filterField, $scodeCat, $qryFilter, $first, $orderPar ) {

    $outIDs = abcfsl_db_staff_ids_sorted_all_or_cat( $parentID, $scodeCat, $orderPar );

    if( empty( $qryFilter ) ) { $qryFilter = $first; }
    //Menu ALL selected
    if( empty( $qryFilter ) ) { return $outIDs; }
    if( $qryFilter == '*' ) {  return $outIDs; }

    $azIDs = abcfsl_db_staff_ids_not_sorted_az( $parentID, $filterField, $qryFilter );
    $outIDs = array_intersect( $outIDs, $azIDs );

    return $outIDs;
}
//== AZ MENU END ================================

//== MULTIFILTER START ===========================
//Menu type: MTF.  Multi filter output.
function abcfsl_db_mf_MTF( $parentID, $scodeCat, $optns, $menu, $filters, $orderPar ) {

    //Shortcode CAT filter. If present, first set is filterd by category.
    $qryType = '';
    if( !empty( $scodeCat ) ) { $qryType = 'CAT'; }

    //First run. No multi filters. Filtered by category if shortcode has a category option.;
    $runNoFilters = abcfsl_db_staff_ids_sorted_all_or_cat( $parentID, $scodeCat, $orderPar );

    $totalQty = count( $runNoFilters );
    if( $totalQty == 0 ) { return array(); }
    //-------------------------------------------
    if( $optns['filtersEmpty'] ) { return $runNoFilters; }

    //-------------------------------------------
    $filter1Value = $filters[1];
    $filter2Value = $filters[2];

    $filter1Type = $menu['filter1Type'];
    $filter2Type = $menu['filter2Type'];

    $filter1Field = $menu['filter1Field'];
    $filter2Field = $menu['filter2Field'];

    //---------------------------------
    $minLen = 3;
    $runF1 = abcfsl_db_mf_run( $parentID, $filter1Type, $filter1Value, $filter1Field, $runNoFilters, $minLen  );
    if( $runF1['qty'] == 0 ) { return array(); }

    $runF2 = abcfsl_db_mf_run( $parentID, $filter2Type, $filter2Value, $filter2Field, $runF1['postIDs'], $minLen );
    if( $runF2['qty'] == 0 ) { return array(); }

    $postIDsOut = array_intersect( $runNoFilters, $runF2['postIDs'] );
    //return array_intersect( $runNoFilters, $runF2['postIDs'] );

    //Remove excluded. EXCLUDED
    return abcfsl_db_staff_members_not_hidden( $parentID, $postIDsOut );
}

function abcfsl_db_mf_run( $parentID, $filterType, $filterValue, $filterField, $postIDsIn, $minLen ) {

    //$postIDsIn = all records from the last query.
    //$filterValue = filter to run.
    //Filter value empty = return all records from the last query.
    //Filter not empty = run query.
    //Return only matching records from last query and query in. Dicard others.

    $out['postIDs'] = $postIDsIn;
    $out['qty'] = count( $postIDsIn );

    if( $filterValue == '*') { $filterValue = ''; }
    if( !empty( $filterValue ) ){

        $postIDs = abcfsl_db_mf_run_filter_type( $parentID, $filterType, $filterValue, $filterField, $minLen );
        $postIDsOut = array_intersect( $postIDsIn, $postIDs );
        $out['postIDs'] = $postIDsOut;
        $out['qty'] = count( $postIDsOut );
    }
    return $out;
}

//Called from abcfsls_db_mf_MFP_NEW // SLSN
function abcfsl_db_mf_run_filter_type( $parentID, $filterType, $filterValue, $filterField, $minLen ) {

    $postIDs = array();

    switch ( $filterType ) {
        case 'C' :
            $postIDs = abcfsl_db_staff_ids_not_sorted_cat( $parentID, $filterValue );
            break;
        case 'AZ' :
            $postIDs = abcfsl_db_staff_ids_not_sorted_az( $parentID, $filterField, $filterValue );
            break;
        case 'TXT' :
            $postIDs = abcfsls_db_mf_txt( $parentID, $filterField, $filterValue, $minLen );
            break;
        case 'TXTM' :
            $postIDs = abcfsls_db_mf_txt_m( $parentID, $filterField, $filterValue, $minLen );
            break;
        case 'DROP':
            $postIDs = abcfsls_db_mf_drop_not_sorted( $parentID, $filterField, $filterValue );
            break;
       default:
            break;
    }

    return $postIDs;

    // case 'DROP':
    //     if ( function_exists( 'abcfsls_db_mf_drop_not_sorted' ) ){
    //         $postIDs = abcfsls_db_mf_drop_not_sorted( $parentID, $filterField, $filterValue );
    //     }
    //     else{
    //         $postIDs = abcfsls_db_mf_drop($parentID, $filterField, $filterValue );
    //     }
    //     break;


}
//== MULTIFILTER END ===========================

//=== ALL START ================================================
//== SORTED. ALL OR SHORTCODE CATEGORY FILTER. EXCLUDED REMOVED!
//Used by abcfsls_db_mf_MFP_NEW ?????? // SLSN
function abcfsl_db_staff_ids_sorted_all_or_cat( $parentID, $scodeCat, $orderPar ) {

    $outIDs = abcfsl_db_staff_ids_sorted_all( $parentID, $orderPar );

    if( !empty( $scodeCat ) ) {
        //Staff IDs, filtered by shordcode categories. NOT sorted.
        $catsIDs = abcfsl_db_staff_ids_not_sorted_cats( $parentID, $scodeCat );

        //Return only included in categories
        return array_intersect( $outIDs, $catsIDs );
    }
    //All staff members, sorted
    return $outIDs;
}

//Sort Order. ASC, DESC. post_parent = Template ID
function abcfsl_db_staff_ids_sorted_all( $parentID, $orderPar )  {

    $scodeOrder = $orderPar['scodeOrder'];
    $cSort = $orderPar['cSort'];
    $cSortOrder = $orderPar['cSortOrder'];
    
    $allIDs = array();

    $isCustomSort = false;
    if( !empty( $cSort ) ) {  
        //'_txt_F1'
        $cSort = '_txt_' . $cSort;
        $isCustomSort = true;  
    }

    if( $scodeOrder != 'DESC' ) {  $scodeOrder = 'ASC'; }
    if( $cSortOrder != 'DESC' ) {  $cSortOrder = 'ASC';  }

    //Sort Text --------------------------------------------
    if ( !$isCustomSort ) {
        //Sort Text ASC
        if (  $scodeOrder == 'ASC' ){
            $allIDs = abcfsl_db_staff_ids_sorted_asc( $parentID );
        }

        //Sort Text DESC 
        if (  $scodeOrder == 'DESC' ){
            $allIDs = abcfsl_db_staff_ids_sorted_desc( $parentID );
        }
    }
    //Custom sort -------------------------------------------------
    if ( $isCustomSort ) {

        //Custom sort ASC, Sort Text ASC
        if (  $cSortOrder == 'ASC' && $scodeOrder == 'ASC' ){
            $allIDs = abcfsl_db_staff_ids_c_sorted_asc_asc( $parentID, $cSort );
        }
        
        //Custom sort DESC, Sort Text ASC
        if (  $cSortOrder == 'DESC' && $scodeOrder =='ASC' ){
            $allIDs = abcfsl_db_staff_ids_c_sorted_desc_asc( $parentID, $cSort );
        }
        
        //Custom sort ASC, Sort Text DESC
        if (  $cSortOrder == 'ASC' && $scodeOrder =='DESC' ){
            $allIDs = abcfsl_db_staff_ids_c_sorted_asc_desc( $parentID, $cSort );
        }
        
        //Custom sort DESC, Sort Text DESC
        if (  $cSortOrder == 'DESC' && $scodeOrder == 'DESC' ){
            $allIDs = abcfsl_db_staff_ids_c_sorted_desc_desc( $parentID, $cSort );
        } 
    }  
    
    $outIDs = isset( $allIDs ) ? $allIDs : array(); 
   
    //Remove excluded. EXCLUDED
    return abcfsl_db_staff_members_not_hidden( $parentID, $outIDs );
}

//Get all not hidden.
function abcfsl_db_staff_members_not_hidden( $parentID, $postIDs ) {

    $allIDs = $postIDs;
    $hiddenIDs = abcfsl_db_staff_members_hidden( $parentID );
    //Remove excluded. EXCLUDED
    return array_diff ( $postIDs, $hiddenIDs );
}
//=== ALL END ================================================
//===  WRAPPERS END =========================================
//===========================================================

//===  STAFF IDs, SQL START ========================================
//Sort Order, ASC. post_parent = Template ID
function abcfsl_db_staff_ids_sorted_asc( $parentID ) {

    global $wpdb;
    return  $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY menu_order ASC", $parentID ));    
}

//Sort Order, DESC. post_parent = Template ID
function abcfsl_db_staff_ids_sorted_desc( $parentID ) {

    global $wpdb;
    return $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY menu_order DESC", $parentID ));
}

//Custom sort ASC, Sort Text ASC. 
function abcfsl_db_staff_ids_c_sorted_asc_asc( $parentID, $cSort ) {

    global $wpdb;
    $out = array();

    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value ASC, p.menu_order ASC", $parentID, $cSort ));

    return $out;
}

//Custom sort DESC, Sort Text ASC. 
function abcfsl_db_staff_ids_c_sorted_desc_asc( $parentID, $cSort ) {

    global $wpdb;
    $out = array();

    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value DESC, p.menu_order ASC", $parentID, $cSort ));

    return $out;
}

//Custom sort DESC, Sort Text ASC. 
function abcfsl_db_staff_ids_c_sorted_asc_desc( $parentID, $cSort ) {

    global $wpdb;
    $out = array();

    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value ASC, p.menu_order DESC", $parentID, $cSort ));

return $out;
}

//Custom sort DESC, Sort Text ASC. 
function abcfsl_db_staff_ids_c_sorted_desc_desc( $parentID, $cSort ) {

    global $wpdb;
    $out = array();

    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value DESC, p.menu_order DESC", $parentID, $cSort ));

return $out;
}

function abcfsl_db_staff_ids_not_sorted_az( $parentID, $filterField, $qryFilter ) {

    //qryFilter= 1 Letter; filterField = meta_key

    if( $filterField == '_sortTxtST' ){ $filterField = '_sortTxt'; }
    if( $filterField == 'postTitlePT' ){ $filterField = 'postTitle'; }

    global $wpdb;
    $out =array();

    if( $filterField == 'postTitle' ) {
        $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->posts p 
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND LEFT( p.post_title, 1 ) = %s;", $parentID, $qryFilter ));    
    }
    else {
        $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = %s
            AND LEFT( pm.meta_value, 1 ) = %s;", $parentID, $filterField, $qryFilter ));
    }

    return isset( $out ) ? $out : array();
}

function abcfsl_db_staff_ids_not_sorted_cat( $parentID, $filterValue ) {

    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->term_relationships tr
            JOIN $wpdb->posts p ON tr.object_id = p.ID
            JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            JOIN $wpdb->terms t ON tt.term_id = t.term_id
            WHERE p.post_parent = %d
            AND t.slug = %s
            AND p.post_status = 'publish'", $parentID, $filterValue ));

    return isset( $out ) ? $out : array();
}

function abcfsl_db_image_meta( $postID ) {
    global $wpdb;
    $meta = $wpdb->get_col(
    "SELECT meta_value
    FROM $wpdb->postmeta
    WHERE post_id = ' . $postID .
    ' AND meta_key = '_wp_attachment_metadata'");
    return $meta;
}

//-- PRETTY -----------------------------------------
//Get staffMemberID when rewrite is implemented. Fix for single page - multiple templates.
function abcfsl_db_post_id_by_pretty( $tplateID, $staffName, $multi='' ) {

    if( empty( $staffName ) ) { return 0; }

    $postID = null;
    global $wpdb;

    if( empty( $multi ) ){
        $postID = $wpdb->get_var( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON  pm.post_id = p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = '_pretty'
            AND pm.meta_value = %s;", $tplateID, $staffName ) );
    }
    else{
        $postID = $wpdb->get_var( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON  pm.post_id = p.ID
            WHERE p.post_status = 'publish'
            AND pm.meta_key = '_pretty'
            AND pm.meta_value = %s;", $staffName ) );
    }

    //get_var() function returns null when there are no results.
    if( is_null($postID) ) { return 0; }
    return $postID;   
}



// PRETTY For page title only
function abcfsl_db_post_id_by_pretty_name( $metaValue ) {

    if( empty( $metaValue ) ) { return 0; }

    global $wpdb;
    $postID = $wpdb->get_var( $wpdb->prepare(
        "SELECT pm.post_id
        FROM $wpdb->postmeta pm
        JOIN $wpdb->posts p ON  pm.post_id = p.ID
        WHERE p.post_status = 'publish'
        AND pm.meta_key = '_pretty'
        AND pm.meta_value = %s;", $metaValue ) );      

    if( is_null($postID) ) { return 0; }
    return $postID;
}

//Yoast SEO. Page title filter. PRETTY
function abcfsl_db_spg_title_by_pretty( $metaValue ) {

    $postID = abcfsl_db_post_id_by_pretty_name( $metaValue );
    if( is_null($postID) || $postID == 0 ) { return ''; }

    global $wpdb;
    $sPgTitle = $wpdb->get_var( $wpdb->prepare(
            "SELECT meta_value
            FROM $wpdb->postmeta
            WHERE meta_key = '_sPgTitle'
            AND post_id = %d;", $postID ) );

    return $sPgTitle;
}

//Single staff member shortcode
function abcfsl_db_staff_member( $staffID ) {

    global $wpdb;
    $postID = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE ID = %d
        AND post_status = 'publish'", $staffID ));

    return $postID;
}

function abcfsl_db_staff_members_hidden( $parentID ) {

    global $wpdb;
    return  $wpdb->get_col( $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts p
            JOIN $wpdb->postmeta pm
            ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = '_hideSMember'
            AND pm.meta_value = 1", $parentID ));
}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

//Not used yet
function abcfsl_db_staff_members_expired( $parentID ) {

    global $wpdb;

    $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts p
            JOIN $wpdb->postmeta pm
            ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = '_expireDT'
            AND pm.meta_value = 1", $parentID ));

    return $postIDs;
}

// ISOTOPE ???
function abcfsl_db_post_cat_slugs( $postID ) {

    global $wpdb;
    $slugs = $wpdb->get_col( $wpdb->prepare(
    "SELECT t.slug
    FROM $wpdb->term_relationships tr
    JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
    JOIN $wpdb->terms t ON tt.term_id  = t.term_id
    WHERE tr.object_id = %d
    AND tt.taxonomy = 'tax_staff_member_cat';", $postID ));

    return $slugs;
}

// ISOTOPE ???
function abcfsl_db_posts_cat_slugs( $parentID ) {

    global $wpdb;
    $slugs = $wpdb->get_results( $wpdb->prepare(
        "SELECT p.ID, t.slug
        FROM $wpdb->posts p
        JOIN $wpdb->term_relationships tr ON p.ID = tr.object_id
        JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        JOIN $wpdb->terms t ON tt.term_id = t.term_id
        WHERE p.post_parent = %d
        AND tt.taxonomy = 'tax_staff_member_cat'
        ORDER BY p.ID", $parentID ));

    return $slugs;
}

//Not used yet
function abcfsl_db_posts_sortTxt( $parentID ) {

    global $wpdb;
    $sortTxt = $wpdb->get_results( $wpdb->prepare(
            "SELECT pm.post_id, pm.meta_value
            FROM $wpdb->posts p
            JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
            WHERE p.post_parent = %d
            AND pm.meta_key = '_sortTxt'", $parentID ));

    return $sortTxt;
}
//==STAFF SEARCH - START ====================================
//Used only by abcfsls_db_mf_MFP_NEW ?????? // SLSN
//Returns all records. Sorted. Shortcode categories filtered. 

//In the future replace it by: abcfsl_db_staff_ids_sorted_all_or_cat
function abcfsl_db_staff_ids_no_menu( $parentID, $scodeCat, $scodeOrder ) {

    $orderPar['scodeOrder'] = $scodeOrder;
    $orderPar['cSort'] = '';
    $orderPar['cSortOrder'] = '';
    
    return abcfsl_db_staff_ids_sorted_all_or_cat( $parentID, $scodeCat, $orderPar );
}

//Return all records OR record filtererd by shortcode category option.?????????????????????
//Used only by deprecated abcfsls_db_mf_MFP (staff search // SLSN
function abcfsl_db_mf_run_no_filters( $parentID, $scodeCat, $scodeOrder='ASC' ) {

    return  abcfsl_db_staff_ids_no_menu( $parentID, $scodeCat, $scodeOrder );
}
//==STAFF SEARCH - END ====================================

//== GROUPS - START ===================================== 
//== GRPABC. Multidimensional array array of StaffID - Slug. Duplicates not removed.
function abcfsl_db_groups_staff_ids_slugs_abc( $parentID, $grpID, $slugsIN ) {

    $grpOptns = get_post_custom( $grpID );
    $metaKey = abcfsl_db_group_by_field( $grpOptns );
    if( empty( $metaKey ) ) { return  array(); }

    if( $metaKey == '_sortTxtST' ){ $metaKey = '_sortTxt'; }
    if( $metaKey == 'postTitlePT' ){ $metaKey = 'postTitle'; }
    $query = '';
    
    global $wpdb;
    if( $metaKey == 'postTitle' ) {
        $query = "SELECT p.ID staffID, LEFT( p.post_title, 1 ) slug 
            FROM $wpdb->posts p
            WHERE p.post_parent = {$parentID}
            AND p.post_status = 'publish'
            AND LEFT( p.post_title, 1 ) IN ( {$slugsIN} );";   
    }
    else {
        $query = "SELECT pm.post_id staffID, LEFT( pm.meta_value, 1 ) slug 
        FROM $wpdb->postmeta pm
        JOIN $wpdb->posts p ON pm.post_id = p.ID
        WHERE p.post_parent = {$parentID}
        AND p.post_status = 'publish'
        AND pm.meta_key = '{$metaKey}' 
        AND LEFT( pm.meta_value, 1 ) IN ( {$slugsIN} );";
    }

    //An associative array.
    $results = $wpdb->get_results( $query, ARRAY_A );
    return $results;   
} 

//== GRPTXT. Multidimensional array array of StaffID - Slug. Duplicates not removed.
function abcfsl_db_groups_staff_ids_slugs_txt( $parentID, $grpID, $slugsIN ) {

    $grpOptns = get_post_custom( $grpID );
    $metaKey = abcfsl_db_group_by_field( $grpOptns );
    if( empty( $metaKey ) ) { return  array(); }

    global $wpdb;
    $query = "SELECT pm.post_id staffID, pm.meta_value slug
        FROM $wpdb->postmeta pm
        JOIN $wpdb->posts p ON pm.post_id = p.ID
        WHERE p.post_parent = {$parentID}
        AND p.post_status = 'publish'
        AND pm.meta_key = '{$metaKey}' 
        AND pm.meta_value IN ( {$slugsIN} );";

    //An associative array.
    $results = $wpdb->get_results( $query, ARRAY_A );
    return $results;
}  

//Staff ID > slug. Remove duplicate IDs.
function abcfsl_db_groups_staff_ids_slugs_cat( $slugsIN ) {

    global $wpdb;

    $query = "
    SELECT tr.object_id staffID, t.slug
    FROM $wpdb->term_taxonomy tt
    JOIN $wpdb->terms t ON  tt.term_id = t.term_id
    JOIN $wpdb->term_relationships tr ON  tt.term_taxonomy_id = tr.term_taxonomy_id
    WHERE tt.taxonomy = 'tax_staff_member_cat'
    AND t.slug IN ( $slugsIN );    
    ";

    //An associative array.
    $results = $wpdb->get_results( $query, ARRAY_A );
    // Remove duplicate staff IDs
    //$resultsUnique = abcfsl_cnt_groups_unique_key( $results,'staffID' );

    return $results;
  }

// Slugs > Category name pairs. IN - comma delimited saved slug names;
function abcfsl_db_groups_cat_slug_name_pairs( $slugsIN ) {
    global $wpdb;

    $query = "
    SELECT t.slug, t.name
    FROM $wpdb->term_taxonomy tt
    JOIN $wpdb->terms t ON  tt.term_id = t.term_id
    WHERE tt.taxonomy = 'tax_staff_member_cat'
    AND t.slug IN ( $slugsIN );
    ";

    $results = $wpdb->get_results( $query );
    return $results;
}

//What field to use for meta_key DB parameter
function abcfsl_db_group_by_field( $grpOptns ){

    $grpFieldID = isset( $grpOptns['_grpFieldID'] ) ?  $grpOptns['_grpFieldID'][0] : '';
    $grpFieldType = isset( $grpOptns['_grpFieldType'] ) ? $grpOptns['_grpFieldType'][0] : '';
    if( empty( $grpFieldType ) ) { $grpFieldID = ''; }
    return $grpFieldType . $grpFieldID;
}
//== GROUPS - END =======================================

function abcfsl_db_get_post_title( $staffID ) {

  if( empty( $staffID ) ) { return ''; }

  global $wpdb;
  $postTitle = $wpdb->get_var( $wpdb->prepare(
      "SELECT post_title
      FROM $wpdb->posts
      WHERE ID = %d;", $staffID ) ); 

    //get_var() function returns null when there are no results.
    return $postTitle;
}
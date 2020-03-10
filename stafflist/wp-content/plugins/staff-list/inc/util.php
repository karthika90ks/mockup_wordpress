<?php
function abcfsl_util_grid_cols_qty( $colsXX, $colsXL, $colsLG, $colsMD, $colsSM ){

    if( $colsXX == 0 ) { $colsXX = 2; }
    if( $colsXL == 0 ) { $colsXL = 2; }
    if( $colsLG == 0 ) { $colsLG = 1; }
    if( $colsMD == 0 ) { $colsMD = 1; }
    if( $colsSM == 0 ) { $colsSM = 1; }

    if( $colsXX < $colsXL ){ $colsXX = $colsXL; }

    if( $colsLG > $colsXL ){ $colsLG = $colsXL; }
    if( $colsMD > $colsLG ){ $colsMD = $colsLG; }
    if( $colsSM > $colsMD ){ $colsSM = $colsMD; }

    $colsQty['XX'] = $colsXX;
    $colsQty['XL'] = $colsXL;
    $colsQty['LG'] = $colsLG;
    $colsQty['MD'] = $colsMD;
    $colsQty['SM'] = $colsSM;

    return $colsQty;
}

//Get fieldOrder meta. Convert saved meta to array.
function abcfsl_util_field_order( $tplateOptns, $isSingle=false ){

    $fieldOrder = '';
    $fieldOrderA = array();

    if( $isSingle ){
        $fieldOrder = isset( $tplateOptns['_fieldOrderS'] ) ? $tplateOptns['_fieldOrderS'][0] : '';
        if(empty($fieldOrder)){
            $fieldOrder = isset( $tplateOptns['_fieldOrder'] ) ? $tplateOptns['_fieldOrder'][0] : '';
        }
    }
    else {
        $fieldOrder = isset( $tplateOptns['_fieldOrder'] ) ? $tplateOptns['_fieldOrder'][0] : '';
    }

    if(empty($fieldOrder)){
        for ( $i = 1; $i <= 40; $i++ ) { $fieldOrderA[$i] = 'F' . $i; }
    }
    else{
        $fieldOrderA = unserialize( $fieldOrder );

        // Array has duplicates
        if(count(array_unique($fieldOrderA)) < count($fieldOrderA)){
            $fieldOrderU = array_unique($fieldOrderA);
            $fieldOrderA = array_combine(range(1, count($fieldOrderU)), array_values($fieldOrderU));
        }
    }

    //[1] => F1 [2] => F4 [3] => F5
    return $fieldOrderA;
}
//== CSS Class START =============================================
//OUT; tag with all . No spliting classes into staff and single.
function abcfsl_util_tag_base_attrs( $tag, $pfix, $baseCls, $customCls, $style, $id='' ){

    if( empty( $tag ) ){ return ''; }

    if( !empty( $baseCls ) ){ $baseCls = $pfix . $baseCls; }
    if( !empty( $customCls ) ){ $customCls = ' ' . $customCls; }

    $cls = $baseCls . $customCls;

    $div['cntrS'] = abcfl_html_tag( $tag, $id, $cls, $style );
    $div['cntrE'] = abcfl_html_tag_end( $tag );

    return $div;
}

//Field container classes. 
function abcfsl_util_field_tag_cls_bldr( $marginT, $tagFont, $tagCustCls, $isSingle, $pfix ){

    //???????Custom not needed - remove from dropdown.
    //----------------------------------------
    //Top margin. Class name or empty string if Default or Custom selected.
    $tagMarginT = abcfsl_util_cls_name_nc_bldr( $marginT, 'MT', $pfix );

    //Font Size. Class name or empty string if Default or Custom selected.
    $tagFont = abcfsl_util_cls_name_nc_bldr( $tagFont, 'F', $pfix );

    $optionsCls = trim($tagMarginT . ' ' . $tagFont);

    if( empty( $tagCustCls ) ){ return $optionsCls; }
    //-------------------------------------

    //Field container custom class. Get only staff list classes or single page classes.
    $fieldCntrCustCls= abcfsl_util_pg_type_cls_bldr( $tagCustCls, $isSingle );

    $mergedCls = abcfsl_util_merge_custom_cls( $optionsCls, $fieldCntrCustCls );
    return $mergedCls;
}

//Parse custom classes string. Returns string of classes: List, Single Page, Both. lst_ spg_
function abcfsl_util_pg_type_cls_bldr( $classes, $isSingle ){

    //Staff only class starts with: 'lst_'
    //Single Page only class starts with: 'spg_'
    $pgType = 'L';
    if( $isSingle ){ $pgType = 'S'; }

    $cls['clsLst'] = '';
    $cls['clsSpg'] = '';
    $cls['clsBoth'] = '';
    if(empty($classes)){ return '';}

    $hasLstCls = false;
    $hasSpgCls = false;

    if (strpos($classes,'lst_') !== false) { $hasLstCls = true; }
    if (strpos($classes,'spg_') !== false) { $hasSpgCls = true; }
    if(!$hasLstCls && !$hasSpgCls) { return $classes; }

    $inputFixed = preg_replace('/\s+/', ' ', $classes);
    $clsLst = '';
    $clsSpg = '';
    $clsBoth = '';

    $pieces = explode(' ', $inputFixed);

    foreach($pieces as $value){
        $prefix = substr($value, 0, 4);
        switch ($prefix){
        case 'lst_':
            $clsLst .= substr($value, 4) . ' ';
            break;
        case 'spg_':
            $clsSpg .= substr($value, 4) . ' ';
            break;
        default:
            $clsBoth .= $value . ' ';
            break;
        }
    }

    $out = '';
    switch ($pgType){
        case 'L':
            $out = trim($clsBoth . $clsLst);
            break;
        case 'S':
            $out = trim($clsBoth . $clsSpg);
            break;
        default:
            break;
    }
    return $out;
}

function abcfsl_util_class_name_bldr( $suffix, $clsBaseName, $pfix, $default='' ){

    if( empty( $suffix ) ) { return $default; }
    if( empty( $clsBaseName ) ) { return $default; }
    if( $suffix == 'C' ) { return $default; }

    return $pfix . $clsBaseName . $suffix;
}

//Can be used with D-default, C-custom , N-none option
function abcfsls_util_cls_name_bldr_ncd( $clsBaseName, $suffix, $pfix, $default='' ){

    if( $suffix == 'N' || $suffix == 'C' ){ return ''; }
    if( $suffix == 'D' ) { return $default; }
    if( empty( $clsBaseName ) ) { return $default; }

    return $pfix . $clsBaseName . $suffix;
}

//Custom class handler. Append custom classes to staff list class names (if prefix slp). Replace if not. 
function abcfsl_util_merge_custom_cls( $cls, $custCls ){
    
    if( empty( $custCls ) ) { return $cls; }
    if( empty( $cls ) ) { return $custCls; }
    //Check for leading sls
    $left = strtolower( substr( $custCls, 0, 4 ) );
    if( $left == 'slp ' ) { 
        return trim( $cls . ' ' . substr( $custCls, 3 )); 
    }
    return trim( $cls . ' ' .  $custCls);;
}

function abcfsl_util_cls_bldr( $cls, $pfix ){
    if( empty( $cls) ) { return ''; }
    return $pfix . $cls;
}

//Return class name or empty string. Used for cbos Class: None, Custom or Selected.
function abcfsl_util_cls_name_ncd_bldr( $suffix, $clsBaseName, $pfix, $default='' ){

    //abcfsl MT 10 = pfix clsBaseName suffix

    if( $suffix == 'N' || $suffix == 'C'|| $suffix == 'D' ){ return ''; }
    if( empty( $suffix ) ) { $suffix = $default; }
    if( empty( $suffix) ) { return ''; }
    return $pfix . $clsBaseName . $suffix;
}

//Return empty if N or C.
function abcfsl_util_cls_name_nc_bldr( $suffix, $clsBaseName, $pfix, $default='' ){

    if( $suffix == 'N' || $suffix == 'C' ){ return ''; }
    if( $suffix == 'D' ) { $suffix = $default; }
    if( empty( $suffix ) ) { $suffix = $default; }
    if( empty( $suffix) ) { return ''; }
    return ' ' . $pfix . $clsBaseName . $suffix;
}

function abcfsl_util_center_cls( $centerYN, $pfix ){
    $out = '';
    if( $centerYN == 'Y' ) { $out = ' ' . $pfix . 'MLRAuto'; }
    return $out;
}

function abcfsl_util_img_center_cls( $centerYN, $pfix ){
    $out = '';
    if( $centerYN == 'Y' ) { $out = ' ' . $pfix . 'ImgCenter'; }
    return $out;
}

function abcfsl_util_upper_cls( $upCase, $pfix ){
    $clsUpper = '';
    if( $upCase == 'Y' ) { $clsUpper = ' ' . $pfix . 'Upper' ; }
    return $clsUpper;
}

function abcfsl_util_lead_space( $in ){
    if( empty( $in ) ) { return ''; }
    return ' ' . $in;
}

//== CSS Class END =============================================
 function abcfsl_util_pg_cnt_parts_defaults( $noDataMsgT, $noDataMsgM ){

    //Menu no data Msg overwrites template message.
    if( empty( $noDataMsgM ) ) { $noDataMsgM = $noDataMsgT; } 

    $cntParts['itemsHTML'] = abcfsl_util_no_data_msg( $noDataMsgM, 0 );
    $cntParts['ldjsonSD'] = '';
    $cntParts['totalQty'] = 0;
    $cntParts['pgnCnt'] = '';
    //$cntParts['pgnB'] = '';

   return $cntParts;
}

 function abcfsl_util_pg_cnt_parts( $tplateOptns, $totalQty, $pageNo, $itemsHTML, $itemsSD, $pfix, $ajax, $top=0 ){

    $cntParts['itemsHTML'] = $itemsHTML;
    $cntParts['totalQty'] = $totalQty;
    $cntParts['ldjsonSD'] = abcfsl_struct_data( $itemsSD );
    $cntParts['pgnCnt'] = '';
    
    if( $top == 0 ){
        $cntParts['pgnCnt'] = abcfsl_paginator_cnt( $tplateOptns, $totalQty, $pageNo, $pfix, $ajax );
    }

   return $cntParts;
}

 //Categories or AZ menu. No data message.
function abcfsl_util_no_data_msg( $noDataMsg, $totalQty ){

    if( $totalQty > 0 ) { return '';}
    if( empty( $noDataMsg ) ) { return '';}

    $div = abcfsl_cnt_generic_div_simple( 'abcfslFS16 abcfslFW600 abcfslMLRAuto abcfslPadT5 abcfslTxtCenter', '' );

    return  $div['cntrS'] .  $noDataMsg . $div['cntrE'];
}



function abcfsl_util_imgs_folder_url( $socIconSize ){

    $imgsFolderUrl = ABCFSL_PLUGIN_URL . 'images';
    if( $socIconSize == 'C' ){
        $uploadDir = wp_upload_dir();
        $custom = 'abcfolio/staff-list';
        $baseURL = $uploadDir['baseurl'];
        $imgsFolderUrl = trailingslashit( $baseURL ) . $custom;
    }
    return trailingslashit( $imgsFolderUrl );
}

function abcfsl_util_ajax_loader( $imgFileName, $ajax, $pfix ){

    $imgsFolderUrl = ABCFSL_PLUGIN_URL . 'images';
    $imgURL = trailingslashit( $imgsFolderUrl ) . $imgFileName;

    $loaderS = abcfl_html_tag( 'div', $pfix . 'AjaxLoader_' . $ajax, '', '' );
    $img = abcfl_html_img_tag_resp( '', $imgURL, 'Loading...', '', $pfix . 'AjaxLoaderImg');
    return $loaderS . $img . abcfl_html_tag_end( 'div' );
}

//Get parts of shortcode option. Example: CAT-199
function abcfsl_util_scode_menu_parts( $scodeNo ){

    $scodParts['type'] = '';
    $scodParts['id'] = 0;

    if( $scodeNo == '0' || empty( $scodeNo ) ){ return $scodParts; }
    if( strlen( $scodeNo ) < 5 ) { return $scodParts; }

    $scodParts['type'] = substr( $scodeNo, 0, 3 );
    $scodParts['id'] = substr( $scodeNo, 4 );

    return $scodParts;
}

// GRPCAT GRPTXT GRPABC
function abcfsl_util_scode_group_parts( $scodeNo ){

    $scodParts['type'] = '';
    $scodParts['id'] = 0;

    if( $scodeNo == '0' || empty( $scodeNo ) ){ return $scodParts; }
    if( strlen( $scodeNo ) < 8 ) { return $scodParts; }

    $scodParts['type'] = substr( $scodeNo, 0, 6 );
    $scodParts['id'] = substr( $scodeNo, 7 );

    return $scodParts;
}

//Array has no values. edited from: if ($element === "")
function abcfsl_util_is_array_empty( $array ) {

    foreach ( $array as $element ) {
      if ( !empty( $element ) ){ 
        return false;
      }
    }
    return true;
}

function abcfsl_util_current_dt( $type='mysql', $gmt = 0, $outDiv=false ) {

    $dt = current_time( $type, $gmt = 0 );

    if ( $outDiv) {
        return abcfl_html_tag_with_content( $dt, 'div', 'xx' );
    } else {
        return $dt;
    }
}

//=== MENU =============================================
function abcfsl_util_menu_has_menu( $menuNo ){

    if( $menuNo == '0' ||  empty( $menuNo ) ){ return false; }
    if( strlen( $menuNo ) < 5 ) { return false; }
 
    return true;
 }
 
 function abcfsl_util_menu_defaults(){
 
     $minLen[1] = '3';
     $minLen[2] = '3';
     $minLen[3] = '3';
     $minLen[4] = '3';
     $minLen[5] = '3';
     $minLen[6] = '3';
 
     $menu['menuID'] = '';
     $menu['pageURL'] = '';
 
     $menu['first'] = '';
     $menu['qryFilter'] = '';
     $menu['menuType'] = 'NONE';
 
     $menu['filterField'] = '';
     $menu['filterType'] = '';
 
     $menu['filter1Type'] = '';
     $menu['filter2Type'] = '';
     $menu['filter3Type'] = '';
     $menu['filter4Type'] = '';
     $menu['filter5Type'] = '';
     $menu['filter6Type'] = '';
 
     $menu['filter1Field'] = '';
     $menu['filter2Field'] = '';
     $menu['filter3Field'] = '';
     $menu['filter4Field'] = '';
     $menu['filter5Field'] = '';
     $menu['filter6Field'] = '';
 
     $menu['minLen'] = $minLen;
 
     $menu['menuItemsHTML'] = '';
     $menu['noDataMsg'] = '';
     $menu['pfix'] = '';
 
     return $menu;
 }

 function abcfsl_util_filters_defaults(){
     $filters[1] = '';
     $filters[2] = '';
     $filters[3] = '';
     $filters[4] = '';
     $filters[5] = '';
     $filters[6] = '';
     $filters['btn'] = '';
     $filters['frmType'] = '';
 
     return $filters;
 }

 function abcfsl_util_scode_defaults() {

    $obj = ABCFSL_Main();
    $ver = str_replace('.', '' , $obj->pluginVersion);
    $prefix = $obj->prefix;

    //SCMENUID
    return array( 'id' => '0',
        'pversion' => $ver,
        'prefix' => $prefix,
        'category' => '',
        'random' => false,
        'top' => '',
        'master' => '',
        'staff-id' => '0',
        'staff-az' => '',
        'staff-category' => '',
        'smid' => '0',
        'staff-name' => '',
        'page' => '',        
        'menu-id' => '',
        'menu-scode' => '',
        'ajax' => '0',
        'group-id' => '',
        'search-form' => '',
        'date-plus' => '',
        'order' => 'ASC',
        'c-sort' => '',
        'multi-template' => '',
        'c-sort-order' => 'ASC'
   );
}

function abcfsl_util_is_active_bday(){
    if( is_plugin_active( 'abcfolio-staff-list-birthday/staff-list-birthday.php' ) ) {
        return true;
    }
    return false;
}








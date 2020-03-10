<?php
//ALL CONTENT HTML. 
//Called from a shortcode. Used by all layouts.
//Calls individual layouts. menus, pagination.
//Adds AJAX script when ajax parameter is set. 
function abcfsl_cnt_html( $scodeArgs ){

    $pageNo = $scodeArgs['page'];
    $pfix = $scodeArgs['prefix'];
    $ajax = $scodeArgs['ajax'];
    $staffID = $scodeArgs['staff-id'];
    $searchForm = $scodeArgs['search-form'];
    $menuScode = $scodeArgs['menu-scode'];

    // GRPCAT GRPTXT GRPABC -------------------------
    $grpParts = abcfsl_util_scode_group_parts( $scodeArgs['group-id'] );
    $grpID = $grpParts['id'];
    $grpType = $grpParts['type'];
    //------------------------------------
    //$cSort = $scodeArgs['c-sort'];
    //$cSortOrder = $scodeArgs['c-sort-order'];

    //$parentID is always used to get staff member IDs.
    $tplateID = $scodeArgs['id'];
    $parentID = $tplateID;
    if( $scodeArgs['master'] > 0 ){ $parentID = $scodeArgs['master']; }

    //SCMENUID
    $scodeMenuID = $scodeArgs['menu-id'];
    //=============================================================
    $tplateOptns = get_post_custom( $tplateID );

    //$sPageUrl = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    $lstCntrW = isset( $tplateOptns['_lstCntrW'] ) ? esc_attr( $tplateOptns['_lstCntrW'][0] ) : '';
    $lstACenter = isset( $tplateOptns['_lstACenter'] ) ? esc_attr( $tplateOptns['_lstACenter'][0] ) : 'Y';
    $lstCntrCls = isset( $tplateOptns['_lstCntrCls'] ) ? esc_attr( $tplateOptns['_lstCntrCls'][0] ) : '';
    $lstCntrStyle = isset( $tplateOptns['_lstCntrStyle'] ) ? esc_attr( $tplateOptns['_lstCntrStyle'][0] ) : '';
    $pgnationPgQty = isset( $tplateOptns['_pgnationPgQty'] ) ? $tplateOptns['_pgnationPgQty'][0] : 0;
    $pgnationTB = isset( $tplateOptns['_pgnationTB'] ) ? $tplateOptns['_pgnationTB'][0] : 'B';
    $pgnationColor = isset( $tplateOptns['_pgnationColor'] ) ? $tplateOptns['_pgnationColor'][0] : 'G';
    //------------------------------------------------

    //SCMENUID
    //$tplateMenuID = isset( $tplateOptns['_tplateMenuID'] ) ? esc_attr( $tplateOptns['_tplateMenuID'][0] ) : '';
    //$menuNo = $tplateMenuID;
    //if( empty( $tplateMenuID ) ) { $menuNo = $scodeMenuID; }

    //Menu tab deleted
    $menuNo = $scodeMenuID;
    $hasMenu = abcfsl_util_menu_has_menu( $menuNo );

    //-- MULTIFILTER START -------------------------------------
    $btn = '';
    $frmType = '';
    $filtersEmpty = true;
    $filters = abcfsl_util_filters_defaults();

    if( $hasMenu ){
        $filters = abcfsl_cnt_filter_post( $menuNo );
        $filtersEmpty = abcfsl_cnt_filters_empty( $filters );
        $btn = $filters['btn'];
        $frmType = $filters['frmType'];
        if( !empty( $searchForm ) ) { $frmType = $searchForm; }
    }
    //-- MULTIFILTER END -------------------------------------

    //No paging if there are any search criteria present.
    $pgnationPgQtyAjax = $pgnationPgQty;
    if( !$filtersEmpty ) {
        $pgnationPgQty = 0;
        $pageNo = 0;
        $tplateOptns['_pgnationPgQty'][0] = 0;
    }

    //-- AJAX -------------------------------------
    $ajaxMenu = false;
    $ajaxMFP = false;

    // tplateMenuID has been deprecated.
    //if( !empty( $tplateMenuID ) )  { $ajax = 0;  }
    if( $ajax > 0 ) { 
        $ajaxMenu = true;  
        $ajaxMFP = true;
    }

    //if( !empty( $menuNo ) && $ajax > 0 )  { $ajaxMenu = true;  }
    //if( $ajax > 0 ) { $ajaxMFP = true;  }

    //------------------------------------------------
    //?????????
    //$lstImgCls = isset( $tplateOptns['_lstImgCls'] ) ? esc_attr( $tplateOptns['_lstImgCls'][0] ) : $pfix . 'ImgCenter';
    //$tplateOptns['_lstImgCls'] = array($lstImgCls);

    //-- Plugin container --------------------------------------------
    $cntCntrStyle = abcfl_css_w_responsive( $lstCntrW, $lstCntrW ) . $lstCntrStyle;
    $centerCls = abcfsl_util_center_cls( $lstACenter, $pfix );
    $cntCntrCustomCls = $lstCntrCls . $centerCls . ' ' . 'SL_' . $scodeArgs['tplate'] . '_v' . $scodeArgs['pversion'];
    $gridCntr = abcfsl_cnt_generic_div( $pfix, 'GridCntr', $cntCntrCustomCls, $cntCntrStyle, '', '', $tplateID, 'Y', false);

    //-- Get menu -------------------------------------
    //Returns array: HTML, menu options and qry parameters OR qry parameters.
    //Menu HTML + menu options. Not search criteria. // MULTIFILTER
    $menu = abcfsl_util_menu_defaults();
    if( $hasMenu ) {
        $menu = abcfsl_cnt_menu_from_staff_shortcode( $menuNo, $scodeArgs, $filters, $ajaxMFP, $ajax ); 
    }

    $menuItemsHTML = $menu['menuItemsHTML'];
    if( $menuScode == 1 ) $menuItemsHTML = '';
    $menu['menuItemsHTML'] = '';
    //-----------------------------------
    $optns['tplateID'] =  $tplateID;
    $optns['parentID'] =  $parentID;
    $optns['pfix'] =  $pfix;
    $optns['ajax'] = $ajax;
    $optns['random'] = $scodeArgs['random'];
    $optns['scodeOrder'] = strtoupper($scodeArgs['order']);
    $optns['cSort'] =  strtoupper($scodeArgs['c-sort']);
    $optns['cSortOrder'] = strtoupper($scodeArgs['c-sort-order']);
    $optns['scodeCat'] = $scodeArgs['category'];        
    $optns['top'] = $scodeArgs['top'];
    $optns['staffID'] = $staffID;
    $optns['grpID'] = $grpID;
    $optns['grpType'] = $grpType;
    $optns['datePlus'] = $scodeArgs['date-plus'];
    //-- PG -------------------
    $optns['pageNo'] = $pageNo;
    $optns['pgnationPgQty'] =  $pgnationPgQty;

    //----------------------------------------------------
    $cntParts['itemsHTML'] = '';
    $cntParts['totalQty'] = 0;
    $cntParts['sdProperties'] = array();
    $cntParts['js'] = '';
    $cntParts['pgnCnt'] = '';
    $cntParts['ldjsonSD'] = '';


    // SFORM SEARCH FORM
    $showRecords = true;
    if( $btn == 'reset' && $frmType == 'SF' ) { $showRecords = false; }

    if( $filtersEmpty ) {
        if( $btn == 'search' && $frmType == 'SF' ) { $showRecords = false; }
    }

    // AJAX
    //ISOTOPE ???
     //Returns cntParts. Takes menu options. Returns filtered grid based on menu options.
    if( $showRecords ) {
        switch ( $scodeArgs['tplate'] ) {
            case 'A' :
                $cntParts = abcfsl_cnt_grid_a( $tplateOptns, $optns, $menu, $filters );
                break;
            case 'B' :
                $cntParts = abcfsl_cnt_grid_b( $tplateOptns, $optns, $menu, $filters );
                break;
            case 'C' :
                $cntParts = abcfsl_cnt_grid_c( $tplateOptns, $optns, $menu, $filters );
                break;                
            case 'L' :
                $cntParts = abcfsl_cnt_list( $tplateOptns, $optns, $menu, $filters );
                break;
            default:
                break;
        }
    }

    //== AJAX START ==================================
    if( $staffID > 0 ) { $ajax = 0;}

    $jsAjax = '';
    $ajaxItemsS = '';
    $ajaxDivE = '';
    $ajaxSdS = '';
    $ajaxPgnS = '';
    $ajaxLoader = '';

    //????????????????????????????????????????
    $pgnCnt = $cntParts['pgnCnt'];
    $pgnT = '';
    $pgnB = '';

    if ( $pgnationTB == 'T' ){ $pgnT = $pgnCnt; }
    else { $pgnB = $pgnCnt; }

    $ajaxPar['ajax'] = $ajax;
    $ajaxPar['tplateID'] = $tplateID;
    $ajaxPar['parentID'] = $parentID;
    $ajaxPar['pfix'] = $pfix;
    $ajaxPar['scodeArgs'] = $scodeArgs;
    $ajaxPar['scodeMenuID'] = $scodeMenuID;
    $ajaxPar['pgnationPgQty'] = $pgnationPgQtyAjax;
    $ajaxPar['menu'] = $menu;
    $ajaxPar['filters'] = $filters;
    //$ajaxPar['filtersEmpty'] = $filtersEmpty;
    $ajaxPar['pgnationColor'] = $pgnationColor;
    $ajaxPar['ajaxMenu'] = $ajaxMenu;
    $ajaxPar['ajaxMFP'] = $ajaxMFP;

    if( $ajax > 0 ) {
        $jsPar = abcfsl_js_params( $ajaxPar );
        $jsAjax = abcfsl_cnt_js_ajax( $jsPar );

        $ajaxItemsS = abcfl_html_tag( 'div', '', $jsPar['clsItemsCntr'], '' );
        $ajaxSdS = abcfl_html_tag( 'div', '', $jsPar['clsSDCntr'], '' );
        $ajaxPgnS = abcfl_html_tag( 'div', $jsPar['clsPgnCntr'], '', '' );
        $ajaxDivE = abcfl_html_tag_end( 'div' );

        if(!empty( $pgnT )) { $pgnT = $ajaxPgnS . $pgnT . $ajaxDivE; }
        if(!empty( $pgnB )) { $pgnB = $ajaxPgnS . $pgnB . $ajaxDivE; }

        //Ajax pagination container for ALL last.
        if( empty( $pgnT )  &&  empty( $pgnB ) ) { 
            if( $pgnationPgQtyAjax > 0 ) {
                if ( $pgnationTB == 'T' ){   
                    $pgnT = $ajaxPgnS . $ajaxDivE;                  
                }
                else { 
                    $pgnB = $ajaxPgnS . $ajaxDivE;
                 }
            }
         }

        $ajaxLoader = abcfsl_util_ajax_loader( 'ajax-loader-bert-gray.gif', $ajax, $pfix );
    }
    //== AJAX END ==================================

    //Render page
    $cntHTML = $menuItemsHTML .
            $gridCntr['cntrS'] .
            $pgnT .
            $ajaxLoader .
            $ajaxItemsS .
            $cntParts['itemsHTML'] .
            $ajaxDivE .
            $pgnB .
            $gridCntr['cntrE'];

    //Structured data
    $jsonLdSD = $ajaxSdS . $cntParts['ldjsonSD'] .  $ajaxDivE;

    // vCard ----------------------------------
    //abcfvc_mbox_vcard_test();
    //?????????????????????????????????
    //$currentDate = abcfsl_util_current_dt( 'Y-m-d', 1, true );
    //$cntHTML =  $currentDate . $cntHTML;

    return $jsAjax . $cntHTML . $jsonLdSD;
}

//=======================================================================
/*
 * Content builders. Used by all layouts. Returns single text field container + content.
 */

// //TEXT FIELD BUILDER. Renders single text field, container + content.
// function abcfsl_cnt_txt_field( $itemOptns, $tplateOptns, $itemID, $sPageUrl, $F, $isSingle, $pfix ){

//     $showFieldOn = '';
//     $showField = true;
//     $fieldType = 'N';

//      //Quit if field is not selected or hidden. //$F = F9 or SPTL
//     switch ( $F ){
//         case 'SL': //Social PRO
//             $showSocial = isset( $tplateOptns['_showSocial'] ) ? esc_attr( $tplateOptns['_showSocial'][0] ) : 'N';
//             if( $showSocial != 'Y' ) { return ''; }

//             $showFieldOn = isset( $tplateOptns['_showSocialOn'] ) ? esc_attr( $tplateOptns['_showSocialOn'][0] ) : 'Y';
//             $fieldType = 'SL';
//             break;
//         case 'SPTL': //Single Page Text link
//             $sPgLnkShow = isset( $tplateOptns['_sPgLnkShow'] ) ? $tplateOptns['_sPgLnkShow'][0] : 'N';
//             if( $sPgLnkShow != 'Y' ) { return ''; }
//             $showFieldOn = 'L';
//             $fieldType = 'SPTL';
//             break;
//        default:
//             $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? esc_attr( $tplateOptns['_fieldType_' . $F][0] ) :'N';
//             $hideField = isset( $tplateOptns['_hideDelete_' . $F] ) ? esc_attr( $tplateOptns['_hideDelete_' . $F][0] ) : 'N';
//             if( $fieldType == 'N' || $hideField != 'N' ) { return ''; }

//             $showFieldOn = isset( $tplateOptns['_showField_' . $F] ) ? esc_attr( $tplateOptns['_showField_' . $F][0] ) : 'L';
//             break;
//     }

//     //Quit if field is not selected or hidden.
//     switch ( $showFieldOn ){
//         case 'L': //List only
//             if( $isSingle ){ $showField = false; }
//             break;
//         case 'S': //Single page only
//             if( !$isSingle ){ $showField = false; }
//             break;
//        default:
//             break;
//     }
//     if( !$showField ){ return ''; }

//     //------------------------------------------------------------
//     $tagCls = '';
//     $marginT = '';
//     $tagFont = '';
//     $tagType = '';
//     $tagStyle = '';
//     $newTab = '';

//     $aTagParts['hrefUrl'] = '';
//     $aTagParts['hrefTxt'] = '';
//     $aTagParts['target'] = '';
//     $aTagParts['isSP'] = false;

//     switch ($F){
//         case 'SPTL':
//             $tagType = isset( $tplateOptns['_sPgLnkTag'] ) ? $tplateOptns['_sPgLnkTag'][0] : 'div';
//             $tagCustomCls = isset( $tplateOptns['_sPgLnkCls'] ) ? esc_attr( $tplateOptns['_sPgLnkCls'][0] ) : '';
//             //$tagStyle = isset( $tplateOptns['_sPgLnkStyle'] ) ? esc_attr( $tplateOptns['_sPgLnkStyle'][0] ) : '';
//             $tagStyle = '';
//             $marginT = isset( $tplateOptns['_sPgLnkMarginT'] ) ? $tplateOptns['_sPgLnkMarginT'][0] : 'N';
//             $tagFont = isset( $tplateOptns['_sPgLnkFont'] ) ? $tplateOptns['_sPgLnkFont'][0] : 'D';

//             $newTab = isset( $tplateOptns['_sPgLnkNT'] ) ? $tplateOptns['_sPgLnkNT'][0] : '0';
//             if( $newTab == '0' ) { $newTab = 'N';} else { $newTab = 'Y';}

//             $lineTxt = isset( $tplateOptns['_sPgLnkTxt'] ) ? esc_attr( $tplateOptns['_sPgLnkTxt'][0] ) : '';
//             break;
//        default:
//             $tagType = isset( $tplateOptns['_tagType_' . $F] ) ? esc_attr( $tplateOptns['_tagType_' . $F][0] ) : 'div';
//             $marginT = isset( $tplateOptns['_tagMarginT_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginT_' . $F][0] ) : 'N';
//             $tagFont = isset( $tplateOptns['_tagFont_' . $F] ) ? esc_attr( $tplateOptns['_tagFont_' . $F][0] ) : 'D';
//             $tagCustomCls = isset( $tplateOptns['_tagCls_' . $F] ) ? esc_attr( $tplateOptns['_tagCls_' . $F][0] ) : '';
//             $tagStyle = isset( $tplateOptns['_tagStyle_' . $F] ) ? esc_attr( $tplateOptns['_tagStyle_' . $F][0] ) : '';            
//             $newTab = isset( $tplateOptns['_newTab_' . $F] ) ? esc_attr( $tplateOptns['_newTab_' . $F][0] ) : 'N';

//             //Get href parts: url + link text + target. Returns empty if no URL
//             //$aTagParts = abcfsl_util_a_tag_parts( $itemOptns, $itemID, $sPageUrl, $F );
//             $aTagParts = abcfsl_spg_a_tag_parts( $itemOptns, $itemID, $sPageUrl, $F );
            

//             // HTML
//             $lineTxt = isset( $itemOptns['_txt_' . $F] ) ? $itemOptns['_txt_' . $F][0]  : '';            
//             break;
//     }

//     //-- Field container classes -------------------
//     $tagCls =  abcfsl_util_field_tag_cls_bldr( $marginT, $tagFont, $tagCustomCls, $isSingle, $pfix );
//     //------------------------------------------------------------
//     $isSP = $aTagParts['isSP'];
//     $onclick = '';
//     $args = '';
//     if( $isSP ){
//         $onclick = abcfsl_spg_a_tag_lnk_onclick( isset( $itemOptns['_imgLnkClick'] ) ? esc_attr( $itemOptns['_imgLnkClick'][0] ) : '' );
//         $args = abcfsl_spg_a_tag_lnk_args(isset( $itemOptns['_imgLnkArgs'] ) ? esc_attr( $itemOptns['_imgLnkArgs'][0] ) : '');
//     }
//     //------------------------------------------------------------
//     //'locale' => isset( $tplateOptns['_locale_' . $F] ) ? esc_attr( $tplateOptns['_locale_' . $F][0] ) : '',
//     $par = array(
//         'F' => $F,
//         'fieldType' => $fieldType,
//         'fieldTypeF' => ' ' . $fieldType . $F,
//         'tagCustomCls' => $tagCustomCls,
//         'tagMarginT' => $marginT,
//         'capMarginT' => isset( $tplateOptns['_captionMarginT_' . $F] ) ? $tplateOptns['_captionMarginT_' . $F][0] : 'N',
//         'tagFont' => $tagFont,
//         'tagType' => $tagType,
//         'tagCls' => $tagCls,
//         'lblCls' => isset( $tplateOptns['_lblCls_' . $F] ) ? esc_attr( $tplateOptns['_lblCls_' . $F][0] ) : '',
//         'txtCls' => isset( $tplateOptns['_txtCls_' . $F] ) ? esc_attr( $tplateOptns['_txtCls_' . $F][0] ) : '',
//         'tagStyle' => $tagStyle,
//         'lnkCls' => isset( $tplateOptns['_lnkCls _' . $F] ) ? esc_attr( $tplateOptns['_lnkCls_' . $F][0] ) : '',
//         'lnkStyle' => isset( $tplateOptns['_lnkStyle_' . $F] ) ? esc_attr( $tplateOptns['_lnkStyle_' . $F][0] ) : '',               
//         'lblStyle' => isset( $tplateOptns['_lblStyle_' . $F] ) ? esc_attr( $tplateOptns['_lblStyle_' . $F][0] ) : '',        
//         'txtStyle' => isset( $tplateOptns['_txtStyle_' . $F] ) ? esc_attr( $tplateOptns['_txtStyle_' . $F][0] ) : '',
//         'showAsTxt' => isset( $tplateOptns['_showAsTxt_' . $F] ) ? esc_attr( $tplateOptns['_showAsTxt_' . $F][0] ) : '0',
//         'cbomLayout' => isset( $tplateOptns['_cbomLayout_' . $F] ) ? $tplateOptns['_cbomLayout_' . $F][0] : 'R',

//         'dteYMD'  => isset( $itemOptns['_dteYMD_' . $F] ) ?  $itemOptns['_dteYMD_' . $F][0] : '', 
//         'dtFormat'  => isset( $tplateOptns['_dtFormat_' . $F] ) ? $tplateOptns['_dtFormat_' . $F][0] : '',

//         'lblTxt' => isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '', 
//         'url' => isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '',
//         'urlTxt' => isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '',
//         'tapAction' => isset( $itemOptns['_tapAction_' . $F] ) ? esc_attr( $itemOptns['_tapAction_' . $F][0] ) : '',

//         'newTab' => $newTab,
//         'lineTxt'  => $lineTxt,        
//         'hrefUrl' => $aTagParts['hrefUrl'],
//         'hrefTxt' => $aTagParts['hrefTxt'],
//         'target' => $aTagParts['target'],
//         'cbom' => isset( $itemOptns['_cbom_' . $F] ) ?  $itemOptns['_cbom_' . $F][0]  : '', 
//         'checkg' => isset( $itemOptns['_checkg_' . $F] ) ?  $itemOptns['_checkg_' . $F][0]  : '',       
//         'cbomSort' => isset( $tplateOptns['_cbomSort_' . $F] ) ? $tplateOptns['_cbomSort_' . $F][0] : 'N',
//         'cbomSortLocale' => isset( $tplateOptns['_cbomSortLocale_' . $F] ) ? $tplateOptns['_cbomSortLocale_' . $F][0] : '',        
//         'sPageUrl' => $sPageUrl,
//         'itemID'  => $itemID,
//         'isSingle'  => $isSingle,
//         'clsPfix'  => $pfix,
//         'statTxt'  => isset( $tplateOptns['_statTxt_' . $F] ) ? $tplateOptns['_statTxt_' . $F][0] : '',
//         'statTxtFs'  => isset( $tplateOptns['_statTxtFs_' . $F] ) ? $tplateOptns['_statTxtFs_' . $F][0] : '',
//         'onclick' => $onclick,
//         'args' => $args
//     );

//     $editorCnt  = isset( $itemOptns['_editorCnt_' . $F] ) ? esc_attr( $itemOptns['_editorCnt_' . $F][0] ) : '';
//     $noAutop = isset( $tplateOptns['_noAutop_' . $F] ) ? $tplateOptns['_noAutop_' . $F][0] : '';
//     $excludedSlugs = isset( $tplateOptns['_excludedSlugs_' . $F] ) ? esc_attr( $tplateOptns['_excludedSlugs_' . $F][0] ) : '';

//     $out = '';
//     switch ( $fieldType ){
//         case 'T': //Text
//         case 'PT': //Paragraph Text
//         case 'CBO':
//             $out = abcfsl_cnt_field_T( $par );
//             break;
//         case 'LT': //Static Lbl + Text
//         case 'LBLCBO': //Static Lbl + Text
//             $out = abcfsl_cnt_field_LT( $par );
//             break;
//         case 'STXT': //Static Text
//             $out = abcfsl_cnt_field_STXT( $par, $tplateOptns, $itemOptns, $F );
//             break;
//         case 'H': //Hyperlink
//             $out = abcfsl_cnt_field_H( $par );
//             break;
//         case 'TH': //Static Text + Hyperlink
//             $out = abcfsl_cnt_field_TH( $par );
//             break;
//         case 'EM': //Email
//             $out = abcfsl_cnt_field_EM( $par );
//             break;
//         case 'STXEM': //Email with static text
//             $out = abcfsl_cnt_field_STXEM( $par );
//             break;
//         case 'SLFONE': //Phone with static text
//             $out = abcfsl_cnt_fone_field_SLFONE( $par );
//             break;
//         case 'FONE': //Phone
//             $out = abcfsl_cnt_fone_field_FONE( $par );
//             break;                                    
//          case 'MP': //Multipart
//             $out = abcfsl_cnt_MP( $par, $tplateOptns, $itemOptns, $F );            
//             break;
//         case 'CE': //HTML
//             $out = abcfsl_cnt_field_WPE( $par, $editorCnt, $noAutop );
//             break;
//         case 'HL': //Horizontal Line
//             $out = abcfsl_cnt_field_HL( $par['tagCls'], $par['tagStyle'], $pfix );
//             break;
//         case 'SC': //Shortcode
//             $out = abcfsl_cnt_field_SC( $par );
//             break;
//         case 'SPTL':  //Single Page Text Link
//             $out = abcfsl_cnt_field_SPTL( $par, $itemOptns );
//             break;
//         case 'SH': //Single Page Hyperlink
//             $out = abcfsl_cnt_field_SH_legacy_field( $par, $itemOptns, $F );
//             break;
//         case 'SL': //Social Links
//             $out = abcfsl_cnt_icons_field_SL( $par, $itemOptns, $tplateOptns );
//             break;
//         case 'IMGCAP': //image with caption
//             $out = abcfsl_cnt_txt_img_field_IMGCAP( $par, $itemOptns );
//             break;
//         case 'IMGHLNK': //image hyperlink with caption
//             $out = abcfsl_cnt_txt_img_field_IMGHLNK( $par, $itemOptns );
//             break;
//         case 'SLDTE': //Static lbl + date
//             $out = abcfsl_cnt_date_field_SLDTE( $par, $itemOptns );
//             break;            
//         case 'CBOM': //Multiple Drop-downs.    
//             $out = abcfsl_cnt_field_CBOM( $par );
//             break;            
//         case 'CHECKG': //Checkbox group.
//             $out = abcfsl_cnt_field_CHECKG( $par );
//             break; 
//         case 'STARR': 
//             $out = abcfsl_cnt_icons_field_STARR( $par, $tplateOptns, $itemOptns, $F );
//             break; 
//         case 'ICONLNK': 
//             $out = abcfsl_cnt_icons_field_ICONLNK( $par, $tplateOptns, $itemOptns, $F );
//             break;  
//         case 'STFFCAT': 
//             $out = abcfsl_cnt_cats_field_STFFCAT( $par, $excludedSlugs );
//             break; 
//         case 'POSTTITLE':             
//             $out = abcfsl_cnt_field_POSTTITLE( $par );
//             break;                                                                                     
//        default:
//             break;
//     }
//     return $out;
// }

//==================================================================
function abcfsl_cnt_generic_div( $pfix, $baseCls, $customCls, $customStyle, $vAidCls, $divID, $itemID, $addItemCls, $isSingle ){

    $cntrCls = abcfsl_cnt_class_bldr( $pfix, $baseCls, $customCls, $isSingle, $vAidCls, $addItemCls, $itemID );

    $div['cntrS'] = abcfl_html_tag( 'div', $divID, $cntrCls, $customStyle );
    $div['cntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

function abcfsl_cnt_generic_div_simple( $customCls, $customStyle, $divID='' ){
    return abcfsl_cnt_generic_div( '', '', $customCls, $customStyle, '', $divID, '', 'N', false );
}

//Returns classes
function abcfsl_cnt_class_bldr( $pfix, $baseCls, $customCls, $isSingle=false, $vAidCls='', $addItemCls='N', $itemID='0' ){

    $cntrBaseCls = '';
    if( !empty( $baseCls ) ){ $cntrBaseCls = $pfix . $baseCls; }
    if( !empty( $vAidCls ) ){ $vAidCls = ' ' . $pfix . $vAidCls; }
    $custCls = abcfsl_util_pg_type_cls_bldr( $customCls, $isSingle );

    $itemCls = '';
    if($addItemCls == 'Y'){ $itemCls = ' ' . $cntrBaseCls . '_' . $itemID; }

    return  trim( $cntrBaseCls . ' ' . $custCls . $vAidCls . $itemCls );
}

function abcfsl_cnt_filters_empty( $filters ){

    //Array ( [1] => * [2] => * [3] => [4] => [5] => [6] => [btn] => search [frmType] => ) 
    //Check only first 6 items.
    $empty = true;
    for ($x = 1; $x <= 6; $x++) {        
        if( !empty( $filters[$x] ) ){ 
            if( $filters[$x] == '*' ) { continue; }           
            $empty = false;
            break;
        }
    }
    return $empty;
}
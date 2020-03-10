<?php
//Render Single Page content.
function abcfsl_cnt_spage( $scodeArgs ){

    $clsPfix = $scodeArgs['prefix'];
    $tplateID = $scodeArgs['id'];
    $pversion = $scodeArgs['pversion'];
    $staffID = abcfsl_spg_a_tag_staff_member_id ( $scodeArgs );

    //Both qry args are missing. Show blank page. 
    if( $staffID == 0 ) {  return '';  }
    //PRETTY Pretty permalinks. No records.
    //if( $staffID == -1 ) {  return abcfl_html_tag_with_content( 'Sorry, no results were found.', 'p', '' );  }
    if( $staffID == -1 ) {  return '';  }

    //Check if post has been published ----
    $postStatus = get_post_status( $staffID );
    if( $postStatus != 'publish' ) { return ''; }

    //Why single page is blank.
    $itemOptns = get_post_custom( $staffID );
    if( empty( $itemOptns ) ) {  return ''; }

    $hideSMember = isset( $itemOptns['_hideSMember'] ) ? esc_attr( $itemOptns['_hideSMember'][0] ) : '0';
    $hideSPgLnk = isset( $itemOptns['_hideSPgLnk'] ) ? $itemOptns['_hideSPgLnk'][0] : '0';
    if( $hideSMember == 1 ) { return ''; }    
    if( $hideSPgLnk == 1 ) { return ''; }
     //-----------------------------------------
    $tplateOptns = get_post_custom( $tplateID );

     //==GRID C GRID D =====================================
    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '1';

    $spgLayout = 'N';
    switch ( $lstLayout ) {
        case 1:
        case 2:
        case 3:    
            $spgLayout = 'IMG';
            break;
        case 4:    
            $spgLayout = 'NOIMG';
            break;    
        default:
            break;
    }

    if( $spgLayout == 'N' ) { return ''; }

    $hasImg = abcfsl_cnt_spage_has_img( $tplateOptns, $itemOptns );
    if( !$hasImg ) { $spgLayout = 'NOIMG'; }
    $pl = 'i';
    if( $spgLayout == 'NOIMG' ) { $pl = 'ni'; }

    //----------------------------------
    $spgCntrW = isset( $tplateOptns['_spgCntrW'] ) ? esc_attr( $tplateOptns['_spgCntrW'][0] ) : '';
    $spgACenter = isset( $tplateOptns['_spgACenter'] ) ? esc_attr( $tplateOptns['_spgACenter'][0] ) : 'Y';

    $spgCntrCls = isset( $tplateOptns['_spgCntrCls'] ) ? esc_attr( $tplateOptns['_spgCntrCls'][0] ) : '';
    //---------------------------------------------------------------    
    $cntrStyle = trim( abcfl_css_w_responsive( $spgCntrW, $spgCntrW ) ) ;
    $centerCls = abcfsl_util_center_cls( $spgACenter, $clsPfix );

    //Single Page container
    $spgCntrCustCls = trim( $centerCls . ' ' . $spgCntrCls );
    //$spgCntrCustCls = $centerCls;
    $spgCntrID = 'slv' . $pversion . '_t' . $tplateID . '_sm' . $staffID . '_pl' . $pl;
    $spgCntr = abcfsl_util_tag_base_attrs( 'div', $clsPfix, 'SPgCntr', $spgCntrCustCls, $cntrStyle, $spgCntrID );

    $out['itemHTML'] = '';
    $out['itemSD'] = '';

    switch ($spgLayout) {
        case 'IMG':
            $outItem = abcfsl_cnt_spage_cnt_IMG( $staffID, $tplateOptns, $itemOptns, $clsPfix );
            break;
        case 'NOIMG':
            $outItem = abcfsl_cnt_spage_cnt_NOIMG( $staffID, $tplateOptns, $itemOptns, $clsPfix );
            break;            
        default:
            break;
    }

    //Return Grid container + all items. SDATA
    $cntHTML = $spgCntr['cntrS'] . $outItem['itemHTML'] . $spgCntr['cntrE'];
    $cntSD = abcfsl_struct_data( $outItem['itemSD'] );

    return $cntHTML . $cntSD;
}

function abcfsl_cnt_spage_has_img( $tplateOptns, $itemOptns ){

    $hasImg = true;
    $imgUrlS = isset( $itemOptns['_imgUrlS'] ) ? esc_attr( $itemOptns['_imgUrlS'][0] ) : '';
    if( empty( $imgUrlS ) ){
        $placeholder = abcfsl_img_placeholder( $tplateOptns, true );
        if( empty( $placeholder['imgUrl'] ) ){  $hasImg = false; }
    }
    return $hasImg;
}

//== IMG START ======================================================
function abcfsl_cnt_spage_cnt_IMG( $staffID, $tplateOptns, $itemOptns, $clsPfix ){

    $colL = isset( $tplateOptns['_spgCols'] ) ? esc_attr( $tplateOptns['_spgCols'][0] ) : '6';

    $out['itemHTML'] = '';
    $out['itemSD'] = '';

    $imgCntr = abcfsl_cnt_spage_img_cntr( $staffID, $tplateOptns, $itemOptns, $colL, $clsPfix );
    $txtHTML = abcfsl_cnt_spage_txt_section_m( $staffID, $itemOptns, $tplateOptns, $clsPfix );

    //================================================
    $spgCClsT = isset( $tplateOptns['_spgCClsT'] ) ? esc_attr( $tplateOptns['_spgCClsT'][0] ) : '';
    $spgCClsM = isset( $tplateOptns['_spgCClsM'] ) ? esc_attr( $tplateOptns['_spgCClsM'][0] ) : '';
    $spgCClsB = isset( $tplateOptns['_spgCClsB'] ) ? esc_attr( $tplateOptns['_spgCClsB'][0] ) : '';
    $spgMMarginT = isset( $tplateOptns['_spgMMarginT'] ) ? esc_attr( $tplateOptns['_spgMMarginT'][0] ) : 'N';
    $baseClsM = abcfsl_cnt_spage_base_cls_m_cntr( $spgMMarginT, $clsPfix );

    $spgCntrT = abcfsl_util_tag_base_attrs( 'div', $clsPfix, '', $spgCClsT, '' );
    $spgCntrM = abcfsl_util_tag_base_attrs( 'div', $clsPfix, $baseClsM, $spgCClsM, '' );
    $spgCntrB = abcfsl_util_tag_base_attrs( 'div', $clsPfix, '', $spgCClsB, '' );

    if( !empty( $txtHTML['T'] ) ) { $txtHTML['T'] =  $spgCntrT['cntrS'] . $txtHTML['T'] . $spgCntrT['cntrE']; }
    if( !empty( $txtHTML['M'] ) || !empty( $imgCntr ) ) { $txtHTML['M'] =  $spgCntrM['cntrS'] . $imgCntr . $txtHTML['M'] . $spgCntrM['cntrE'];   }
    if( !empty( $txtHTML['B'] ) ) { $txtHTML['B'] =  $spgCntrB['cntrS'] . $txtHTML['B'] . $spgCntrB['cntrE']; }

   //SDATA
   $out['itemHTML'] = $txtHTML['T'] . $txtHTML['M'] . $txtHTML['B'];
   $out['itemSD'] = abcfsl_struct_data_item_single( $tplateOptns, $itemOptns );
   return $out;

}

function abcfsl_cnt_spage_base_cls_m_cntr( $marginT, $clsPfix ){
    $clsMT = abcfsl_util_cls_name_ncd_bldr( $marginT, 'MT', $clsPfix );
    return trim ( 'SPgCntrM abcfClrFix '  . $clsMT );
}

function abcfsl_cnt_spage_img_cntr( $staffID, $tplateOptns, $itemOptns, $colL, $clsPfix ){

    $itemOptns['_imgLnkL'] = array('');

    //Single page uses imgUrlL paramers to render an image. If imgUrlS != 'SP' it will replace imgUrlL value and related settings.
    $imgUrlS = isset( $itemOptns['_imgUrlS'] ) ? esc_attr( $itemOptns['_imgUrlS'][0] ) : '';
    if( $imgUrlS != 'SP' ){
        $itemOptns['_imgUrlL'] = array( $imgUrlS );
        $imgIDS = isset( $itemOptns['_imgIDS'] ) ? esc_attr( $itemOptns['_imgIDS'][0] ) : 0;
        $itemOptns['_imgIDL'] = array( $imgIDS );
    }

    $spgMICls = isset( $tplateOptns['_spgMICls'] ) ? esc_attr( $tplateOptns['_spgMICls'][0] ) : '';
    //-------------------------------------------------
    $par['pgLayout'] = 100;
    $par['itemID'] = $staffID;
    $par['colL'] = $colL;
    $par['clsPfix'] = $clsPfix;
    $par['vAidCls'] = '';
    $par['sPageUrl'] = '';
    $par['isSingle'] = true;
    $par['custCls'] = $spgMICls;

    return abcfsl_cnt_img_cntr( $tplateOptns, $itemOptns, $par  );
}

// Text fields + M container & M fields.
function abcfsl_cnt_spage_txt_section_m( $staffID, $itemOptns, $tplateOptns, $clsPfix ){

    $colL = isset( $tplateOptns['_spgCols'] ) ? esc_attr( $tplateOptns['_spgCols'][0] ) : '6';
    $colR = (12 - $colL);
    $spgMTCls = isset( $tplateOptns['_spgMTCls'] ) ? esc_attr( $tplateOptns['_spgMTCls'][0] ) : '';

    //TxtCntrSPg = padding-left: 10px; PadLPc5 
    $par['pfix'] = $clsPfix;
    $par['colR'] = $colR;
    $par['colCntrCls'] = 'TxtColSPg';
    $par['txtCntrCls'] = abcfsl_cnt_spage_txt_cntr_default_cls( $spgMTCls );
    $par['custCls'] = $spgMTCls;
    $par['center'] = 'Center575';
    $par['custStyle'] = '';

    $divMiddle = abcfsl_cnt_spage_txt_m_divs( $par );
    //-----------------------------------------------
    $outHTML = abcfsl_cnt_spage_txt_sections( $staffID, $itemOptns, $tplateOptns, $clsPfix );

    if( !empty( $outHTML['M'] ) ) { $outHTML['M'] =  $divMiddle['cntrS'] . $outHTML['M'] . $divMiddle['cntrE']; }

    return $outHTML;
}

// Text section divs. No content. Column div + Txt container div
function abcfsl_cnt_spage_txt_m_divs( $par ){

    //Replacement for: abcfsl_cnt_txt_cntr_divs( $par );
    $pfix = $par['pfix'];
    $txtCntrCls = $par['txtCntrCls'];
    $txtCntrCustCls = $par['custCls'];
    $txtCntrCustStyle = $par['custStyle'];
    $center = $par['center'];

    $colCntrCls = ' ' . $pfix . $par['colCntrCls'];
    $wrapClsBase = 'LstCol';

    if( !empty( $txtCntrCls ) ) { $txtCntrCls =  ' ' . $pfix . $txtCntrCls;  }
    if( !empty( $center ) ) { $center =  ' ' . $pfix . $par['center'];  }
    if( !empty( $txtCntrCustCls ) ) { $txtCntrCustCls =  ' ' . $pfix . $txtCntrCustCls;  }

    $clsTxtCntr = rtrim( $txtCntrCls  . $txtCntrCustCls . $center );
    $clsColumnCntr = $pfix . $wrapClsBase . ' ' . $pfix . $wrapClsBase . '-' . $par['colR'] . $colCntrCls;

    $colCntrS = abcfl_html_tag( 'div', '', $clsColumnCntr, '' );
    $txtCntrS = abcfl_html_tag( 'div', '', $clsTxtCntr, $txtCntrCustStyle );

    $div['cntrS'] = $colCntrS . $txtCntrS;
    $div['cntrE'] = abcfl_html_tag_ends( 'div,div');

    return $div;
}

//Add default class if there is no custom one.
function abcfsl_cnt_spage_txt_cntr_default_cls( $spgMTCls ){
    $out = '';
    if( empty( $spgMTCls ) ) { $out = 'PadLPc5'; }
    return $out;
}
//== IMG END ======================================================

//=== NOIMG START ==============================================
function abcfsl_cnt_spage_cnt_NOIMG( $staffID, $tplateOptns, $itemOptns, $clsPfix ){

    $out['itemHTML'] = '';
    $out['itemSD'] = '';

    $txtHTML = abcfsl_cnt_spage_txt_sections( $staffID, $itemOptns, $tplateOptns, $clsPfix );

    //---------------------------------------
    $spgCClsT = isset( $tplateOptns['_spgCClsT'] ) ? esc_attr( $tplateOptns['_spgCClsT'][0] ) : '';
    $spgCClsM = isset( $tplateOptns['_spgCClsM'] ) ? esc_attr( $tplateOptns['_spgCClsM'][0] ) : '';
    $spgCClsB = isset( $tplateOptns['_spgCClsB'] ) ? esc_attr( $tplateOptns['_spgCClsB'][0] ) : '';

    $spgCntrT = abcfsl_util_tag_base_attrs( 'div', $clsPfix, '', $spgCClsT, '' );
    $spgCntrM = abcfsl_util_tag_base_attrs( 'div', $clsPfix, '', $spgCClsM, '' );
    $spgCntrB = abcfsl_util_tag_base_attrs( 'div', $clsPfix, '', $spgCClsB, '' );

    // Add container divs if there is a content.
    if( !empty( $txtHTML['T'] ) ) { $txtHTML['T'] =  $spgCntrT['cntrS'] . $txtHTML['T'] . $spgCntrT['cntrE']; }
    if( !empty( $txtHTML['M'] ) ) { $txtHTML['M'] =  $spgCntrM['cntrS'] . $txtHTML['M'] . $spgCntrM['cntrE']; }
    if( !empty( $txtHTML['B'] ) ) { $txtHTML['B'] =  $spgCntrB['cntrS'] . $txtHTML['B'] . $spgCntrB['cntrE']; }

   $out['itemHTML'] = $txtHTML['T'] . $txtHTML['M'] . $txtHTML['B'];
   $out['itemSD'] = abcfsl_struct_data_item_single( $tplateOptns, $itemOptns );

   return $out;
}
//=== NOIMG END ==============================================



//SPg gontent divided by sections T,M,B.
function abcfsl_cnt_spage_txt_sections( $staffID, $itemOptns, $tplateOptns, $clsPfix ){

    $outHTML['T'] = '';
    $outHTML['M'] = '';
    $outHTML['B'] = '';

    //List of all fields in sort order. Get all text lines for a single record.
    $fieldOrder = abcfsl_util_field_order( $tplateOptns, true );

    //Template built-in styles for individual fields
    $spgFieldsStyle = abcfsl_cnt_spage_field_built_in_styles( $tplateOptns, $fieldOrder );

    foreach ( $fieldOrder as $F ) {
        $fieldCntrSPg = isset( $tplateOptns['_fieldCntrSPg_' . $F] ) ? esc_attr( $tplateOptns['_fieldCntrSPg_' . $F][0] ) : '';

        switch ( $fieldCntrSPg ) {
            case 'M':
                $outHTML['M'] .= abcfsl_cnt_txt_field( $itemOptns, $spgFieldsStyle, $staffID, '', $F, true, $clsPfix );
                break;
            case 'T':
                 $outHTML['T'] .= abcfsl_cnt_txt_field( $itemOptns, $spgFieldsStyle, $staffID, '', $F, true, $clsPfix );
                break;
            case 'B':
                $outHTML['B'] .= abcfsl_cnt_txt_field( $itemOptns, $spgFieldsStyle, $staffID, '', $F, true, $clsPfix );
                break;
            default:
                $outHTML['M'] .= abcfsl_cnt_txt_field( $itemOptns, $spgFieldsStyle, $staffID, '', $F, true, $clsPfix );
                break;
        }
    }
    return $outHTML;
}

//Replace built-in staff field styles with single page styling, if set.
function abcfsl_cnt_spage_field_built_in_styles( $tplateOptns, $fieldOrder ){

    foreach ( $fieldOrder as $F ) {
        $tagTypeSPg = isset( $tplateOptns['_tagTypeSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagTypeSPg_' . $F][0] ) : '';
        $tagFontSPg = isset( $tplateOptns['_tagFontSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagFontSPg_' . $F][0] ) : '';
        $tagMarginTSPg = isset( $tplateOptns['_tagMarginTSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginTSPg_' . $F][0] ) : '';

        if( !empty( $tagTypeSPg ) ) { $tplateOptns['_tagType_' . $F][0] = $tagTypeSPg; }
        if( !empty( $tagFontSPg ) ) { $tplateOptns['_tagFont_' . $F][0] = $tagFontSPg; }
        if( !empty( $tagMarginTSPg ) ) { $tplateOptns['_tagMarginT_' . $F][0] = $tagMarginTSPg; }
    }

    return $tplateOptns;
}
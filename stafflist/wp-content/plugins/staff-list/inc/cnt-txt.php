<?php
//=== LIST, GRID B, SINGLE - START =================================
//Text section container + text fields. (all input fields)
function abcfsl_cnt_txt_cntr( $tplateOptns, $itemOptns, $optns ){

    $pfix = $optns['clsPfix'];
    $isSingle = $optns['isSingle'];
    $itemID = $optns['itemID'];
    $sPageUrl = $optns['sPageUrl'];

    $txtFieldsHTML  = '';
    $vAidCls = '';
    if( $optns['vAid'] == 'Y' ) { $vAidCls = ' ' . $pfix . 'VAidTxt'; }

    //Text container custom CSS. Defaults to 'PadLPc5'  
    $lstTxtCntrCustomCls = isset( $tplateOptns['_lstTxtCntrCls'] ) ? esc_attr( $tplateOptns['_lstTxtCntrCls'][0] ) : $pfix . 'PadLPc5';

    $par['colR'] = $optns['colR'];
    $par['pfix'] = $pfix;
    $par['custCls'] = abcfsl_util_pg_type_cls_bldr( $lstTxtCntrCustomCls, $isSingle );
    $par['custStyle'] = isset( $tplateOptns['_lstTxtCntrStyle'] ) ? esc_attr( $tplateOptns['_lstTxtCntrStyle'][0] ) : '';
    $par['vAidCls'] = $vAidCls;
    $par['pgLayout'] = $optns['pgLayout'];
    $par['center'] = $optns['center'];
    $par['txtCntrCls'] = $optns['txtCntrCls'];
    $par['colWrapBaseCls'] = $optns['colWrapBaseCls'];
    //---------------------------------------
    //Txt column wrap (div) + Txt container div.
    $txtColDivs = abcfsl_cnt_txt_cntr_divs( $par );

    //List of all fields in sort order. Get all text lines for a single record.
    $fieldOrder = abcfsl_util_field_order( $tplateOptns, $isSingle ); 

    foreach ( $fieldOrder as $F ) {
        $txtFieldsHTML .= abcfsl_cnt_txt_field( $itemOptns, $tplateOptns, $itemID, $sPageUrl, $F, $isSingle, $pfix );
    }
    return $txtColDivs['cntrS'] . $txtFieldsHTML . $txtColDivs['cntrE'];

//.abcfslPadLPc10{ padding-left: 10%; }
//.abcfslTxtCenter { text-align: center; }
//.abcfslPadLRPc0 { padding-left: 0; padding-right: 0; }

//<div class="abcfslLstCol abcfslLstCol-7 abcfslLstTxtCol">
//<div class="abcfslLst1TxtCntr abcfslPadLPc10 abcfslTxtCenter767 abcfslPadLRPc0767">
// ---  text fields  ---------------------
//</div>
//</div>
}

// Text section divs. No content. Column div + Txt container div
function abcfsl_cnt_txt_cntr_divs( $par ){

    $pgLayout = $par['pgLayout'];
    $colR = $par['colR'];
    $pfix = $par['pfix'];
    $colWrapBaseCls = $par['colWrapBaseCls'];
    $txtCntrCls = $par['txtCntrCls'];
    $txtCntrCustCls = $par['custCls'];
    $txtCntrCustStyle = $par['custStyle'];
    $vAidCls = $par['vAidCls'];
    $center = $pfix . $par['center'];
    //$center = $pfix . 'Center575';

    $clsColWrap = ' ' . $pfix . $colWrapBaseCls;
    $wrapClsBase = 'LstCol';

    //Center text if viewport smaller than?. ADD classes for all 1 column options
    //Media queries class
    $mQCls = '';
    //List (1), Grid B (2), Grid A (3), Single(100), Isotope A (200), Isotope B (201)
    switch ( $pgLayout ) {
        case 100 :
            $mQCls = $center;
            break;
        case 2 :
            $mQCls = $center;
            break;
        case 201 :
            $mQCls = $center;
            $wrapClsBase = 'ILstCol';
            break;
        default:
            break;
   }
    //------------------------------------------------
    $clsTxtCntr = rtrim( ' ' . $pfix . $txtCntrCls . ' ' . $mQCls . ' ' . $txtCntrCustCls );
    $clsColumnCntr = $pfix . $wrapClsBase . ' ' . $pfix . $wrapClsBase . '-' . $colR . $clsColWrap . $vAidCls;

    $colCntrS = abcfl_html_tag( 'div', '', $clsColumnCntr, '' );
    $txtCntrS = abcfl_html_tag( 'div', '', $clsTxtCntr, $txtCntrCustStyle );

    $div['cntrS'] = $colCntrS . $txtCntrS;
    $div['cntrE'] = abcfl_html_tag_ends( 'div,div');

    return $div;
}
//=== LIST, GRID B, SINGLE - END ==============================================

//=== GRID A - START ====================================================
function abcfsl_cnt_txt_cntr_grid_a( $itemOptns, $tplateOptns, $par, $fieldOrder ){

    $itemID = $par['itemID'];
    $par['colL'] = '';
    $pfix = $par['clsPfix'];
    $par['vAidCls'] = 'N';
    $addMaxW = $par['addMaxW'];
    //$par['cntrCls'] = 'TxtCntrGridB';

    $lstTxtCntrCls = isset( $tplateOptns['_lstTxtCntrCls'] ) ? esc_attr( $tplateOptns['_lstTxtCntrCls'][0] ) : '';
    $lstTxtCntrStyle = isset( $tplateOptns['_lstTxtCntrStyle'] ) ? esc_attr( $tplateOptns['_lstTxtCntrStyle'][0] ) : '';

    $maxWCntr['cntrS'] = '';
    $maxWCntr['cntrE'] = '';
    if($addMaxW == 'Y'){
        $imgUrl = isset( $itemOptns['_imgUrlL'] ) ? esc_attr( $itemOptns['_imgUrlL'][0] ) : '';
        $imgIDL = isset( $itemOptns['_imgIDL'] ) ? esc_attr( $itemOptns['_imgIDL'][0] ) : 0;
        $maxWCntr = abcfsl_cnt_txt_cntr_grid_a_max_w_wrap( $tplateOptns, $imgIDL, $imgUrl, $addMaxW );
    }
    $itemLinesHTML  = '';
    $vAidCls = '';
    if( $par['vAid'] == 'Y' ) { $vAidCls = ' ' . $pfix . 'VAidTxt'; }

    //cnt-txt.php
    $div = abcfsl_cnt_txt_cntr_grid_a_div( $par['cntrCls'], $pfix, $lstTxtCntrCls, $lstTxtCntrStyle, $vAidCls, '', '', 'N', false );

    foreach ( $fieldOrder as $F ) {
        $itemLinesHTML .= abcfsl_cnt_txt_field( $itemOptns, $tplateOptns, $itemID, $par['sPageUrl'], $F, false, $pfix );
    }

    return $maxWCntr['cntrS'] . $div['cntrS'] . $itemLinesHTML . $div['cntrE'] . $maxWCntr['cntrE'];
}

function abcfsl_cnt_txt_cntr_grid_a_div( $cntrCls, $pfix, $customCls, $customStyle, $vAidCls, $divID, $itemID, $addItemCls, $isSingle ){

    $clsCntr = abcfsl_cnt_class_bldr( $pfix, $cntrCls, $customCls, $isSingle, $vAidCls, $addItemCls, $itemID );
    $div['cntrS'] = abcfl_html_tag( 'div', $divID, $clsCntr, $customStyle );
    $div['cntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

//<div style="width:450px; max-width:450px;">
//        <div class="abcfslGridTxtCntr">
//            <h2 class="abcfslHXSmall6  abcfslPadT10">Caption</h2>
//            <div>Caption</div>
//            <div>
//            </div>
//        </div>
//</div>
//</div>

//Add div wrap to the text section when option:  max-width = width of the image.
function abcfsl_cnt_txt_cntr_grid_a_max_w_wrap( $tplateOptns, $imgIDL, $imgUrl, $addMaxW ){

    $maxWCntr['cntrS'] = '';
    $maxWCntr['cntrE'] = '';

    if($addMaxW != 'Y') { return $maxWCntr; }

    //No image selected.  Check placeholder options.
    if( empty( $imgUrl )){
        $placeholder = abcfsl_img_placeholder( $tplateOptns, false );
        $imgUrl = $placeholder['imgUrl'];
        $imgIDL = $placeholder['imgID'];
        if( empty( $imgUrl )){ return $maxWCntr; }
    }

    //---------------------------------
    //Create image container by Img ID. If image not found, return empty container
    if( $imgIDL > 0 ){
        $imgWH = abcfsl_img_wh( $imgIDL, $imgUrl );
        if( $imgWH['ok'] ){ return abcfsl_cnt_txt_cntr_grid_a_max_w_div( $imgWH['w'] ); }
        return $maxWCntr;
    }

    //Quick start image.
    $imgW = abcfsl_cnt_txt_cntr_grid_a_qs_img_w( $imgUrl );
    if( $imgW > 0 ){ return abcfsl_cnt_txt_cntr_grid_a_max_w_div( $imgW ); }

    //Placeholder default image
    $imgW = abcfsl_cnt_txt_cntr_grid_a_placeholder_img_w( $imgUrl );
    if( $imgW > 0 ){ return abcfsl_cnt_txt_cntr_grid_a_max_w_div( $imgW ); }

    //--- User image. Missing Img ID. ------------------
    $imgIDL = abcfsl_img_id_by_url( $imgUrl );

    if( $imgIDL == 0 ){ return $maxWCntr; }

    $imgWH = abcfsl_img_wh( $imgIDL, $imgUrl );
    if( $imgWH['ok'] ){ return abcfsl_cnt_txt_cntr_grid_a_max_w_div( $imgWH['w'] ); }

    return $maxWCntr;
}

function abcfsl_cnt_txt_cntr_grid_a_max_w_div( $imgW ){

    $cssMaxW = abcfl_css_w( $imgW, true );
    $maxWCntr['cntrS'] = abcfl_html_tag( 'div', '', 'abcfslMLRAuto', $cssMaxW );
    $maxWCntr['cntrE'] = abcfl_html_tag_end( 'div' );

    return $maxWCntr;
}

//Quick start image.
function abcfsl_cnt_txt_cntr_grid_a_qs_img_w( $imgUrl ){
    $imgW = 0;
    //Quck Start image.
    if ( strpos( $imgUrl, 'staff-list-pro/images/staff-member') !== false) { $imgW = 220; }
    return $imgW;
}

//Placeholder default image
function abcfsl_cnt_txt_cntr_grid_a_placeholder_img_w( $imgUrl ){
    $imgW = 0;
    if ( strpos( $imgUrl, 'staff-list-pro/images/placeholder') !== false) { $imgW = 250; }
    return $imgW;
}
//=== GRID A - END ====================================================
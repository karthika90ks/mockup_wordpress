<?php
//T Text
function abcfsl_cnt_field_T( $par ){

    $txt = $par['lineTxt'];
    if(abcfl_html_isblank($txt)) { return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    return $cntrS . $txt . $cntrE;
}

//Static Label & Text (span)
function abcfsl_cnt_field_LT( $par ){

    $lineTxt = $par['lineTxt'];
    if( abcfl_html_isblank( $lineTxt ) ) { return ''; }

    if(abcfl_html_isblank($par['lblTxt'])) { return abcfsl_cnt_field_T($par); }

    $tagCls = abcfsl_util_pg_type_cls_bldr( $par['tagCls'], $par['isSingle'] );
    $lblCls = abcfsl_util_pg_type_cls_bldr( $par['lblCls'], $par['isSingle'] );
    $txtCls = abcfsl_util_pg_type_cls_bldr( $par['txtCls'], $par['isSingle'] );

    $cntrS = abcfl_html_tag( $par['tagType'], '', $tagCls, $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    $spanLblS = abcfl_html_tag( 'span', '', $lblCls, $par['lblStyle']  );
    $spanTxtS = abcfl_html_tag( 'span', '', $txtCls, $par['txtStyle'] );

    $spanE = abcfl_html_tag_end('span');

    return $cntrS . $spanLblS . html_entity_decode( $par['lblTxt'] ) . '&nbsp;' . $spanE . $spanTxtS . html_entity_decode($lineTxt) . $spanE . $cntrE;
}

function abcfsl_cnt_field_POSTTITLE( $par ){

    $staffID = $par['itemID'];
    //$postTitle = get_the_title( $staffID );
    $postTitle = abcfsl_db_get_post_title( $staffID );
    if( empty( $postTitle ) ) { return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    return $cntrS . $postTitle . $cntrE;
}
//--------------------------------------------
//H Hyperlink
function abcfsl_cnt_field_H( $par ){

    if( empty( $par['hrefUrl'] ) ){ return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

//    $onclick = '';
//    $args = '';
//    if( $par['isSP'] ){
//        $onclick = $par['onclick'];
//        $args = $par['args'];
//    }
    $aTag = abcfl_html_a_tag_nb( $par['hrefUrl'], $par['hrefTxt'], $par['target'], $par['lnkCls'], $par['lnkStyle'], '', $par['onclick'], $par['args'] );
    return $cntrS . $aTag . $cntrE;
}

//TH Hyperlink with Static Text
function abcfsl_cnt_field_TH( $par ){

    if( empty( $par['hrefUrl'] ) ){ return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

//    $onclick = '';
//    $args = '';
//    if( $par['isSP'] ){
//        $onclick = $par['onclick'];
//        $args = $par['args'];
//    }

    $aTag = abcfl_html_a_tag_nb( $par['hrefUrl'], $par['lblTxt'], $par['target'], $par['lnkCls'], $par['lnkStyle'], '', $par['onclick'], $par['args'] );
    return $cntrS . $aTag . $cntrE;
}
//--------------------------------------------

//Horizontal Line
function abcfsl_cnt_field_HL( $tagCls, $tagStyle, $pfix ){

    //if(empty($tagCls)) { $tagCls = 'abcfslBB12 abcfsWidth100'; }
    if(empty($tagCls)) { $tagCls = $pfix . 'BB12 ' . $pfix . 'Width100'; }
    return abcfl_html_tag( 'div', '', $tagCls, $tagStyle ) . abcfl_html_tag_end( 'div');
}

//PRO --- Shortcode
function abcfsl_cnt_field_SC( $par ){

    $scode = $par['lineTxt'];
    if(abcfl_html_isblank($scode)) { return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    return $cntrS . do_shortcode($scode) . $cntrE;
}


// Email. Added showAsTxt option
function abcfsl_cnt_field_EM( $par ){

    $url = $par['hrefUrl'];
    $urlTxt = $par['hrefTxt'];
    if( empty( $url ) ){ return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);        

    if( $par['showAsTxt'] == 1 ) {
        return $cntrS . $url . $cntrE;
    }
    //----------------------------------------
    $url = 'mailto:' . $url;
    $link = abcfl_html_a_tag( $url, $urlTxt, '', $par['lnkCls'], $par['lnkStyle'], '', false );
    return $cntrS . $link . $cntrE;
}

function abcfsl_cnt_field_STXEM( $par ){

    $url = $par['hrefUrl'];
    if( empty( $url ) ){ return ''; }    

    $urlTxt = $par['lblTxt'];

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);        

    //----------------------------------------
    $url = 'mailto:' . $url;
    $link = abcfl_html_a_tag( $url, $urlTxt, '', $par['lnkCls'], $par['lnkStyle'], '', false );
    return $cntrS . $link . $cntrE;
}

//Text editor
function abcfsl_cnt_field_WPE( $par, $editorCnt, $noAutop ){

    //$cnt = $par['editorCnt'];
    if( abcfl_html_isblank( $editorCnt ) ) { return ''; }
    $cnt = html_entity_decode( $editorCnt );

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    //the_content
    $cnt = apply_filters( 'abcfsl_cnt', $cnt );
    //$cnt = apply_filters( 'abcfsl_cnt_wpautop', $cnt );
    if( empty( $noAutop ) ) { $cnt = apply_filters( 'abcfsl_cnt_wpautop', $cnt ); }
    
    //$cnt = apply_filters('the_content', $cnt);
    return $cntrS .  $cnt  . $cntrE;
}

//== SINGLE PAGE LINK START ====================================
function abcfsl_cnt_field_SPTL( $par, $itemOptns ){

    $hideSPgLnk = isset( $itemOptns['_hideSPgLnk'] ) ? $itemOptns['_hideSPgLnk'][0] : '0';
    if( $hideSPgLnk == 1 ) { return ''; }

    //Returns A tag for link to a Sinle Page.
    $url = 'SP';
    if( $par['newTab'] == 'Y' ) { $url = 'NT SP'; }
    //$itemOptns['_imgLnkL'][0] = $url;

    $staffID = $par['itemID'];
    $itemTxt = $par['lineTxt'];

    $lnkParts = abcfsl_spg_a_tag_img_lnk_parts( $staffID, $par['sPageUrl'], $itemOptns, $url );
    if( abcfl_html_isblank( $itemTxt ) ) { $itemTxt = $lnkParts['href']; }

    $aTag = abcfl_html_a_tag_nb( $lnkParts['href'], $itemTxt, $lnkParts['target'], $par['lnkCls'], $par['lnkStyle'], '', $lnkParts['onclick'], $lnkParts['args'] );

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    return $cntrS . $aTag . $cntrE;
}

//Single Page Hyperlink. Discontinued.
function abcfsl_cnt_field_SH_legacy_field( $par, $itemOptns, $F ){

    $url = 'SP';
    if( $par['newTab'] == 'Y' ) { $url = 'NT SP'; }

    $staffID = $par['itemID'];
    $itemTxt = $par['lblTxt'];

    $lnkParts = abcfsl_spg_a_tag_img_lnk_parts( $staffID, $par['sPageUrl'], $itemOptns, $url );
    if( abcfl_html_isblank( $itemTxt ) ) { $itemTxt = $lnkParts['href']; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    $aTag = abcfl_html_a_tag_nb( $lnkParts['href'], $itemTxt, $lnkParts['target'], $par['lnkCls'], $par['lnkStyle'], '', $lnkParts['onclick'], $lnkParts['args'] );
    return $cntrS . $aTag . $cntrE;
}
//== SINGLE PAGE LINK END ===================================

//== STATIC TEXT START =========================================
function abcfsl_cnt_field_STXT( $par, $tplateOptns, $itemOptns, $F ){

    $txt = $par['statTxt'];
    if( abcfl_html_isblank( $txt ) ) { return ''; }

    $render = abcfsl_cnt_have_content( $par['statTxtFs'], $tplateOptns, $itemOptns, $par['isSingle'] );
    if( !$render ) { return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    return $cntrS . $txt . $cntrE;
}

function abcfsl_cnt_have_content( $Fs, $tplateOptns, $itemOptns, $isSingle ){

    if( empty( $Fs ) ) { return true;  }
    $Fs = trim($Fs, ',');
    if( empty( $Fs ) ) { return true;  }

    $fieldFs = explode(",", $Fs);
    $values = '';
    foreach( $fieldFs as $F ) {
        $values .= abcfsl_cnt_field_has_value( $tplateOptns, $itemOptns, $F, $isSingle );
    }

    if( abcfl_html_isblank($values ) ) { return false; }
    return true;
}

function abcfsl_cnt_field_has_value( $tplateOptns, $itemOptns, $F, $isSingle ){

    $showFieldOn = isset( $tplateOptns['_showField_' . $F] ) ? esc_attr( $tplateOptns['_showField_' . $F][0] ) : 'L';

    switch ( $showFieldOn ){
        case 'N':
            if( $isSingle ){ return ''; }
            break;
        case 'L': //List only
            if( $isSingle ){ return ''; }
            break;
        case 'S': //Single page only
            if( !$isSingle ){ return ''; }
            break;
       default:
            break;
    }

    $txt = isset( $itemOptns['_txt_' . $F] ) ? $itemOptns['_txt_' . $F][0]  : '';
    if( !abcfl_html_isblank( $txt ) ) { return 'x'; }

    $txt = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';
    if( !abcfl_html_isblank( $txt ) ) { return 'x'; }

    $txt = isset( $itemOptns['_editorCnt_' . $F] ) ? esc_attr( $itemOptns['_editorCnt_' . $F][0] ) : '';
    if( !abcfl_html_isblank( $txt ) ) { return 'x'; }

    return '';
}
//== STATIC TEXT END ===================================


//== SUPPORT FUNCTIONS ===========================================
function abcfsl_cnt_field_CHECKG( $par ){

    $checkgSaved = $par['checkg'];
    if( empty( $checkgSaved ) ) { return ''; }

    $tagCls = $par['tagCls'];
    $lblCls = abcfsl_util_pg_type_cls_bldr( $par['lblCls'], $par['isSingle'] );
    $txtCls = abcfsl_util_pg_type_cls_bldr( $par['txtCls'], $par['isSingle'] );

    $cntrS = abcfl_html_tag( $par['tagType'], '', $tagCls, $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);
    $lblCntr = '';
    $lblTxt = $par['lblTxt'];

    if( !abcfl_html_isblank( $lblTxt ) ) {
        $spanLblS = abcfl_html_tag( 'span', '', $lblCls, $par['lblStyle']  );
        $lblCntr = $spanLblS . html_entity_decode( $par['lblTxt'] ) . '&nbsp;' . abcfl_html_tag_end('span');
    }

    $cbomHTML = abcfsl_cnt_cbom_field_html( $par, $checkgSaved, $txtCls, $lblTxt );
    return $cntrS . $lblCntr  . $cbomHTML . $cntrE;    
}

function abcfsl_cnt_field_CBOM( $par ){
    
    $cbomSaved = $par['cbom'];
    if( empty( $cbomSaved ) ) { return ''; }

    $tagCls = $par['tagCls'];
    $lblCls = abcfsl_util_pg_type_cls_bldr( $par['lblCls'], $par['isSingle'] );
    $txtCls = abcfsl_util_pg_type_cls_bldr( $par['txtCls'], $par['isSingle'] );

    $cntrS = abcfl_html_tag( $par['tagType'], '', $tagCls, $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);
    $lblCntr = '';
    $lblTxt = $par['lblTxt'];

    if( !abcfl_html_isblank( $lblTxt ) ) {
        $spanLblS = abcfl_html_tag( 'span', '', $lblCls, $par['lblStyle']  );
        $lblCntr = $spanLblS . html_entity_decode( $par['lblTxt'] ) . '&nbsp;' . abcfl_html_tag_end('span');
    }

    $cbomHTML = abcfsl_cnt_cbom_field_html( $par, $cbomSaved, $txtCls, $lblTxt );
    return $cntrS . $lblCntr  . $cbomHTML . $cntrE;
}




function abcfsl_cnt_cbom_field_html( $par, $cbomSaved, $txtCls, $lblTxt ){

    $outHTML = '';
    $cbomLayout = $par['cbomLayout'];
    //R=row
    if( $cbomLayout == 'R' ) { 

        if( !abcfl_html_isblank( $lblTxt ) ) {
            $spanTxtS = abcfl_html_tag( 'span', '', $txtCls, $par['txtStyle'] );
            $outHTML = $spanTxtS . html_entity_decode( $cbomSaved ) . abcfl_html_tag_end('span');;
        }
        else{
            $outHTML = html_entity_decode( $cbomSaved );
        }
    }

    return $outHTML;
}
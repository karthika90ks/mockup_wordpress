<?php
function abcfsl_mbox_tplate_icons_optns_STARR( $tplateOptns, $F ){

    $tagType = isset( $tplateOptns['_tagType_' . $F] ) ? esc_attr( $tplateOptns['_tagType_' . $F][0] ) : ''; 
    $iconOnCls = isset( $tplateOptns['_iconOnCls_' . $F] ) ? $tplateOptns['_iconOnCls_' . $F][0] : '';
    $iconOffCls = isset( $tplateOptns['_iconOffCls_' . $F] ) ? $tplateOptns['_iconOffCls_' . $F][0] : '';
    $iconOnStyle = isset( $tplateOptns['_iconOnStyle_' . $F] ) ? $tplateOptns['_iconOnStyle_' . $F][0] : '';
    $iconOffStyle = isset( $tplateOptns['_iconOffStyle_' . $F] ) ? $tplateOptns['_iconOffStyle_' . $F][0] : '';
    $iconMaxQty = isset( $tplateOptns['_iconMaxQty_' . $F] ) ? $tplateOptns['_iconMaxQty_' . $F][0] : '';
    $iconType = isset( $tplateOptns['_iconType_' . $F] ) ? esc_attr( $tplateOptns['_tagType_' . $F][0] ) : ''; 
    //----------------------------------------------------
    $flexCntrS50 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );
    $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' ); 
    $divE = abcfl_html_tag_end( 'div'); 
    //--------------------------------------------------------    
    $cboTT = abcfsl_cbo_icon_tag();
    $cbo16 = abcfsl_cbo_1_6();
    $cboYN = abcfsl_cbo_yn();
    $cboIconType = abcfsl_cbo_icon_type();

    abcfsl_mbox_tplate_field_section_hdr( 20, 409 );
    $iTag = abcfl_input_cbo_strings( 'tagType_' . $F, '', $cboTT, $tagType, abcfsl_txta(403), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $maxQty = abcfl_input_cbo_strings( 'iconMaxQty_' . $F, '', $cbo16, $iconMaxQty, abcfsl_txta(404), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $iType = abcfl_input_cbo_strings( 'iconType_' . $F, '', $cboIconType, $iconType, abcfsl_txta(506), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $onCls = abcfl_input_txt( 'iconOnCls_' . $F, '', $iconOnCls, abcfsl_txta(405), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $onStyle = abcfl_input_txt( 'iconOnStyle_' . $F, '', $iconOnStyle, abcfsl_txta(407), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $offCls = abcfl_input_txt( 'iconOffCls_' . $F, '', $iconOffCls, abcfsl_txta(406), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $offStyle = abcfl_input_txt( 'iconOffStyle_' . $F, '', $iconOffStyle, abcfsl_txta(408), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );

    echo $flexCntrS50 . $flex3ColS . $iTag . $divE . $flex3ColS . $maxQty . $divE . $flex3ColS . $iType . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntrS50 . $flex2ColS . $onCls . $divE . $flex2ColS . $onStyle . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntrS50 . $flex2ColS . $offCls . $divE . $flex2ColS . $offStyle . abcfl_html_tag_ends( 'div,div' );
}
//=============================================================
function abcfsl_mbox_tplate_icons_optns_ICONLNK( $tplateOptns, $F ){

    $tagType = isset( $tplateOptns['_tagType_' . $F] ) ? $tplateOptns['_tagType_' . $F][0] : ''; 
    $iconML = isset( $tplateOptns['_iconML_' . $F] ) ? $tplateOptns['_iconML_' . $F][0] : '';
    $iconType = isset( $tplateOptns['_iconType_' . $F] ) ? $tplateOptns['_iconType_' . $F][0] : ''; 
    $lnkNT = isset( $tplateOptns['_lnkNT_' . $F] ) ? $tplateOptns['_lnkNT_' . $F][0] : ''; 
    
    $icon1Name = isset( $tplateOptns['_icon1Name_' . $F] ) ? $tplateOptns['_icon1Name_' . $F][0] : '';
    $icon1Cls = isset( $tplateOptns['_icon1Cls_' . $F] ) ? $tplateOptns['_icon1Cls_' . $F][0] : '';
    $icon1Style = isset( $tplateOptns['_icon1Style_' . $F] ) ? $tplateOptns['_icon1Style_' . $F][0] : '';

    $icon2Name = isset( $tplateOptns['_icon2Name_' . $F] ) ? $tplateOptns['_icon2Name_' . $F][0] : '';
    $icon2Cls = isset( $tplateOptns['_icon2Cls_' . $F] ) ? $tplateOptns['_icon2Cls_' . $F][0] : '';   
    $icon2Style = isset( $tplateOptns['_icon2Style_' . $F] ) ? $tplateOptns['_icon2Style_' . $F][0] : '';

    $icon3Name = isset( $tplateOptns['_icon3Name_' . $F] ) ? $tplateOptns['_icon3Name_' . $F][0] : '';
    $icon3Cls = isset( $tplateOptns['_icon3Cls_' . $F] ) ? $tplateOptns['_icon3Cls_' . $F][0] : '';   
    $icon3Style = isset( $tplateOptns['_icon3Style_' . $F] ) ? $tplateOptns['_icon3Style_' . $F][0] : '';    

    $icon4Name = isset( $tplateOptns['_icon4Name_' . $F] ) ? $tplateOptns['_icon4Name_' . $F][0] : '';
    $icon4Cls = isset( $tplateOptns['_icon4Cls_' . $F] ) ? $tplateOptns['_icon4Cls_' . $F][0] : '';
    $icon4Style = isset( $tplateOptns['_icon4Style_' . $F] ) ? $tplateOptns['_icon4Style_' . $F][0] : '';

    $icon5Name = isset( $tplateOptns['_icon5Name_' . $F] ) ? $tplateOptns['_icon5Name_' . $F][0] : '';
    $icon5Cls = isset( $tplateOptns['_icon5Cls_' . $F] ) ? $tplateOptns['_icon5Cls_' . $F][0] : '';   
    $icon5Style = isset( $tplateOptns['_icon5Style_' . $F] ) ? $tplateOptns['_icon5Style_' . $F][0] : '';

    $icon6Name = isset( $tplateOptns['_icon6Name_' . $F] ) ? $tplateOptns['_icon6Name_' . $F][0] : '';
    $icon6Cls = isset( $tplateOptns['_icon6Cls_' . $F] ) ? $tplateOptns['_icon6Cls_' . $F][0] : '';   
    $icon6Style = isset( $tplateOptns['_icon6Style_' . $F] ) ? $tplateOptns['_icon6Style_' . $F][0] : '';  

    //----------------------------------------------------  
    $flexCntrS50 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );       
    $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' );   
    $divE = abcfl_html_tag_end( 'div'); 
    //--------------------------------------------------------    
    $cboTT = abcfsl_cbo_icon_tag();
    $cboIconML = abcfsl_cbo_icon_margin();
    $cboIconType = abcfsl_cbo_icon_type();

    //--------------------------------------------------------
    abcfsl_mbox_tplate_field_section_hdr( 19, 409 );
    $iTag = abcfl_input_cbo_strings( 'tagType_' . $F, '', $cboTT, $tagType, abcfsl_txta(403), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $iML = abcfl_input_cbo_strings( 'iconML_' . $F, '', $cboIconML, $iconML, abcfsl_txta(504), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $iType = abcfl_input_cbo_strings( 'iconType_' . $F, '', $cboIconType, $iconType, abcfsl_txta(506), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_input_checkbox('lnkNT_' . $F,  '', $lnkNT, abcfsl_txta(143), '', '', '', 'abcflFldCntr', '', '', '' );

    echo $flexCntrS50 . $flex3ColS . $iTag . $divE . $flex3ColS . $iML . $divE . $flex3ColS . $iType . abcfl_html_tag_ends( 'div,div' );

    abcfsl_mbox_tplate_icons_lnk_optns( '1', $icon1Name, $icon1Cls, $icon1Style, $F );
    abcfsl_mbox_tplate_icons_lnk_optns( '2', $icon2Name, $icon2Cls, $icon2Style, $F );
    abcfsl_mbox_tplate_icons_lnk_optns( '3', $icon3Name, $icon3Cls, $icon3Style, $F );
    abcfsl_mbox_tplate_icons_lnk_optns( '4', $icon4Name, $icon4Cls, $icon4Style, $F );
    abcfsl_mbox_tplate_icons_lnk_optns( '5', $icon5Name, $icon5Cls, $icon5Style, $F );
    abcfsl_mbox_tplate_icons_lnk_optns( '6', $icon6Name, $icon6Cls, $icon6Style, $F );
}

function abcfsl_mbox_tplate_icons_lnk_optns( $no, $iconName, $iconCls, $iconStyle, $F ){

    $flexCntrS50 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' );
    $divE = abcfl_html_tag_end( 'div');
    //--------------------------------------------------------
    $name = abcfl_input_txt( 'icon' . $no . 'Name_' . $F, '', $iconName, abcfsl_txta(502), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $cls = abcfl_input_txt( 'icon' . $no . 'Cls_' . $F, '', $iconCls, abcfsl_txta(501), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $style = abcfl_input_txt( 'icon' . $no . 'Style_' . $F, '', $iconStyle, abcfsl_txta(503), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );

    echo $flexCntrS50 . $flex3ColS . $name . $divE . $flex3ColS . $cls . $divE . $flex3ColS . $style . abcfl_html_tag_ends( 'div,div' );
}

function abcfsl_mbox_tplate_icons_style( $tplateOptns, $F ){

    $tagCls = isset( $tplateOptns['_tagCls_' . $F] ) ? esc_attr( $tplateOptns['_tagCls_' . $F][0] ) : '';
    $tagMarginT = isset( $tplateOptns['_tagMarginT_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginT_' . $F][0] ) : 'N';
    $tagMarginTSPg = isset( $tplateOptns['_tagMarginTSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginTSPg_' . $F][0] ) : '';
    //----------------------------------------------------
    $flexCntrS50 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );
    $divE = abcfl_html_tag_end( 'div'); 

    $cbo = abcfsl_cbo_txt_margin_top();
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(323), abcfsl_aurl(2), 'abcflFontWP abcflFontS13 abcflFontW400' );
    //-------------------------------------------------------- 
    abcfsl_mbox_tplate_field_section_hdr( 14, 368 );

    $mT = abcfl_input_cbo_strings( 'tagMarginT_' . $F, '', $cbo, $tagMarginT, abcfsl_txta(15) . ' - ' . abcfsl_txta(68), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $mTSpg = abcfl_input_cbo_strings( 'tagMarginTSPg_' . $F, '', $cbo, $tagMarginTSPg, abcfsl_txta(15) . ' - ' . abcfsl_txta(69), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl'); 
    echo $flexCntrS50 . $flex2ColS . $mT . $divE . $flex2ColS . $mTSpg . abcfl_html_tag_ends( 'div,div' );

    echo abcfl_input_txt( 'tagCls_' . $F, '', $tagCls, $lbl, abcfsl_txta(374), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}
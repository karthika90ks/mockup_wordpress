<?php
//Field options for a single field F+P
function abcfsl_mbox_tplate_field( $tplateOptns, $F ){

    if( $F == 'F1' ) {echo  abcfl_html_tag('div','','inside');}
    else { echo  abcfl_html_tag( 'div','','inside hidden' ); }  

    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? esc_attr( $tplateOptns['_fieldType_' . $F][0] ) : 'N';
    $fieldTypeH = isset( $tplateOptns['_fieldTypeH_' . $F] ) ? esc_attr( $tplateOptns['_fieldTypeH_' . $F][0] ) : 'N';

    //-- Field type not selected. Display only Add New Field cbo -----------------------
    if($fieldType == 'N'){
        abcfsl_mbox_tplate_field_add_field_cbo( $fieldType, $F );
        echo abcfl_html_tag_end('div');
        return;
    }

    //?????????????????????
    $showField = isset( $tplateOptns['_showField_' . $F] ) ? esc_attr( $tplateOptns['_showField_' . $F][0] ) : 'L';
    $hideDelete = isset( $tplateOptns['_hideDelete_' . $F] ) ? esc_attr( $tplateOptns['_hideDelete_' . $F][0] ) : 'N';
    $fieldLocked = isset( $tplateOptns['_fieldLocked_' . $F] ) ? esc_attr( $tplateOptns['_fieldLocked_' . $F][0] ) : '0';
    $showAsTxt = isset( $tplateOptns['_showAsTxt_' . $F] ) ? esc_attr( $tplateOptns['_showAsTxt_' . $F][0] ) : '0';

    $noAutop = isset( $tplateOptns['_noAutop_' . $F] ) ? $tplateOptns['_noAutop_' . $F][0] : '0';

    //Line container
    $tagType = isset( $tplateOptns['_tagType_' . $F] ) ? esc_attr( $tplateOptns['_tagType_' . $F][0] ) : 'div';
    $tagFont = isset( $tplateOptns['_tagFont_' . $F] ) ? esc_attr( $tplateOptns['_tagFont_' . $F][0] ) : 'D';
    $tagMarginT = isset( $tplateOptns['_tagMarginT_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginT_' . $F][0] ) : 'N';
    $captionMarginT = isset( $tplateOptns['_captionMarginT_' . $F] ) ? esc_attr( $tplateOptns['_captionMarginT_' . $F][0] ) : '';
    
    $tagCls = isset( $tplateOptns['_tagCls_' . $F] ) ? esc_attr( $tplateOptns['_tagCls_' . $F][0] ) : '';
    $tagStyle = isset( $tplateOptns['_tagStyle_' . $F] ) ? esc_attr( $tplateOptns['_tagStyle_' . $F][0] ) : '';

    $fieldCntrSPg = isset( $tplateOptns['_fieldCntrSPg_' . $F] ) ? esc_attr( $tplateOptns['_fieldCntrSPg_' . $F][0] ) : 'M';
    $tagTypeSPg = isset( $tplateOptns['_tagTypeSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagTypeSPg_' . $F][0] ) : '';
    $tagFontSPg = isset( $tplateOptns['_tagFontSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagFontSPg_' . $F][0] ) : '';
    $tagMarginTSPg = isset( $tplateOptns['_tagMarginTSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginTSPg_' . $F][0] ) : '';
    $captionMarginTSPg = isset( $tplateOptns['_captionMarginTSPg_' . $F] ) ? $tplateOptns['_captionMarginTSPg_' . $F][0] : '';

    $dtFormat = isset( $tplateOptns['_dtFormat_' . $F] ) ? $tplateOptns['_dtFormat_' . $F][0] : '';
    //Static Label
    $lblTxt = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';   
    //STXT Static text field type.
    $statTxt  = isset( $tplateOptns['_statTxt_' . $F] ) ? esc_attr( $tplateOptns['_statTxt_' . $F][0] ) : '';
    //Comma delimited list of fields linked to static text field.
    $statTxtFs  = isset( $tplateOptns['_statTxtFs_' . $F] ) ? esc_attr( $tplateOptns['_statTxtFs_' . $F][0] ) : '';

    $cbomQty  = isset( $tplateOptns['_cbomQty_' . $F] ) ? $tplateOptns['_cbomQty_' . $F][0] : '1';
    $cbomSort  = isset( $tplateOptns['_cbomSort_' . $F] ) ? $tplateOptns['_cbomSort_' . $F][0] : 'N';
    $cbomSortLocale = isset( $tplateOptns['_cbomSortLocale_' . $F] ) ? esc_attr($tplateOptns['_cbomSortLocale_' . $F][0] ) : '';

    //Static Label + Text (span). Label section style
    //$lblTag = isset( $tplateOptns['_lblTag_' . $F] ) ? esc_attr( $tplateOptns['_lblTag_' . $F][0] ) : 'div';
    $lblCls = isset( $tplateOptns['_lblCls_' . $F] ) ? esc_attr( $tplateOptns['_lblCls_' . $F][0] ) : '';
    $lblStyle = isset( $tplateOptns['_lblStyle_' . $F] ) ? esc_attr( $tplateOptns['_lblStyle_' . $F][0] ) : '';

    //Static Label + Text (span). Text section style
    $txtCls = isset( $tplateOptns['_txtCls_' . $F] ) ? esc_attr( $tplateOptns['_txtCls_' . $F][0] ) : '';
    $txtStyle = isset( $tplateOptns['_txtStyle_' . $F] ) ? esc_attr( $tplateOptns['_txtStyle_' . $F][0] ) : '';

    //Input field label & description
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';

    $inputLinkLblLbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : '';
    $inputLinkLblHlp = isset( $tplateOptns['_lnkLblHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblHlp_' . $F][0] ) : '';
    $inputLinkUrlLbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';
    $inputLinkUrlHlp = isset( $tplateOptns['_lnkUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlHlp_' . $F][0] ) : '';

    $imgUrlLbl = isset( $tplateOptns['_imgUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlLbl_' . $F][0] ) : '';
    $imgUrlHlp = isset( $tplateOptns['_imgUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlHlp_' . $F][0] ) : '';
    $imgAltLbl = isset( $tplateOptns['_imgAltLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgAltLbl_' . $F][0] ) : '';
    $imgAltHlp = isset( $tplateOptns['_imgAltHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgAltHlp_' . $F][0] ) : '';  

    $imgLnkLbl = isset( $tplateOptns['_imgLnkLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkLbl_' . $F][0] ) : '';
    $imgLnkHlp = isset( $tplateOptns['_imgLnkHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkHlp_' . $F][0] ) : '';
    $imgLnkAttrLbl = isset( $tplateOptns['_imgLnkAttrLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkAttrLbl_' . $F][0] ) : '';
    $imgLnkAttrHlp = isset( $tplateOptns['_imgLnkAttrHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkAttrHlp_' . $F][0] ) : '';
    $imgLnkClickLbl = isset( $tplateOptns['_imgLnkClickLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkClickLbl_' . $F][0] ) : '';
    $imgLnkClickHlp = isset( $tplateOptns['_imgLnkClickHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkClickHlp_' . $F][0] ) : ''; 

    //???????????
    $newTab = isset( $tplateOptns['_newTab_' . $F] ) ? esc_attr( $tplateOptns['_newTab_' . $F][0] ) : 'N';

    //PRO ---  TODO Add class and style ?
    $lnkCls = isset( $tplateOptns['_lnkCls _' . $F] ) ? esc_attr( $tplateOptns['_lnkCls_' . $F][0] ) : '';
    $lnkStyle = isset( $tplateOptns['_lnkStyle_' . $F] ) ? esc_attr( $tplateOptns['_lnkStyle_' . $F][0] ) : '';

    //?????????????????????????????????
    //$socialIconsL = isset( $tplateOptns['_socialIconsL_' . $F] ) ? esc_attr( $tplateOptns['_socialIconsL_' . $F][0] ) : 'N';
    //$socialC1 = isset( $tplateOptns['_socialC1_' . $F] ) ? esc_attr( $tplateOptns['_socialC1_' . $F][0] ) : '';

    $sdProperty = isset( $tplateOptns['_sdProperty_' . $F] ) ? esc_attr( $tplateOptns['_sdProperty_' . $F][0] ) : '';
    $excludedSlugs = isset( $tplateOptns['_excludedSlugs_' . $F] ) ? esc_attr( $tplateOptns['_excludedSlugs_' . $F][0] ) : '';
    //====================================================
    //Field name & hidden Field Type
    //if( $fieldTypeH != 'SH' ){
        abcfsl_mbox_tplate_field_number_and_datatype( $fieldTypeH, $F );
        abcfsl_mbox_tplate_field_lock( $showField, $fieldLocked, $F );
    //}

    //Field type (hidden value).
    switch ( $fieldTypeH ){
        case 'SH': //Single Page Hyperlink DISCONTINUED
            abcfsl_mbox_tplate_field_section_hdr( 23 );
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 259, 127 );
            abcfsl_mbox_tplate_field_hide_delete( $hideDelete, $F );
            break;   
        case 'STXT': //Static Text
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input_txt( 'inputLbl_', $F, $inputLbl, 208, 282, true );
            abcfsl_mbox_tplate_field_input_STXT( $statTxt, $statTxtFs, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );            
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false, '2' );
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'MP':
            abcfsl_mbox_tplate_field_section_hdr( 1, 125);
            abcfsl_mbox_tplate_field_mp( $tplateOptns, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false, '2' );
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'T':
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false, '2' );
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'PT':
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false, '2' );
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'LT': //Static Label + Text
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 275, 293, true );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );         
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            //Field Container style
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, true, '2', '', '', '', '', 2, 211 );
            //Static label style
            abcfsl_autil_class_and_style( 'lblCls_', $lblCls, 'lblStyle_', $lblStyle, $F, true, '2', '', '', '', '', 0, 226 );
            //Text  style
            abcfsl_autil_class_and_style( 'txtCls_', $txtCls, 'txtStyle_', $txtStyle, $F, true, '2', '', '', '', '', 0, 81 );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'H': //Hyperlink
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            echo abcfl_input_info_lbl(abcfsl_txta(230), 'abcflMTop5', 12);
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkLblLbl, $inputLinkLblHlp, $F, 205, 282, 245, 257, true, 'lnkLblLbl_', 'lnkLblHlp_' );
            echo abcfl_input_hline('1', '20');
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 302, 282, 317, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false );
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'TH': //Static text + Hyperlink
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 182, 264, true );
            //----------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 302, 282, 317, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );
            //----------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false, '2' );
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'EM': //Email
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            echo abcfl_input_info_lbl(abcfsl_txta(200), 'abcflMTop5', 13);
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkLblLbl, $inputLinkLblHlp, $F, 205, 282, 245, 257, true, 'lnkLblLbl_', 'lnkLblHlp_' );
            echo abcfl_input_hline('1', '20');
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 300, 282, 318, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_show_as_txt( $showAsTxt, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false, '2' );
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'STXEM': //Email with static text
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 182, 339, true );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 300, 282, 318, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false, '2' );
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;  
        case 'SLFONE': //Static label + Phone.
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input( $lblTxt, $F, abcfsl_txta( 275 ), abcfsl_txta( 293 ), true );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkLblLbl, $inputLinkLblHlp, $F, 383, 282, 209, 257, true, 'lnkLblLbl_', 'lnkLblHlp_' );
            echo abcfl_input_hline('1', '20');
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 382, 282, 209, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );          
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_field_custom_classes( $tagCls, $lblCls, $txtCls, $F, 2 );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;  
        case 'FONE': //Static label + Phone.
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkLblLbl, $inputLinkLblHlp, $F, 383, 282, 209, 257, true, 'lnkLblLbl_', 'lnkLblHlp_' );
            echo abcfl_input_hline('1', '20');
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 382, 282, 209, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );          
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_field_custom_tag_cls( $tagCls, $F, 2 );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;                                      
        case 'CE': //WP Text editor
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_noautop( $noAutop, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );         
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false, '2' );
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'HL': //PRO --- Horizontal Line
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_input_txt( 'inputLbl_', $F, $inputLbl, 208, 282, true );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            //------------------------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false, '2' );
            break;
        case 'SC': //PRO --- Shortcode
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            //---------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
            abcfsl_mbox_tpate_field_margin_t( 'tagMarginT_', $tagMarginT, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 0, 130 );
            abcfsl_mbox_tpate_field_margin_t( 'tagMarginTSPg_', $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false, '2' );
            break;
        case 'CBO': // Dropdown
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 0, 193 );
            abcfsl_mbox_tplate_cbo_items( $tplateOptns, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, false, '2' );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break; 
        case 'LBLCBO': //Static label + Dropdown
            //-- Static label --------------------------------
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 275, 293 );        
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 0, 193 );
            abcfsl_mbox_tplate_cbo_items( $tplateOptns, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            //Field Container style
            abcfsl_autil_class_and_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, true, '2', '', '', '', '', 2, 211 );
            //Static Label style
            abcfsl_autil_class_and_style( 'lblCls_', $lblCls, 'lblStyle_', $lblStyle, $F, true, '2', '', '', '', '', 0, 226 );
            //Text  style
            abcfsl_autil_class_and_style( 'txtCls_', $txtCls, 'txtStyle_', $txtStyle, $F, true, '2', '', '', '', '', 0, 81 );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'CBOM': //Drop-Down Group
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //-- Static label --------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 81, 125 );
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 275, 293 );  
            abcfsl_mbox_tplate_field_cbom_qty( $cbomQty, $F, 366 );  
            abcfsl_util_yn( 'cbomSort_', $F, $cbomSort, 370, 0 );
            abcfsl_mbox_tplate_field_input_txt( 'cbomSortLocale_', $F, $cbomSortLocale, 371, 0 );              
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 80, 193 );
            abcfsl_mbox_tplate_cbo_items( $tplateOptns, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
             //Field custom CSS styles
            abcfsl_autil_field_custom_classes( $tagCls, $lblCls, $txtCls, $F, 82 );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'CHECKG': //Checkbox Group
            abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //-- Static label --------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 85, 275 );
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 0, 372 );               
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 84, 376 );
            abcfsl_mbox_tplate_checkbox_items( $tplateOptns, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
             //Field custom CSS styles
            abcfsl_autil_field_custom_classes( $tagCls, $lblCls, $txtCls, $F, 86 );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break; 
        case 'IMGCAP': //Image 
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgUrlLbl, $imgUrlHlp, $F, 312, 282, 209, 257, true, 'imgUrlLbl_', 'imgUrlHlp_' );
            echo abcfl_input_hline('1', '20'); //Caption           
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 25, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );  
            echo abcfl_input_hline('1', '20');  //ALT          
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgAltLbl, $imgAltHlp, $F, 186, 282, 209, 257, true, 'imgAltLbl_', 'imgAltHlp_' );                     
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_img_style( $tagFont, $tagMarginT, $captionMarginT, $F );
            abcfsl_mbox_tplate_field_img_style_spg( $tagFontSPg, $tagMarginTSPg, $captionMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_field_img_custom_classes( $tagCls, $lblCls, $txtCls, $F, 2 );          
            break; 
        case 'IMGHLNK': //Image Hyperlink
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgUrlLbl, $imgUrlHlp, $F, 312, 282, 209, 257, true, 'imgUrlLbl_', 'imgUrlHlp_' );
            echo abcfl_input_hline('1', '20'); //Caption           
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 25, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );  
            echo abcfl_input_hline('1', '20');  //ALT          
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgAltLbl, $imgAltHlp, $F, 186, 282, 209, 257, true, 'imgAltLbl_', 'imgAltHlp_' );  
            echo abcfl_input_hline('1', '20');          
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgLnkLbl, $imgLnkHlp, $F, 261, 282, 209, 257, true, 'imgLnkLbl_', 'imgLnkHlp_' );
            echo abcfl_input_hline('1', '20');           
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgLnkAttrLbl, $imgLnkAttrHlp, $F, 198, 282, 209, 257, true, 'imgLnkAttrLbl_', 'imgLnkAttrHlp_' );
            echo abcfl_input_hline('1', '20');            
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgLnkClickLbl, $imgLnkClickHlp, $F, 199, 282, 209, 257, true, 'imgLnkClickLbl_', 'imgLnkClickHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_img_style( $tagFont, $tagMarginT, $captionMarginT, $F );
            abcfsl_mbox_tplate_field_img_style_spg( $tagFontSPg, $tagMarginTSPg, $captionMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_field_img_custom_classes( $tagCls, $lblCls, $txtCls, $F, 2 );           
            break; 
        case 'SLDTE': //Static Lbl + Date
            echo abcfl_input_hline('2', '20');            
            abcfsl_mbox_tplate_field_txt_input_custom( $lblTxt, $F, 275, 293, 16 );
            abcfsl_mbox_tplate_field_date_format( $dtFormat, $F );    
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 394, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );  
            echo abcfl_input_hline('1', '20');
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 395, 282, 209, 257, true, 'dteDisplayLbl_', 'dteDisplayHlp_' );          
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_field_custom_classes( $tagCls, $lblCls, $txtCls, $F, 86 );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'STARR': 
            abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );     
            //------------------------------------------------              
            abcfsl_mbox_tplate_icons_optns_STARR( $tplateOptns, $F ); 
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );   
            abcfsl_mbox_tplate_icons_style( $tplateOptns, $F ); 
            break;  
        case 'ICONLNK': 
            abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );     
            //------------------------------------------------ 
            abcfsl_mbox_tplate_icons_optns_ICONLNK( $tplateOptns, $F ); 
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );   
            abcfsl_mbox_tplate_icons_style( $tplateOptns, $F ); 
            break;
        case 'ICONLNKCAP': 
            echo abcfl_input_hline('2', '20');
            break;
        case 'STFFCAT': 
            echo abcfl_input_hline('2', '20');
            echo abcfsl_mbox_autil_input_txt( 'lblTxt_', $F, $lblTxt, 275, 0 );
            echo abcfsl_mbox_autil_input_txt_help_link( 'inputLbl_', $F, $inputLbl, 208, 282, 33 );
            echo abcfsl_mbox_autil_input_txt_help_link( 'excludedSlugs_', $F, $excludedSlugs, 505, 0, 18 );
            //----------------------------------
            //abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            //abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, '', '', true, 'inputLbl_', 'inputHlp_' );   
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_field_custom_classes( $tagCls, $lblCls, $txtCls, $F, 2 );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );   
            break;
        case 'POSTTITLE':  
            echo abcfl_input_hline('2', '20');          
            echo abcfsl_mbox_autil_input_txt( 'inputLbl_', $F, $inputLbl, 209, 0 ); 
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F );
            abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F );
            //----------------------------------
            abcfsl_autil_field_custom_tag_cls( $tagCls, $F, 2 );         
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );   
            break; 
        case 'LBLEMAIL': 
            echo abcfl_input_hline('2', '20');
            break;                         
        default:
            break;
    }
echo abcfl_html_tag_end('div');
}

//== SECTION HEADERS ==================================================
//Add new field
function abcfsl_mbox_tplate_field_add_field_cbo( $fieldType, $F ){

    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(320), abcfsl_aurl(13) );
    $cboLineType = abcfsl_cbo_field_type();
    echo abcfl_input_cbo('fieldType_' . $F, '',$cboLineType, $fieldType, abcfsl_txta(222), abcfsl_txta(212), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Field number and datatype
function abcfsl_mbox_tplate_field_number_and_datatype( $fieldTypeH, $F ){

    if( $fieldTypeH == 'SH' ) { return; }

    $cboLineType = abcfsl_cbo_field_type();
    $fieldType = $cboLineType[$fieldTypeH];
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL,  $F. '.&nbsp;&nbsp;' . $fieldType, abcfsl_aurl_f( $fieldTypeH ), 'abcflFontWP abcflFontS20 abcflFontW600 abcflMTop10 abcflBlue' );
    echo abcfl_input_hidden( '', 'fieldTypeH_' . $F, $fieldTypeH );
}

//== FIELDS =========================================================
function abcfsl_mbox_tplate_field_lock($showField, $fieldLocked, $F ){

    //????????
    if($showField == 'N'){ return;}

    $clsBoxlbl = '';
    $boxLbl = abcfsl_txta(296);
    if($fieldLocked == '1'){
        $clsBoxlbl = 'abcflBBRed';
        $boxLbl = abcfsl_txta(297);
    }
    echo abcfl_input_checkbox('lineLocked_'. $F,  '', $fieldLocked, $boxLbl, '', '', '', 'abcflFldCntr', '', '', $clsBoxlbl );
}

function abcfsl_mbox_tplate_field_show_field( $showField, $hideDelete, $F ){

    $cboShowField = abcfsl_cbo_show_field();
    abcfsl_mbox_tplate_field_hide_delete( $hideDelete, $F );
    echo abcfl_input_cbo('showField_' . $F, '',$cboShowField, $showField, abcfsl_txta_r(72), abcfsl_txta(233), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    
}

function abcfsl_mbox_tplate_field_hide_delete( $hideDelete, $F ){

    $cboHideDelete = abcfsl_cbo_hide_delete();
    echo abcfl_input_cbo('hideDelete_' . $F, '',$cboHideDelete, $hideDelete, abcfsl_txta_r(71), abcfsl_txta(134), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Field container type
function abcfsl_mbox_tplate_field_field_cntr_type( $tagType, $F, $typeL='tagType_'){

    $cboTxtCntr = abcfsl_cbo_tag_type();
    echo abcfl_input_cbo($typeL . $F, '',$cboTxtCntr, $tagType, abcfsl_txta_r(287), abcfsl_txta(279), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_tplate_field_date_format( $dtFormat, $F ){
    //abcfl_input_date
    $cboDt= abcfsl_cbo_date_format();
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(395), abcfsl_aurl(15), 'abcflFontWP abcflFontS13 abcflFontW400' );
    echo abcfl_input_cbo('dtFormat_' . $F, '',$cboDt, $dtFormat,  $lbl, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//?????????????????????????????????
function abcfsl_mbox_tplate_field_new_tab( $newTab, $F ){
    $cboYN = abcfsl_cbo_yn();
    echo abcfl_input_cbo('newTab_' . $F, '', $cboYN, $newTab, abcfsl_txta(143), '', '50%', false, '', '', 'abcflFldCntr', 'abcflFldLbl');
}
//==INPUT FIELDS =====================================================
//Single input. Replace with: abcfsl_mbox_tplate_field_input_txt
function abcfsl_mbox_tplate_field_input( $value, $F, $lblTxt, $helpTxt, $required=false ){
    if( $required ) { $lblTxt = abcfsl_txta_txt_r( $lblTxt ); }    
    echo abcfl_input_txt('lblTxt_' . $F, '', $value, $lblTxt, $helpTxt, '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Single input. Static label?
function abcfsl_mbox_tplate_field_input_txt( $fldID, $F, $fldValue, $lblID, $helpID, $required=false ){
    $lbl = abcfsl_txta($lblID);
    if( $required ) { $lbl = abcfsl_txta_r( $lblID ); }
    echo abcfl_input_txt( $fldID . $F, '', $fldValue, $lbl, abcfsl_txta( $helpID ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Static label.
function abcfsl_mbox_tplate_field_input_static_lbl( $inputData, $F, $lblID, $helpID, $required=false ){
    $lbl = abcfsl_txta($lblID);
    if( $required ) { $lbl = abcfsl_txta_r($lblID); }
    echo abcfl_input_txt('lblTxt_' . $F, '', $inputData, $lbl, abcfsl_txta( $helpID ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}
//=================================================================================
function abcfsl_mbox_tplate_field_txt_input_custom( $inputData, $F, $lblID, $helpID, $docID=0, $inputID='', $required=false ){
    if( empty( $inputID ) ) { $inputID = 'lblTxt_'; }
    $lbl = abcfsl_txta( $lblID );
    if( $required ) { $lbl = abcfsl_txta_r($lblID); }
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lbl, abcfsl_aurl( $docID ), 'abcflFontWP abcflFontS13 abcflFontW400' );
    echo abcfl_input_txt( $inputID . $F, '', $inputData, $lbl, abcfsl_txta( $helpID ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Two fields: Field label +  Field description
function abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, $name1, $help1, $name2, $help2, $reqired, $lbl='inputLbl_', $hlp='inputHlp_'){
    
    $lblName1 = abcfsl_txta( $name1 );
    if ( $reqired ) { abcfsl_txta_r( $name1 ); }    
    echo abcfl_input_txt( $lbl . $F, '', $inputLbl, $lblName1, abcfsl_txta( $help1 ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    if( !empty( $name2 ) ) {
        echo abcfl_input_txt($hlp . $F, '', $inputHlp, abcfsl_txta( $name2 ), abcfsl_txta( $help2 ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
}

function abcfsl_mbox_tplate_field_input_STXT( $statTxt, $statTxtFs, $F ){

    $lblFs = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(185), abcfsl_aurl(53), 'abcflFontWP abcflFontS13 abcflFontW400' );

    echo abcfl_input_txtarea('statTxt_' . $F, '', $statTxt, abcfsl_txta_r(182), abcfsl_txta(221), '50%', '2', '', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('statTxtFs_' . $F, '', $statTxtFs, $lblFs, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Fonts
function abcfsl_mbox_tplate_field_font( $fieldName, $fielValue, $F, $help=247, $lbl=47 ){
    $cbo = abcfsl_cbo_font_size();
    echo abcfl_input_cbo_strings( $fieldName . $F, '', $cbo, $fielValue, abcfsl_txta( $lbl ), abcfsl_txta( $help ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Top margin.
function abcfsl_mbox_tpate_field_margin_t( $fieldName, $fielValue, $F, $help=0, $lbl=15 ){
    $cbo = abcfsl_cbo_txt_margin_top();
    echo abcfl_input_cbo_strings($fieldName . $F, '', $cbo, $fielValue, abcfsl_txta( $lbl ), abcfsl_txta( $help ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_tplate_field_cntr_spg( $fielValue, $F ){
    $cbo = abcfsl_cbo_field_cntr_spg();
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(140), abcfsl_aurl(9), 'abcflFontWP abcflFontS13 abcflFontW400' );
    echo abcfl_input_cbo_strings('fieldCntrSPg_' . $F, '', $cbo, $fielValue, $lbl, abcfsl_txta(148), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_tplate_field_show_as_txt( $showAsTxt, $F ){
    echo abcfl_input_checkbox('showAsTxt_' . $F,  '', $showAsTxt, abcfsl_txta(328), '', '', '', 'abcflMTop10', '', '', '' );
}

//Section header + optional help link (?) Default text 'Field Labels'
function abcfsl_mbox_tplate_field_section_hdr( $aurl, $txta=319, $hline=true){
    if( $hline ) { echo abcfl_input_hline('2', '20'); }
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta($txta), abcfsl_aurl($aurl) );
}

function abcfsl_mbox_tplate_field_cbom_qty( $cbomQty, $F, $txtID, $xtaID=0 ){

    $cboQty = abcfsl_cbo_list_grid_columns_12();
    echo abcfl_input_cbo( 'cbomQty_' . $F, '', $cboQty, $cbomQty, abcfsl_txta_r($txtID), abcfsl_txta(0), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_util_yn( $fldID, $F, $fielValue, $lblID, $helpID ){
    $cboYN = abcfsl_cbo_yn();
    echo abcfl_input_cbo( $fldID . $F, '', $cboYN, $fielValue, abcfsl_txta( $lblID ), abcfsl_txta( $helpID ), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

function abcfsl_mbox_tplate_field_noautop( $noAutop, $F ){ 
    echo abcfl_input_checkbox('noAutop_' . $F, '', $noAutop, abcfsl_txta(380), '', '', '', 'abcflFldCntr', '', '', '' );
}

function abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F ){
 
    abcfsl_mbox_tplate_field_section_hdr( 5, 286 );
    abcfsl_mbox_tplate_field_show_field( $showField, $hideDelete, $F );
    abcfsl_mbox_tplate_field_cntr_spg( $fieldCntrSPg, $F );
}

function abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F ){

            abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
            abcfsl_mbox_tplate_field_field_cntr_type( $tagType, $F, 'tagType_' );
            abcfsl_mbox_tplate_field_font( 'tagFont_', $tagFont, $F );
            abcfsl_mbox_tpate_field_margin_t( 'tagMarginT_', $tagMarginT, $F );
}

function abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F ){

    abcfsl_mbox_tplate_field_section_hdr( 0, 130 );
    abcfsl_mbox_tplate_field_field_cntr_type( $tagTypeSPg, $F, 'tagTypeSPg_' );
    abcfsl_mbox_tplate_field_font( 'tagFontSPg_', $tagFontSPg, $F );
    abcfsl_mbox_tpate_field_margin_t( 'tagMarginTSPg_', $tagMarginTSPg, $F );
}

function abcfsl_mbox_tplate_field_img_style( $tagFont, $tagMarginT, $captionMarginT, $F ){

    //abcfsl_mbox_tpate_field_margin_t( $fieldName, $fielValue, $F, $help=0, $lbl=15 )
    abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
    abcfsl_mbox_tpate_field_margin_t( 'tagMarginT_', $tagMarginT, $F, 0, 391 );
    abcfsl_mbox_tplate_field_font( 'tagFont_', $tagFont, $F, 0, 392 );
    abcfsl_mbox_tpate_field_margin_t( 'captionMarginT_', $tagMarginT, $F, 0, 393 );
}

function abcfsl_mbox_tplate_field_img_style_spg( $tagFontSPg, $tagMarginTSPg, $captionMarginTSPg, $F ){

    abcfsl_mbox_tplate_field_section_hdr( 0, 130 );
    abcfsl_mbox_tpate_field_margin_t( 'tagMarginTSPg_', $tagMarginTSPg, $F, 0, 391 );
    abcfsl_mbox_tplate_field_font( 'tagFontSPg_', $tagFontSPg, $F, 0, 392 );
    abcfsl_mbox_tpate_field_margin_t( 'captionMarginTSpg_', $captionMarginTSPg, $F, 0, 393 );
}
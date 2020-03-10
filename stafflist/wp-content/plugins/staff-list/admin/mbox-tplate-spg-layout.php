<?php
function abcfsl_mbox_tplate_spg_layout( $tplateOptns, $layout ){

    echo  abcfl_html_tag('div','','inside hidden');

        $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
        $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
        $spgCols = isset( $tplateOptns['_spgCols'] ) ? esc_attr( $tplateOptns['_spgCols'][0] ) : '6';
        $spgMMarginT = isset( $tplateOptns['_spgMMarginT'] ) ? esc_attr( $tplateOptns['_spgMMarginT'][0] ) : 'N';

        $spgCntrW = isset( $tplateOptns['_spgCntrW'] ) ? esc_attr( $tplateOptns['_spgCntrW'][0] ) : '';
        $spgACenter = isset( $tplateOptns['_spgACenter'] ) ? esc_attr( $tplateOptns['_spgACenter'][0] ) : 'Y';
        $spgMICls = isset( $tplateOptns['_spgMICls'] ) ? esc_attr( $tplateOptns['_spgMICls'][0] ) : '';
        $spgMTCls = isset( $tplateOptns['_spgMTCls'] ) ? esc_attr( $tplateOptns['_spgMTCls'][0] ) : '';
        $spgCntrCls = isset( $tplateOptns['_spgCntrCls'] ) ? esc_attr( $tplateOptns['_spgCntrCls'][0] ) : '';
        //$spgCntrStyle = isset( $tplateOptns['_spgCntrStyle'] ) ? esc_attr( $tplateOptns['_spgCntrStyle'][0] ) : '';
        $spgCClsT = isset( $tplateOptns['_spgCClsT'] ) ? esc_attr( $tplateOptns['_spgCClsT'][0] ) : '';
        $spgCClsM = isset( $tplateOptns['_spgCClsM'] ) ? esc_attr( $tplateOptns['_spgCClsM'][0] ) : '';
        $spgCClsB = isset( $tplateOptns['_spgCClsB'] ) ? esc_attr( $tplateOptns['_spgCClsB'][0] ) : '';      

       //-- ADD NEW Record Screen. Display only Add New Layout cbo ------------------------
        if( $lstLayoutH == '0' ){
            echo abcfl_html_tag_end('div');
            return;
        }

        abcfsl_mbox_tplate_spg_layout_cntr( $spgCntrW, $spgACenter, $layout ); 
        if( $layout == 100 ) { abcfsl_mbox_tplate_spg_layout_cntr_m( $spgCols, $spgMMarginT, $spgMICls, $spgMTCls ); }
        abcfsl_mbox_tplate_spg_layout_css( $spgCntrCls, $spgCClsT, $spgCClsM, $spgCClsB );
        
    echo abcfl_html_tag_end('div');
}

//sPg Container
function abcfsl_mbox_tplate_spg_layout_cntr( $spgCntrW, $spgACenter, $layout ){

    $png = 'staff-single-pg.png';
    if( $layout == 200 ) { $png = 'staff-single-pg-no-img.png'; }

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, $png, abcfsl_txta(69)  . ' ' . abcfsl_txta(13), abcfsl_txta(322), abcfsl_aurl(9) );
    echo abcfl_input_txt('spgCntrW', '', $spgCntrW, abcfsl_txta(48), abcfsl_txta(260), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_util_center_yn( 'spgACenter', $spgACenter );
}

//Middle section with image.
function abcfsl_mbox_tplate_spg_layout_cntr_m( $spgCols, $spgMMarginT, $spgMICls, $spgMTCls ){

    $cboCols = abcfsl_cbo_list_columns();
    $cboTM = abcfsl_cbo_margin_top_social();
    $lblIL = abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfsl_txta_r(253), abcfsl_aurl(64) );

    echo abcfl_input_hline('2');
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'staff-single-pg-m.png', abcfsl_txta(145), '', abcfsl_aurl(9) );

    echo abcfl_input_cbo('spgCols', '',$cboCols, $spgCols, $lblIL, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('spgMMarginT', '',$cboTM, $spgMMarginT, abcfsl_txta(15), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_mbox_tplate_spg_layout_m_css( $spgMICls, $spgMTCls );
}

//Custom CSS. 
function abcfsl_mbox_tplate_spg_layout_css( $spgCntrCls, $spgCClsT, $spgCClsM, $spgCClsB ){

    echo abcfl_input_hline('2', '20');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(367), abcfsl_aurl(2) );
    echo abcfl_input_info_lbl( abcfsl_txta(374), 'abcflMTop5', '14');

    echo abcfl_input_txt( 'spgCntrCls', '', $spgCntrCls, abcfsl_txta(400), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_txt( 'spgCClsT', '', $spgCClsT, abcfsl_txta(285), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_txt( 'spgCClsM', '', $spgCClsM, abcfsl_txta(145), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_txt( 'spgCClsB', '', $spgCClsB, abcfsl_txta(315), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//Middle section L and R containers, custom CSS
function abcfsl_mbox_tplate_spg_layout_m_css( $spgMICls, $spgMTCls ){   
    echo abcfl_input_txt( 'spgMICls', '', $spgMICls, abcfsl_txta(367) . ' - '. abcfsl_txta(401), abcfsl_txta(374), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );   
    echo abcfl_input_txt( 'spgMTCls', '', $spgMTCls, abcfsl_txta(367) . ' - '. abcfsl_txta(251), abcfsl_txta(252), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' ); 
}

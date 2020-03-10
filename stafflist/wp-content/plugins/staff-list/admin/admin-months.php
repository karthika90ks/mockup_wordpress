<?php
function abcfsl_admin_months() {

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;

    $optnName = 'abcfsl_month_names';
    $monthsSaved = get_option( $optnName );
    //========================================
    if ( isset($_POST['btnSaveMonths']) ){
        check_admin_referer( $slug . '_nonce' );

        abcfsl_admin_months_save( $optnName, $_POST );
        $monthsSaved = get_option( $optnName );
        abcfl_autil_msg_ok();
    }
    //======================================== 
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(388), abcfsl_aurl(21), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMLeft30 abcflMTop20');

    if( empty( $monthsSaved ) || !$monthsSaved ){ 
        $monthsSaved = abcfsl_admin_months_defaults(); 
    }
    else{
        $monthsSaved = wp_parse_args(  $monthsSaved, abcfsl_admin_months_defaults() );
    }

    //--Form Start ------------------------
    echo abcfl_html_form( 'frm_default_tplate', '');
    wp_nonce_field($slug . '_nonce');
    //-- Main Cntr DIV Start --------------
    echo abcfl_html_tag_cls('div', 'abcflMTop20 abcflMLeft30');

        echo abcfsl_admin_months_render_input( '1', $monthsSaved['m1'] );
        echo abcfsl_admin_months_render_input( '2', $monthsSaved['m2'] );
        echo abcfsl_admin_months_render_input( '3', $monthsSaved['m3'] );
        echo abcfsl_admin_months_render_input( '4', $monthsSaved['m4'] );
        echo abcfsl_admin_months_render_input( '5', $monthsSaved['m5'] );
        echo abcfsl_admin_months_render_input( '6', $monthsSaved['m6'] );
        echo abcfsl_admin_months_render_input( '7', $monthsSaved['m7'] );
        echo abcfsl_admin_months_render_input( '8', $monthsSaved['m8'] );
        echo abcfsl_admin_months_render_input( '9', $monthsSaved['m9'] );
        echo abcfsl_admin_months_render_input( '10', $monthsSaved['m10'] );
        echo abcfsl_admin_months_render_input( '11', $monthsSaved['m11'] );
        echo abcfsl_admin_months_render_input( '12', $monthsSaved['m12'] );

        echo abcfl_input_hline('2', '30', '50P');
        //-- Button DIV Start --------------------------
        echo abcfl_html_tag('div','', 'submit' );
        echo abcfl_input_btn( 'btnConvert', 'btnSaveMonths', 'submit', abcfsl_txta(34), 'button-primary abcficBtnWide' );

    //-- ENDs: Button, Main Cntr, Form,  ------------------------------------------------
    echo abcfl_html_tag_ends('div,div,form');    
}

function abcfsl_admin_months_render_input( $no, $value ) {

    $mN = $no;
    if ( $mN < 10 ) { $mN = '0' . $no; }
    return abcfl_input_txt('month' . $mN, '', $value, $no, '', '30%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_admin_months_save( $optnName, $post ) {

    // [_wpnonce] => 013d0e3387
    // [month01] => styczeń
    // [month02] => luty
    // [btnSaveMonths] => Save Changes

    $months = []; 
    if (array_key_exists( 'month01', $post ) ) { $months['m1'] = $post['month01']; }
    if (array_key_exists( 'month02', $post ) ) { $months['m2'] = $post['month02']; }
    if (array_key_exists( 'month03', $post ) ) { $months['m3'] = $post['month03']; }
    if (array_key_exists( 'month04', $post ) ) { $months['m4'] = $post['month04']; }
    if (array_key_exists( 'month05', $post ) ) { $months['m5'] = $post['month05']; }
    if (array_key_exists( 'month06', $post ) ) { $months['m6'] = $post['month05']; }
    if (array_key_exists( 'month07', $post ) ) { $months['m7'] = $post['month07']; }
    if (array_key_exists( 'month08', $post ) ) { $months['m8'] = $post['month08']; }
    if (array_key_exists( 'month09', $post ) ) { $months['m9'] = $post['month09']; }
    if (array_key_exists( 'month10', $post ) ) { $months['m10'] = $post['month10']; }
    if (array_key_exists( 'month11', $post ) ) { $months['m11'] = $post['month11']; }
    if (array_key_exists( 'month12', $post ) ) { $months['m12'] = $post['month12']; }

    if( empty( $months ) ) {
        delete_option( $optnName );
        return;
    }

    //update_option( $optnName, $months ); 
    if ( get_option( $optnName ) !== false ) { 
        update_option( $optnName, $months );     
    } else {
        $autoload = 'no';
        add_option( $optnName, $newValue, '', $autoload );
    }
}

function abcfsl_admin_months_defaults() {
    $months['m1'] = ''; 
    $months['m2'] = ''; 
    $months['m3'] = ''; 
    $months['m4'] = ''; 
    $months['m5'] = ''; 
    $months['m6'] = ''; 
    $months['m7'] = ''; 
    $months['m8'] = ''; 
    $months['m9'] = ''; 
    $months['m10'] = ''; 
    $months['m11'] = ''; 
    $months['m12'] = '';
    return $months;
}
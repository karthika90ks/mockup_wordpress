<?php
/**
 * Add scripts, styles and icons
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_enqueue_scripts', 'abcfsl_scripts_enq', 21 );

function abcfsl_scripts_enq() {

    $obj = ABCFSL_Main();
    $ver = $obj->pluginVersion;

    abcfsl_scripts_enq_css( $ver );
}

function abcfsl_scripts_enq_css( $ver ) {

    wp_register_style('abcfsl-staff-list', ABCFSL_PLUGIN_URL . 'css/staff-list.css', array(), $ver, 'all');
    wp_enqueue_style('abcfsl-staff-list');
}



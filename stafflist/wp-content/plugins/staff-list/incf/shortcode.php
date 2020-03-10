<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}

add_shortcode( 'abcf-staff-list', 'abcfsl_scode_add_list' );
add_shortcode( 'abcf-staff-single', 'abcfsl_scode_add_single' );
//==============================================

function abcfsl_scode_add_list( $scodeArgs ) {
    $args = abcfsl_scode_args( $scodeArgs );
    $args['tplate']= 'L';
    $args['ajax']= '0';
    return abcfsl_cnt_html( $args );
}

//---------------------------------------------------------------

function abcfsl_scode_add_single( $scodeArgs ) {

    $args = shortcode_atts( abcfsl_util_scode_defaults(), $scodeArgs );
    $staffMemberID = ( get_query_var('smid') ) ? get_query_var('smid' ) : 0;
    $args['smid'] =  $staffMemberID;
    $args['staff-name'] = get_query_var('staff-name');

    return abcfsl_cnt_spage($args);
}


function abcfsl_scode_args( $scodeArgs ) {

    $args = shortcode_atts( abcfsl_util_scode_defaults(), $scodeArgs );
    if( $args['random'] == '1' ) { $args['random'] = true;}

    // PG ----
    $staffPg = (get_query_var('page') ) ? get_query_var( 'page' ) : '';
    $args['page'] = $staffPg;

    return $args;
}
//-- Shortcode builders -------------------------------------------
function abcfsl_scode_build_scode( $layoutNo, $tplateID ) {

    $scode = '[abcf-staff-list' . ' id="' . $tplateID . '"]';

    switch ( $layoutNo ) {
        case 10:
            $scode = '[abcf-staff-single' . ' id="' . $tplateID . '"]';
            break;
        default:
            break;
    }
    return esc_attr( $scode );
}
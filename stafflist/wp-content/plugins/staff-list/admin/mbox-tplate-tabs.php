<?php
function abcfsl_mbox_tplate_tabs(){

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;
    $clsPfix = $obj->prefix;

    abcfsl_v_tabs_manager_div_s( '1' ); //---Manager START
        abcfsl_mbox_tplate_tabs_render_nav_tabs();
        abcfsl_mbox_tplate_tabs_render_cnt( $clsPfix );
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsl_mbox_tplate_tabs_render_nav_tabs( ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_txta(344) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(345) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(22) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(346) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(347) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(64) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(348) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(280) );

        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(170) );
    echo abcfl_html_tag_end( 'ul' );

}

function abcfsl_mbox_tplate_tabs_render_cnt( $clsPfix ){

    global $post;
    $tplateID = $post->ID;
    $tplateOptns = get_post_custom( $tplateID );

    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_1', 'abcflVTabsCntCntr' ); //---Content START

    abcfsl_mbox_tplate_staff( $tplateOptns );
    abcfsl_mbox_tplate_css( $tplateOptns, $clsPfix );
    abcfsl_mbox_tplate_img( $tplateOptns );
    abcfsl_mbox_tplate_spg_layout( $tplateOptns );
    abcfsl_mbox_tplate_spg_optns( $tplateID, $tplateOptns );
    mbox_tplate_field_order( $tplateID, $tplateOptns, false );
    mbox_tplate_field_order( $tplateID, $tplateOptns, true );
    abcfsl_mbox_list_order($tplateID, $tplateOptns);

    abcfsl_mbox_tplate_shortcode( $tplateID, $tplateOptns );

    echo abcfl_html_tag_end( 'div' ); //---Content END


}


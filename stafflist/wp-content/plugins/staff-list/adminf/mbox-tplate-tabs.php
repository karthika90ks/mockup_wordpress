<?php
function abcfsl_mbox_tplate_tabs_OLD(){

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;
    $pfix = $obj->prefix;

    abcfsl_v_tabs_manager_div_s( '1' ); //---Manager START
        abcfsl_mbox_tplate_tabs_render_nav_tabs();
        abcfsl_mbox_tplate_tabs_render_cnt( $pfix, $slug );
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsl_mbox_tplate_tabs(){

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;
    $pfix = $obj->prefix;

    global $post;
    $tplateID = $post->ID;
    $tplateOptns = get_post_custom( $tplateID );

    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $layout = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout; 

    abcfsl_v_tabs_manager_div_s( '1' ); //---Manager START

        switch ( $layout ) {
            case 10:
                abcfsl_mbox_tplate_tabs_render_tabs_bday_a();
                abcfsl_mbox_tplate_tabs_render_cnt_bday_a(  $tplateID, $tplateOptns, $pfix, $slug );
                break;                            
            default:
                abcfsl_mbox_tplate_tabs_render_tabs_default();
                abcfsl_mbox_tplate_tabs_render_cnt_default(  $tplateID, $tplateOptns, $pfix, $slug );
                break;
    }
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsl_mbox_tplate_tabs_render_tabs_default( ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_txta(344) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(345) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(2) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(346) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(347) );
            echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(59) );
            echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(100) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(64) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(348) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(280) );
            echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(58) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(170) );
    echo abcfl_html_tag_end( 'ul' );

}

function abcfsl_mbox_tplate_tabs_render_cnt_default( $pfix, $slug ){

    global $post;
    $tplateID = $post->ID;
    $tplateOptns = get_post_custom( $tplateID );

    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_1', 'abcflVTabsCntCntr' ); //---Content START
        abcfsl_mbox_tplate_staff_pg_layout( $tplateOptns );
        abcfsl_mbox_tplate_staff_pg_cntrs( $tplateOptns, $pfix );
        abcfsl_mbox_tplate_img( $tplateOptns, $pfix );
        abcfsl_mbox_tplate_spg_layout( $tplateOptns, 100 );
        abcfsl_mbox_tplate_spg_optns( $tplateID, $tplateOptns, $slug );
        abcfsl_mbox_tplate_social( $tplateOptns );
        abcfsl_mbox_tplate_pg( $tplateOptns );
        abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, false );
        abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, true );
        abcfsl_mbox_tplate_staff_order( $tplateID, $tplateOptns );
        abcfsl_mbox_tplate_structured_data( $tplateOptns );
        abcfsl_mbox_tplate_shortcode( $tplateID, $tplateOptns );
    echo abcfl_html_tag_end( 'div' ); //---Content END
}

//=======================================================
function abcfsl_mbox_tplate_tabs_render_tabs_bday_a(){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_txta(402) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(347) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(508) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(170) );
    echo abcfl_html_tag_end( 'ul' );
}

function abcfsl_mbox_tplate_tabs_render_cnt_bday_a(  $tplateID, $tplateOptns, $pfix, $slug ){

    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_1', 'abcflVTabsCntCntr' ); //---Content START

    abcfsl_mbox_tplate_staff_pg_layout( $tplateOptns );
    abcfsl_mbox_tplate_spg_optns_bday( $tplateID, $tplateOptns, $slug );
    abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, false );
    abcfsl_mbox_tplate_shortcode_bday( $tplateID, $tplateOptns );

    echo abcfl_html_tag_end( 'div' ); //---Content END

}

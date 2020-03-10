<?php
// GRID C GRID D
function abcfsl_mbox_item_tabs(){

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;

    global $post;
    $postID = $post->ID;
    $itemOptns = get_post_custom( $postID );
    $tplateID = $post->post_parent;

    if( $tplateID == 0 ) { $tplateID = get_option( 'sl_default_tplate_id', 0 ); }
    $tplateOptns = get_post_custom( $tplateID );

    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $layout = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;

    abcfsl_v_tabs_manager_div_s( '1' ); //---Manager START

    switch ( $layout ) {
        case 4:
        case 5:    
            abcfsl_mbox_item_tabs_render_nav_c();
            abcfsl_mbox_item_tabs_render_cnt_c( $tplateID, $tplateOptns, $postID );
            break;            
        default:
            abcfsl_mbox_item_tabs_render_nav_tabs();
            abcfsl_mbox_item_tabs_render_cnt( $tplateID, $tplateOptns, $postID );
            break;
    }
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    wp_nonce_field( $slug, $slug . '_nonce' );
}

//=================================================================
function abcfsl_mbox_item_tabs_render_nav_tabs( ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_txta(68) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(69) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(2) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(52) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(9) );
    echo abcfl_html_tag_end( 'ul' );
}

// GRID C GRID D
function abcfsl_mbox_item_tabs_render_nav_c( ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_txta(68) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(69) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(52) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(9) );
    echo abcfl_html_tag_end( 'ul' );
}

//LIST, GRID A, GRID B
function abcfsl_mbox_item_tabs_render_cnt( $tplateID, $tplateOptns, $postID ){

    // global $post;
    // $postID = $post->ID;
    // $itemOptns = get_post_custom( $postID );
    // $tplateID = $post->post_parent;

    // if( $tplateID == 0 ) { $tplateID = get_option( 'sl_default_tplate_id', 0 ); }
    // $tplateOptns = get_post_custom( $tplateID );

    $itemOptns = get_post_custom( $postID );

    //--- Content START ----------------------
    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_1', 'abcflVTabsCntCntr' );

    abcfsl_mbox_item_text( $postID, $itemOptns, $tplateOptns, false );
    abcfsl_mbox_item_text( $postID, $itemOptns, $tplateOptns, true );
    abcfsl_mbox_item_img( $itemOptns, $tplateOptns );
    abcfsl_mbox_item_icons_tab( $itemOptns, $tplateOptns );
    abcfsl_mbox_item_optns( $itemOptns, $tplateOptns );

    echo abcfl_html_tag_end( 'div' );
    //---Content END ----------------------------
}

// GRID C, GRID D
function abcfsl_mbox_item_tabs_render_cnt_c( $tplateID, $tplateOptns, $postID ){

    $itemOptns = get_post_custom( $postID );

    //--- Content START ----------------------
    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_1', 'abcflVTabsCntCntr' );

    abcfsl_mbox_item_text( $postID, $itemOptns, $tplateOptns, false );
    abcfsl_mbox_item_text( $postID, $itemOptns, $tplateOptns, true );
    abcfsl_mbox_item_icons_tab( $itemOptns, $tplateOptns );
    abcfsl_mbox_item_optns( $itemOptns, $tplateOptns );

    echo abcfl_html_tag_end( 'div' );
    //---Content END ----------------------------
}
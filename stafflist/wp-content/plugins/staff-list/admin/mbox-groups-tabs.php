<?php
function abcfsl_mbox_groups_tabs(){

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;
    $pfix = $obj->prefix;

    global $post;
    $postID = $post->ID;
    $grpOptns = get_post_custom( $postID );
    $grpType = isset( $grpOptns['_grpType'] ) ? $grpOptns['_grpType'][0] : '';    

    abcfsl_v_tabs_manager_div_s( '1' ); //---Manager START
    abcfsl_mbox_groups_tabs_render_nav_tabs();
    abcfsl_mbox_groups_tabs_render_cntr_start(); //---Manager END

        //GRPCAT GRPTXT GRPABC
        switch ( $grpType ) {
                case 'GRPCAT':                    
                    abcfsl_mbox_groups_layout( $grpOptns );
                    abcfsl_mbox_group_items( $postID, $grpOptns, $grpType );                                        
                    abcfsl_mbox_shortcode_group( $postID, $grpType );             
                    break;
                case 'GRPTXT':
                    abcfsl_mbox_groups_layout( $grpOptns );
                     abcfsl_mbox_group_items( $postID, $grpOptns, $grpType );                     
                     abcfsl_mbox_shortcode_group( $postID, $grpType ); 
                    break;
                case 'GRPABC':
                    abcfsl_mbox_groups_layout( $grpOptns );
                    abcfsl_mbox_group_items( $postID, $grpOptns, $grpType );
                    abcfsl_mbox_shortcode_group( $postID, $grpType ); 
                    break;                               
                default:
                    abcfsl_mbox_group_items( $postID, $grpOptns, $grpType );
                    break;
        }
        echo abcfl_html_tag_end( 'div' ); //---Manager END
        abcfsl_mbox_groups_tabs_render_cntr_end();

    wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsl_mbox_groups_tabs_render_nav_tabs( ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_txta(13) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(45) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(3) );
    echo abcfl_html_tag_end( 'ul' );
}

function abcfsl_mbox_groups_tabs_render_cntr_start(){
    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_1', 'abcflVTabsCntCntr' ); //---Content START
}

function abcfsl_mbox_groups_tabs_render_cntr_end(){
    echo abcfl_html_tag_end( 'div' ); //---Content END
}
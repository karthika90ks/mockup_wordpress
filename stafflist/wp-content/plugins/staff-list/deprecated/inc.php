<?php
//==== DEPRECATED START ============================
//Called from menu shortcode. Returns  menu HTML. Not linked to a page. Page has two shortcodes: menu and staff.
// function abcfsl_cnt_menu_from_category_shortcode( $scodeArgs ){

//     $menuID = $scodeArgs['id'];
//     $menuOptns = get_post_custom( $menuID );
//     $pageURL = isset( $menuOptns['_fPageUrl'] ) ? esc_attr( $menuOptns['_fPageUrl'][0] ) : '';

//     if( empty( $pageURL ) ){
//         global $post;
//         $postID  = $post->ID;
//         $pageURL = get_permalink($postID);
//     }

//     $menuPar['menuID'] = $menuID;
//     $menuPar['pageURL'] = $pageURL;
//     $menuPar['menuType'] = 'CAT';

//     return abcfsl_cnt_menu_builder( $scodeArgs, $menuPar );
// }

// function abcfsl_cnt_menu_from_shortcode( $scodeArgs, $menuType ){

//     $menuID = $scodeArgs['id'];
//     $menuOptns = get_post_custom( $menuID );
//     $pageURL = isset( $menuOptns['_fPageUrl'] ) ? esc_attr( $menuOptns['_fPageUrl'][0] ) : '';

//     if( empty( $pageURL ) ){
//         global $post;
//         $postID  = $post->ID;
//         $pageURL = get_permalink($postID);
//     }

//     $menuPar['menuID'] = $menuID;
//     $menuPar['pageURL'] = $pageURL;
//     $menuPar['menuType'] = $menuType;

//     return abcfsl_cnt_menu_builder( $scodeArgs, $menuPar );
// }

// function abcfsl_scode_cat_menu( $scodeArgs ) {
//     $out = abcfsl_cnt_menu_from_category_shortcode( abcfsl_scode_args( $scodeArgs ) );
//     return $out['menuItemsHTML'];
// }
// function abcfsl_scode_az_menu( $scodeArgs ) {
//     $out = abcfsl_cnt_menu_from_shortcode( abcfsl_scode_args( $scodeArgs ), 'AZM' );
//     return $out['menuItemsHTML'];
// }

//== LINKS START =========================================

//Fix in free version abcfsl_util_href_bldr ????????????????????? //Get href parts: url + link text + target.
function abcfsl_util_a_tag_parts( $itemOptns, $itemID, $sPageUrl, $F ){

    $aTagParts['hrefUrl'] = '';
    $aTagParts['hrefTxt'] = '';
    $aTagParts['target'] = '';
    $aTagParts['isSP'] = false;

    //Takes all field types. Returns empty if no URL
    $itemUrl = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';
    if( abcfl_html_isblank( $itemUrl ) ) { return $aTagParts; }

    $pretty = isset( $itemOptns['_pretty'] ) ? esc_attr( $itemOptns['_pretty'][0] ) : '';

    $urlOptns = abcfsl_spg_a_tag_url_selector( $itemID, $itemUrl, $sPageUrl, $pretty );
    $itemTxt = isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '';
    if( abcfl_html_isblank( $itemTxt ) ) { $itemTxt = $urlOptns['hrefUrl']; }

    $aTagParts['hrefUrl'] = $urlOptns['hrefUrl'];
    $aTagParts['hrefTxt'] = $itemTxt;
    $aTagParts['target'] = $urlOptns['target'];
    $aTagParts['isSP'] = $urlOptns['isSP'];

    return $aTagParts;
}

//Image Link, SPTL link, Hyperlink. ($imgLnkL = SP)
function abcfsl_util_img_lnk_parts( $staffID, $sPageUrl, $itemOptns, $url ){

    //$imgLnkL = isset( $itemOptns['_imgLnkL'] ) ? esc_attr( $itemOptns['_imgLnkL'][0] ) : '';
    $pretty = isset( $itemOptns['_pretty'] ) ? esc_attr( $itemOptns['_pretty'][0] ) : '';
    $urlParts = abcfsl_spg_a_tag_url_selector( $staffID, $url, $sPageUrl, $pretty );

    $lnk['imgID'] = abcfsl_util_img_lnk_id( isset( $itemOptns['_imgID'] ) ? esc_attr( $itemOptns['_imgID'][0] ) : 0 );
    $lnk['href'] = $urlParts['hrefUrl'];
    $lnk['target'] = $urlParts['target'];
    $lnk['onclick'] = abcfsl_util_lnk_onclick( isset( $itemOptns['_imgLnkClick'] ) ? esc_attr( $itemOptns['_imgLnkClick'][0] ) : '' );
    $lnk['args'] = abcfsl_util_lnk_args(isset( $itemOptns['_imgLnkArgs'] ) ? esc_attr( $itemOptns['_imgLnkArgs'][0] ) : '');

    return $lnk;
}

//Convert NT to _blank
function abcfsl_util_get_target( $url ){

    $out['hrefUrl'] = $url;
    $out['target'] = '';
    if( abcfl_html_isblank( $url ) ) { return $out; }

    if(strlen($url) < 4) { return $out; }

    $targetNT = substr( $url, 0, 2 );
    if( $targetNT == 'NT' ) {
        $out['hrefUrl'] = trim( substr( $url, 2 ) );
        $out['target'] = '_blank';
    }
    return $out;
}

//Get Single page Url if 'SP' used as url. Otherwise return URL as entered.
function abcfsl_util_url_selector( $staffID, $lnkUrl, $sPageUrl, $pretty ){

    $out['hrefUrl'] = '';
    $out['target'] = '';
    $out['isSP'] = false;
    if( abcfl_html_isblank( $lnkUrl ) ) { return $out;}

    if( $lnkUrl == 'NT SP' ) {
        $lnkUrl = 'SP';
        $out['target'] = '_blank';
    }

    if( $lnkUrl == 'SP' ) {
        $out['isSP'] = true;
    }

    //if($lnkUrl == 'SP') {
    if($out['isSP']) {
        //If single page url is blank return empty sting.
        if( abcfl_html_isblank( $sPageUrl ) ) { return $out; }

        

        if( abcfsl_util_is_single_pretty( $sPageUrl, $pretty ) ) {
            $out['hrefUrl'] = trailingslashit( trailingslashit( $sPageUrl ) . $pretty ) ;
            return $out;
        }
        else {
            //Add staff member ID single page url.
            $out['hrefUrl'] = abcfl_html_url( array('smid' => $staffID), $sPageUrl );
            return $out;
        }
    }
    $gt = abcfsl_util_get_target( $lnkUrl );
    $out['hrefUrl'] = $gt['hrefUrl'];
    $out['target'] =  $gt['target'];
    return $out;
}


function abcfsl_util_lnk_onclick( $imgLnkClick ){
    //Check mix of double and single quotes. Return empty if true; ???
    return $imgLnkClick;
}

function abcfsl_util_lnk_args( $lnkArgs ){
    //Convert HTML entities to characters. Double quotes only;
    if(!empty($lnkArgs)){ $lnkArgs = html_entity_decode($lnkArgs, ENT_COMPAT); }
    return $lnkArgs;
}

function abcfsl_util_img_lnk_id( $imgID ){
    if( $imgID == 0 ) { return '';}
    return $imgID;
}
//== LINKS END =========================================

//== PRETTY PERMALINKS START ===========================
//TRUE if single page URL is ready for pretty permalink    
function abcfsl_util_is_single_pretty( $sPageUrl, $pretty ){

    if( empty( $pretty ) ) { return false; }

    if( strlen( $sPageUrl ) < 10 ) { return false; }
    $sPageUrl = rtrim( $sPageUrl, '/' );

    if( substr($sPageUrl, -3) == 'bio' ) { return true; }
    if( substr($sPageUrl, -7) == 'profile' ) { return true; }
    if( substr($sPageUrl, -6) == 'profil' ) { return true; }
    if( substr($sPageUrl, -7) == 'profilo' ) { return true; }
    if( substr($sPageUrl, -6) == 'perfil' ) { return true; }
    //if( substr($sPageUrl, -8) == 'attorney' ) { return true; }

    $out = false;
    if( function_exists( 'abcfslcp_is_single_pretty' )){
       $out = abcfslcp_is_single_pretty( $sPageUrl );
    }
    return $out;
}

// PRETTY ????????? Get staffMemberID when rewrite is implemented
function abcfsl_util_staff_member_id ( $scodeArgs ){

    $tplateID = $scodeArgs['id'];
    $staffID = (int)$scodeArgs['staff-id'];
    $multi = $scodeArgs['multi-template'];

    //Shortcode request to show a specific record: staff-id.
    if( $staffID > 0 ){ return $staffID; }

    //Added by: abcfsl_scode_add_single ()
    $smid = (int)$scodeArgs['smid'];
    $staffName= $scodeArgs['staff-name'];
    $staffMemberID = 0;

    //URL contains staff ID (smid). Return ID.
    if( $smid > 0 ) { return $smid; }

    //No smid, pretty URL assumed but staff-name is empty. Return zero.
    if( empty( $staffName ) ) { return 0; }

    //?smid=63561
    if( !empty( $staffName ) & strlen( $staffName ) > 6 ){

        if ( substr($staffName, 0, 6) == '?smid=' ){ return (int) substr( $staffName, 6 ); }

        $staffMemberID = abcfsl_db_post_id_by_pretty( $tplateID, $staffName, $multi );

        //????? Blank page vs why page is blank.
        if( $staffMemberID == 0 ) { $staffMemberID = -1; }
    }

    return $staffMemberID;
}
//== PRETTY PERMALINKS END ===============================
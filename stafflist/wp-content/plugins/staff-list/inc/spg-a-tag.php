<?php
//== NOT IMPLEMENTED YET == 
//Single page hyperlinks functions. Creates links added to staff page and pretty permalinks.
//==  All functions are currently in util.php
//== 1. Comment out utility functions
//== 2. Include spg-a-tag.php
//== 3. Change prefix and rename functions

//== LINKS START =========================================
//Fix in free version abcfsl_util_href_bldr ?????????????????????
//Get href parts: url + link text + target.

//NOT LOCAL abcfsl_util_a_tag_parts
function abcfsl_spg_a_tag_parts( $itemOptns, $itemID, $sPageUrl, $F ){

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
//NOT LOCAL abcfsl_util_img_lnk_parts
//Image Link, SPTL link, Hyperlink. ($imgLnkL = SP)
function abcfsl_spg_a_tag_img_lnk_parts( $staffID, $sPageUrl, $itemOptns, $url ){

    //$imgLnkL = isset( $itemOptns['_imgLnkL'] ) ? esc_attr( $itemOptns['_imgLnkL'][0] ) : '';
    $pretty = isset( $itemOptns['_pretty'] ) ? esc_attr( $itemOptns['_pretty'][0] ) : '';
    $urlParts = abcfsl_spg_a_tag_url_selector( $staffID, $url, $sPageUrl, $pretty );

    $lnk['imgID'] = abcfsl_spg_a_tag_img_lnk_id( isset( $itemOptns['_imgID'] ) ? esc_attr( $itemOptns['_imgID'][0] ) : 0 );
    $lnk['href'] = $urlParts['hrefUrl'];
    $lnk['target'] = $urlParts['target'];
    $lnk['onclick'] = abcfsl_spg_a_tag_lnk_onclick( isset( $itemOptns['_imgLnkClick'] ) ? esc_attr( $itemOptns['_imgLnkClick'][0] ) : '' );
    $lnk['args'] = abcfsl_spg_a_tag_lnk_args(isset( $itemOptns['_imgLnkArgs'] ) ? esc_attr( $itemOptns['_imgLnkArgs'][0] ) : '');

    return $lnk;
}

//NOT LOCAL abcfsl_util_get_target
//Convert NT to _blank
function abcfsl_spg_a_tag_get_target( $url ){

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

//NOT LOCAL abcfsl_util_url_selector
//Get Single page Url if 'SP' used as url. Otherwise return URL as entered.
function abcfsl_spg_a_tag_url_selector( $staffID, $lnkUrl, $sPageUrl, $pretty ){

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

        if( abcfsl_spg_a_tag_is_single_pretty( $sPageUrl, $pretty ) ) {
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

//NOT LOCAL abcfsl_util_lnk_onclick
function abcfsl_spg_a_tag_lnk_onclick( $imgLnkClick ){
    //Check mix of double and single quotes. Return empty if true; ???
    return $imgLnkClick;
}
//NOT LOCAL abcfsl_util_lnk_args
function abcfsl_spg_a_tag_lnk_args( $lnkArgs ){
    //Convert HTML entities to characters. Double quotes only;
    if(!empty($lnkArgs)){ $lnkArgs = html_entity_decode($lnkArgs, ENT_COMPAT); }
    return $lnkArgs;
}
//LOCAL abcfsl_util_img_lnk_id
function abcfsl_spg_a_tag_img_lnk_id( $imgID ){
    if( $imgID == 0 ) { return '';}
    return $imgID;
}
//== LINKS END =========================================

//== PRETTY PERMALINKS START ===========================
//LOCAL  --------   SLT !!!!!!!!!  abcfsl_util_is_single_pretty
//TRUE if single page URL is ready for pretty permalink
function abcfsl_spg_a_tag_is_single_pretty( $sPageUrl, $pretty ){

    if( empty( $pretty ) ) { return false; }

    if( strlen( $sPageUrl ) < 10 ) { return false; }
    $sPageUrl = rtrim( $sPageUrl, '/' );

    if( substr($sPageUrl, -3) == 'bio' ) { return true; }
    if( substr($sPageUrl, -7) == 'profile' ) { return true; }
    if( substr($sPageUrl, -6) == 'profil' ) { return true; }
    if( substr($sPageUrl, -7) == 'profilo' ) { return true; }
    if( substr($sPageUrl, -6) == 'perfil' ) { return true; }
    if( substr($sPageUrl, -4) == 'team' ) { return true; } 
    //if( substr($sPageUrl, -8) == 'attorney' ) { return true; } 

    //Custom permalinks plugin.
    $out = false;
    if( function_exists( 'abcfslcp_is_single_pretty' )){
       $out = abcfslcp_is_single_pretty( $sPageUrl );
    }
    return $out;
}

//NOT LOCAL 
//Get staffMemberID when rewrite is implemented. abcfsl_util_staff_member_id
function abcfsl_spg_a_tag_staff_member_id ( $scodeArgs ){

    $staffID = (int)$scodeArgs['staff-id'];
    if( $staffID > 0 ){ return $staffID; }

    $tplateID = $scodeArgs['id'];

    $smid = (int)$scodeArgs['smid'];
    $staffName= $scodeArgs['staff-name'];
    $staffMemberID = 0;

    if( $smid > 0) { return $smid; }
    if( empty( $staffName ) ) { return 0; }

    //?smid=63561
    if( !empty( $staffName ) & strlen( $staffName ) > 6 ){

        if ( substr($staffName, 0, 6) == '?smid=' ){ return (int) substr( $staffName, 6 ); }
        $staffMemberID = abcfsl_db_post_id_by_pretty( $tplateID, $staffName );
    }
    return $staffMemberID;
}
//== PRETTY PERMALINKS END ===============================

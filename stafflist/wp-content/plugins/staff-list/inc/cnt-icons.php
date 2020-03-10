<?php
function abcfsl_cnt_icons_field_SL( $par, $itemOptns, $tplateOptns ){

    //$itemID = $par['itemID'];
    $isSingle = $par['isSingle'];
    $clsPfix = $par['clsPfix'];

    $socialSource = isset( $tplateOptns['_socialSource'] ) ? esc_attr( $tplateOptns['_socialSource'][0] ) : '32-70';
    $social1 = isset( $tplateOptns['_social1'] ) ? esc_attr( $tplateOptns['_social1'][0] ) : '';
    $social2 = isset( $tplateOptns['_social2'] ) ? esc_attr( $tplateOptns['_social2'][0] ) : '';
    $social3 = isset( $tplateOptns['_social3'] ) ? esc_attr( $tplateOptns['_social3'][0] ) : '';
    $cntrCls = isset( $tplateOptns['_socialCntrCls'] ) ? esc_attr( $tplateOptns['_socialCntrCls'][0] ) : '';
    $cntrStyle = isset( $tplateOptns['_socialCntrStyle'] ) ? esc_attr( $tplateOptns['_socialCntrStyle'][0] ) : '';
    $socialTM = isset( $tplateOptns['_socialTM'] ) ? esc_attr( $tplateOptns['_socialTM'][0] ) : 'N';

    $fbookUrl = isset( $itemOptns['_fbookUrl'] ) ? esc_attr( $itemOptns['_fbookUrl'][0] ) : '';
    $googlePlusUrl = isset( $itemOptns['_googlePlusUrl'] ) ? esc_attr( $itemOptns['_googlePlusUrl'][0] ) : '';
    $twitUrl = isset( $itemOptns['_twitUrl'] ) ? esc_attr( $itemOptns['_twitUrl'][0] ) : '';
    $likedUrl = isset( $itemOptns['_likedUrl'] ) ? esc_attr( $itemOptns['_likedUrl'][0] ) : '';
    $emailUrl = isset( $itemOptns['_emailUrl'] ) ? esc_attr( $itemOptns['_emailUrl'][0] ) : '';
    $instaUrl = isset( $itemOptns['_instaUrl'] ) ? esc_attr( $itemOptns['_instaUrl'][0] ) : '';

    $socialC1Url = isset( $itemOptns['_socialC1Url'] ) ? esc_attr( $itemOptns['_socialC1Url'][0] ) : '';
    $socialC2Url = isset( $itemOptns['_socialC2Url'] ) ? esc_attr( $itemOptns['_socialC2Url'][0] ) : '';
    $socialC3Url = isset( $itemOptns['_socialC3Url'] ) ? esc_attr( $itemOptns['_socialC3Url'][0] ) : '';

    $iconBaseCls = 'MR10';
    $iconCustomCls = '';
    //$socialCntrBaseCls = '';

    $imgsFolderUrl = ABCFSL_PLUGIN_URL . 'images';
    if( $socialSource == 'C' ){
        $uploadDir = wp_upload_dir();
        $custom = 'abcfolio/staff-list';
        $baseURL = $uploadDir['baseurl'];
        $imgsFolderUrl = trailingslashit( $baseURL ) . $custom;
    }
    $imgsFolderUrl = trailingslashit( $imgsFolderUrl );

    $fbookCntr = abcfsl_cnt_icons_social_a_tag( 'facebook', 'Facebook', $fbookUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $googlePlusCntr = abcfsl_cnt_icons_social_a_tag( 'googleplus', 'Google+', $googlePlusUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $twitCntr = abcfsl_cnt_icons_social_a_tag( 'twitter', 'Twitter', $twitUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $linkedCntr = abcfsl_cnt_icons_social_a_tag( 'linkedin', 'LinkedIn', $likedUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    //$instaCntr = abcfsl_cnt_icons_social_a_tag( 'instagram', 'Instagram', $instaUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $emailCntr = abcfsl_cnt_icons_social_a_tag( 'email', 'Email', $emailUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );

    $c1Cntr = abcfsl_cnt_icons_social_a_tag( abcfsl_cnt_icons_social_custom_basename( $social1, '1' ), $social1, $socialC1Url, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $c2Cntr = abcfsl_cnt_icons_social_a_tag( abcfsl_cnt_icons_social_custom_basename( $social2, '2'), $social2, $socialC2Url, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $c3Cntr = abcfsl_cnt_icons_social_a_tag( abcfsl_cnt_icons_social_custom_basename( $social3, '3'), $social3, $socialC3Url, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );

    $socialCntr = abcfsl_cnt_icons_social_cntr_cls( $socialTM, $cntrCls, $cntrStyle, $clsPfix, $isSingle );

    //$socialIcons = $fbookCntr . $googlePlusCntr . $twitCntr . $linkedCntr .  $c1Cntr . $c2Cntr . $c3Cntr . $emailCntr;
    //return $socialCntr['cntrS'] . $socialIcons . $socialCntr['cntrE'];

    return $socialCntr['cntrS'] . $fbookCntr . $googlePlusCntr . $twitCntr . $linkedCntr .  $c1Cntr . $c2Cntr . $c3Cntr . $emailCntr . $socialCntr['cntrE'];
}

function abcfsl_cnt_icons_social_cntr_cls( $socialTM, $customCls, $cntrStyle, $clsPfix, $isSingle ){

    $clsTM = abcfsl_util_cls_name_ncd_bldr( $socialTM, 'MT', $clsPfix );
    $baseCls = trim ( 'SocialIconsA '  . $clsTM);
    return abcfsl_cnt_generic_div( $clsPfix, $baseCls, $customCls, $cntrStyle, '', '', '', 'N', $isSingle);
}
//========================================================================
//Single icon cntr $href
function abcfsl_cnt_icons_social_a_tag( $fileBaseName, $iconTitle, $href, $socialSource, $imgsFolderUrl, $clsPfix, $baseCls, $customCls, $isSingle ){

    if( empty( $href ) ){ return ''; }
    if( empty( $iconTitle ) ){ return ''; }
    if( empty( $fileBaseName ) ){ return ''; }

    $iconTitle = str_replace( '_', ' ', $iconTitle );

    $iconCls = '';
    $iconStyle = '';
    $aCls = abcfsl_cnt_class_bldr( $clsPfix, $baseCls, $customCls, $isSingle );

    $imgUrl = abcfsl_cnt_icons_social_url( $socialSource, $imgsFolderUrl, $fileBaseName);

     //( $imgID, $src, $alt, $title, $cls='', $style='', $args='', $itemprop='image' )
    $imgTag = abcfl_html_img_tag_resp('', $imgUrl, $iconTitle, $iconTitle, $iconCls, $iconStyle);

    $aTag['hrefUrl'] = $href;
    $aTag['target'] = '';

    //?????????????????????????????????????
    if( $fileBaseName == 'email' ){
        $aTag['hrefUrl'] = $url = 'mailto:' . $href;
    }
    else {
       $aTag = abcfsl_spg_a_tag_get_target( $href );
    }

    //abcfl_html_a_tag($href, $lnkTxt, $target='', $cls='', $style='', $spanStyle='', $blankTag=true, $onclickJS='', $args='')
    $imgATag = abcfl_html_a_tag( $aTag['hrefUrl'], $imgTag, $aTag['target'], $aCls, '', '', false );

    return $imgATag;
}

//Returns icon URL.
function abcfsl_cnt_icons_social_url( $socialSource, $imgsFolderUrl, $fileBaseName ){

    //Custom icons. $fileBaseName = name of the icon included with the plugin OR custom1, custom2...
    //$imgsFolderUrl uploads/abcfolio/staff-list
    if( $socialSource == 'C' ){ return $imgsFolderUrl . $fileBaseName . '.png';  }

    // SLSN
    //Icons included in the plugin. subfolder: 32; 488.... abcfsls_cbo_social_icons()
    $subfolder = trailingslashit( $socialSource );

    return $imgsFolderUrl . $subfolder . $fileBaseName . '.png';
}


//Figure out $fileBaseName from custom social icon name.
//In: Value of: Template Options > Social Icons > Custom Link 1, Custom Link 2...
//Out: fileBaseName of one of the default icons included in the plugin. OR social1, social2....
function abcfsl_cnt_icons_social_custom_basename( $iconTitle, $no ){

    if( empty( $iconTitle ) ){ return ''; }

    $iconTitleL = strtolower ( $iconTitle );
    if( $iconTitleL == 'google+' ) { $iconTitleL = 'googleplus'; }
    $fileBaseName = $iconTitleL;

    return $fileBaseName;
}
//=== STAR RATINGS START ======================================================================
function abcfsl_cnt_icons_field_STARR( $par, $tplateOptns, $itemOptns, $F ){

    $iTag = isset( $tplateOptns['_tagType_' . $F] ) ? $tplateOptns['_tagType_' . $F][0] : 'I'; 
    $iType = isset( $tplateOptns['_iconType_' . $F] ) ? $tplateOptns['_iconType_' . $F][0] : 'WOFF'; 
    $iconMaxQty = isset( $tplateOptns['_iconMaxQty_' . $F] ) ? $tplateOptns['_iconMaxQty_' . $F][0] : '';
    $iconOnCls = isset( $tplateOptns['_iconOnCls_' . $F] ) ? esc_attr( $tplateOptns['_iconOnCls_' . $F][0] ) : '';
    $iconOffCls = isset( $tplateOptns['_iconOffCls_' . $F] ) ? esc_attr( $tplateOptns['_iconOffCls_' . $F][0] ) : '';
    $iconOnStyle = isset( $tplateOptns['_iconOnStyle_' . $F] ) ? esc_attr( $tplateOptns['_iconOnStyle_' . $F][0] ) : '';
    $iconOffStyle = isset( $tplateOptns['_iconOffStyle_' . $F] ) ? esc_attr( $tplateOptns['_iconOffStyle_' . $F][0] ) : '';
    
    $rating = $par['lineTxt'];

    if( empty( $iconOnCls )  ) { return ''; }
    if( empty( $rating )  ) { return ''; }
    if( $rating == '0' )  { return ''; }
    if( empty( $iconMaxQty )  ) { return ''; }
    $rating = (int)$rating;

    $iCls = $iconOnCls . ' kamStarOn';
    $iStyle = $iconOnStyle;
    $stars = '';

    if( empty( $iconOffCls )  ) {  $iconMaxQty = $rating; }

    for ( $x = 1; $x <= $iconMaxQty; $x++) {
        if( $x > $rating ) { 
            $iCls = $iconOffCls; 
            $iStyle = $iconOffStyle;
        }
        $stars .= abcfsl_cnt_icons_icon_cntr( $iCls, $iStyle, $iTag, $iType );
    } 

    //$id = '';
    $tagCls = $par['tagCls']  . ' ' . $par['fieldType'] . $par['F'];
    $lbl = $rating . '/' . $iconMaxQty;
    $microdata = 'aria-label="' . $lbl . '"';

    return  abcfl_html_tag_with_content(  $stars, 'div', '',  $tagCls, '', $microdata, false );
}
//=== STAR RATINGS END ======================================

//=== ICON LINKS START ======================================
function abcfsl_cnt_icons_field_ICONLNK( $par, $tplateOptns, $itemOptns, $F ){

    $iTag = isset( $tplateOptns['_tagType_' . $F] ) ? $tplateOptns['_tagType_' . $F][0] : 'I';  
    $iconML = isset( $tplateOptns['_iconML_' . $F] ) ? $tplateOptns['_iconML_' . $F][0] : 'XXXXX';
    $iType = isset( $tplateOptns['_iconType_' . $F] ) ? $tplateOptns['_iconType_' . $F][0] : 'WOFF'; 
    $iLnkNT = isset( $tplateOptns['_lnkNT_' . $F] ) ? $tplateOptns['_lnkNT_' . $F][0] : '';

    $icon1Name = isset( $tplateOptns['_icon1Name_' . $F] ) ? esc_attr( $tplateOptns['_icon1Name_' . $F][0] ) : '';
    $icon1Cls = isset( $tplateOptns['_icon1Cls_' . $F] ) ? esc_attr( $tplateOptns['_icon1Cls_' . $F][0] ) : '';
    $icon1Style = isset( $tplateOptns['_icon1Style_' . $F] ) ? esc_attr( $tplateOptns['_icon1Style_' . $F][0] ) : '';

    $icon2Name = isset( $tplateOptns['_icon2Name_' . $F] ) ? esc_attr( $tplateOptns['_icon2Name_' . $F][0] ) : '';
    $icon2Cls = isset( $tplateOptns['_icon2Cls_' . $F] ) ? esc_attr( $tplateOptns['_icon2Cls_' . $F][0] ) : '';   
    $icon2Style = isset( $tplateOptns['_icon2Style_' . $F] ) ? esc_attr( $tplateOptns['_icon2Style_' . $F][0] ) : '';

    $icon3Name = isset( $tplateOptns['_icon3Name_' . $F] ) ? esc_attr( $tplateOptns['_icon3Name_' . $F][0] ) : '';
    $icon3Cls = isset( $tplateOptns['_icon3Cls_' . $F] ) ? esc_attr( $tplateOptns['_icon3Cls_' . $F][0] ) : '';   
    $icon3Style = isset( $tplateOptns['_icon3Style_' . $F] ) ? esc_attr( $tplateOptns['_icon3Style_' . $F][0] ) : '';    

    $icon4Name = isset( $tplateOptns['_icon4Name_' . $F] ) ? esc_attr( $tplateOptns['_icon4Name_' . $F][0] ) : '';
    $icon4Cls = isset( $tplateOptns['_icon4Cls_' . $F] ) ? esc_attr( $tplateOptns['_icon4Cls_' . $F][0] ) : '';
    $icon4Style = isset( $tplateOptns['_icon4Style_' . $F] ) ? esc_attr( $tplateOptns['_icon4Style_' . $F][0] ) : '';

    $icon5Name = isset( $tplateOptns['_icon5Name_' . $F] ) ? esc_attr( $tplateOptns['_icon5Name_' . $F][0] ) : '';
    $icon5Cls = isset( $tplateOptns['_icon5Cls_' . $F] ) ? esc_attr( $tplateOptns['_icon5Cls_' . $F][0] ) : '';   
    $icon5Style = isset( $tplateOptns['_icon5Style_' . $F] ) ? esc_attr( $tplateOptns['_icon5Style_' . $F][0] ) : '';

    $icon6Name = isset( $tplateOptns['_icon6Name_' . $F] ) ? esc_attr( $tplateOptns['_icon6Name_' . $F][0] ) : '';
    $icon6Cls = isset( $tplateOptns['_icon6Cls_' . $F] ) ? esc_attr( $tplateOptns['_icon6Cls_' . $F][0] ) : '';   
    $icon6Style = isset( $tplateOptns['_icon6Style_' . $F] ) ? esc_attr( $tplateOptns['_icon6Style_' . $F][0] ) : ''; 

    $icon1Url = isset( $itemOptns['_icon1Url_' . $F] ) ? esc_attr( $itemOptns['_icon1Url_' . $F][0] ) : '';    
    $icon2Url = isset( $itemOptns['_icon2Url_' . $F] ) ? esc_attr( $itemOptns['_icon2Url_' . $F][0] ) : '';     
    $icon3Url = isset( $itemOptns['_icon3Url_' . $F] ) ? esc_attr( $itemOptns['_icon3Url_' . $F][0] ) : '';  
    $icon4Url = isset( $itemOptns['_icon4Url_' . $F] ) ? esc_attr( $itemOptns['_icon4Url_' . $F][0] ) : '';
    $icon5Url = isset( $itemOptns['_icon5Url_' . $F] ) ? esc_attr( $itemOptns['_icon5Url_' . $F][0] ) : '';  
    $icon6Url = isset( $itemOptns['_icon6Url_' . $F] ) ? esc_attr( $itemOptns['_icon6Url_' . $F][0] ) : ''; 


    if( !empty( $iconML ) ) { $iconML = ' ' . $par['clsPfix'] . 'IMR' . $iconML . ' ' . $par['clsPfix'] . 'IMR'; }

    $cntrCls = $par['tagCls'] . $iconML . ' ' . $par['fieldType'] . $par['F'];

    $microdata = '';
    $out = '';
    $out .= abcfsl_cnt_icons_lnk_cntr( $icon1Url, $icon1Cls, $icon1Style, $icon1Name, $iTag, $iType, $iLnkNT );
    $out .= abcfsl_cnt_icons_lnk_cntr( $icon2Url, $icon2Cls, $icon2Style, $icon2Name, $iTag, $iType, $iLnkNT );
    $out .= abcfsl_cnt_icons_lnk_cntr( $icon3Url, $icon3Cls, $icon3Style, $icon3Name, $iTag, $iType, $iLnkNT );
    $out .= abcfsl_cnt_icons_lnk_cntr( $icon4Url, $icon4Cls, $icon4Style, $icon4Name, $iTag, $iType, $iLnkNT );
    $out .= abcfsl_cnt_icons_lnk_cntr( $icon5Url, $icon5Cls, $icon5Style, $icon5Name, $iTag, $iType, $iLnkNT );
    $out .= abcfsl_cnt_icons_lnk_cntr( $icon6Url, $icon6Cls, $icon6Style, $icon6Name, $iTag, $iType, $iLnkNT );

    return abcfl_html_tag_with_content(  $out, 'div', '',  $cntrCls, '', $microdata, false );
}

function abcfsl_cnt_icons_lnk_cntr(  $url, $iCls, $iStyle, $iName, $iTag, $iType, $iLnkNT ){

    if( empty( $url )  ) { return ''; }
    if( empty( $iName )  ) { return ''; }
    if( empty( $iCls )  ) { return ''; }
    
    $microdata = 'aria-label="' . $iName . '"';

    $partsURL = abcfsl_spg_a_tag_get_target( $url );
    $hrefUrl = $partsURL['hrefUrl'];
    $target = $partsURL['target'];
    if( !empty( $iLnkNT ) ) {  $target = '_blank'; }

    $iconHTML = abcfsl_cnt_icons_icon_cntr( $iCls, $iStyle, $iTag, $iType );

    return abcfl_html_a_tag_icon( $hrefUrl, $iconHTML, $target, '', $microdata );

    // <a aria-label="Skip to main navigation" href="#navigation-main">
    // <i aria-hidden="true" class="fas fa-bars"></i>
    // </a>
}

//------------------------
function abcfsl_cnt_icons_icon_cntr( $iCls, $iStyle, $iTag, $iType ){

    $iconHTML = '';
    if( $iType == 'SVG' ){
        $iconHTML = abcfsl_cnt_icons_icon_cntr_svg( $iCls, $iStyle, $iTag, $iName );
    }
    else {
        $iconHTML = abcfsl_cnt_icons_icon_cntr_font( $iCls, $iStyle, $iTag  );
    }
    return $iconHTML;
}

//HTML of single icon, web font.
function abcfsl_cnt_icons_icon_cntr_font( $iCls, $iStyle, $iTag ){

    if( empty( $iCls )  ) { return ''; }
    $microdata = 'aria-hidden="true"';
    return abcfl_html_tag_with_content( '', $iTag, '', $iCls, $iStyle, $microdata, true );

    //<i aria-hidden="true" class="fas fa-bars" style="color:#ff0000;"></i>
}

//HTML of single icon, SVG.
function abcfsl_cnt_icons_icon_cntr_svg( $iCls, $iStyle, $iTag, $iName ){

    if( empty( $iCls )  ) { return ''; }
    $microdata = 'title="' . $iName . '"';
    return abcfl_html_tag_with_content( '', $iTag, '', $iCls, $iStyle, $microdata, true );

    //<i title="Magic is included!" class="fas fa-magic"></i>
}
//=== ICON LINKS END ======================================




<?php
function abcfsl_aurl( $id ) {

    $d = 'https://abcfolio.com/';
    $sld = 'https://abcfolio.com/wordpress-plugin-staff-list/documentation/';
    //DONE MENUS
    //Staff List Customization
    //Staff List Fields
    //Staff List Filters and Menus
    //Staff List Groups
    //Staff List Images
    //Staff List Member
    //Staff List SEO
    //Staff List Single Page
    //Staff List Template

    switch ($id){
        case 0:
            $out = '';
            break;
        case 1: 
            $out = '';
            break;
        case 2: 
            $out = $sld . 'custom-css-classes/';
            break;
        case 3: 
            $out = $sld . 'filters-and-menus/';
            break;
        case 4: 
            $out = $sld . 'staff-template-single-page-options/';            
            break;
        case 5: 
            $out = $sld . 'input-fields-field-display-options/';
            break;
        case 6:             
            $out = $sld . 'staff-template-image-defaults/';
            break;
        case 7:
            $out = $sld . 'social-media-icons/';
            break;
        case 8:
            $out = $sld . 'social-media-icons/#custom-links';
            break;
        case 9:
            $out = $sld . 'single-page-layouts/';
            break;
        case 10:
            $out = $sld . 'quick-start/';
            break;
        case 11:
            $out = $d . 'wordpress-plugin-staff-list/';
            break;
        case 12:
            $out = $sld . 'create-single-page/';
            break;
        case 13:
            $out = $sld . 'input-fields-add-field/';
            break;
        case 14:
            $out = $sld . 'input-fields-field-style/';
            break;
        case 15:            
            $out = $sld . 'field-type-static-label-and-date/#date-display-format';
            break;
        case 16:            
            $out = $sld . 'field-type-static-label-and-date/#date-static-label';
            break;
        case 17:            
            $out = $sld . 'staff-list-layout-grid-c/';
            break;
        case 18:            
            $out = $sld . 'field-type-staff-categories/#excluded-slugs';
            break;
        case 19:            
            $out = $sld . 'field-type-icon-font-with-links/#icon-options'; 
            break;
        case 20:            
            $out = $sld . 'field-type-icon-font-star-rating/#icon-options'; 
            break;
        case 21:            
            $out = $sld . 'field-type-static-label-and-date/#month-names';
            break;
        case 22:
            $out = $sld . 'create-single-page/#single-page-blank';
            break;
        case 23:
            $out = $sld . 'field-type-single-page-text-link/';
            break;
        case 24:
            $out = '';
            break;
        case 25:
            $out = $sld . 'staff-list-layouts/';
            break;
        case 26:
            $out = $sld . 'staff-list-layout-list/';
            break;
        case 27:
            $out = $sld . 'staff-list-layout-grid-a/';
            break;
        case 28:
            $out = $sld . 'staff-list-layout-grid-b/';
            break;
        case 29:
            $out = $sld . 'single-page/';
            break;
        case 30:
            $out = $sld . 'staff-list-layout-grid-b/#grid-b-item-container';
            break;
        case 31:
            $out = $sld . 'staff-order/';
            break;
        case 32:
            $out = $d . 'quality-wordpress-plugins-support-registration/';
            break;
        case 33:            
            $out = $sld . 'input-fields-field-labels/';
            break;
        case 34:
            $out = $sld . 'categories-menu/';
            break;
        case 35:
            $out = $sld . 'az-menu/';
            break;
        case 36:
            $out = $sld . 'multi-filter/';
            break;
        case 37:
            $out = $sld . 'add-menu-to-page/';
            break;
        case 38:
            $out = $sld . 'pagination/';
            break;
        case 39:
            $out = '';
            break;
        case 40:
            $out = $sld . 'circular-images/';
            break;
        case 41:
            $out = $sld . 'images/';
            break;
        case 42:
            $out = $sld . 'image-overlay/';
            break;
        case 43:
            $out = $sld . 'image-options/';
            break;
        case 44:
            $out = $sld . 'image-placeholders/';
            break;
        case 45:   
            $out = '';        
            break;
        case 46:
            $out = $sld . 'structured-data/';
            break;
        case 47:            
            $out = '';
            break;
        case 48:            
            $out = '';
            break;
        case 49:
            $out = $sld . 'images-alt-tag/';
            break;
//------------------------------
        case 50:
            $out = $sld . 'staff-page-images/';
            break;
        case 51:
            $out = $d . 'wordpress-plugin-registration/';
            break;
        case 52:
            $out = $d . 'abcfolio-plugins-instalation-and-updates/#license-key';
            break;
        case 53:
            $out = $sld . 'field-type-static-text/#Linked-Fields';
            break;
        case 54:
            $out = $sld . 'staff-list-page/#create-and-publish-staff-list-page';
            break;
        case 55:
            $out = $sld . 'shortcodes/#shortcode-category-filter';
            break;
        case 56:
            $out = $sld . 'shortcodes/#shortcode-options';
            break;
        case 57:
            $out = '';
            break;
        case 58:
            $out = '';
            break;
        case 59:
            $out = '';
            break;
//------------------------------
        case 60:
            $out = $sld . 'single-page-pretty-permalinks/#permalink-spg-name';
            break;
        case 61:            
            $out = '';
            break;
        case 62:
            $out = '';
            break;
        case 63:
            $out = $sld . 'staff-list-layout-list/#left-right-columns';
            break;
        case 64:
            $out = $sld . 'single-page-layout/#left-right-columns';
            break;
        case 65:
            $out = $sld . 'image-overlay/#overlay-image-width';
            break;
        case 66:
            $out = $sld . 'image-links/';
            break;
        case 67:
            $out = $sld . 'single-page-images/';
            break;
        case 68:
            $out = $d . 'staff-list-plugin-getting-started/';
            break;            
        case 69:            
            break;
//------------------------------
        case 70:
            $out = '';
            break;
        case 71:
            $out = $sld . 'sort-text-data-entry/';
            break;
        case 72:
            $out = $sld . 'groups-layout-options/#horizontal-line';
            break;            
        case 73:
            $out = $sld . 'customization/';
            break; 
        case 74:
            $out = $sld . 'groups/';
            break; 
        case 75:
            $out = $sld . 'group-by-first-letter-a-z/';
            break; 
        case 76:
            $out = $sld . 'groups-shortcode-parameter/';
            break; 
        case 77:
            $out = $sld . 'groups-layout-options/';
            break;
        case 78:
            $out = $sld . 'group-by-categories/';
            break; 
        case 79:
            $out = $sld . 'group-by-text/';
            break; 
//------------------------------                
        case 80:
            $out = $sld . 'field-type-drop-down-group/#create-drop-down-list';
            break; 
        case 81:
            $out = $sld . 'field-type-drop-down-group/#drop-down-options';
            break;
        case 82:
            $out = $sld . 'field-type-drop-down-group/#custom-css';
            break; 
        case 83:
            $out = $d . '';
            break; 
        case 84:
            $out = $sld . 'field-type-checkbox-group/#checkbox-values';
            break; 
        case 85:
            $out = $sld . 'field-type-checkbox-group/#static-label';
            break; 
        case 86:
            $out = $sld . 'field-type-checkbox-group/#custom-css';
            break; 
        case 87:
        $out = $d . '';
        break;  
        case 88:
        $out = $d .'' ;
        break; 
        case 89:
        $out = $d . '';
        break; 
//------------------------------         
        case 90:
        $out = $d .'' ;
        break; 
        case 91:
        $out = $d . '';
        break; 
        case 92:
        $out = $d .'' ;
        break; 
        case 93:
        $out = $d . '';
        break;                                          

        default:
            $out = '';
            break;
    }
    return $out;
}

function abcfsl_aurl_f( $fieldTypeH ) {

    $sld = 'https://abcfolio.com/wordpress-plugin-staff-list/documentation/';

    switch ($fieldTypeH){
        case 'STXT': 
            $out = $sld . 'field-type-static-text/';
            break;
        case 'MP':
            $out = $sld . 'field-type-name-multipart/';
            break;
        case 'T': 
            $out = $sld . 'field-type-single-line-text/';
            break;
        case 'PT':
            $out = $sld . 'field-type-paragraph-text/';
            break;
        case 'LT':
            $out = $sld . 'field-type-static-label-and-text/';
            break;
        case 'H':
            $out = $sld . 'field-type-hyperlink/';
            break;
        case 'TH':
            $out = $sld . 'field-type-hyperlink-with-static-text/';
            break;
        case 'SH':
            $out = '';
            break;
        case 'EM':
            $out = $sld . 'field-type-email/';
            break;            
        case 'IMGCAP': 
            $out = $sld . 'field-type-image-with-caption/';
            break; 
        case 'IMGHLNK': 
            $out = $sld . 'field-type-image-hyperlink';
            break; 
        case 'SLDTE': 
            $out = $sld . 'field-type-static-label-and-date/';
            break;             
        case 'CHECKG':
            $out = $sld . 'field-type-checkbox-group/';
            break;            
        case 'CBOM': 
            $out = $sld . 'field-type-drop-down-group/';
            break;                                 
        case 'CE':
            $out = $sld . 'field-type-text-editor/';
            break;
        case 'HL':
            $out = $sld . 'field-type-horizontal-line/';
            break;
        case 'SC':
            $out = $sld . 'field-type-shortcode/';
            break;
        case 'CBO':
            $out = $sld . 'field-type-drop-down/';
            break;
        case 'LBLCBO':
            $out = $sld . '-field-type-drop-down-and-static-label/';
            break;
        case 'STXEM':
            $out = $sld . 'field-type-email-with-static-text/';
            break;
        case 'SLFONE':
            $out = $sld . 'field-type-phone-and-static-label/';
            break;  
        case 'FONE':
            $out = $sld . 'field-type-phone/';
            break;  
        case 'STARR': 
            $out = $sld . 'field-type-icon-font-star-rating/';
            break;  
        case 'ICONLNK': 
            $out = $sld . 'field-type-icon-font-with-links/';
            break; 
        case 'STFFCAT': 
            $out = $sld . 'field-type-staff-categories/';
            break; 
        case 'POSTTITLE': 
            $out = $sld . 'field-type-post-title/';
            break;             
        default:
            $out = '';
            break;
    }
    return $out;
}


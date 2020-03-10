<?php
function abcfsl_cnt_cats_field_STFFCAT( $par, $excludedSlugs ){

    $staffID = $par['itemID'];

    $cats = abcfsl_cnt_cats_staff_member( $staffID, $excludedSlugs );
    if( abcfl_html_isblank( $cats ) ) { return ''; }
    //------------------------------
    $par['lineTxt'] = $cats;
    $staticTxt = $par['lblTxt'];

    if( abcfl_html_isblank( $staticTxt ) ) {   
        return abcfsl_cnt_field_T( $par ); 
    }

    return abcfsl_cnt_field_LT ( $par );
}

function abcfsl_cnt_cats_staff_member( $staffID, $excludedSlugs ){

    $staffMTerms = get_the_terms( $staffID, 'tax_staff_member_cat' );

    if ( !$staffMTerms ){ return ''; }
    if ( is_wp_error( $staffMTerms ) ){ return ''; }
    if( empty( $staffMTerms ) ) { return ''; }

    $staffMCats = array();
    foreach ( $staffMTerms as $term ) {
        $staffMCats[$term->slug] = $term->name;
    }

    $notExcluded = abcfsl_cnt_cats_not_excluded( $staffMCats, $excludedSlugs );
    if( empty( $notExcluded ) ) { return ''; }
    return implode (", ", $notExcluded);
}

function abcfsl_cnt_cats_not_excluded( $staffMCats, $excludedSlugs ){

    if( empty( $excludedSlugs ) ) { return $staffMCats; }

    $excluded = explode(',', $excludedSlugs);
    foreach ( $excluded as $slug ) {
        unset( $staffMCats[$slug] );
    }
    return $staffMCats;  
}

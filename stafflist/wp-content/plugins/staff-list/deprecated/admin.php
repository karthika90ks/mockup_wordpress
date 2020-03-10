<?php
// ACTION
// function abcfsl_mbox_mfilter_layout_frm_action( $filterOptns ){
//     $mfFrmAction = isset( $filterOptns['_mfFrmAction'] ) ? esc_attr( $filterOptns['_mfFrmAction'][0] ) : '';
//     echo abcfl_input_hline('2');
//     echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, '', '' );
//     echo abcfl_input_txt('mfFrmAction', '', $mfFrmAction,  abcfsl_txta(0, 'URL'), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
// }

function abcfsl_cbo_add_field_type_OLD() {
    return array('N'  => '- - -',
    'CHECKG'  => abcfsl_txta(375),
    'CBOM'  => abcfsl_txta(352), 
    'CBO'  => abcfsl_txta(234),
    'LBLCBO'  => abcfsl_txta(274),
    'EM'  => abcfsl_txta(290),
    'STXEM'  => abcfsl_txta(337), 
    'H'  => abcfsl_txta(82),
    'TH'  => abcfsl_txta(256),
    'HL'  => abcfsl_txta(324),        
    'IMGCAP'  => 'Image + Caption',
    'IMGHLNK'  => abcfsl_txta(0),
    'MP'  => abcfsl_txta(313),
    'PT'  => abcfsl_txta(86),
    'FONE'  => abcfsl_txta(0),
    'SC'  => abcfsl_txta(3),
    'T'  => abcfsl_txta(38),
    'SLDTE'  => abcfsl_txta(390),
    'SLFONE'  => abcfsl_txta(381),
    'LT'  => abcfsl_txta(206),
    'STXT'  => abcfsl_txta(182),

    'CE'  => abcfsl_txta(73)
    );
}

//FOR Field number and datatype. Includes deprecated 'SH' (74)
function abcfsl_cbo_field_type_all_OLD() {
    return array('N'  => '- - -',    
        'T'  => abcfsl_txta(38),
        'PT'  => abcfsl_txta(86),
        'CE'  => abcfsl_txta(73),
        'MP'  => abcfsl_txta(313),
        'EM'  => abcfsl_txta(290),
        'STXEM'  => abcfsl_txta(337),        
        'H'  => abcfsl_txta(82),
        'TH'  => abcfsl_txta(256),  
        'LT'  => abcfsl_txta(206),
        'STXT'  => abcfsl_txta(182),
        'CBO'  => abcfsl_txta(234),
        'LBLCBO'  => abcfsl_txta(274),
        'CBOM'  => abcfsl_txta(352),
        'CHECKG'  => abcfsl_txta(375), 
        'SC'  => abcfsl_txta(3), 
        'SLFONE'  => abcfsl_txta(381),
        'FONE'  => abcfsl_txta(0),
        'HL'  => abcfsl_txta(324),
        'IMGCAP'  => 'Image + Caption',       
        'IMGHLNK'  => abcfsl_txta(0), 
        'SLDTE'  => abcfsl_txta(390),
        'SH'  => abcfsl_txta(74)
    );
}
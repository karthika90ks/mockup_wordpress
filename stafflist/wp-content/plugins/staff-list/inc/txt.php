<?php
//abcfl_html_tag_with_content abcfsl_cnt_spage
function abcfsl_txt($id, $suffix='') {

    switch ($id){
        case 1:
            $out = 'Staff List Birthdays plugin not installed!';
            break;
        case 2:
            $out = '';
            break;
        case 3:
            $out = '';
            break;          
        default:
            $out = '';
            break;
    }
    return $out . $suffix;
}
function abcfsl_txt_err ( $id, $suffix='', $bold=false ) {
    $txt = abcfsl_txt($id, $suffix='');
    return '<div class="abcflRed">' . $txt . '</div>';

}
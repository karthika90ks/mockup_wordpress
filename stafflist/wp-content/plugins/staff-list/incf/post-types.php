<?php
/**
 * Custom post types setup NEW
*/
if ( ! defined( 'ABSPATH' ) ) {exit;}

add_action( 'init', 'abcfsl_register_tax_category', 10);
add_action( 'init', 'abcfsl_register_post_types', 100 );
//----------------------------------------
function abcfsl_register_post_types() {

    $slug = 'edit.php?post_type=cpt_staff_lst_item';

    //register_post_type( 'cpt_staff_lst_item', abcfsl_setup_post_type_sm( $slug ) );
    register_post_type( 'cpt_staff_lst_item', abcfsl_post_types_args_sm() );
    //register_post_type( 'cpt_staff_lst', abcfsl_setup_post_type_st( $slug ) );
    register_post_type( 'cpt_staff_lst', abcfsl_post_types_args_st( $slug ) );
    //register_post_type( 'cpt_staff_lst_menu', abcfsl_post_types_args_cm() );
    register_post_type( 'cpt_staff_grps', abcfsl_post_types_group( $slug, abcfsl_post_types_group_lbls() ) );
}

function abcfsl_register_tax_category() {
    register_taxonomy( 'tax_staff_member_cat', array( 'cpt_staff_lst_item'), abcfsl_tax_category_args() );
}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

//-- Staff Member ---------------------------------------------
function abcfsl_post_types_lbls_sm() {

    $lbls = array(
            'menu_name' => 'Staff List',
            'name'               => __('Staff Members', 'staff-list'), //Staff Members Admin table header
            'add_new'            => __('Add New', 'staff-list'),
            'add_new_item'       => __('Staff Member', 'staff-list'), //Staff Member, New record
            'edit_item'          => __('Staff Member', 'staff-list'), //Staff Member, Edit  record
            'all_items'          => __('Staff Members', 'staff-list') //Staff Members Main menu label
    );
    return $lbls;
}

function abcfsl_post_types_args_sm() {

    $args = array(
        'labels'        => abcfsl_post_types_lbls_sm(),
        'description'   => '',
        'taxonomies'    => array( 'tax_staff_lst_grp' ),
        'public'        => true,
    'exclude_from_search'   => true,
    'publicly_queryable'   => false,
    'show_in_nav_menus'   => false,
    'show_ui'       => true,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_in_menu'  => true,
        'menu_icon'   => 'dashicons-groups',
        'menu_position' => 81,
        //'capability_type' => 'staff_member',
        //'map_meta_cap' => true
    );
    return $args;
}

//-- Staff Template --------------------------------
function abcfsl_post_types_lbls_st() {

    $lbls = array(
        'menu_name'	         => 'Menu Staff',
        'name'               => 'Staff Templates', //Staff Templates, Admin table header 
        'add_new'            => __('Add Template', 'staff-list'),
        'add_new_item'       => 'Staff Template', //Staff Template, New record
        'edit_item'          => 'Staff Template', //Staff Template, Edit record
        'all_items'          =>  'Staff Templates', //Menu - Main label
    );
    return $lbls;
}

function abcfsl_post_types_args_st( $slug ) {

    $args = array(
        'labels'        => abcfsl_post_types_lbls_st(),
        'description'   => '',
        'public'        => true,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_ui'       => true,
        'show_in_menu'  => $slug
    );

    return $args;
}

//== GROUPS =====================================
function abcfsl_post_types_group( $slug, $lbls ) {

    $args = array(
            'labels'        => $lbls,
            'description'   => '',
            'public'        => false,
            'hierarchical'  => false,
            'supports'      => array( 'title' ),
            'has_archive'   => false,
            'show_ui'       => true,
            'show_in_menu'  => $slug
    );

    return $args;
}

function abcfsl_post_types_group_lbls() {

    $lbls = array(
        'name'               => 'Groups', //Admin table header
        'add_new'            => __('Add Template', 'staff-list'),
        'add_new_item'       => 'Grouping Template', //New record
        'edit_item'          => 'Grouping Template', //Edit record
        'all_items'          => 'Groups', //Menu - Main label
    );
    return $lbls;
}

//-- Category Menu --------------------------------
function abcfsl_post_types_lbls_cm() {
    $lbls = array(
        'name'               => 'Category Menus', //Category Menus, Admin table header
        'add_new'            => __( 'Add Menu', 'staff-list'),
        'add_new_item'       => 'Category Menu', //Category Menu New record
        'edit_item'          => 'Category Menu', //Category Menu Edit record
        'all_items'          => 'Category Menus' //Menu - Main label no POT
    );
    return $lbls;
}

function abcfsl_post_types_args_cm() {
    $args = array(
        'labels'        => abcfsl_post_types_lbls_cm(),
        'description'   => '',
        'public'        => false,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_ui'       => true,
        'show_in_menu'  => 'edit.php?post_type=cpt_staff_lst_item'
    );
    return $args;
}

// -- Staff Categories taxonomy -------------------------------------------340 - 3
function abcfsl_tax_category_lbls() {
    $lbls = array(
            'name'              => __('Staff Categories', 'staff-list'), //Categories Main screen + Staff member category selection + Staff Members Table Header. 
            'add_new_item'      => __('Add Category', 'staff-list'), // Add staff category. Category screen + buttom
            'edit_item'         => __('Edit Category', 'staff-list'), //Edit category screen
            'update_item'        => __('Edit Category', 'staff-list'),       
            'all_items'         => __('Staff Categories', 'staff-list')  //Staff member category selection. only Tab All
        );
    return $lbls;
}

function abcfsl_tax_category_args() {
//Taxonomy capabilities include
//assign_terms,
//edit_terms,
//manage_terms (displays the taxonomy in the admin navigation)
//and delete_terms.
    $args = array(
        'labels' => abcfsl_tax_category_lbls(),
        'public'  => false,
        'show_ui' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'show_in_nav_menus' => false,
        'show_in_menu'  => false,
        'rewrite' => array( 'slug' => 'staff_category' ),
        'capabilities' => array(
            'manage_terms'  => 'manage_staff_categories' ,
            'edit_terms'    => 'manage_staff_categories',
            'delete_terms'  => 'manage_staff_categories',
            'assign_terms'  => 'assign_staff_categories'
        )
    );
    return $args;
}
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//=======================================================
// function abcfsl_setup_post_type_sm( $slug ) {
    
//     $lbls = array(
//         'name'               => __('Staff Members', 'staff-list'), //Staff Members Admin table header
//         'add_new'            => __('Add New', 'staff-list'),
//         'add_new_item'       => __('Staff Member', 'staff-list'), //Staff Member, New record
//         'edit_item'          => __('Staff Member', 'staff-list'), //Staff Member, Edit  record
//         'all_items'          => __('Staff Members', 'staff-list') //Staff Members Main menu label
//     );

//     $args = array(
//             'labels'        => $lbls,
//             'description'   => '',
//             'public'        => false,
//             'hierarchical'  => false,
//             'supports'      => array( 'title' ),
//             'has_archive'   => false,
//             'show_ui'       => true,
//             'show_in_menu'  => $slug
//     );

//     return $args;
// }

// function abcfsl_setup_post_type_st( $slug ) {

//     $lbls = array(
//         'menu_name'	         => 'Menu Staff',
//         'name'               => 'Staff Templates', //Staff Templates, Admin table header 
//         'add_new'            => __('Add Template', 'staff-list'),
//         'add_new_item'       => 'Staff Template', //Staff Template, New record
//         'edit_item'          => 'Staff Template', //Staff Template, Edit record
//         'all_items'          =>  'Staff Templates', //Menu - Main label
//     );

//     $args = array(
//         'labels'        => $lbls,
//         'description'   => '',
//         'public'        => false,
//         'hierarchical'  => false,
//         'supports'      => array( 'title' ),
//         'has_archive'   => false,
//         'show_ui'       => true,
//         'show_in_menu'  => $slug
//     );

//     return $args;
// }
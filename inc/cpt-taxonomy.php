<?php

function wp_school_register_custom_post_types(){

    //register Staff post type
    $labels = array(
        'name'                  => _x( 'Staff', 'post type general name' ),
        'singular_name'         => _x( 'Staff', 'post type singular name'),
        'menu_name'             => _x( 'Staff', 'admin menu' ),
        'name_admin_bar'        => _x( 'Staff', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'Staff' ),
        'add_new_item'          => __( 'Add New Staff' ),
        'new_item'              => __( 'New Staff' ),
        'edit_item'             => __( 'Edit Staff' ),
        'view_item'             => __( 'View Staff' ),
        'all_items'             => __( 'All Staff' ),
        'search_items'          => __( 'Search Staff' ),
        'parent_item_colon'     => __( 'Parent Staff:' ),
        'not_found'             => __( 'No Staff found.' ),
        'not_found_in_trash'    => __( 'No Staff found in Trash.' ),
        'archives'              => __( 'Staff Archives'),
        'insert_into_item'      => __( 'Insert into Staff'),
        'uploaded_to_this_item' => __( 'Uploaded to this Staff item'),
        'filter_item_list'      => __( 'Filter Staff list'),
        'items_list_navigation' => __( 'Staff list navigation'),
        'items_list'            => __( 'Staff list'),
        'featured_image'        => __( 'Staff featured image'),
        'set_featured_image'    => __( 'Set Staff featured image'),
        'remove_featured_image' => __( 'Remove Staff featured image'),
        'use_featured_image'    => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'staff' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array(array()),
    );

    register_post_type( 'staff', $args );

    //register Student post type
    $labels = array(
        'name'                  => _x( 'Students', 'post type general name' ),
        'singular_name'         => _x( 'Student', 'post type singular name'),
        'menu_name'             => _x( 'Students', 'admin menu' ),
        'name_admin_bar'        => _x( 'Students', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'Student' ),
        'add_new_item'          => __( 'Add New Student' ),
        'new_item'              => __( 'New Student' ),
        'edit_item'             => __( 'Edit Student' ),
        'view_item'             => __( 'View Student' ),
        'all_items'             => __( 'All Students' ),
        'search_items'          => __( 'Search Students' ),
        'parent_item_colon'     => __( 'Parent Student:' ),
        'not_found'             => __( 'No Students found.' ),
        'not_found_in_trash'    => __( 'No Students found in Trash.' ),
        'archives'              => __( 'Student Archives'),
        'insert_into_item'      => __( 'Insert into Student'),
        'uploaded_to_this_item' => __( 'Uploaded to this Student item'),
        'filter_item_list'      => __( 'Filter Student list'),
        'items_list_navigation' => __( 'Student list navigation'),
        'items_list'            => __( 'Student list'),
        'featured_image'        => __( 'Student featured image'),
        'set_featured_image'    => __( 'Set Student featured image'),
        'remove_featured_image' => __( 'Remove Student featured image'),
        'use_featured_image'    => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'students' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-buddicons-groups',
        'supports'           => array(),
    );

    register_post_type( 'students', $args );
}

add_action ( 'init', 'wp_school_register_custom_post_types' );


function wp_school_register_taxonomies() {

    //add staff type taxonomy
    $labels = array(
        'name'              => _x( 'Staff Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Staff Types' ),
        'all_items'         => __( 'All Staff Types' ),
        'parent_item'       => __( 'Parent Staff Type' ),
        'parent_item_colon' => __( 'Parent Staff Type:' ),
        'edit_item'         => __( 'Edit Staff Type' ),
        'update_item'       => __( 'Update Staff Type' ),
        'add_new_item'      => __( 'Add New Staff Type' ),
        'new_item_name'     => __( 'New Staff Type Name' ),
        'menu_name'         => __( 'Staff Type' ),
    );
    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'staff-type' ),
    );

    register_taxonomy( 'staff-type', array( 'staff' ), $args );

}

add_action( 'init', 'wp_school_register_taxonomies' );

//add custom post type template for student block editor
function student_post_template() {
	$custom_post_type_object = get_post_type_object( 'students' );
	$custom_post_type_object->template = [
		[ 'core/paragraph', [], [] ],
		[ 'core/button', [], [] ],
	];
    $custom_post_type_object->template_lock = 'all';

}
add_action( 'init', 'student_post_template' );


//adjust title placeholder text for student block editor
function change_title_text( $title ){
     $screen = get_current_screen();
 
     if  ( 'students' == $screen->post_type ) {
          $title = 'Add student name here';
     }
 
     return $title;
}

add_filter( 'enter_title_here', 'change_title_text' );

?>
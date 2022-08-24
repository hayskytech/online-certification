<?php
// Custom Post Type //
add_action( "init",function(){

    // Enrollment
    $labels0 = array(
        "name" => "Enrollments",
        "singular_name" => "Enrollment",
        "add_new"    => "Add Enrollment",
        "add_new_item" => "Add New Enrollment",
        "all_items" => "All Enrollments",
    );
    $args0 = array(    
        "public" => true,
        "label"       => "Enrollments",
        "labels"      => $labels0,
        "description" => "Enrollments custom post type.",
        "menu_icon"      => "dashicons-pressthis",    
        "supports"   => array( "title", "thumbnail"),
        "capability_type" => "page",
        "publicly_queryable"  => false,
        'menu_position' => 5
    );
    register_post_type("enrollment", $args0);

    // Course
    $labels = array(
        "name" => "Courses",
        "singular_name" => "Course",
        "add_new"    => "Add Course",
        "add_new_item" => "Add New Course",
        "all_items" => "All Courses",
    );
    $args = array(    
        "public" => true,
        "label"       => "Courses",
        "labels"      => $labels,
        "description" => "Courses custom post type.",
        "menu_icon"      => "dashicons-welcome-widgets-menus",    
        "supports"   => array( "title"),
        "capability_type" => "page",
        "publicly_queryable"  => false,
        'menu_position' => 5
    );
    register_post_type("course", $args);
    
});
// Register taxonomy fees and duration for courses //
add_action( "init",function(){
    $labels = array(
        "name" => "Fees",
        "singular_name" => "Fees",
        "add_new"    => "Add Fees",
        "add_new_item" => "Add New Fees",
        "all_items" => "All Fees",
    );
    $args = array(
        "labels"      => $labels,
        "hierarchical"               => true,
        "public"                     => true,
        "show_ui"                    => true,
        "show_admin_column"          => true,
        "show_in_nav_menus"          => true,
        "show_tagcloud"              => true,
        "show_in_rest"               => true,
    );
    register_taxonomy("fees", array("course"), $args);
    
    $labels = array(
        "name" => "Duration",
        "singular_name" => "Duration",
        "add_new"    => "Add Duration",
        "add_new_item" => "Add New Duration",
        "all_items" => "All Durations",
    );
    $args = array(    
        "labels"                    => $labels,
        "hierarchical"              => true,
        "public"                    => true,
        "show_ui"                   => true,
        "show_admin_column"         => true,
        "show_in_nav_menus"         => true,
        "show_tagcloud"             => true,
        "show_in_rest"              => true,
    );
    register_taxonomy("duration", array("course"), $args);    
});
?>
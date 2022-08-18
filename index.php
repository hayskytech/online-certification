<?php
/**
 * Plugin Name: Online Certification
 * Plugin URI: https://haysky.com/
 * Description: Add students, courses, duration, fees and enrollment. Online verify certificate.
 * Version: 2.0.0
 * Author: Haysky
 * Author URI: https://haysky.com/
 * License: GPLv2 or later
 */
error_reporting(E_ERROR | E_PARSE);
// $wpdb->show_errors(); $wpdb->print_error();
// $int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);
add_action( 'init', function(){
    add_rewrite_rule(
        'verify/([0-9]+)/?$',
        'index.php?pagename=verify&certificate_id=$matches[1]',
        'top' );
});
add_filter( 'query_vars', function( $query_vars ){
    $query_vars[] = 'certificate_id';
    return $query_vars;
});

add_shortcode('verify',function(){ include 'verify.php'; });

include 'custom_post_types.php';
// include 'student_meta_fields.php';
// include 'student_columns.php';
include 'enrollment_meta_fields.php';
include 'enrollment_columns.php';
/*
add_action('admin_menu' , function(){
    add_menu_page('Convert Students','Convert Students','manage_options', 'convert_students_admin', 'convert_students_rjv', 'dashicons-admin-users','2');
});

function convert_students_rjv(){
    $args = array(
        'posts_per_page'   => -1,
        'offset'           => 0,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'enrollment',
        'post_status'      => array('publish','pending'),
        'suppress_filters' => true
    );
    $enrollment = get_posts($args);
    foreach ($enrollment as $enrollment) {
        $ID = $enrollment->ID;
        $student_id = get_post_meta($ID, 'student',true);
        $student_name = get_the_title($student_id);
        $my_post = array(
            'ID'           => $ID,
            'post_title'   => $student_name,
        );
        wp_update_post( $my_post );
        $photo = get_post_thumbnail_id($student_id);
        set_post_thumbnail( $ID, $photo );
    }
}
*/
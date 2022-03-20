<?php
/*
Plugin Name: #Coaching Center
Plugin URI: https://www.haysky.com/
Description: Add students, courses, duration, fees and enrollment. Online verify certificate.
Version: 2.0.0
Author: Sufyan
Author URI: https://www.sufyan.in/
License: GPLv2 or later
Text Domain: sufyan
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
include 'student_meta_fields.php';
include 'student_columns.php';
include 'enrollment_meta_fields.php';
include 'enrollment_columns.php';
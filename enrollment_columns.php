<?php
/* -- You can change custom post_type to page, product, course etc. -- */

$post_type = "enrollment";
add_filter('manage_'.$post_type.'_posts_columns', function($columns) {
    return array_merge($columns, [
        "course" => __("Course", "textdomain"),
        "start_date" => __("Start Date", "textdomain"),
        "fees" => __("Fees", "textdomain"),
        "certificate" => __("Certificate", "textdomain"),
        "photo" => __("Photo", "textdomain"),
    ]);
});
add_action('manage_'.$post_type.'_posts_custom_column', function($column_key, $post_id) {
    if ($column_key == "course") {
        echo '<h2>'.get_the_title(get_post_meta($post_id, "course", true)).'</h2>';
    }
    if ($column_key == "start_date") {
        echo 'Start Date: '.get_post_meta($post_id, "start_date", true);
        echo '<br>End Date: '.get_post_meta($post_id, "end_date", true);
    }
    if ($column_key == "fees") {
        echo 'Fees: '.get_post_meta($post_id, "fees", true);
        echo '<br>Paid: '.get_post_meta($post_id, "paid", true);
        echo '<br>Due: '.get_post_meta($post_id, "remaining", true);
    }
    if ($column_key == "certificate") {
        $cert_id = get_post_meta($post_id, "certificate", true);
        echo '<h2><a href="'.site_url().'/verify/'.$cert_id.'" target="_blank">'.$cert_id.'</a></h2>';
    }
    if ($column_key == "photo") {
        echo get_the_post_thumbnail($post_id, 'thumb');
    }
}, 10, 2);
<?php
/* -- You can change custom post_type to page, product, course etc. -- */

$post_type = "enrollment";
add_filter('manage_'.$post_type.'_posts_columns', function($columns) {
    return array_merge($columns, [
        "student" => __("student", "textdomain"),
        "course" => __("course", "textdomain"),
        "start_date" => __("start_date", "textdomain"),
        "end_date" => __("end_date", "textdomain"),
        "fees" => __("fees", "textdomain"),
        "paid" => __("paid", "textdomain"),
        "remaining" => __("remaining", "textdomain"),
        "certificate" => __("certificate", "textdomain"),
    ]);
});
add_action('manage_'.$post_type.'_posts_custom_column', function($column_key, $post_id) {
    if ($column_key == "student") {
        echo get_post_meta($post_id, "student", true);
    }
    if ($column_key == "course") {
        echo get_post_meta($post_id, "course", true);
    }
    if ($column_key == "start_date") {
        echo get_post_meta($post_id, "start_date", true);
    }
    if ($column_key == "end_date") {
        echo get_post_meta($post_id, "end_date", true);
    }
    if ($column_key == "fees") {
        echo get_post_meta($post_id, "fees", true);
    }
    if ($column_key == "paid") {
        echo get_post_meta($post_id, "paid", true);
    }
    if ($column_key == "remaining") {
        echo get_post_meta($post_id, "remaining", true);
    }
    if ($column_key == "certificate") {
        echo get_post_meta($post_id, "certificate", true);
    }
}, 10, 2);

?>
<?php
/* Powered By Haysky Code Generator: KEY
[["wp_fetch","student"],["text","course"],["date","start_date"],["text","fees"],["text","paid"],["text","remaining"],["text","certificate"],["submit","Extra Post Columns"]]
*/
?>
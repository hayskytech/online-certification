<?php
/* -- You can change custom post_type to page, product, course etc. -- */

$post_type = "student";
add_filter('manage_'.$post_type.'_posts_columns', function($columns) {
    return array_merge($columns, [
        "education" => __("education", "textdomain"),
        "college" => __("college", "textdomain"),
        "date_of_birth" => __("date_of_birth", "textdomain"),
        "phone" => __("phone", "textdomain"),
        "phone2" => __("phone2", "textdomain"),
        "gender" => __("gender", "textdomain"),
        "email" => __("email", "textdomain"),
        "address" => __("address", "textdomain"),
        "referred_by" => __("referred_by", "textdomain"),
    ]);
});
add_action('manage_'.$post_type.'_posts_custom_column', function($column_key, $post_id) {
    echo get_post_meta($post_id, $column_key, true);
}, 10, 2);


add_action( 'quick_edit_custom_box', 'ws365150_custom_edit_box_pt', 10, 3 );
function ws365150_custom_edit_box_pt( $column_name, $post_type, $taxonomy ) {
    global $post;

    switch ( $post_type ) {
        case 'student':
        if( $column_name === 'phone' ): 
        ?>
        <fieldset class="inline-edit-col-left">
            <legend class="inline-edit-legend">Student Details</legend>
            <div class="inline-edit-col">
                <label>
                    <span class="title">Phone</span>
                    <span class="input-text-wrap"><input type="text" name="phone" class="ptitle" value="<?php echo get_post_meta( $post->ID, 'phone', true ); ?>"></span>
                </label>
                <label>
                    <span class="title">Phone 2</span>
                    <span class="input-text-wrap">
                        <input type="text" name="phone2" value="<?php echo get_post_meta( $post->ID, 'phone2', true ); ?>" autocomplete="off" spellcheck="false"></span>
                </label>                
            </div>
        </fieldset>
        <?php
        endif;
            // echo 'custom page field';
            break;

        default:
            break;
    }
}

add_action( 'save_post', 'ws365150_update_custom_quickedit_box' );
function ws365150_update_custom_quickedit_box() {
    if( isset( $_POST ) && isset( $_POST['phone'] ) ) {
        update_post_meta($_POST['post_ID'], 'phone', $_POST['phone']);
        update_post_meta($_POST['post_ID'], 'phone2', $_POST['phone2']);
    }
    return; 
}
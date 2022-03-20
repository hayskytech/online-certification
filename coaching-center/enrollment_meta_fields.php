<?php
add_action( "add_meta_boxes",function(){
    add_meta_box(
        "diwp-post-read-timer3",
        "Post Meta Fields", 
// Creates Metabox Callback Function
function(){
    global $post;
    wp_enqueue_script("jquery");
    $meta = get_post_meta($post->ID);
    $data["student"] = $meta["student"][0];
    $data["course"] = $meta["course"][0];
    $data["start_date"] = $meta["start_date"][0];
    $data["end_date"] = $meta["end_date"][0];
    $data["fees"] = $meta["fees"][0];
    $data["paid"] = $meta["paid"][0];
    $data["remaining"] = $meta["remaining"][0];
    $data["certificate"] = $meta["certificate"][0];
    ?>
    <table>
        <tr>
        <td>Student</td>
        <td>
            <select name="student"  >
                <?php
                $args = array(
                    'posts_per_page'   => -1,
                    'offset'           => 0,
                    'orderby'          => 'date',
                    'order'            => 'DESC',
                    'post_type'        => 'student',
                    'post_status'      => 'publish',
                    'suppress_filters' => true
                );
                $options = get_posts($args);
                foreach ($options as $option) {
                    echo '<option value="'.$option->ID.'">'.$option->post_title.'</option>';
                }
                ?>
            </select>
        </td>
        </tr>
        <tr>
        <td>Course</td>
        <td>
            <select name="course"  >
                <?php
                $args = array(
                    'posts_per_page'   => -1,
                    'offset'           => 0,
                    'orderby'          => 'date',
                    'order'            => 'DESC',
                    'post_type'        => 'course',
                    'post_status'      => 'publish',
                    'suppress_filters' => true
                );
                $options = get_posts($args);
                foreach ($options as $option) {
                    echo '<option value="'.$option->ID.'">'.$option->post_title.'</option>';
                }
                ?>
            </select>
        </td>
        </tr>
        <tr>
            <td>Start Date</td>
            <td><input type="date" name="start_date" >
            </td>
        </tr>
        <tr>
            <td>End Date</td>
            <td><input type="date" name="end_date" >
            </td>
        </tr>
        <tr>
            <td>Fees</td>
            <td><input type="text" name="fees" >
            </td>
        </tr>
        <tr>
            <td>Paid</td>
            <td><input type="text" name="paid" >
            </td>
        </tr>
        <tr>
            <td>Remaining</td>
            <td><input type="text" name="remaining" >
            </td>
        </tr>
        <tr>
            <td>Certificate ID</td>
            <td><input type="text" name="certificate" >
            </td>
        </tr>
    </table>
    <script type="text/javascript">
        jQuery('select[name=student]').val('<?php echo $data["student"]; ?>');
        jQuery('select[name=course]').val('<?php echo $data["course"]; ?>');
        jQuery('input[name=start_date]').val('<?php echo $data["start_date"]; ?>');
        jQuery('input[name=end_date]').val('<?php echo $data["end_date"]; ?>');
        jQuery('input[name=fees]').val('<?php echo $data["fees"]; ?>');
        jQuery('input[name=paid]').val('<?php echo $data["paid"]; ?>');
        jQuery('input[name=remaining]').val('<?php echo $data["remaining"]; ?>');
        jQuery('input[name=certificate]').val('<?php echo $data["certificate"]; ?>');
    </script>
    <?php
},
        "enrollment",
        "side",
        "high"
    );
});

add_action( "save_post",function(){
    global $post;
    update_post_meta($post->ID, "student", $_POST["student"]);
    update_post_meta($post->ID, "course", $_POST["course"]);
    update_post_meta($post->ID, "start_date", $_POST["start_date"]);
    update_post_meta($post->ID, "end_date", $_POST["end_date"]);
    update_post_meta($post->ID, "fees", $_POST["fees"]);
    update_post_meta($post->ID, "paid", $_POST["paid"]);
    update_post_meta($post->ID, "remaining", $_POST["remaining"]);
    update_post_meta($post->ID, "certificate", $_POST["certificate"]);
});
/*
add_filter("the_content",function($postContent){
    global $post;
    echo "<p><strong>Student: ".get_post_meta($post->ID, "student", true)."</strong></p>";
    echo "<p><strong>Course: ".get_post_meta($post->ID, "course", true)."</strong></p>";
    echo "<p><strong>Start Date: ".get_post_meta($post->ID, "start_date", true)."</strong></p>";
    echo "<p><strong>Fees: ".get_post_meta($post->ID, "fees", true)."</strong></p>";
    echo "<p><strong>Paid: ".get_post_meta($post->ID, "paid", true)."</strong></p>";
    echo "<p><strong>Pending: ".get_post_meta($post->ID, "remaining", true)."</strong></p>";
    echo "<p><strong>Certificate ID: ".get_post_meta($post->ID, "certificate", true)."</strong></p>";
    echo $postContent;
});
//*/ 
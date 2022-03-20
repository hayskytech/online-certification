<?php
add_action( "add_meta_boxes",function(){
    add_meta_box(
        "diwp-post-read-timer",
        "Post Meta Fields", 
// Creates Metabox Callback Function
function(){
    global $post;
    wp_enqueue_script("jquery");
    $meta = get_post_meta($post->ID);
    $data["education"] = $meta["education"][0];
    $data["college"] = $meta["college"][0];
    $data["date_of_birth"] = $meta["date_of_birth"][0];
    $data["phone"] = $meta["phone"][0];
    $data["phone2"] = $meta["phone2"][0];
    $data["gender"] = $meta["gender"][0];
    $data["email"] = $meta["email"][0];
    $data["address"] = $meta["address"][0];
    $data["referred_by"] = $meta["referred_by"][0];
    ?>
    <table>
        <tr>
            <td>Education</td>
            <td><input type="text" name="education" >
            </td>
        </tr>
        <tr>
            <td>College</td>
            <td><input type="text" name="college" >
            </td>
        </tr>
        <tr>
            <td>Date Of Birth</td>
            <td><input type="date" name="date_of_birth" >
            </td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><input type="text" name="phone" >
            </td>
        </tr>
        <tr>
            <td>Phone2</td>
            <td><input type="text" name="phone2" >
            </td>
        </tr>
        <tr>
        <td>Gender</td>
        <td><select  name="gender" >
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" >
            </td>
        </tr>
        <tr>
            <td>Address</td>
            <td><input type="text" name="address" >
            </td>
        </tr>
        <tr>
            <td>Referred By</td>
            <td><input type="text" name="referred_by" >
            </td>
        </tr>
    </table>
    <script type="text/javascript">
        jQuery('input[name=education]').val('<?php echo $data["education"]; ?>');
        jQuery('input[name=college]').val('<?php echo $data["college"]; ?>');
        jQuery('input[name=date_of_birth]').val('<?php echo $data["date_of_birth"]; ?>');
        jQuery('input[name=phone]').val('<?php echo $data["phone"]; ?>');
        jQuery('input[name=phone2]').val('<?php echo $data["phone2"]; ?>');
        jQuery('select[name=gender]').val('<?php echo $data["gender"]; ?>');
        jQuery('input[name=email]').val('<?php echo $data["email"]; ?>');
        jQuery('input[name=address]').val('<?php echo $data["address"]; ?>');
        jQuery('input[name=referred_by]').val('<?php echo $data["referred_by"]; ?>');
    </script>
    <?php
},
        "student",
        "side",
        "high"
    );
});

add_action( "save_post",function(){
    global $post;
    update_post_meta($post->ID, "education", $_POST["education"]);
    update_post_meta($post->ID, "college", $_POST["college"]);
    update_post_meta($post->ID, "date_of_birth", $_POST["date_of_birth"]);
    update_post_meta($post->ID, "phone", $_POST["phone"]);
    update_post_meta($post->ID, "phone2", $_POST["phone2"]);
    update_post_meta($post->ID, "gender", $_POST["gender"]);
    update_post_meta($post->ID, "email", $_POST["email"]);
    update_post_meta($post->ID, "address", $_POST["address"]);
    update_post_meta($post->ID, "referred_by", $_POST["referred_by"]);
});
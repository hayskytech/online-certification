<?php
global $wp;
$main_url = home_url( $wp->request );
$arr = explode('/', $main_url);
$cid = $arr[count($arr)-1];
$cid = get_query_var('certificate_id');
global $wpdb;
// $row = $wpdb->get_row("SELECT * from certificate where certificate=$id");
// $courses = $wpdb->get_results("SELECT id,course from course",OBJECT_K);
$args = array(
    'posts_per_page'   => -1,
    'offset'           => 0,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_type'        => 'enrollment',
    'post_status'      => array('publish','pending'),
    'meta_key' 		   => 'certificate',
    'meta_value' 	   => $cid,
    'suppress_filters' => true
);
$enrollment = get_posts($args);
if ($enrollment[0]->ID) {
	$meta = get_post_meta($enrollment[0]->ID);
	$student = get_the_title($enrollment[0]->ID);
	$course = get_the_title($meta["course"][0]);
	$image = '';
	if (has_post_thumbnail( $enrollment[0]->ID ) ){
		$img_id = get_post_thumbnail_id( $enrollment[0]->ID );
		$file_url = wp_get_attachment_url( $img_id );
		$image = wp_get_attachment_image_src($img_id, 'medium')[0];
	}
	$d1 = date('d-M-Y', strtotime($meta["start_date"][0]));
	$d2 = date('d-M-Y', strtotime($meta["end_date"][0]));
?>
<div id="certificate" style="position: relative;">
	<p id="p1">THIS CERTIFICATE IS AWARDED TO</p>
	<p id="p2"><?php echo $student; ?></p>
	<p id="p3">for  the  successful  completion  of  training  on </p>
	<p id="p4"><?php echo $course; ?></p>
	<p id="p5">During  the  period  of</p>
	<p id="p6"><?php echo $d1; ?> to <?php echo $d2; ?></p>
	<p id="p7">URL: https://haysky.com/verify/<?php echo $meta["certificate"][0]; ?></p>
	<img src="<?php echo plugin_dir_url(__FILE__); ?>certificate.jpg">
	<?php
	if ($image) {
	    echo '<img src="'.$image.'" id="student_photo">';
	}
	?>
	<canvas id="qr-code"></canvas>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script type="text/javascript">
document.title = '<?php echo $cid.' - '.$student.' - '.$course; ?>';    var qr;
    qr = new QRious({
        element: document.getElementById('qr-code'),
        size: 200,
        value: 'https://haysky.com/verify/<?php echo $meta["certificate"][0]; ?>'
    });
</script>
<style type="text/css">
#qr-code,#student_photo, #certificate p{
	position: absolute;
}
#certificate p{
	font-weight: bold;
	left: 6%;
	margin: 0;
}
#p1,#p4,#p6{
	font-size: 2.4vw;
}
#p1{
	top: 28%;
}
#p2{
	color: #0300a9;
	font-size: 2.6vw;
	top: 36%;
}
#p3{
	font-size: 2vw;
	top: 45%;
}
#p4{
	color: #0300a9;
	top: 49%;
}
#p5{
	top: 55%;
	font-size: 2vw;
}
#p6{
	color: #0300a9;
	top: 59%;
}
#p7{
	font-size: 2vw;
	top: 76%;
}
@media (min-width: 800px){
	#qr-code{
	    border: 5px solid white;
	    outline: 2px solid;
	}
}
#student_photo{
    right: 9.5%;
    width: 15%;
    top: 14%;
	object-fit: cover;
	height: 25%;
}
#qr-code{
    right: 11.5%;
    width: 11%;
    top: 40%;
}
#primary{
	padding: 10px !important;
	margin: 0 !important;
	border: 0px none !important;
	width: 100%;
}
.ast-container{
	display: block !important;
	padding: 0 !important;
	max-width: inherit;
	margin: 0 !important;
}
@media print{
	#primary{
		padding: 10px !important;
		height: 100vh;
		width: 100vw;
	}
	main{
		max-width: 100% !important;
	}
	header,footer,main header,.widget-area.secondary{
		display: none;
	}
}
</style>
<?php
} else {
	echo '<h2>Certificate not found</h2>';
}
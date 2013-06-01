<?php
get_header();
?>

<?php 
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		include "loop.single.php";
 
		$max_w = "500";
		include "loop.video.php";
		//defining size of thumbnails in gallery
		$img_post_parent = get_the_ID();
		$img_amount = -1;
		$mini_size = array(48,48);
		$medium_size = "medium";
		$custom_width = "500";
		include "loop.attachment.php";
 
		include "loop.single2.php";

	endwhile;

else :
endif; ?>

<?php get_footer(); ?>

<?php
/*
Template Name: Pinterest Gallery
*/
get_header();
?>

<div id="press" class="part-mid1">
<?php // this page loop
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		include("loop.page.php");
	endwhile;
else :
endif; ?>			

</div><!-- end #academic -->

<?php get_footer(); ?>

<?php
/*
Template Name: Resources
*/
get_header();
?>

<?php 
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$col400 = " style='width: 400px; padding-bottom:10px; '";
		include("loop.page.php");
	endwhile;
else :
endif;
rewind_posts(); ?>

<?php $args = array(
	'taxonomy' => 'resource-category',
	'hierarchical' => 1,
	'pad_counts ' => 1
	
	); ?>

<?php
$categories = get_categories($args);
foreach ($categories as $cat) { 
	if ($cat->category_parent == 0) {
		echo '<div class="resource-category">';
		echo '<a href="'.get_option('home').'/resource-category/'.$cat->category_nicename.'/"><h3>'.$cat->cat_name.'</h3></a>'; //"category-resource/" should be sbstituted by something like "get_option('category_base')"
		echo '<div class="page-text"> '.$cat->category_description.'</div>';
		echo '</div>';
	}
	
	if ($cat->category_parent != 0) {	 
		//echo '<a href="'.get_option('home').get_option('category_base').'/'.$cat->category_nicename.'/">'.$cat->cat_name.'</a>';
	}
	//echo '<br />';
}
?>

<?php
echo '<div class="tag-cloud" > Tags: ';
		wp_tag_cloud(array('taxonomy' => 'resource-tag', 'number' => 0, 'smallest'=> 8,'largest'=> 12));
		echo '</div>';
?>
<!-- Last resources submited -->
<?php // related content loop
/*$pt = $general_options['pt_r'];
$rl_tit = "Resources";

$args = array(
    	'posts_per_page' => -1,
	'post_type' => $pt,
	'orderby' => 'name',
	'order' => 'ASC'
);
if ( $paged > 1 ) {
  $args['paged'] = $paged;
}
$related_query = new WP_Query( $args );
if ( $related_query->have_posts() ) :
	echo "<section id='landing'>";
	while ( $related_query->have_posts() ) : $related_query->the_post();
		include("loop.related.php");
	endwhile;
	echo "</section><!-- end #openlab -->";

	include "navigation.php";

else :
// if no related posts, code in here
endif;*/
?>

<?php get_footer(); ?>

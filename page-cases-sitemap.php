<?php
/*
Template Name: REsources sitemap
*/
get_header();
?>

<?php 
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$col400 = " style='width: 400px; padding-bottom:10px; '";
		include("loop.page.php");
		echo '<div class="tag-cloud" >';
		wp_tag_cloud(array('taxonomy' => 'project-tag', 'number' => 0, 'smallest'=> 8,'largest'=> 10));
		echo '</div> ';
		// submit form link
		$post_parent = get_the_ID();
		$args = array(
			'child_of' => $post_parent,
			'parent' => $post_parent,
		);
		$children = get_pages($args);
		foreach ( $children as $child ) {
			$child_tit = $child->post_title;
			$child_url = get_page_link( $child->ID );
			echo "
				<div class='submit-button'><a title='" .$child_tit. "' href='" .$child_url. "'>" .$child_tit. "</a></div>";
		}
	endwhile;


else :
endif;
rewind_posts(); ?>

<?php // related content loop
$pt = $general_options['pt_c'];
$rl_tit = "Case Studies";

$args = array(
    'posts_per_page' => -1,
	'post_type' => $pt,
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
	echo "</section><!-- end #landing -->";

	include "navigation.php";

else :
// if no related posts, code in here
endif;
?>

<?php get_footer(); ?>

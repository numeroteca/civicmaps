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
		// submit form link
		$post_parent = get_the_ID();
		$args = array(
			'child_of' => $post_parent,
			'parent' => $post_parent,
			'orderby' => 'name',
			'order' => 'ASC'
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


	<?php
	$args = array(
		'orderby' => 'name',
		'show_count' => 1,
		'pad_counts' => 1,
		'hierarchical' => 1,
		'taxonomy' => 'resource-category',
		'title_li' => '',
	  	'depth' => 1
	);
	?>
	<ul class="list-categories">
	<?php
	wp_list_categories($args);
	?>
	</ul>
<?php
echo '<div class="tag-cloud" > Tags: ';
		wp_tag_cloud(array('taxonomy' => 'resource-tag', 'number' => 0, 'smallest'=> 8,'largest'=> 12));
		echo '</div>';
?>

<?php // related content loop
$pt = $general_options['pt_r'];
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
endif;
?>

<?php get_footer(); ?>

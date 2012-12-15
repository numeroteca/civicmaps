<?php
/*
Template Name: Home temporal
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
$pt = $general_options['pt_r'];
$rl_tit = "Projects";

     global $wpdb, $wti_like_post_db_version;
		//getting the most liked posts
		$query = "SELECT COUNT(post_id) AS total FROM `{$wpdb->prefix}wti_like_post` L JOIN {$wpdb->prefix}posts P ";
		$query .= "ON L.post_id = P.ID WHERE value > 0";
		$post_count = $wpdb->get_var($query);
   
		if($post_count > 0) {

echo "<section id='openlab'>";

			//pagination script
			//$limit = get_option('posts_per_page');
			$limit = 12;
			$current = max( 1, $_GET['paged'] );
			$total_pages = ceil($post_count / $limit);
			$start = $current * $limit - $limit;
			
			$query = "SELECT post_id, SUM(value) AS like_count, post_title FROM `{$wpdb->prefix}wti_like_post` L JOIN {$wpdb->prefix}posts P ";
			$query .= "ON L.post_id = P.ID WHERE value > 0 GROUP BY post_id ORDER BY like_count DESC, post_title LIMIT $start, $limit";
			$result = $wpdb->get_results($query);

				foreach ($result as $project) {
					$post_title = stripslashes($project->post_title);
					$permalink = get_permalink($project->post_id);
					$like_count = $project->like_count;
include("loop.related-home.php");
					
				}
echo "</section><!-- end #openlab -->";
	include "navigation.php";
		}
//$args = array(
//	'posts_per_page' => 12,
//	'post_type' => $pt,
//);
//if ( $paged > 1 ) {
//  $args['paged'] = $paged;
//}
//$related_query = new WP_Query( $args );
//if ( $related_query->have_posts() ) :
//	echo "<section id='openlab'>";
//	while ( $related_query->have_posts() ) : $related_query->the_post();
//		include("loop.related-home.php");
//	endwhile;
//	echo "</section><!-- end #openlab -->";

//	include "navigation.php";

//else :
// if no related posts, code in here
//endif;
?>

<?php get_footer(); ?>

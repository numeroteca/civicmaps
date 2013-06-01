<?php /* Template Name: Resources */
get_header(); ?>

<?php 
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
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
<div class="span6" > 
	<?php
	$categories = get_categories($args);
	foreach ($categories as $cat) { 
		if ($cat->category_parent == 0) {
			echo '<div class="">';
			echo '<a href="'.get_option('home').'/resource-category/'.$cat->category_nicename.'/"><h3>'.$cat->cat_name.'</h3></a>'; //"category-resource/" should be sbstituted by something like "get_option('category_base')"
			echo '<div class="page-text"> '.$cat->category_description.'</div>';
			echo '</div><hr>';
		}
	
		if ($cat->category_parent != 0) {	 
			//echo '<a href="'.get_option('home').get_option('category_base').'/'.$cat->category_nicename.'/">'.$cat->cat_name.'</a>';
		}
		//echo '<br />';
	}
	?>
</div>
<?php
echo '<div class="tag-cloud span5 offset1" > Tag cloud<br> ';
		wp_tag_cloud(array('taxonomy' => 'resource-tag', 'number' => 0, 'smallest'=> 8,'largest'=> 14));
		echo '</div>';
?>

<?php get_footer(); ?>

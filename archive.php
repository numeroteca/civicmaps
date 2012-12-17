<?php get_header(); ?>

<?php
$termname = $wp_query->queried_object->name;
$termdesc = $wp_query->queried_object->description;
?>

<div id="archive" class="part-mid2">
<article class="">
	<?php if ( have_posts() ) : ?>
	<header class="art-pre">
		<?php /* If this is a category archive */ if (is_category() || is_tag()) { ?>
			<h1 class="art-tit"><?php echo single_cat_title(); ?> </h1>
			<span class="sub-tit-1">All posts from </span>
			<span class"postmetadata alt"><small><?php echo category_description(); ?></small></span>

		<?php /* If this is resource taxonomy exists */ 
			} elseif ( $taxonomy_exist = taxonomy_exists('resource-tag') || $taxonomy_exist = taxonomy_exists('category-tag')) { ?>
				
				<div class="list-categories">
					<?php 
					$args = array(
						'orderby' => 'name',
						'show_count' => 0,
						'pad_counts' => 0,
						'hierarchical' => 1,
						'taxonomy' => 'resource-category',
						'title_li' => '',
					  	'depth' => 0
					); 
					?>
					<ul class="">
					<?php  wp_list_categories($args);  ?>
					</ul>
					<a href="/submit-resource/"><button class="btn btn-large btn-primary" type="button">Submit resource</button></a> 
				</div>
				<?php
				echo "<div class='breadcrumbs'><small>";
				if(function_exists('bcn_display')){bcn_display();}
				echo "</small></div>"; ?>
				<div class="databox">
					<h1 class="art-tit"><?php echo $termname ?></h1> 
					<div class="postmetadata alt"><?php echo category_description(); ?></div>	
				

				<?php //listing categories
					$queried_object = get_queried_object();  
					$term_id = $queried_object->term_id;  			
					$args = array(
						'orderby' => 'name',
						'show_count' => 0,
						'pad_counts' => 0,
						'hierarchical' => 1,
						'taxonomy' => 'resource-category',
						'title_li' => '',
					  	'depth' => 0,
						'child_of' => $term_id
					);
					?>
					<ul class="secondary-list-categories">
					<?php
					wp_list_categories($args); //to remove the "no categories a function was added in functions.php
					?>
					</ul>	</div>		  
				<?php 
				if ( get_post_type() =='resouces') {		
				$resource_tag = get_the_term_list( $post->ID, 'resouce-tag', ' ', ' ', '' );
				//echo get_the_term_list( $post->ID, 'tipo', 'Tipo: ', ' ', '' );				
					echo '<span class="sub-tit-1">Other resource tags:';
					echo $resource_tag;
					echo '</span> ';
				echo '';
				
			}?>
				
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h1 class="art-tit"><?php the_time('F jS, Y'); ?></h1>

		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h1 class="art-tit"><?php the_time('F'); ?></h1>
			<p>Content published <?php the_time('F \d\e Y'); ?>.</p>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h1 class="art-tit"><?php the_time('Y'); ?></h1>
			<p>Content published  <?php the_time('Y'); ?>.</p>

		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h1 class="art-tit">	General archive
			<?php } ?>

	</header>
</article>
		<?php //navigation needed  ?>

		<?php /* Start the Loop */ ?>
		<?php 
		if ( $taxonomy_exist = taxonomy_exists('resource-tag')) { 
			echo "<section id=''>";
		} else { 
			echo "<section>";
		} 
		while ( have_posts() ) : the_post();
			if ( get_post_type() == 'resources') {  //if it is a resource
				include("loop.related.php");				
			} else { //para los demas casos 	
				include "loop.post.php";	
			} ?>
		<?php endwhile; ?>
		</section>

		<?php //navigation needed  ?>

		<?php else : ?>

			<article id="post-0" class="">
				<header class="">
					<h1 class=""><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

	<?php endif; ?>
</div>
<section id='related'>
	<?php if ( ! dynamic_sidebar( 'bar-3' ) ) : ?><?php endif; // end blog widget area ?>
</section><!-- end #related -->
<?php get_footer(); ?>

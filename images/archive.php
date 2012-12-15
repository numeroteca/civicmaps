<?php get_header(); ?>

<?php
$termname = $wp_query->queried_object->name;
$termdesc = $wp_query->queried_object->description;
?>
<div id="blog" class="part-mid1 page-text">
	<?php if ( have_posts() ) : ?>
			<header class="">
			<?php /* If this is a category archive */ if (is_category() || is_tag()) { ?>
				<p class="subtitle">Inside </p>
				<h1><?php echo single_cat_title(); ?></h1>
				<span class"postmetadata alt"><small><?php echo category_description(); ?></small></span>

			<?php /* If this is taxonomy */ } elseif ( $taxonomy_exist = taxonomy_exists('project-tag')) { ?>
				<h1><?php echo $termname ?></h1> 
				<?php 
				$project_tag = get_the_term_list( $post->ID, 'project-tag', '', ' ', '' );
				//echo get_the_term_list( $post->ID, 'tipo', 'Tipo: ', ' ', '' );
				if ( 'remotes' == get_post_type() ) {				
					echo 'Other project tags: ';
					echo $project_tag;
					}?>
					
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1><?php the_time('F jS, Y'); ?></h1>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1><?php the_time('F'); ?></h1>
				<p>Content published <?php the_time('F \d\e Y'); ?>.</p>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1><?php the_time('Y'); ?></h1>
				<p>Content published  <?php the_time('Y'); ?>.</p>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1>General archive
				<?php } ?>

			</header>

				<?php //navigation needed  ?>

				<?php /* Start the Loop */ ?>
				<?php 
				echo "<section id='archive'>";
				while ( have_posts() ) : the_post();
					if ( 'remotes' == get_post_type() ) {  //if it is remote
						include("loop.related.php");				
					} elseif (false ){  //on theroad
					
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

<?php get_footer(); ?>

<?php get_header(); ?>

<?php
$termname = $wp_query->queried_object->name;
$termdesc = $wp_query->queried_object->description;

?>

<div id="blog" class="part-mid1">
<article class="part-mid1">
	<?php if ( have_posts() ) : ?>
			<header class="art-pre">
			<?php /* If this is a category archive */ if (is_category() || is_tag()) { ?>
				<h1 class="art-tit"><?php echo single_cat_title(); ?></h1>
				<span class="sub-tit-1">All posts from </span>
				<span class"postmetadata alt"><small><?php echo category_description(); ?></small></span>

			<?php /* If this is taxonomy */ } elseif ( $taxonomy_exist = taxonomy_exists('resource-tag') || $taxonomy_exist = taxonomy_exists('category-tag')) { ?>
				<h1 class="art-tit"><?php echo $termname ?></h1> 
				  
				<?php 
				if ( 'resouces' == get_post_type() ) {		
				$resource_tag = get_the_term_list( $post->ID, 'resouce-tag', ' ', ' ', '' );
				//echo get_the_term_list( $post->ID, 'tipo', 'Tipo: ', ' ', '' );				
					echo '<span class="sub-tit-1">Other resource tags:';
					echo $resource_tag;
					echo '</span> ';
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
					echo "<section id='landing'>";
				} else { 
					echo "<section>";
				} 
				while ( have_posts() ) : the_post();
					if ( 'resources' == get_post_type() ) {  //if it is remote
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
<section id='related'>
	<?php if ( ! dynamic_sidebar( 'bar-3' ) ) : ?><?php endif; // end blog widget area ?>
</section><!-- end #related -->
<?php get_footer(); ?>

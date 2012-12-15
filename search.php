<?php get_header(); ?>

<div id="blog" class="part-mid1">
	<h1>You've searched for: <strong>"<?php the_search_query(); ?>"</strong></h1>

<?php if ( have_posts() ) : 
   			//necessary to show the tags 
   			global $wp_query;
			$wp_query->in_the_loop = true;

			global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			$more = 0; 
			
			/* Start the Loop */ ?>
				<?php 
				if ( $taxonomy_exist = taxonomy_exists('project-tag')) { 
					echo "<section id='openlab'>";
				} elseif ('scientifics' == get_post_type() ) { 
					$pt = $general_options['pt_s'];
						$rl_tit = "Scientifics";
					echo "<section id='related'> <header class='section-tit'><h2><!--" .$rl_tit. "--></h2></header>";
				} else { 
					echo "<section>";
				} 
				while ( have_posts() ) : the_post();
					if ( 'remotes' == get_post_type() ) {  //if it is remote
						include("loop.related.php");				
					} elseif ('scientifics' == get_post_type() ){  //if it is page
						include("loop.post.php");
					} elseif ('post' == get_post_type() ){  //if it is page
					include "loop.post.php";
					} elseif ('page' == get_post_type() ){  //if it is page
						include("loop.post.titles.php");
					} else { //para los demas casos 
						include "loop.post.php";	
					} ?>
				<?php endwhile; ?>
		</section>
	
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

<?php include "navigation.php"; ?>			

</div>
<section id='related'>
	<?php if ( ! dynamic_sidebar( 'bar-3' ) ) : ?><?php endif; // end blog widget area ?>
</section><!-- end #related -->
<?php get_footer(); ?>
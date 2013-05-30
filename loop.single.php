<article id="post-<?php the_ID(); ?>" 
	<?php if ( get_post_type() == $general_options['pt_c'] || get_post_type() == $general_options['pt_i'] ) {
		 post_class('span8'); }
		elseif ( get_post_type() == $general_options['pt_r'] ) {
		 post_class('part-mid2'); } ?>
	>

	<?php

	$post_tit = get_the_title();
	$post_subtitle =  get_post_meta($post->ID, 'subtitle', true) ;
	$authorfullname = get_the_author_meta('first_name').' '.get_the_author_meta('last_name');
	$project_url = get_post_meta($post->ID, 'projecturl', true) ;
	$resource_tag = get_the_term_list( $post->ID, 'resource-tag', '', ' ', '' );
	$resource_cat = get_the_term_list( $post->ID, 'resource-category', '', ' ', '' );
	?>
	<header class="art-pre">
		<?php
		if ( get_post_type() == $general_options['pt_r'] ) { //if resource
			echo "<small>";
			if(function_exists('bcn_display')){bcn_display();}
			echo "</small>";
		}	
		echo "<h1 class='art-tit'>" .$post_tit. "</h1>";
		echo "<div class='postmetadata'>" .$post_subtitle;
		edit_post_link(' Edit', ' | ', '');
		if ( get_post_type() == $general_options['pt_c'] ) { //if case study
			echo "<dl class='dl-horizontal'><dt>Project url</dt><dd><a href='".$project_url. "'>" .$project_url. "</a></dd>";
			$authorfullname = get_the_author_meta('first_name').get_the_author_meta('last_name');
			echo "<dt>Author </dt><dd>".$authorfullname. "</dd></dl>";
			}
		elseif ( get_post_type() == $general_options['pt_r'] ) { //if resource

			echo "<dl class='dl-horizontal'><dt>url</dt><dd><a href='".$project_url. "'>" .$project_url. "</a></dd>";
			echo "<dt>Category </dt><dd>".$resource_cat. "</dd> ";
			echo "<dt>Tags </dt><dd>".$resource_tag. "</dd> ";
			echo "</dl>";
		}	
		echo "</div>";
		?>
	</header><!-- end .art-pre -->

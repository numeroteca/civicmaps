<header class="art-pre">
	<?php
	$post_tit = get_the_title();
	$post_subtitle =  get_post_meta($post->ID, 'subtitle', true) ;
	$authorfullname = get_the_author_meta('first_name').' '.get_the_author_meta('last_name');
	$project_url = get_post_meta($post->ID, 'projecturl', true) ;

	echo "<h1 class='art-tit'>" .$post_tit. "</h1>";
	echo "<div class='postmetadata'>" .$post_subtit;
	echo $resource_tag; 
	//echo " Category: " .$resource_cat;			
	edit_post_link(' Edit', ' | ', '');
	if ( get_post_type() == $general_options['pt_c'] ) {
		echo "<dl class='dl-horizontal'><dt>Project url</dt><dd><a href='".$project_url. "'>" .$project_url. "</a></dd>";
		
		echo "<dt>Author </dt><dd>".$authorfullname. "</dd></dl>";
		}
	echo "</div>";
	?>
</header><!-- end .art-pre -->

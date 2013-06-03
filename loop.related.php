<?php
// common vars
$post_perma = get_permalink();
$post_tit = get_the_title();
//$post_image = the_post_thumbnail('thumbnail');
$post_subtitle =  get_post_meta($post->ID, 'subtitle', true) ;
$excerpt = get_the_excerpt( );

// vars depending on the post type
if ( get_post_type() == $general_options['pt_c'] ) { // if Case Study post type------------------------------------
	

} elseif ( get_post_type() == $general_options['pt_r'] ) { // if Resource post type------------------------------------
	//related excerpt
	$post_excerpt = get_the_excerpt();
		// to make the excerpt be 80 characters $pattern = '/.{80}/i';
		//preg_match($pattern, $post_excerpt, $matches);
		//if ( $matches[0] != '' ) {
		//	$post_excerpt = $matches[0] . "...";
		//}
	// related thumb
//	$max_w = "500";
//	include "loop.video.php";
	$resource_tag = get_the_term_list( $post->ID, 'resource-tag', '<span class="label">', '</span> <span class="label">', '</span>' );  
	$resource_cat = get_the_term_list( $post->ID, 'resource-category', '', ' ', '' );
	$projecturl = get_post_meta($post->ID, 'projecturl', true);
		$pattern = '/.{30}/i';
		preg_match($pattern, $projecturl, $matches);
		if ( $matches[0] != '' ) {
			$projecturl = $matches[0] . "...";
		}
	$img_post_parent = get_the_ID();
	$img_amount = 1;
	$mini_size = array(100,100);
	include "loop.attachment.php";
	if ( isset($img_mini) ) {
		$post_thumbimg = $img_mini_vars[0];
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	} else { unset($post_thumbimg); }


} elseif ( get_post_type() == $general_options['pt_i'] ) { // if interview post type
	// related subtit
	if ( post_custom('institution') ) {
		$post_subtit = get_post_meta($post->ID, 'institution', true);
	} else { unset($post_subtit); }
	// related thumb
	if ( post_custom('thumbimg') ) {
		// get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	} else { unset($post_thumbimg); }

} elseif ( get_post_type() == 'post' ) {
	// if is a post
	if ( isset($authorr) ) {
	// if academic lab
	//	print_r($author);
		$auth_id = $authorr->ID;
		$author_vars = get_userdata($auth_id);
		$auth_tw = $author_vars->twitter;
		$auth_inst = $author_vars->institution;
		
		$first_name = $author_vars->first_name;
		$last_name = $author_vars->last_name;
		// related subtit
		if ( $auth_tw != '' ) {
			$post_subtit = "@" .$auth_tw;
		} else { $post_subtit = ""; }
		// related tit
		$author_nick = $author_vars->display_name;
		$post_tit = "" .$first_name. " " .$last_name;
		//		if ( get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '' ) {
		//			$post_tit = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
		//		} else { $post_tit = get_the_author_meta('display_name'); }
		$post_perma = $general_vars['blogurl']. "/blog/author/" .$author_vars->user_login;
		//$authors_link = the_author_posts_link();
		//echo $authors_link;
		//related excerpt
		//		$post_excerpt = $author_vars->description;
		$post_excerpt = "";
		// related thumb --removed, as we don't need for academic lab
		//$post_thumbimg = get_avatar( $auth_id, 128 );
		
	} else {
		// related tit
		$post_tit = get_the_title();
		// related subtit
		$post_subtit = get_the_date();
		// related thumb
		$img_post_parent = get_the_ID();
		$img_amount = 1;
		$mini_size = array(100,100);
		include "loop.attachment.php";
		if ( isset($img_mini) ) {
			$post_thumbimg = $img_mini_vars[0];
			$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
		} else { unset($post_thumbimg); }
	}
} elseif ( get_post_type() == 'page' ) {
	// if curatorial commite inside about page
	// related tit
	$post_tit = get_the_title();
	// related subtit
	if ( post_custom('subtitle') ) {
		// get integrantes custom field values
		$authors = get_post_meta($post->ID, 'subtitle', true);
		$post_subtit = $authors;
	}
	// related thumb
	if ( post_custom('project_url') ) {
		// get integrantes custom field values
		$url = get_post_meta($post->ID, 'project_url', true);
		$post_url = "<a href='>" .$url. "'>" .$url. "</a>";
	}

	$img_post_parent = get_the_ID();
	$img_amount = 1;
	$mini_size = array(150,150);
	include "loop.attachment.php";
	if ( isset($img_mini) ) {
		$post_thumbimg = $img_mini_vars[0];
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	} else { unset($post_thumbimg); }
	$post_excerpt = get_the_excerpt();
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('span3'); ?>>
	
	<header class="art-tit">
		<?php
		
		if ( get_post_type() == $general_options['pt_c'] || get_post_type() == $general_options['pt_i'] ) {
			echo "<div class='databox thumbnail'>";
				echo "<a href='" .$post_perma. "' title='Permalink to " .$post_tit. "' rel='bookmark alt=" .$excerpt. "'>";
				echo the_post_thumbnail('thumbnail', array(
					'alt'	=> $excerpt,
					'title'	=> $excerpt,
					));
			
				echo "</a><h4><a href='" .$post_perma. "' title='Permalink to " .$post_tit. "' rel='bookmark' title='" .$excerpt. "'>" .$post_tit. "</a></h4>";		
				echo "<span class='sub-tit-1'>" .$post_subtitle. "</span>"; 
		} elseif ( get_post_type() == $general_options['pt_r']) { //if resource
			
			echo "<div class='databox-resource thumbnail'>";
				echo "<a href='" .$post_perma. "' title='Permalink to " .$post_tit. "' rel='bookmark alt=" .$excerpt. "'>";
					echo "<div >";				
					echo the_post_thumbnail(medium, array(
						'alt'	=> $excerpt,
						'title'	=> $excerpt,
						));	
					echo "</div>";
				echo "</a><div ><h4><a href='" .$post_perma. "' title='Permalink to " .$post_tit. "' rel='bookmark' title='" .$excerpt. "'>" .$post_tit. "</a></h4>";
				echo "<div class='page-text'>" .$post_excerpt. "</div></div>"; //only used for resources
				echo "<dl>";
				if ($projecturl!='') {echo "<dt>url</dt><dd><a href='".$projecturl. "'>" .$projecturl. "</a></dd>";}
				echo "<dt>Category </dt><dd>".$resource_cat. "</dd> ";
				echo "<dt>Tags </dt><dd>".$resource_tag. "</dd> ";
				echo "</dl>";
		}
		echo "</div>";
		?>
		
		
		
	</header><!-- end .art-pre -->

	<?php // comments
	/*
	if ( get_post_type() == $general_options['pt_r'] && comments_open() && ! post_password_required() ) {
		$post_perma = $post_perma. "#respond";
	?>
		<section class='post_meta'>
			<div class="post_meta_item"><a href="<?php echo $post_perma; ?>"><?php human_comment_count(); ?></a></div>
			<div class="post_meta_item"><?php GetWtiLikePost();?></div>
		</section>
	<?php }*/ ?>

</article>

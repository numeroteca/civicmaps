<?php
// common vars
$post_perma = get_permalink();
$post_tit = get_the_title();

// vars depending on the post type
if ( get_post_type() == $general_options['pt_c'] ) {
	// if Case Study post type-------------------------------
	// author bio
	$bio = get_the_excerpt();
	// author thumb
	if ( post_custom('thumbimg') ) {
		// get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	}
		$project_url = get_post_meta($post->ID, 'projecturl', true) ;
		$post_subtitle =  get_post_meta($post->ID, 'subtitle', true) ;
		$project_location =  get_post_meta($post->ID, 'location', true) ;
		$project_budget =  get_post_meta($post->ID, 'budget', true) ;
		$project_mission =  get_post_meta($post->ID, 'mission', true) ;
		$project_issue_summary =  get_post_meta($post->ID, 'issuesummary', true) ;
		$project_mapping_summary =  get_post_meta($post->ID, 'mappingsummary', true) ;
		$project_partners =  get_post_meta($post->ID, 'partner', false) ;
		$project_link = get_post_meta($post->ID, 'link', true) ;
		$project_interviewvideo = get_post_meta($post->ID, 'interviewvideo', true) ;
		$project_time = get_post_meta($post->ID, 'time', true) ;
		$post_subtit = '' .$post_subtitle;
		

} elseif ( get_post_type() == $general_options['pt_i'] ) {
	// if interviews post type-------------------------
	// author bio
	$post_subtitle =  get_post_meta($post->ID, 'subtitle', true) ;
	$post_subtit = '' .$post_subtitle;
	$project_partner =  get_post_meta($post->ID, 'partner', true) ;
	$project_link = get_post_meta($post->ID, 'link', true) ;
	$project_interviewvideo = get_post_meta($post->ID, 'interviewvideo', true) ;
	$post_image = the_post_thumbnail('thumbnail');
	$bio =  get_post_meta($post->ID, 'bio', true) ;
	// author thumb
	if ( post_custom('thumbimg') ) {
		// get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	}
	// author name
	$author = get_the_title();

} elseif ( get_post_type() == $general_options['pt_r']  ) {

	//if resource----------------

	// post subtitle
	$post_author = get_the_author(); 
	$project_url = get_post_meta($post->ID, 'project_url', true); 
	$resource_tag = get_the_term_list( $post->ID, 'resource-tag', '', ' ', '' );
	$resource_cat = get_the_term_list( $post->ID, 'resource-category', '', ' ', '' );
	$author_url = get_the_author_meta('user_url');
	$author_url = '<br><a href="'.$author_url.'">' .$author_url. '</a>';


} elseif ( get_post_type() == 'attachment'  ){
	//if post type: is an attachment
	// author bio
	$bio = get_the_author_meta('description');
	// author name
	if ( get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '' ) {
		$author = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
	} else { $author = get_the_author_meta('display_name'); }
	// author thumb
	$post_thumbimg = get_avatar( get_the_author_meta('ID'), 128 );
	// post subtitle
	$post_author = get_the_author(); 
	$post_time = get_the_time('F d, Y');
	$post_tit = get_the_title($post->post_parent); //calling the title of the post, not of the image
	$link_post_tit = get_permalink($post->post_parent);
	$back_to_post = "&laquo; Back to post <a href=\"" .$link_post_tit. "\" rev=\"attachment\" title=\"Back to" .$post_tit. "\">  " .$post_tit. "</a>";
	$post_tit = $back_to_post;
	$attachment_tit = get_the_title();
	$prev_img = get_previous_image_link();
	$next_img = get_next_image_link();
	$navigation_attachment = "<div id=\"navegation-attachment\" class=\"navigation\"> <div class=\"nav-image-left\">" .$prev_img. "</div><div class=\"nav-image-middle\">" .$attachment_tit. "</div><div class=\"nav-image-right\">" .$next_img. "</div></div>";
	
}

else {
	//if post type: get_post_type() == 'post'
	// author bio
	$blogger_bio = get_the_author_meta('description');
	// author name
	if ( get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '' ) {
		$author = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
	} else { $author = get_the_author_meta('display_name'); }
	$post_author = "<a href='" .get_author_posts_url(get_the_author_meta( 'ID' )). "'>" .get_the_author_meta('display_name'). "</a>";
	// author thumb
	$post_thumbimg = get_avatar( get_the_author_meta('ID'), 64 );
	// post subtitle
	$post_time = get_the_time('F d, Y');
	$post_categories = get_the_category();
	$cats_out = "";
	$tags_out = "";
	$separator = "  ";
	foreach ( $post_categories as $category ) {
		$cats_out .= '<strong><a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></strong>' .$separator;
	}
	$post_tags = get_the_tags();
	if ($post_tags) {
		$sepcatstags = ", ";
		foreach( $post_tags as $tag ) {
			$tags_out .= '<a href="' .get_tag_link($tag->term_id). '">' .$tag->name. '</a>' .$separator;
		}
	} else { $sepcatstags = ""; }

	$post_subtit = "Date: " .$post_time. " | Context: " .$cats_out . $sepcatstags . $tags_out;
}

// from nos: display whatever............................................. ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('part-mid1'); ?>>

		<?php
		// echoing attachments for jQuery gallery: images and videos if any
		// this can be done anywhare after include "loop.attachment.php" code
		if ( isset($attach_out) ) {
			echo $attach_out;
		}
		?>
		<header class="art-pre">
			<?php
			echo "<h1 class='art-tit'>" .$post_tit. "</h1>";
			echo "<div class='postmetadata'>" .$post_subtit;
			echo $resource_tag; 
			//echo " Category: " .$resource_cat;			
			edit_post_link(' Edit', ' | ', '');
			if ( get_post_type() == $general_options['pt_c'] ) {
				echo "<dl class='dl-horizontal'><dt>Project url</dt><dd><a href='".$project_url. "'>" .$project_url. "</a></dd>";
				echo "<dt>Location </dt><dd>".$project_location. "</dd>";
				echo "<dt>Budget </dt><dd>".$project_budget. "</dl>";
				}
			echo "</div>";
			?>
		</header><!-- end .art-pre -->
		<section class="page-text" id="content-txt">
			<?php
			echo $navigation_attachment;
			wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
			if ( get_post_type() == $general_options['pt_c'] ) {
				echo "<h3>Individual, Organization or Partners Background/Mission </h3> ".$project_mission;
				echo "<h3>Summary of Issue</h3> ".$project_issue_summary;
				echo "<h3>Summary of Mapping as part of overall Strategy (abstract)  </h3> ".$project_mapping_summary;			
				echo "<h3>Narrative - What happened?</h3> ".$project_issue_summary;
				the_content();			
			} elseif ( get_post_type() == $general_options['pt_i'] )		{	
				the_excerpt();
			} elseif ( get_post_type() == $general_options['pt_r'] )		{
				the_content();
			} else {
				the_content();	
				
			}
			?>
		</section>

<?php if ( get_post_type() == 'post' ) {
// if blog ?>
		<section class="blogger postmetadata">
			<?php if ( isset($post_thumbimg) ) {
				//echo "<span class='img-background' style='background: url(" .$post_thumbimg. ") center center no-repeat #eee;' ></span>";
				echo "<div class='blogger-avatar'>" .$post_thumbimg. "</div>";
				$style_img = "style='margin-left: 73px;'";
			} ?>
			<div class="blogger-tit"<?php if ( isset($style_img) ) { echo " " .$style_img; } ?>>Content posted by <em><?php echo $author ?></em>.</div>
			<div class="blogger-bio"<?php if ( isset($style_img) ) { echo " " .$style_img; } ?>><?php echo $blogger_bio ?></div>
		</section><!-- end .blogger -->
			<?php // last posts by this author
			$args = array(
				'author' => get_the_author_meta('ID'),
				'posts_per_page' => '6',
				'post__not_in' => array( get_the_ID() )
			);
			$blogger_query = new WP_Query( $args );
			if ( $blogger_query->have_posts() ) : ?>
		<section class="blogger postmetadata">
				<div class="blogger-tit ">Other posts by this author:</div>
				<ul class="blogger-rel">
				<?php while ( $blogger_query->have_posts() ) : $blogger_query->the_post();
				//defining size of thumbnails in gallery
				$img_post_parent = get_the_ID();
				$img_amount = 1;
				$mini_size = array(48,48);
				include "loop.attachment.php";
?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink to <?php the_title(); ?>">
						<?php echo $attach_out; ?><div class="blogger-rel-tit"><?php the_title(); ?></div></a>
					</li>
				<?php unset($attach_out); endwhile; ?>
				</ul>
		</section><!-- end .blogger -->
			<?php else :
			endif;
			?>
<?php } 
	comments_template(); ?>
	</article>

<?php if ( get_post_type() == 'post' ) {?>

<?php } else { ?>
	<aside id="bio">
		<div class="architects">
			<header><h2><?php echo $author; ?></h2></header>
			<?php if ( get_post_type() == $general_options['pt_i'] ) { 
				echo "<div class='page-text'>";				
				echo "<strong>Bio</strong><br>";
				echo $bio;
				echo "</div>";
				} ?>
				
			<div class='page-text'>
				<?php if ( get_post_type() == $general_options['pt_c'] ) { ?>
					<strong>Project Partners</strong><br><?php }
				elseif ( get_post_type() == $general_options['pt_i'] ) { ?>
					<strong>Contact information</strong><br>
				<?php } 
					
				
				if ($project_partners[0]=="") { ?>
				<!-- If there are no custom fields, show nothing -->
					<?php } else { ?>
					<?php foreach($project_partners as $project_partners) {
					echo "<div class=''>" .$project_partners. "</div>";
					echo "<br>";
					} ?>														
				<?php } 
				
				
				if ( get_post_type() == $general_options['pt_c'] || get_post_type() == $general_options['pt_i'] ) {
				echo "<br><strong>Related links</strong><br>";	
				echo $project_link ; 
				echo "<br><strong>Interview/video</strong><br>";
				echo $project_interviewvideo; 
				}
				?>
			</div>
		</div>
		</div><!-- end .architects -->
		
		
		

		<!-- end .page-text -->
	</aside><!-- end #bio -->

<?php } ?>

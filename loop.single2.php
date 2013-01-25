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
		$content = get_the_content();
		$project_url = get_post_meta($post->ID, 'projecturl', true) ;
		$post_subtitle =  get_post_meta($post->ID, 'subtitle', true) ;
		$project_location =  get_post_meta($post->ID, 'location', true) ;
		$project_budget =  get_post_meta($post->ID, 'budget', true) ;
		$project_mission =  wpautop( get_post_meta($post->ID, 'mission', true)) ;
		$project_issue_summary =  wpautop( get_post_meta($post->ID, 'issuesummary', true));
		$project_mapping_summary =  wpautop( get_post_meta($post->ID, 'mappingsummary', true)) ;
		$project_partners =  get_post_meta($post->ID, 'partner', false) ;
		$project_link = get_post_meta($post->ID, 'link', true) ;
		$project_interviewvideo = get_post_meta($post->ID, 'interviewvideo', true) ;
		$project_time = get_post_meta($post->ID, 'time', true) ;
		$project_tools = get_post_meta($post->ID, 'projecttools', true) ;
		$post_subtit = '' .$post_subtitle;
		

} elseif ( get_post_type() == $general_options['pt_i'] ) {

	// if interviews post type-------------------------
	// author bio
	$post_subtitle =  get_post_meta($post->ID, 'subtitle', true) ;
	$post_subtit = '' .$post_subtitle;
	$project_partner =  get_post_meta($post->ID, 'partner', true) ;
	$project_link = get_post_meta($post->ID, 'link', true) ;
	$project_interviewvideo = get_post_meta($post->ID, 'interviewvideo', true) ;
	$bio =  get_post_meta($post->ID, 'bio', true) ;
	// author name
	$author = get_the_title();

} elseif ( get_post_type() == $general_options['pt_r']  ) {

	//if resource----------------

	// post subtitle
	$post_author = get_the_author(); 
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

// from nos: display whatever............................................. 

// echoing attachments for jQuery gallery: images and videos if any
	// this can be done anywhare after include "loop.attachment.php" code

	if ( isset($attach_out) ) {
		echo $attach_out;
	}
?>
		
		<section class="page-text" id="content-txt">
			<?php 
			echo $navigation_attachment;
			
			wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
			if ( get_post_type() == $general_options['pt_c'] ) {
				echo "<dl class='accordion'><dt><h3>Individual, Organization or Partners Background/Mission <i class='icon-arrow-down'></i></h3></dt><dd>".$project_mission."</dd>";
				echo "<dt><h3>Summary of Issue <i class='icon-arrow-down'></i></h3></dt><dd> ".$project_issue_summary."</dd>";
				echo "<dt><h3>Summary of Mapping as part of overall Strategy (abstract) <i class='icon-arrow-down'></i></h3></dt><dd> ".$project_mapping_summary."</dd>";			
				echo "<dt><h3>Narrative - What happened? <i class='icon-arrow-down'></i></h3></dt><dd> ";
				the_content();
				echo "</dd><dt><h3>Tools <i class='icon-arrow-down'></i></h3></dt><dd>".$project_tools."</dd></dl>";
				
				//the_content();			
			} elseif ( get_post_type() == $general_options['pt_i'] ) { //if interview	
				echo "<h3>the excerpt</h3>";
				the_excerpt();
				echo "<h3>the content</h3>";
				the_content();
			} elseif ( get_post_type() == $general_options['pt_r'] ) { //if resource
								
				the_content();
			} else {
				the_content();	
				
			}
			?>
		</section>


	<?php comments_template(); ?>
	</article>

<?php if ( get_post_type() == 'post' ) {?>

<?php } else { ?>
	<aside id="bio">
		<div class="">
			
			<?php if ( get_post_type() == $general_options['pt_i'] ) { ?>
				<header><h2><?php //echo $author; ?></h2></header>
				<?php echo "<div class='page-text databox'>";			
				$post_image = the_post_thumbnail('thumbnail');					
				echo "<br><strong>Bio</strong><br>";
				echo $bio;
				echo "</div>";
				} ?>


			<div class='page-text'>
				<div class='databox'>
				<?php if ( get_post_type() == $general_options['pt_c'] ) { 
					echo "<dl class='dl-horizontal'><dt>Location </dt><dd>".$project_location. "</dd>";
					echo "<dt>Budget </dt><dd>".$project_budget. "</dd>";
					echo "<dt>Time </dt><dd>".$project_time. "</dd></dl>"; ?>
				</div>
				<div class='databox'>
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
		</div>
		</div><!-- end .architects -->
		
		
		

		<!-- end .page-text -->
	</aside><!-- end #bio -->

<?php } ?>

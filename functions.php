<?php
// hide admin toolbar by default
// show admin bar only for admins and editors
//if (!current_user_can('edit_posts')) {
//	add_filter('show_admin_bar', '__return_false');
//}

//uncomment this line show_admin_bar(false);

// Custom post types
add_action( 'init', 'create_post_type', 0 );

function create_post_type() {
	// Case Studies custom post type
	register_post_type( 'cases', array(
		'labels' => array(
			'name' => __( 'Case Studies' ),
			'singular_name' => __( 'Case Study' ),
			'add_new_item' => __( 'Add Case Study' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit this Case Study' ),
			'new_item' => __( 'New Case Studyt' ),
			'view' => __( 'View Case Study' ),
			'view_item' => __( 'View this Case Study' ),
			'search_items' => __( 'Search Case Studies' ),
			'not_found' => __( 'No Case Study was found' ),
			'not_found_in_trash' => __( 'No Case Study in the trash' ),
			'parent' => __( 'Parent' )
		),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'menu_position' => 5,
		//'menu_icon' => get_template_directory_uri() . '/images/icon-post.type-integrantes.png',
		'hierarchical' => true, // if true this post type will be as pages
		'query_var' => true,
		'supports' => array('title', 'editor','excerpt','custom-fields','author','page-attributes','trackbacks','thumbnail','comments' ),
		'rewrite' => array('slug'=>'case','with_front'=>false),
		'can_export' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
	));
	// Remotes custom post type
	register_post_type( 'resources', array(
		'labels' => array(
			'name' => __( 'resources' ),
			'singular_name' => __( 'Resource' ),
			'add_new_item' => __( 'Add resource' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit this resource' ),
			'new_item' => __( 'New resource' ),
			'view' => __( 'View resource' ),
			'view_item' => __( 'View this resource' ),
			'search_items' => __( 'Search resource' ),
			'not_found' => __( 'No resource was found' ),
			'not_found_in_trash' => __( 'No resource in the trash' ),
			'parent' => __( 'Parent' )
		),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'menu_position' => 5,
		//'menu_icon' => get_template_directory_uri() . '/images/icon-post.type-integrantes.png',
		'hierarchical' => false, // if true this post type will be as pages
		'query_var' => true,
		'supports' => array('title', 'editor','excerpt','custom-fields','author','comments','trackbacks','thumbnail' ),
		'rewrite' => array('slug'=>'resource','with_front'=>false),
		'can_export' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
	));
	// Scienticic custom post type
	register_post_type( 'interviews', array(
		'labels' => array(
			'name' => __( 'interviews' ),
			'singular_name' => __( 'Interview' ),
			'add_new_item' => __( 'Add sinterview' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit this interview' ),
			'new_item' => __( 'New interview' ),
			'view' => __( 'View interview' ),
			'view_item' => __( 'View this interview' ),
			'search_items' => __( 'Search interview' ),
			'not_found' => __( 'No interview was found' ),
			'not_found_in_trash' => __( 'No interviews in the trash' ),
			'parent' => __( 'Parent' )
		),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'menu_position' => 5,
		//'menu_icon' => get_template_directory_uri() . '/images/icon-post.type-integrantes.png',
		'hierarchical' => true, // if true this post type will be as pages
		'query_var' => true,
		'supports' => array('title', 'editor','excerpt','custom-fields','author','page-attributes','trackbacks','thumbnail','comments' ),
		'rewrite' => array('slug'=>'interview','with_front'=>false),
		'can_export' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
	));

}

// Custom Taxonomies
add_action( 'init', 'build_taxonomies', 0 );

function build_taxonomies() {
register_taxonomy( 'resource-tag', 'resources', array(
	'hierarchical' => false,
	'label' => 'Resource Tag',
	'name' => 'Resource Tags',
	'query_var' => true,
	'rewrite' => array( 'slug' => 'resource-tag', 'with_front' => false ),) );
register_taxonomy( 'resource-category', 'resources', array(
	'hierarchical' => true,
	'label' => 'Resource Category',
	'name' => 'Resource Categories',
	'query_var' => true,
	'rewrite' => array( 'slug' => 'resource-category', 'with_front' => false ),) );
}



// custom menus
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
		array(
			'header-left-menu' => 'Menú izquierdo de cabecera',
			'header-right-menu' => 'Menú derecho de cabecera',
			'footer-menu' => 'Menú del pie'
		)
		);
	}
}

// to add excerpt box to pages
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

// extra fields in user profile
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
 
	function extra_user_profile_fields( $user ) { ?>
	<h3><?php _e("Extra profile information", "blank"); ?></h3>
	 
	<table class="form-table">

	
	<tr>
	<th><label for="institution"><?php _e("Academic Institution"); ?></label></th>
	<td>
	<input type="text" name="institution" id="institution" value="<?php echo esc_attr( get_the_author_meta( 'institution', $user->ID ) ); ?>" class="regular-text" /><br />
	<span class="description"><?php _e("Please enter the academic institution, organization or group you belong."); ?></span>
	</td>
	</tr>

	<tr>
	<th><label for="twitter"><?php _e("Twitter"); ?></label></th>
	<td>
	<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
	<span class="description"><?php _e("Please enter your twitter username without @."); ?></span>
	</td>
	</tr>

	<tr>
	<th><label for="feed"><?php _e("Feed RSS"); ?></label></th>
	<td>
	<input type="text" name="feed" id="feed" value="<?php echo esc_attr( get_the_author_meta( 'feed', $user->ID ) ); ?>" class="regular-text" /><br />
	<span class="description"><?php _e("Please enter a valid URL feed."); ?></span>
	</td>
	</tr>
	

	</table>
<?php }
 
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
 
function save_extra_user_profile_fields( $user_id ) {
 
if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
update_user_meta( $user_id, 'institution', $_POST['institution'] );
update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
update_user_meta( $user_id, 'feed', $_POST['feed'] );
}


//adding widgets bars
function spainlab_widgets_init() {
	// Area 1, located at the front-page.
	register_sidebar( array(
		'name' => __( 'Bar 1. Front page / home', 'spainlab' ),
		'id' => 'bar-1',
		'description' => 'Barra lateral uno. Descripcion.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	) );
	// Area 2, located at the front-page.
	register_sidebar( array(
		'name' => __( 'Bar 2', 'spainlab' ),
		'id' => 'bar-2',
		'description' => 'Barra lateral dos. Descripcion.',
		'before_widget' => '<span id="%1$s" class="widget boxes %2$s">',
		'after_widget' => '</span>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	// Area 3, located at the blog.
	register_sidebar( array(
		'name' => __( 'Bar 3. Blog bar', 'spainlab' ),
		'id' => 'bar-3',
		'description' => 'Barra lateral tres.',
		'before_widget' => '<div id="%1$s" class="widget-blog %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	

}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'spainlab_widgets_init' );

/*** Comment list ***/

function commentlist($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li id="li-comment-<?php comment_ID() ?>">
	<?php if ( '0' != $comment->comment_parent ) { $avatar_size = 39; } ?>
	<div class="comment-avatar"><?php echo get_avatar( $comment, $avatar_size ); ?></div>
        <ul class="comment_meta">
		<li><?php printf( __('%1$s'), get_comment_author_link()); ?></li>
		<li><?php printf( __('%1$s'), get_comment_date()); ?>, <?php printf( __('%1$s'), get_comment_time()); ?></li>
		<li><?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ;?></li>
	</ul>
        <div class="comment_text"><?php comment_text() ?></div>
        <div class="clear"></div>
<?php
}

/*** human comments counter ***/
function human_comment_count() {
	global $wpdb;
	global $post;
	$postid = $post->ID;
	$count = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_type = '' AND comment_approved = '1' AND comment_post_ID = '$postid'";
	$counter = $wpdb->get_var($count);
	if ( $counter == 0 ) { echo "No comments"; }
	elseif ( $counter == 1 ) { echo "1 comment"; }
	else { echo "$counter comments"; }
}


//Add echo functionality to attachment links. Taken from http://www.seodenver.com/get-images-wordpress-functions/
// These functions are copied directly from wp-includes/media.php
// and modified to return the result instead of echo it.
	function get_adjacent_image_link($prev = true, $text = "test") {
		global $post;
		$post = get_post($post);
		$attachments = array_values(get_children( array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') ));
		foreach ( $attachments as $k => $attachment )
			if ( $attachment->ID == $post->ID )
				break;
		$k = $prev ? $k - 1 : $k + 1;
		if ( isset($attachments[$k]) )
			return wp_get_attachment_link($attachments[$k]->ID, '' , true, false, $text);
	}

	function get_previous_image_link() {
		return get_adjacent_image_link(true,'&laquo; Prev' );
	}

	function get_next_image_link() {
		return get_adjacent_image_link(false,'Next &raquo;' );
	}

function fb_like( $atts, $content=null ){
/* Author: Nicholas P. Iler
 * URL: http://www.ilertech.com/2011/06/add-facebook-like-button-to-wordpress-3-0-with-a-simple-shortcode/
 */
    extract(shortcode_atts(array( 
            'send' => 'false',
            'layout' => 'standard',
            'show_faces' => 'true',
            'width' => '400px',
            'action' => 'like',
            'font' => '',
            'colorscheme' => 'light',
            'ref' => '',
            'locale' => 'en_US',
            'appId' => '' // Put your AppId here is you have one
    ), $atts));
 
    $fb_like_code = <<<HTML
        <div id="fb-root"></div><script src="http://connect.facebook.net/$locale/all.js#appId=$appId&amp;xfbml=1"></script>
        <fb:like ref="$ref" href="$content" layout="$layout" colorscheme="$colorscheme" action="$action" send="$send" width="$width" show_faces="$show_faces" font="$font"></fb:like>
HTML;
 
    return $fb_like_code;
}
add_shortcode('fb', 'fb_like');


/**
 * Register the Gallery custom post type.
 */
function gallery_init() {
    $labels = array(
        'name' => 'Imágenes de la galería',
        'singular_name' => 'Imagen de la galería',
        'add_new_item' => 'New Image de la galería',
        'edit_item' => 'Editar Imagen de la galería',
        'new_item' => 'Nueva Imagen de la galería',
        'view_item' => 'Ver Imagen de la galería',
        'search_items' => 'Buscar Imágenes de la galería',
        'not_found' => 'Imágenes de la galería noencontradas',
        'not_found_in_trash' => 'Ninguna Imagen de la galería en la papelera'
    );
    $args = array(
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'supports' => array('thumbnail')
    );

    register_post_type( 'gallery', $args );
}
add_action( 'init', 'gallery_init' );

/**
 * Modify which columns display when the admin views a list of images posts.
 */
function gallery_posts_columns( $posts_columns ) {
    $tmp = array();

    foreach( $posts_columns as $key => $value ) {
        if( $key == 'title' ) {
            $tmp['gallery'] = 'Imagen de la galería';
        } else {
            $tmp[$key] = $value;
        }
    }

    return $tmp;
}
add_filter( 'manage_gallery_posts_columns', 'gallery_posts_columns' );

/**
 * Custom column output when admin is view the header-image post list.
 */
function gallery_custom_column( $column_name ) {
    global $post;

    if( $column_name == 'gallery' ) {
        echo "<a href='", get_edit_post_link( $post->ID ), "'>", get_the_post_thumbnail( $post->ID ), "</a>";
    }
}
add_action( 'manage_posts_custom_column', 'gallery_custom_column' );

/**
 * Make the "Featured Image" metabox front and center when editing a header-image post.
 */
function gallery_metaboxes( $post ) {
    global $wp_meta_boxes;

    remove_meta_box('postimagediv', 'gallery', 'side');
    add_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', 'gallery', 'normal', 'high');
}
add_action( 'add_meta_boxes_gallery', 'gallery_metaboxes' );

/**
 * Enable thumbnail support in the theme, and set the thumbnail size.
 */
function gallery_after_setup() {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size(250, 250, true);
}
add_action( 'after_setup_theme', 'gallery_after_setup' );



//// CUSTOM DASHBOARD LOGO
////hook the administrative header output
//add_action('admin_head', 'my_custom_logo');
//
//function my_custom_logo() {
//	echo '
//	<style type="text/css">
//	#header-logo { background-image: url('.get_bloginfo('template_directory').'/images/dashboard-logo.png) !important; }
//	</style>
//	';
//}


/*------------------Adding column to the Resource editor -----------------*/
add_filter( 'manage_edit-resources_columns', 'my_edit_resources_columns' ) ;

function my_edit_resources_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Resource' ),
		'resource-tag' => __( 'Tags' ),
		'resource-category' => __( 'Categories' ),
		'date' => __( 'Date' )
	);

	return $columns;
}


/*-----end-*/

add_action( 'manage_resources_posts_custom_column', 'my_manage_resources_columns', 10, 2 );

function my_manage_resources_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'tag' column. */
		case 'resource-tag' :

			/* Get the tags for the post. */
			$terms = get_the_terms( $post_id, 'resource-tag' );

			/* If resourcecategory were found. */
			if ( !empty( $terms) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'resource-tag' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'resource-tag', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No tags' );
			}

			break;

		/* If displaying the 'resource category' column. */
		case 'resource-category' :

			/* Get the categories for the post. */
			$terms = get_the_terms( $post_id, 'resource-category' );

			/* If resourcecategory were found. */
			if ( !empty( $terms) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'resource-category' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'resource-category', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No Categories' );
			}

			break;

		/* Just break out of the switch statement for everything else. */
		default :
	break;}
}




















/*----------------------------- Define the custom box ------------------------------- */

add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );

// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'myplugin_add_custom_box', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'myplugin_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function myplugin_add_custom_box() {
    add_meta_box( 
        'myplugin_sectionid', __( 'My Post Section Title', 'myplugin_textdomain' ),'myplugin_inner_custom_box','post' 
    );
    add_meta_box(
        'myplugin_sectionid', __( 'The extra field', 'myplugin_textdomain' ), 'myplugin_inner_custom_box','cases'
    );
}

/* Prints the box content */
function myplugin_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );

  // The actual fields for data entry
  echo '<label for="myplugin_new_field">';
       _e("The extra field", 'myplugin_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field" value="whatever" size="100" />';
}

/* When the post is saved, saves our custom data */
function myplugin_save_postdata( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  
  // Check permissions
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // OK, we're authenticated: we need to find and save the data

  $mydata = $_POST['myplugin_new_field'];

  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}




// This function adds a meta box with a callback function of my_metabox_callback()
function add_my_meta_box() {
     $var1 = 'this';
     $var2 = 'that';
     add_meta_box( 
           'myplugin_sectionid',
           'Metabox Title',
           'my_metabox_callback',
           'page',
           'normal',
           'low', 
           array( 'foo' => $var1, 'bar' => $var2)
      );
}

// $post is an object containing the current post (as a $post object)
// $metabox is an array with metabox id, title, callback, and args elements. 
// The args element is an array containing your passed $callback_args variables.

function my_metabox_callback ( $post, $metabox ) {
     echo 'Last Modified: '.$post->post_modified;        // outputs last time the post was modified
     echo $metabox['args']['foo'];                         // outputs 'this'
     echo $metabox['args']['bar'];                         // outputs 'that'
     echo get_post_meta($post->ID,'my_custom_field',true); // outputs value of custom field
}










define('myplugin_sectionid', 'my-editor');
define('WYSIWYG_EDITOR_ID', 'myeditor'); //Important for CSS that this is different
define('WYSIWYG_META_KEY', 'extra-content');

add_action('admin_init', 'wysiwyg_register_meta_box');
function wysiwyg_register_meta_box(){
        add_meta_box(myplugin_sectionid, __('WYSIWYG Meta Box', 'wysiwyg'), 'wysiwyg_render_meta_box', 'post');
}

function wysiwyg_render_meta_box(){

        global $post;
        
        $meta_box_id = myplugin_sectionid;
        $editor_id = WYSIWYG_EDITOR_ID;
        
        //Add CSS & jQuery goodness to make this work like the original WYSIWYG
        echo "
                <style type='text/css'>
                        #$meta_box_id #edButtonHTML, #$meta_box_id #edButtonPreview {background-color: #F1F1F1; border-color: #DFDFDF #DFDFDF #CCC; color: #999;}
                        #$editor_id{width:100%;}
                        #$meta_box_id #editorcontainer{background:#fff !important;}
                        #$meta_box_id #$editor_id_fullscreen{display:none;}
                </style>
            
                <script type='text/javascript'>
                        jQuery(function($){
                                $('#$meta_box_id #editor-toolbar > a').click(function(){
                                        $('#$meta_box_id #editor-toolbar > a').removeClass('active');
                                        $(this).addClass('active');
                                });
                                
                                if($('#$meta_box_id #edButtonPreview').hasClass('active')){
                                        $('#$meta_box_id #ed_toolbar').hide();
                                }
                                
                                $('#$meta_box_id #edButtonPreview').click(function(){
                                        $('#$meta_box_id #ed_toolbar').hide();
                                });
                                
                                $('#$meta_box_id #edButtonHTML').click(function(){
                                        $('#$meta_box_id #ed_toolbar').show();
                                });

				//Tell the uploader to insert content into the correct WYSIWYG editor
				$('#media-buttons a').bind('click', function(){
					var customEditor = $(this).parents('#$meta_box_id');
					if(customEditor.length > 0){
						edCanvas = document.getElementById('$editor_id');
					}
					else{
						edCanvas = document.getElementById('content');
					}
				});
                        });
                </script>
        ";
        
        //Create The Editor
        $content = get_post_meta($post->ID, WYSIWYG_META_KEY, true);
        the_editor($content, $editor_id);
        
        //Clear The Room!
        echo "<div style='clear:both; display:block;'></div>";
}

add_action('save_post', 'wysiwyg_save_meta');
function wysiwyg_save_meta(){

        $editor_id = myplugin_sectionid;
        $meta_key = WYSIWYG_META_KEY;

        if(isset($_REQUEST[$editor_id]))
                update_post_meta($_REQUEST['post_ID'], WYSIWYG_META_KEY, $_REQUEST[$editor_id]);
}

add_theme_support( 'post-thumbnails', array( 'cases', 'interviews', 'resources' ) ); // Adding featured image to the custom post types

/*--------How to hide No categories if there are no subcategories
-------http://www.category-icons.com/2009/07/how-to-hide-no-categories-if-there-are-no-subcategories/ --------*/
function bm_dont_display_it($content) {
  if (!empty($content)) {
    $content = str_ireplace('<li>' .__( "No categories" ). '</li>', "", $content);
  }
  return $content;
}
add_filter('wp_list_categories','bm_dont_display_it');

//----- Adds metabox. Via https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Basic-Usage

function cs_sample_metaboxes( $meta_boxes ) {
	$prefix = ''; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'email',
		'title' => 'Issue Summary',
		'pages' => array('cases'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Subtitle',
				'desc' => '',
				'id' => $prefix . 'subtitle',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Project url',
				'desc' => '',
				'id' => $prefix . 'projecturl',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Budget',
				'desc' => 'in dollars',
				'id' => $prefix . 'budget',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Interview Video',
				'desc' => 'insert the iframe',
				'id' => $prefix . 'interviewvideo',
				'type' => 'textarea_small'
			),
			array(
				'name' => 'Related links',
				'desc' => 'Insert with a href=',
				'id' => $prefix . 'link',
				'type' => 'textarea_small'
			),
			array(
				'name' => 'Location',
				'desc' => 'ex: McCloud River Basin (North of Redding), California, USA',
				'id' => $prefix . 'location',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Project Tools',
				'desc' => '',
				'id' => $prefix . 'projecttools',
				'type' => 'text_medium'
			),
			
			array(
				'name' => 'Partners',
				'desc' => '',
				'id' => $prefix . 'partner',
				'type' => 'textarea_small'
			),


			array(
				'name' => 'The date',
				'desc' => '',
				'id' => $prefix . 'time',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Youtube',
				'desc' => 'Insert something like: T5ZTx7GZmqE',
				'id' => $prefix . 'youtube',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Issue Summary',
				'desc' => 'field description (optional)',
				'id' => $prefix . 'issuesummary',
				'type' => 'wysiwyg'
			),
			array(
				'name' => 'Mapping Summary',
				'desc' => '',
				'id' => $prefix . 'mappingsummary',
				'type' => 'wysiwyg'
			),
			array(
				'name' => 'Mission',
				'desc' => '',
				'id' => $prefix . 'mission',
				'type' => 'wysiwyg'
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'cs_sample_metaboxes' );

// Initialize the metabox class
add_action( 'init', 'cs_initialize_cmb_meta_boxes', 9999 );
function cs_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'lib/metabox/init.php' );
	}
}
//------------------end metaboxes -------------//
?>

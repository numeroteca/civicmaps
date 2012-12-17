<?php
/*
Template Name: Resources submit form
*/
get_header();
?>

<?php // doing the inserts into DB
if ( is_user_logged_in() && isset($_POST['addcontent-submit']) ) {
	// if conditions to do inserts

	// getting all $_POST data
	//$form_tit = strip_tags($_POST['addcontent-tit']);
	$form_tit =  wp_strip_all_tags($_POST['addcontent-tit']);
	//$form_desc = strip_tags($_POST['addcontent-desc']);
	$form_desc = wp_strip_all_tags($_POST['addcontent-desc']);
	$form_img = $_FILES['addcontent-file1']['name'];
	$form_video = $_POST['addcontent-video'];
	$form_videoapi = $_POST['addcontent-videoapi'];
	$form_url = $_POST['addcontent-url'];
	$form_category  = $_POST['cat']; //need to work on this
	$form_tags[1] = $_POST['addcontent-tag1'];
	$form_tags[2] = $_POST['addcontent-tag2'];
	$form_tags[3] = $_POST['addcontent-tag3'];
	$form_tags[4] = $_POST['addcontent-tag4'];
	$form_tags[5] = $_POST['addcontent-tag5'];
	$project_tags = array();
	foreach ( $form_tags as $tag ) {
		$tag = trim($tag);
		if ( $tag != '' ) { array_push($project_tags, $tag ); }
	}
	// check possible errors
	$form_errors = array();
	// checking if all the mandatory content has been submited
	if ( $form_tit == '' ) { $form_tit_class = " error"; $fail = "empty"; }
	if ( $form_desc == '' ) { $form_desc_class = " error"; $fail = "empty"; }
//	if ( $form_img == '' ) { $form_file_class = " error"; $fail = "empty"; }

	// checking if all the images have the right format and size
	foreach ( $_FILES as $file ) {
//echo "<pre>";
//print_r($file);
//echo "</pre>";
		if ( $file['type'] == 'image/jpeg' || $file['type'] == 'image/png' || $file['type'] == 'image/gif' || $file['type'] == '' ) {}
		else { $fail1 = "type"; }
//		if ( $file['size'] > '2000000' ) { $fail2 = "size"; }
	}

//echo "<pre>";
//print_r($_FILES);
//echo "</pre>";

	if ( $fail == 'empty' ) {
		// if any mandatory field is empty
		array_push($form_errors, "<strong>ERROR! Empty fields</strong>: The fields Project name and Description are mandatory and you must fill them in to submit your content.");
	}
	if ( $fail1 == 'type' ) {
		// if any image type is not allowed
		array_push($form_errors, "<strong>ERROR! Not allowed image format or image too big</strong>: The images you submit must be one of the following formats: JPG, PNG, GIF; and its weight must be less than 2MB.");
	}
//	if ( $fail2 == 'size' ) {
		// if any image size excceds the maximum
//		array_push($form_errors, "<strong>Image size over the maximum</strong>: The images you submit don't must weight more than 3MB.");
//	}
	if ( $form_errors[0] == '' ) {
		// if no error in the form data

		// user data
		global $current_user;
		get_currentuserinfo();
		$user_id = $current_user->ID;

		// extra content data
		$pt = $general_options['pt_r'];

		// inserting all the data as a resource custom type
		$post_id = wp_insert_post(array(
			'post_type' => $pt, // "page" para páginas, "libro" para el custom post type libro...
			'post_status' => 'draft', // "publish" para publicados, "draft" para borrador, "future" para programarlo...
			'post_author' => $user_id, // el ID del autor, 1 para admin
			'post_title' => $form_tit,
			'post_content' => $form_desc, // el contenido
			'post_category' => $catfinal // matriz de los ID de las categorías a las que asociar la entrada
		)); // La funcion insert devuelve la id del post

		// adding video custom fields to the post
		if ( $form_video != '' ) {
			add_post_meta($post_id, $form_videoapi, $form_video);
		}
		if ( $form_url != '' ) {
			add_post_meta($post_id, 'project_url', $form_url);
		}

		// asociamos a la entrada los términos que queramos de la taxonomía Projects tags
		wp_set_post_terms( $post_id, $project_tags, 'resource-tag','True');


		// begin image insert
		$upload_dir_vars = wp_upload_dir();
		$upload_dir = $upload_dir_vars['path']; // absolute path to uploads folder
		$uploaddir = realpath($upload_dir);

		foreach ( $_FILES as $file ) {
			// for each uploaded file
			$filename = basename($file['name']); // to get file name from form
			$filename = trim($filename); // removing spaces at the begining and end
			$filename = ereg_replace(" ", "-", $filename); // removing spaces inside the name

			$typefile = $file['type']; // file type

			$uploadfile = $uploaddir.'/'.$filename;

			$slugname = preg_replace('/\.[^.]+$/', '', basename($uploadfile));

			if ( file_exists($uploadfile) ) {
				// if file exists
				$count = "a";
				while ( file_exists($uploadfile) ) {
					$count++;
					if ( $typefile == 'image/jpeg' ) { $exten = 'jpg'; }
					elseif ( $typefile == 'image/png' ) { $exten = 'png'; }
					elseif ( $typefile == 'image/gif' ) { $exten = 'gif'; }
					$uploadfile = $uploaddir.'/'.$slugname.'-'.$count.'.'.$exten;
				}
			} // end if file exist

			if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
				// if the file is uploaded
				$slugname = preg_replace('/\.[^.]+$/', '', basename($uploadfile)); // defining image slug again to make it matching the file name
				$attachment = array(
					'post_mime_type' => $typefile,
					'post_title' => $slugname,
					'post_content' => '',
					'post_status' => 'inherit'
				);

				$attach_id = wp_insert_attachment( $attachment, $uploadfile, $post_id );
				// you must first include the image.php file
				// for the function wp_generate_attachment_metadata() to work
				require_once(ABSPATH . "wp-admin" . '/includes/image.php');

				$attach_data = wp_generate_attachment_metadata( $attach_id, $uploadfile );
				wp_update_attachment_metadata( $attach_id,  $attach_data );

				$img_url = wp_get_attachment_url($attach_id);

			} else {
				//echo "There were some problems while uploading the file.";
				//echo 'Here is some more debugging info:';
				//print_r($_FILES);
			}
		}
		// end for each file
		// end insert image

	} // end if no errors in the form data

} // end conditions to do inserts
?>

<div class="part-form page-text">
<?php // this page content
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
//		include("loop.page.php");
	endwhile;
else :
endif; ?>

<?php // add content form
if ( is_user_logged_in() ) {
	// if user is logged in
	// page header
	$post_tit = "Submit a resource";
	$subtitle = "Send a resource and it will be published in our Resources section";
	echo "
	<article>
		<header class='art-pre'><h1 class='art-tit'>" .$post_tit. "</h1>
			<span class='sub-tit-1'>" .$subtitle. "</span>
		</header>
	";
	if ( $post_id != 0 ) {
		// if a content has just inserted
		echo "<section class='page-text'><p>Your content has been sumbited successfully</p>";
		echo "<p>Your resource has been stored. If everything in your submit is accurate, an editor will publish your content as soon as possible.</p></section>";

	} else {
		// form vars
		//$action_slug = $wp_query->query_vars['name'];
		$action_slug = get_permalink();

		include "content-add.form.php";

		// HTML output
		echo $add_form;

	} // end if the content has been inserted




} else {
	// if user is not logged in

	// form vars
//	$action_slug = $wp_query->query_vars['name'];
		$action_slug = get_permalink();
//	$ref = $post_perma;
	$ref = $action_slug;

	include "user-login.form.php";
	include "user-signup.form.php";

	// HTML output
	// page header
	$post_tit = "Log in";
	$subtitle = "You must log in before submit any content.<br />If you don't have still an account, you can fill in the sign up form underneath.";
	echo "
	<article>
		<header class='art-pre'><h1 class='art-tit'>" .$post_tit. "</h1>
			<span class='sub-tit-1'>" .$subtitle. "</span>
		</header>
	";

	if ( isset($_GET['fail']) ) {}
	else {echo $login_form; }
	echo "<h2>Sign up</h2>";
	echo $signup_form;

} // end if user is logged in
?>
	</article>
</div><!-- end .part-form -->
<?php get_footer(); ?>

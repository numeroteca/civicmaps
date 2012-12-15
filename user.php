<?php
// to log out a logged in user
if ( is_user_logged_in() && isset($_POST['logout-submit']) ) {
	$redirect = $_POST['logout-ref'];
	wp_logout();
	header("location: " .$redirect);
}

if ( is_user_logged_in() ) {
// if user is logged in and a logout link has been clicked

	// user data
	global $current_user;
	get_currentuserinfo();
	$username = $current_user->user_login;

	// logout form
	$action_slug = get_permalink();
	$ref = $action_slug;
	include "user-logout.form.php";

	$success_msg = "You have logged in as <strong>" .$username. "</strong> Welcome!";
}

if ( !is_user_logged_in() ) {
	$success_msg = "To submit any content you have to log in first. You can <a href='" .$general_options['blogurl']. "/open-lab/submit-your-project'>log in here</a>.";
}

// to log in a signed up user
if ( isset($_POST['login-submit']) ) {
	$redirect = $_POST['login-ref'];
	$creds = array();
	$creds['user_login'] = $_POST['login-username'];
	$creds['user_password'] = $_POST['login-pass'];
	$creds['remember'] = $_POST['login-remember'];
	$user = wp_signon( $creds, false );

	if ( is_wp_error($user) ) {
		// if error
		// echo error message
		echo $user->get_error_message();
	} else {
		// if everything correct
		// redirect to content
	//	$redirect .= "?login=true"
		header("location: " .$redirect);
	}
}
// end log in proccess

?>

<?php
// to sign up a new user
if ( isset($_POST['signup-submit']) ) {

	// catching all $_POST data
//	$redirect = $_POST['signup-ref']. "?";
	$username = $_POST['signup-username'];
	$pass = $_POST['signup-pass'];
	$pass2 = $_POST['signup-pass2'];
	$mail = $_POST['signup-mail'];
	$firstname = $_POST['signup-firstname'];
	$lastname = $_POST['signup-lastname'];
	$bio = $_POST['signup-bio'];
	$twitter = $_POST['signup-twitter'];
	$website = $_POST['signup-website'];
	$feed = $_POST['signup-feed'];
	$conditions = $_POST['signup-conditions'];
	$institution = $_POST['signup-institution'];
	$human = $_POST['signup-human'];

	require_once(ABSPATH . WPINC . '/registration.php');

	// testing errors and redirecting if necesary
	$user_id = username_exists( $username );
	$mail_id = email_exists($mail);
//	global $errore;
	if ( $user_id || $username == "" || $username == " " ) {
		global $user_exist;
		$user_exist = $user_id;
		// if username already exists
//		$redirect .= "username=fail&";
//		header("location: " .$redirect);
		$errore = "user";
	} else {
//		$redirect .= "username=" .$username. "&";
	}
	if ( $mail_id || $mail == "" ) {
		// if email is already associated to other user
		global $mail_exist;
		$mail_exist = $mail_id;
//		$redirect .= "mail=fail&";
//		header("location: " .$redirect);
		$errore = "mail";
	}
	if ( $pass != $pass2 ) {
		// if passwords don't match
//		$redirect .= "pass=fail&";
//		header("location: " .$redirect);
		$errore = "pass";
	}
	if ( $human != '13' ) {
		$errore = "robot";
	}
	if ( $conditions != 'accept' ) {
		// if user didn't accept the legal advise
		$redirect .= "conditions=fail&";
//		header("location: " .$redirect);
		$errore = "conditions";
	} else {
		$redirect .= "conditions=accept&";
	}
	if ( isset($errore) ) {
	} else {
		// if no errors
		// if pass is empty, we generate a random one
		$random_pass = wp_generate_password( 12, false );
		if ( $pass == '' ) { $pass = $random_pass; }

		$userdata = array(
			'user_pass' => $pass,
			'user_login' => $username,
			'user_url' => $website,
			'user_email' => $mail,
			'first_name' => $firstname,
			'last_name' => $lastname,
			'description' => $bio,
			'role' => 'contributor',
			'twitter' => $twitter,
			'feed' => $feed,
			'institution' => $institution,
		);
		$user_id = wp_insert_user( $userdata );
		update_user_meta( $user_id, 'institution', $institution );
		update_user_meta( $user_id, 'twitter', $twitter );
		update_user_meta( $user_id, 'feed', $feed );
//		$redirect .= "user=" .$user_id;
//		header("location: " .$redirect);

		$success_msg = "<span class='error'>You have sign up successfully. In order to submit any content, first of all <strong>you must log in using the form underneath.</strong></span>";
		// to send confirmation mail to the new user
		$user_data = get_userdata( $user_id );
		$to = $user_data->user_email;
		$subject = "Username and password to login in spain-lab.net";
		$message = 'Hi ' .$user_data->user_login. ',' . "\r\n" .
			'you have signed up succesfully in Spain Lab, the Open Innovation Platform on Architecture. You can log in using your username ('.$user_data->user_login.') and password (' .$pass. '), here: http://spain-lab.net/openlab/submit-your-project/' . "\r\n\r\n" .
			'If you have forgotten your username or password, you can recover them here: http://spain-lab.net/wp-login.php?action=lostpassword' . "\r\n\r\n" .
			'We want to see your projects in OpenLab section. Submit them!' . "\r\n\r\n" .
			'If you have any question about how to submit, please read the FAQ: http://spain-lab.net/faq/' . "\r\n\r\n" .
			'If FAQ don\'t answer your doubt, you can contact us directly: http://spain-lab.net/contact/';
		$headers[] = 'From: SpainLab -- Open Innovation Platform on Architecture <no-reply@spain-lab.net>';
//		$headers[] = 'Bcc: info@montera34.com';
		wp_mail( $to, $subject, $message, $headers );
		$to = 'info@montera34.com';
		$subject = "New user has sign up in spain-lab.net";
		$message = 'A new user has sign up in spain-lab.net: ' . "\r\n\r\n" .
			'+ '.$user_data->user_login. "\r\n\r\n" .
		$headers[] = 'From: SpainLab -- Open Innovation Platform on Architecture <no-reply@spain-lab.net>';
		$headers[] = 'Cc: info@spain-lab.net';
		wp_mail( $to, $subject, $message, $headers );
	} // end testing errors

//	header("location: " .$redirect);
} // end sign up proccess

if ( isset($_GET['user']) ) {
// if user has just signed up
	$success_msg = "<span class='error'>You have sign up successfully. In order to submit any content, first of all <strong>you must log in using the form underneath.</strong></span>";
	// to send confirmation mail to the new user
	$user_data = get_userdata( $_GET['user'] );
	$to = $user_data->user_email;
	$subject = "Username and password to login in spain-lab.net";
	$message = 'Hi ' .$user_data->user_login. ',' . "\r\n" .
		'you have signed up succesfully in Spain Lab, the Open Innovation Platform on Architecture. You can log in using your username ('.$user_data->user_login.') and password (' .$pass. '), here: http://spain-lab.net/openlab/submit-your-project/' . "\r\n" .
		'If you have forgotten your username or password, you can recover them here: http://spain-lab.net/wp-login.php?action=lostpassword' . "\r\n" .
		'We want to see your projects in OpenLab section. Submit them!' . "\r\n" .
		'If you have any question about how to submit, please read the FAQ: http://spain-lab.net/faq/' . "\r\n" .
		'If FAQ don\'t answer your doubt, you can contact us directly: http://spain-lab.net/contact/';
	$headers[] = 'From: SpainLab -- Open Innovation Platform on Architecture <no-reply@spain-lab.net>';
	$headers[] = 'Bcc: info@montera34.com';
	wp_mail( $to, $subject, $message, $headers, $attachments );
}
// end if user has just sign up

?>

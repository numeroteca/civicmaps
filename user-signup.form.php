<?php
echo $mail_id;
// preparing errors if sign up form has been submited
if ( isset($_POST['signup-submit']) ) {
	// if username is empty
	if ( $_POST['signup-username'] == '' || $_POST['signup-username'] == ' ' ) {
		$name_val = '';
		$name_msg = "<span class='error'><strong>You must choose a username: with an empty field you are out of the game.</strong></span>";
		$form_username_class = " error";
	} elseif ( isset($user_exist) ) {
	// if username already exist
		$name_val = $_POST['signup-username'];
		$name_msg = "<span class='error'><strong>The username you have chosen already exists.</strong> Try something different.</span>";
		$form_username_class = " error";
	} elseif ( isset($user_badchar) ) {
	// if username contain bad characters
		$name_val = $_POST['signup-username'];
		$name_msg = "<span class='error'><strong>The username you have chosen already exists or is not a valid one. Try something different and keep in main that you cannot use special charset like * / ( ) [ ] { } ...</strong></span>";
		$form_username_class = " error";
	} else {
	// if username is ok
		$name_val = $_POST['signup-username'];
		$name_msg = "";
		$form_username_class = "";
	}

	if ( $_POST['signup-pass'] != $_POST['signup-pass2'] ) {
	// if the pass confirmation is not correct
		$pass_val = "";
		$pass_msg = "<span class='error'><strong>There is any error in the password you have chosen. Try to type it again carefully.</strong></span><br />";
		$form_pass_class = " error";
	} else {
		$pass_val = "";
		$pass_msg = "";
		$form_pass_class = "";
	}

	if ( $_POST['signup-mail'] == '' ) {
	// if mail field is empty
		$mail_val = "";
		$mail_msg = "<span class='error'><strong>The mail address is a mandatory field. You will receive all your login data in this address.</strong></span><br />";
		$form_mail_class = " error";
	} elseif ( isset($mail_exist) ) {
	// if mail is already asociated to other user
		$mail_val = $_POST['signup-mail'];
		$mail_msg = "<span class='error'><strong>The mail address you have chosen is already associated to other user account.</strong> Try another different.</span><br />";
		$form_mail_class = " error";
	} else {
		$mail_val = $_POST['signup-mail'];
		$mail_msg = "";
		$form_mail_class = "";
	}

	if ( $_POST['signup-human'] != '13' ) {
	// is the user a robot?
		$human_val = $_POST['signup-human'];
		$human_msg = "<span class='error'><strong>Are you sure you are not a robot?</strong> We don't.</span><br />";
		$form_human_class = " error";
	} else {
		$human_val = $_POST['signup-human'];
		$human_msg = "";
		$form_human_class = "";
	}

	if ( $_POST['signup-conditions'] != 'accept' ) {
	// if legal conditions have not been accepted
		$conditions_val = "accept";
		$conditions_msg = "<span class='error'><strong>You must read and accept the Legal and Privacy Advise to sign up.</strong></span><br />";
		$form_conditions_class = " error";
	} else {
		$conditions_val = "accept";
		$conditions_msg = "";
		$form_conditions_class = "";
	}
	// catching all $_POST data
//	$redirect = $_POST['signup-ref']. "?";
	$first_val = $_POST['signup-firstname'];
	$last_val = $_POST['signup-lastname'];
	$bio_val = $_POST['signup-bio'];
	$twitter_val = $_POST['signup-twitter'];
	$web_val = $_POST['signup-website'];
	$feed_val = $_POST['signup-feed'];
	$institution_val = $_POST['signup-institution'];

} else {
// if no errors and the user signed up succesfully
// don't display the signup form

	$signup_form = "";

}


$signup_form = "
<form id='signup' name='signup' method='post' action='" .$action_slug. "'>
	<fieldset class='required" .$form_username_class. "'>
		<span class='req'>*</span>
		<input id='signup-username' name='signup-username' type='text' value='" .$name_val. "' />
		<label>Username</label>
		<div class='mini-faq'>" .$name_msg. "</div>
	</fieldset>
	<fieldset>
		<input id='signup-pass' name='signup-pass' type='password' value='' />
		<label>Password</label>
		<div class='mini-faq'><strong>Choose a strong password</strong>, a good recipe could be a combination of characters and numbers with any capital letters. To make other people difficult to access to your account is always a good idea.</div>
	</fieldset>
	<fieldset class='required" .$form_pass_class. "'>
		<input id='signup-pass2' name='signup-pass2' type='password' value='' />
		<label>Password confirmation</label>
		<div class='mini-faq'>" .$pass_msg. "If you leave the password boxes empty, a random password will be sent to your email address.</div>
	</fieldset>
	<fieldset class='required" .$form_mail_class. "'>
		<span class='req'>*</span>
		<input id='signup-mail' name='signup-mail' type='text' value='" .$mail_val. "' />
		<label>E-mail</label>
		<div class='mini-faq'>" .$mail_msg. "<strong>Spam is evil and you'll never see any from us</strong>. <strong>This address will not be shown in the web, of course!</strong></div>
	</fieldset>
	<fieldset>
		<input id='signup-firstname' name='signup-firstname' type='text' value='" .$first_val. "' />
		<label>First name</label>
		<div class='mini-faq'><strong>All this information about (first and last names, description, institution...) you will appear next to your projects</strong> or other content you submit. You can complete it in any moment after sign up.</div>
	</fieldset>
	<fieldset>
		<input id='signup-lastname' name='signup-lastname' type='text' value='" .$last_val. "' />
		<label>Last name</label>
	</fieldset>
	<fieldset>
		<textarea id='signup-bio' name='signup-bio' cols='45' rows='10'>" .$bio_val. "</textarea>
		<label>Briefly about you</label>
	</fieldset>
	<fieldset>
		<input id='signup-institution' name='signup-institution' type='text' value='" .$institution_val. "' />
		<label>Institution</label>
		<div class='mini-faq'>Do you belong to any academic institution or other kind of organization?</div>
	</fieldset>
	<fieldset>
		<input id='signup-twitter' name='signup-twitter' type='text' value='" .$twitter_val. "' />
		<label>Twitter account</label>
		<div class='mini-faq'><strong>Your twitter username</strong>.</div>
	</fieldset>
	<fieldset>
		<input id='signup-website' name='signup-website' type='text' value='" .$web_val. "' />
		<label>Website</label>
	</fieldset>
	<fieldset>
		<input id='signup-feed' name='signup-feed' type='text' value='" .$feed_val. "' />
		<label>Website Feed</label>
		<div class='mini-faq'>Don't you know what a feed is? Have a look at <a target='_blank' href='http://en.wikipedia.org/wiki/Web_feed'>Wikipedia</a>.</div>
	</fieldset>
	<fieldset class='rem" .$form_conditions_class. "'>
		<input id='signup-conditions' name='signup-conditions' type='checkbox' value='" .$conditions_val. "' />
		<label>I have read the <a href='/privacy-advise' target='_blank'>Legal and Privacy Advise</a> and I agree with it.</label>
		<div class='mini-faq'>" .$conditions_msg. "</div>
	</fieldset>
	<fieldset class='required" .$form_human_class. "'>
		<input id='signup-human' name='signup-human' type='text' value='" .$human_val. "' />
		<label>four plus nine?</label>
		<div class='mini-faq'>" .$human_msg. "<strong>Prove that you are not a robot!</strong></div>
	</fieldset>
	<fieldset>
		<input id='sigup-ref' name='signup-ref' type='hidden' value='" .$ref. "' />
		<input id='signup-submit' name='signup-submit' type='submit' value='Sign up' />
	</fieldset>

</form><!-- #signup -->
";


?>

<?php
$login_form = "
<form id='login' name='login' method='post' action='" .$action_slug. "'>
	<fieldset>
		<input id='login-username' name='login-username' type='text' value='' />
		<label>Username</label>
	</fieldset>
	<fieldset>
		<input id='login-pass' name='login-pass' type='password' value='' />
		<label>Password</label>
		<div class='mini-faq'>Did you forget your password? <strong><a href='/wp-login.php?action=lostpassword'>Get another one</a></strong>.</div>
	</fieldset>
	<fieldset class='rem'>
		<input id='login-remember' name='login-remember' type='checkbox' value='false' />
		<label>Remember me?</label>
	</fieldset>
	<fieldset>
		<input id='login-ref' name='login-ref' type='hidden' value='" .$ref. "' />
		<input id='login-submit' name='login-submit' type='submit' value='Login' />
	</fieldset>
</form><!-- #login -->
";
?>

<?php
$login_form = "
<form id='login' name='login' method='post' action='" .$action_slug. "' class='form-horizontal'>
	<div class='control-group'>
		<label class='control-label' >Username</label>
		<div class='controls'>	
			<input id='login-username' name='login-username' type='text' value='' />
		</div>
	</div>
	<div class='control-group'>
		<label class='control-label' >Password</label>
		<div class='controls'>
			<input id='login-pass' name='login-pass' type='password' value='' />
			<div class='mini-faq'>Did you forget your password? <strong><a href='/wp-login.php?action=lostpassword'>Get another one</a></strong>.</div>
		</div>
	</div>
	<div class='control-group'>
		<label class='control-label' >Remember me?</label>
		<div class='controls'>
			<input id='login-remember' name='login-remember' type='checkbox' value='false' />
		</div>
	</div>
	<fieldset>
		<input id='login-ref' name='login-ref' type='hidden' value='" .$ref. "' />
		<input id='login-submit' name='login-submit' type='submit' value='Login' />
	</fieldset>
</form><!-- #login -->
";
?>

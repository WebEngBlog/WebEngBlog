<link rel="stylesheet" href="<?php echo "modules".S."login".S."template".S."login.css"; ?>" />

<section id="login" >
	<h1>Login</h1>
	<form action="" method="post">
		<fieldset>
			<label id="lbl_username" class="login_label" for="username">Benutzername</label>
			<input id="in_username" class="input_field" type="text" name="username" />
			<label id="lbl_password" class="login_label" for="password">Passwort</label>
			<input id="in_password" class="input_field" type="password" name="password" />
		</fieldset>
		<input id="btn_login" type="submit" name="login" value="Anmelden" />
		<input type="hidden" name="action" value="login" />
	</form>
</section>
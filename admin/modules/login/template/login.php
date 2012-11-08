<article id="login">
	<h3>Login</h3><br>
	<?php 
	if (isset($_POST["action"]) == "Login") {
		?><p><label class="error">Username or password is wrong</label></p><?php
	}
	?>
	<form action="index.php" method="post">
		<label class="login_label" for="username">Username</label><br>
		<input class="input_field" type="text" name="username" /><br>
		<label class="login_label" for="password">Password</label><br>
		<input class="input_field" type="password" name="password" /><br>
		<input type="submit" class="radius medium button" value="Anmelden" />
		<input type="hidden" name="action" value="login" />
	</form>
</article>
<?php
if ($_GET["func"] == "edit" && isset($_GET["id"]) && $_GET["id"] > 0) {
$user = User::getUser((int) $_GET["id"]);
?>

<section id="edit" >
	<h1>Edit</h1>
	<form action="" method="post">
		<fieldset>
			<label id="lbl_username" class="login_label" for="username">Benutzername</label>
			<input id="in_username" class="input_field" type="text" name="username" value="<?php echo $user->name; ?>" />
			<label id="lbl_password" class="login_label" for="password">Passwort</label>
			<input id="in_password" class="input_field" type="password" name="password" />
		</fieldset>
		<input id="btn_login" type="submit" name="edit" value="Bearbeiten" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?display=users'" value="Zurück" />
		<input type="hidden" name="action" value="users" />
		<input type="hidden" name="edit" value="true" />
	</form>
</section>

<?php
} elseif ($_GET["func"] == "delete" && isset($_GET["id"]) && $_GET["id"] > 0) {
?>

<section id="delete" >
	<h1>User löschen</h1>
	<form action="" method="post">
		<p>Wollen sie den User wirklich löschen?</p>
		<input id="btn_delete" type="submit" name="delete" value="Löschen" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?display=users'" value="Zurück" />
		<input type="hidden" name="action" value="users" />
		<input type="hidden" name="delete" value="true" />
	</form>
</section>

<?php 
} elseif ($_GET["func"] == "register") {
?>

<section id="register" >
	<h1>Register</h1>
	<form action="" method="post">
		<fieldset>
			<label id="lbl_username" class="login_label" for="username">Benutzername</label>
			<input id="in_username" class="input_field" type="text" name="username" />
			<label id="lbl_password" class="login_label" for="password">Passwort</label>
			<input id="in_password" class="input_field" type="password" name="password" />
		</fieldset>
		<input id="btn_login" type="submit" name="register" value="Registrieren" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?display=users'" value="Zurück" />
		<input type="hidden" name="action" value="users" />
		<input type="hidden" name="register" value="true" />
	</form>
</section>


<?php
} else {
?>

<script type="text/javascript">
	
	function registerUser(){
		loadContent("display=users&func=register");
	}

	function editUser(id) {
		loadContent("display=users&func=edit&id=" + id);
	}

	function deleteUser(id) {
		loadContent("display=users&func=delete&id=" + id);
	}	

</script>

<?php 
$users = User::getUsers();
?>
	<a href="javascript:registerUser()">Register New User</a>
<?php
	foreach ($users as $value) {
?>
	<section id="list_item" >
		<div>
			<?php echo $value->name; ?>
			<a href="javascript:editUser(<?php echo $value->id ?>)">Edit</a>
			<a href="javascript:deleteUser(<?php echo $value->id ?>)">Delete</a>
		</div>
	</section>

<?php 
	}
?>

<?php
}
?>
<?php
/*******************************************************************************
* users template for the backend (admin area)
* 
* @author 		Tobias Röding
* @copyright	Tobias Röding, 14.10.2012
* @version		0.9
*******************************************************************************/
?>

<?php
if ($_GET["func"] == "edit" && isset($_GET["id"]) && $_GET["id"] > 0) {
$user = User::getUser((int) $_GET["id"]);
?>

<section id="edit" >
	<h1>Change Password</h1>
	<form action="" method="post">
		<label id="lbl_username" class="edit_label" for="username">User:</label>
		<label id="lbl_username" class="edit_label" for="username"><?php echo $user->name; ?></label><br>
		<label id="lbl_oldpassword" class="edit_label" for="password">Old Password</label>
		<input id="in_oldpassword" class="edit_field" type="password" name="oldpassword" /><br>
		<label id="lbl_newpassword" class="edit_label" for="password">New Password</label>
		<input id="in_newpassword" class="edit_field" type="password" name="newpassword" /><br>
		<input id="btn_login" type="submit" name="edit" value="Change Password" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?display=users'" value="Back" />
		<input type="hidden" name="action" value="users" />
		<input type="hidden" name="edit" value="true" />
	</form>
</section>

<?php
} elseif ($_GET["func"] == "delete" && isset($_GET["id"]) && $_GET["id"] > 0) {
?>

<section id="delete" >
	<h1>Delete User</h1>
	<form action="" method="post">
		<p>Do you really want to delete the user?</p>
		<input id="btn_delete" type="submit" name="delete" value="Delete" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?display=users'" value="Back" />
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
		<label id="lbl_username" class="register_label" for="username">Username</label>
		<input id="in_username" class="input_field" type="text" name="username" /><br>
		<label id="lbl_password" class="register_label" for="password">Password</label>
		<input id="in_password" class="input_field" type="password" name="password" /><br>
		<input id="btn_login" type="submit" name="register" value="Register" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?display=users'" value="Back" />
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
	<table>
<?php
	foreach ($users as $value) {
?>
		<tr>
			<td><?php echo $value->name; ?></td>
			<td><a href="javascript:editUser(<?php echo $value->id ?>)">Change Password</a></td>
			<td><a href="javascript:deleteUser(<?php echo $value->id ?>)">Delete</a></td>
		</tr>

<?php 
	}
?>
	</table>
<?php
}
?>
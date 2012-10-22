<?php
/*******************************************************************************
* user template for the backend (admin area)
* 
* @author 		Tobias Röding
* @copyright	Tobias Röding, 14.10.2012
* @version		0.9
*******************************************************************************/
?>

<?php
if ($_GET["func"] == "edit" && isset($_GET["id"]) && $_GET["id"] > 0) {
$user = UserManagement::getUser((int) $_GET["id"]);
?>

<article>
	<h3>Change Password</h3><br>
	<form action="" method="post">
		<h5>User: <?php echo $user->name; ?></h5><br>
		<label id="lbl_oldpassword" class="edit_label" for="password">Old Password</label>
		<input id="in_oldpassword" class="edit_field" type="password" name="oldpassword" /><br>
		<label id="lbl_newpassword" class="edit_label" for="password">New Password</label>
		<input id="in_newpassword" class="edit_field" type="password" name="newpassword" /><br>
		<input id="btn_edit" type="submit" class="radius medium button" value="Change Password" />
		<a href="?display=user"><input id="btn_back" type="button" class="radius medium button" value="Back" /></a>
		<input type="hidden" name="action" value="user" />
		<input type="hidden" name="edit" value="true" />
	</form>
</article>

<?php
} elseif ($_GET["func"] == "delete" && isset($_GET["id"]) && $_GET["id"] > 0) {
?>

<article>
	<h3>Delete User</h3><br>
	<form action="" method="post">
		<p>Do you really want to delete the user?</p>
		<input id="btn_delete" type="submit" class="radius medium button" value="Delete" />
		<a href="?display=user"><input id="btn_back" type="button" class="radius medium button" value="Back" /></a>
		<input type="hidden" name="action" value="user" />
		<input type="hidden" name="delete" value="true" />
	</form>
</section>

<?php 
} elseif ($_GET["func"] == "register") {
?>

<article>
	<h3>Register</h3><br>
	<form action="" method="post">
		<label id="lbl_username" class="register_label" for="username">Username</label>
		<input id="in_username" class="input_field" type="text" name="username" /><br>
		<label id="lbl_fullname" class="register_label" for="fullname">Fullname</label>
		<input id="in_fullname" class="input_field" type="text" name="fullname" /><br>
		<label id="lbl_password" class="register_label" for="password">Password</label>
		<input id="in_password" class="input_field" type="password" name="password" /><br>
		<input id="btn_register" type="submit" class="radius medium button" value="Register" />
		<a href="?display=user"><input id="btn_back" type="button" class="radius medium button" value="Back" /></a>
		<input type="hidden" name="action" value="user" />
		<input type="hidden" name="register" value="true" />
	</form>
</article>


<?php
} else {

$user = UserManagement::getUsers();
?>
<article>
	<h5><a href="?display=user&func=register">Register New User</a></h5><br>
	<table>
		<colgroup>
    		<col width="25%">
    		<col width="25%">
    		<col width="25%">
    		<col width="25%">
  		</colgroup>
<?php
	foreach ($user as $value) {
?>
		<tr>
			<td><?php echo $value->name; ?></td>
			<td><?php echo $value->fullname; ?></td>
			<td><a href="?display=user&func=edit&id=<?php echo $value->id ?>">Change Password</a></td>
			<td><a href="?display=user&func=delete&id=<?php echo $value->id ?>">Delete</a></td>
		</tr>

<?php 
	}
?>
	</table>
</article>
<?php
}
?>
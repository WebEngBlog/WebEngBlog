<?php
/*******************************************************************************
* articles template for the backend (admin area)
* 
* @author 		Tobias Röding
* @copyright	Tobias Röding, 14.10.2012
* @version		0.9
*******************************************************************************/
?>

<?php

if ($_GET["func"] == "edit" && isset($_GET["id"]) && $_GET["id"] > 0) {

$article = Modul::loadModul("articles", ADMIN)->getArticle((int) $_GET["id"]);

?>

<section id="articles" >
	<h1>Edit Article</h1>
	<form action="" method="post">
		<label id="lbl_title" class="title_label" for="title">Title</label><br>
		<input id="in_title" class="input_field" type="text" name="title" value="<?php echo $article->title; ?>" /><br>
		<label id="lbl_content" class="content_label" for="content">Content</label><br>
    	<textarea id="in_content" class="input_field" name="content" cols="50" rows="10"><?php echo $article->content; ?></textarea><br>
		<label id="lbl_tags" class="tag_label" for="tags">Tags</label><br>
		<input id="in_tags" class="input_field" type="text" name="tags" value="<?php echo $article->tags; ?>" /><br>
		<input id="btn_save" type="submit" name="save" value="Save" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?display=articles'" value="Back" />
		<input type="hidden" name="action" value="articles" />
		<input type="hidden" name="edit" value="true" />
	</form>
</section>

<?php
} elseif ($_GET["func"] == "delete" && isset($_GET["id"]) && $_GET["id"] > 0) {
?>

<section id="articles" >
	<h1>Delete Article</h1>
	<form action="" method="post">
		<p>Do you really want to delete the article?</p>
		<input id="btn_delete" type="submit" name="delete" value="Delete" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?display=articles'" value="Back" />
		<input type="hidden" name="action" value="articles" />
		<input type="hidden" name="delete" value="true" />
	</form>
</section>

<?php
} elseif ($_GET["func"] == "create") {
?>

<section id="articles" >
	<h1>Create Article</h1>
	<form action="" method="post">
		<label id="lbl_title" class="title_label" for="title">Titel</label><br>
		<input id="in_title" class="input_field" type="text" name="title" /><br>
		<label id="lbl_content" class="content_label" for="content">Content</label><br>
    	<textarea id="in_content" class="input_field" name="content" cols="50" rows="10"></textarea><br>
		<label id="lbl_tags" class="tag_label" for="tags">Tags</label><br>
		<input id="in_tags" class="input_field" type="text" name="tags" /><br>
		<input id="btn_save" type="submit" name="save" value="Save" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?display=articles'" value="Back" />
		<input type="hidden" name="action" value="articles" />
		<input type="hidden" name="create" value="true" />
	</form>
</section>

<?php
} else {
?>

<script type="text/javascript">

	function loadContent(data) {
		window.location.href = "?" + data;
	}
	
	function createArticle(){
		loadContent("display=articles&func=create");
	}

	function editArticle(id) {
		loadContent("display=articles&func=edit&id=" + id);
	}

	function deleteArticle(id) {
		loadContent("display=articles&func=delete&id=" + id);
	}	

</script>

<?php 
$posts = Modul::loadModul("articles", ADMIN)->getAll();
?>
	<a href="javascript:createArticle()">Create New</a>
	<table>
<?php
	foreach ($posts as $value) {
?>
		<tr>
			<td><?php echo $value->title; ?></td>
			<td><a href="javascript:editArticle(<?php echo $value->id ?>)">Edit</a></td>
			<td><a href="javascript:deleteArticle(<?php echo $value->id ?>)">Delete</a></td>
		</tr>

<?php 
	}
?>
	</table>		
<?php
}
?>
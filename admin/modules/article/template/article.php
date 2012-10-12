<?php
if ($_GET["func"] == "edit" && isset($_GET["id"]) && $_GET["id"] > 0) {

$article = Modul::loadModul("article", ADMIN)->getArticle((int) $_GET["id"]);

?>

<section id="article" >
	<h1>Artikel bearbeiten</h1>
	<form action="" method="post">
		<fieldset>
			<label id="lbl_title" class="title_label" for="title">Titel</label>
			<input id="in_title" class="input_field" type="text" name="title" value="<?php echo $article->title; ?>"/></br>
			<label id="lbl_content" class="content_label" for="content">Content</label>
    		<textarea id="in_content" class="input_field" name="content" cols="50" rows="10"><?php echo $article->content; ?></textarea>
		</fieldset>
		<input id="btn_save" type="submit" name="save" value="Speichern" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?'" value="Zur��ck" />
		<input type="hidden" name="action" value="article" />
		<input type="hidden" name="edit" value="true" />
	</form>
</section>

<?php
} elseif ($_GET["func"] == "create") {
?>

<section id="article" >
	<h1>Artikel erstellen</h1>
	<form action="" method="post">
		<fieldset>
			<label id="lbl_title" class="title_label" for="title">Titel</label>
			<input id="in_title" class="input_field" type="text" name="title" /></br>
			<label id="lbl_content" class="content_label" for="content">Content</label>
    		<textarea id="in_content" class="input_field" name="content" cols="50" rows="10"></textarea>
		</fieldset>
		<input id="btn_save" type="submit" name="save" value="Speichern" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?'" value="Zur��ck" />
		<input type="hidden" name="action" value="article" />
		<input type="hidden" name="create" value="true" />
	</form>
</section>

<?php
} elseif ($_GET["func"] == "delete" && isset($_GET["id"]) && $_GET["id"] > 0) {
?>

<section id="article" >
	<h1>Artikel löschen</h1>
	<form action="" method="post">
		<p>Wollen sie den Artikel wirklich löschen?</p>
		<input id="btn_delete" type="submit" name="delete" value="Löschen" />
		<input id="btn_back" type="button" name="back" onclick="javascript:window.location.href='?'" value="Zur��ck" />
		<input type="hidden" name="action" value="article" />
		<input type="hidden" name="delete" value="true" />
	</form>
</section>

<?php
} else {
?>

<script type="text/javascript">
	
	function createArticle(){
		loadContent("display=article&func=create");
	}

	function editArticle(id) {
		loadContent("display=article&func=edit&id=" + id);
	}

	function deleteArticle(id) {
		loadContent("display=article&func=delete&id=" + id);
	}	

</script>

<?php 
$posts = Modul::loadModul("article", ADMIN)->getAll();
?>
	<a href="javascript:createArticle()">Create New</a>
<?php
	foreach ($posts as $value) {
?>
	<section id="list_item" >
		<div>
			<?php echo $value->title; ?>
			<a href="javascript:editArticle(<?php echo $value->id ?>)">Edit</a>
			<a href="javascript:deleteArticle(<?php echo $value->id ?>)">Delete</a>
		</div>
	</section>

<?php 
	}
?>

<?php
} 
?>
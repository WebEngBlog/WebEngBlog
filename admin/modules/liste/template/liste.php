<link rel="text/javascript" src="<?php echo "modules".S."liste".S."template".S."liste.js"; ?>" />		

<script type="text/javascript">
	
	function createArticle(){
		loadContent("display=article&func=create");
	//	loadContent("create=article");
	}

	function editArticle(id) {
		loadContent("display=article&func=edit&id=" + id);
	//	loadContent("edit=article&id=" + id);
	}

	function deleteArticle(id) {
		loadContent("display=article&func=delete&id=" + id);
	//	loadContent("delete=article&id=" + id);
	}	

</script>

<?php 
$posts = Modul::loadModul("liste", ADMIN)->getAll();
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
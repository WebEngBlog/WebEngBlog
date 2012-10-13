<script type="text/javascript">

	function showArticle(id) {
		loadContent("display=article;comment&id=" + id);
	}
	
</script>

<?php 

$posts = Modul::loadModul("articles", ROOT)->getAll();

foreach ($posts as $value) {
	?><article class="article_preview" onclick="showArticle(<?php echo $value->id ?>)">
		<h1><?php echo $value->title; ?></h1>
		<?php echo substr($value->content, 0, 400) ."...";
	?></article><?php 
}

?>
<?php
/*******************************************************************************
* article template for the frontend
* 
* @author 		Lukas Berg, Tobias Röding
* @copyright	@author, 14.10.2012
* @version		0.9
*******************************************************************************/
?>

<?php
if (isset($_GET["id"]) && $_GET["id"] > 0) {

$article = Modul::loadModul("article", ROOT)->getArticle((int) $_GET["id"]);
?>

<article class="article_whole">
<?php
if ($article->id > 0) {
?>
		<h1><?php echo $article->title; ?></h1>
		<div><?php echo $article->content; ?></div>
<?php
} else {
?>
	<h1>No article found</h1>
<?php
}
?>
</article>

<?php 
} else {
?>

<script type="text/javascript">

	function showArticle(id) {
		loadContent("display=article;comment&id=" + id);
	}
	
</script>

<?php 

$posts = Modul::loadModul("article", ROOT)->getAll();

foreach ($posts as $value) {
	?><article class="article_preview" onclick="showArticle(<?php echo $value->id ?>)">
		<h1><?php echo $value->title; ?></h1>
		<?php echo substr($value->content, 0, 400) ."...";
	?></article><?php 
}
}
?>
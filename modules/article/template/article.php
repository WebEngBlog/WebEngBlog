<?php
/*******************************************************************************
* article template for the frontend
* 
* @author 		Lukas Berg
* @copyright	Lukas Berg, 14.10.2012
* @version		0.9
*******************************************************************************/
?>

<?php
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
?>
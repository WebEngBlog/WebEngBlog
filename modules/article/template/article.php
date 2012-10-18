<?php
/*******************************************************************************
* article template for the frontend
* 
* @author 		Lukas Berg, Tobias R��ding
* @copyright	@author, 14.10.2012
* @version		0.9
*******************************************************************************/
?>

<?php
if (isset($_GET["tag"])) {

$posts = Modul::loadModul("article", ROOT)->getAllArticleWithTag($_GET[tag]);

foreach ($posts as $article) {
	?><article>
		<h3><a href="?display=article&id=<?php echo $article->id ?>"><?php echo $article->title; ?></a></h3>
		<h6>Written by <a href="#"><?php echo $article->author; ?></a> on <?php echo $article->creation_date; ?>.</h6>
		<p><?php echo $article->content; ?></p>
<?php
		$tags = explode(";", $article->tags);
		foreach ($tags as $tag) {
?>
			<a href="?display=article&tag=<?php echo $tag; ?>"><?php echo $tag; ?></a>
<?php
		}
	?></article><?php 
}
?>
<?php
 } elseif (isset($_GET["id"]) && $_GET["id"] > 0) {

$article = Modul::loadModul("article", ROOT)->getArticle((int) $_GET["id"]);
?>

<article>
<?php
if ($article->id > 0) {
?>
		<h3><a href="#"><?php echo $article->title; ?></a></h3>
		<h6>Written by <a href="#"><?php echo $article->author; ?></a> on <?php echo $article->creation_date; ?>.</h6>
		<p><?php echo $article->content; ?></p>
<?php
	$tags = explode(";", $article->tags);
	foreach ($tags as $tag) {
?>
		<a href="?display=article&tag=<?php echo $tag; ?>"><?php echo $tag; ?></a>
<?php
	}
} else {
?>
	<h3>No article found</h3>
<?php
}
?>
</article>

<?php 
} else {

$posts = Modul::loadModul("article", ROOT)->getAll();

foreach ($posts as $value) {
	?><article>
		<h3><a href="?display=article&id=<?php echo $value->id ?>"><?php echo $value->title; ?></a></h3>
		<h6>Written by <a href="#"><?php echo $value->author; ?></a> on <?php echo $value->creation_date; ?>.</h6>
		<?php echo substr($value->content, 0, 400)?>
		<?php echo '<a href="?display=article&id='. $value->id .'" >More &rarr;</a>'
	?></article><?php 
}
}
?>
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
if (isset($_GET["tag"])) {

$posts = Modul::loadModul("article", ROOT)->getAllArticleWithTag($_GET[tag]);

foreach ($posts as $article) {
	$user = R::load("user", $article->author);
	?><article>
		<h3><a href="?display=article&id=<?php echo $article->id ?>"><?php echo $article->title; ?></a></h3>
		<h6>Written by <a href="?display=article&author=<?php echo $user->id; ?>"><?php echo $user->fullname; ?></a> on <?php echo $article->creation_date; ?>.</h6>
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
} elseif (isset($_GET["author"]) && $_GET["autor"] > 0) {

$posts = Modul::loadModul("article", ROOT)->getAllArticleWithAuthor((int) $_GET[author]);

foreach ($posts as $article) {
	$user = R::load("user", $article->author);
	?><article>
		<h3><a href="?display=article&id=<?php echo $article->id ?>"><?php echo $article->title; ?></a></h3>
		<h6>Written by <a href="?display=article&author=<?php echo $user->id; ?>"><?php echo $user->fullname; ?></a> on <?php echo $article->creation_date; ?>.</h6>
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
$user = R::load("user", $article->author);
?>

<article>
<?php
if ($article->id > 0) {
?>
		<h3><a href="#"><?php echo $article->title; ?></a></h3>
		<h6>Written by <a href="?display=article&author=<?php echo $user->id; ?>"><?php echo $user->fullname; ?></a> on <?php echo $article->creation_date; ?>.</h6>
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

foreach ($posts as $article) {
	$user = R::load("user", $article->author);
	?><article>
		<h3><a href="?display=article&id=<?php echo $value->id ?>"><?php echo $article->title; ?></a></h3>
		<h6>Written by <a href="?display=article&author=<?php echo $user->id; ?>"><?php echo $user->fullname; ?></a> on <?php echo $article->creation_date; ?>.</h6>
		<?php echo substr($article->content, 0, 400)?>
		<?php echo '<a href="?display=article&id='. $article->id .'" >More &rarr;</a>'
	?></article><?php 
}
}
?>
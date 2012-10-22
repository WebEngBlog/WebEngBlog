<?php
/*******************************************************************************
* article template for the frontend
* 
* @author 		Lukas Berg, Tobias Röding
* @copyright	@author, 14.10.2012
* @version		1.1
*******************************************************************************/
?>

<?php

if (isset($_GET["id"]) && $_GET["id"] > 0) {

	$article = Modul::loadModul("article", ROOT)->getArticle((int) $_GET["id"]);
	$user = R::load("user", $article->author);
	$article->content = str_replace("\n", "<br>", $article->content);
?>		
		<article>
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
?>		
		</article>
<?php
} else {
	if (isset($_GET["tag"])) {
		$posts = Modul::loadModul("article", ROOT)->getAllArticlesWithTag($_GET["tag"]);
		?><h5>All articles with tag: "<?php echo $_GET["tag"]; ?>"</h5><?php 
	} elseif (isset($_GET["author"])) {
		$posts = Modul::loadModul("article", ROOT)->getAllArticlesWithAuthor((int) $_GET["author"]);
		$user = R::load("user", (int) $_GET["author"]);
		?><h5>All articles of author: "<?php echo $user->fullname; ?>"</h5><?php
	} elseif (isset($_GET["search"]) && trim($_GET["search"]) !== "") {
		$posts = Modul::loadModul("article", ROOT)->getAllArticlesWithSearch($_GET["search"]);
		?><h5>All search results for: "<?php echo $_GET["search"]; ?>"</h5><?php
	} else {
		$posts = Modul::loadModul("article", ROOT)->getAllArticles();
	}

	if (count($posts) > 0) {
		foreach ($posts as $article) {
			$user = R::load("user", $article->author);
			$article->content = str_replace("\n", "<br>", $article->content);
			if(substr_count($article->content, "<br>") > 3) {
				$offset = 0;
				for($i = 1; $i <= 3; $i++) {
					$offset = strpos($article->content, "<br>", $offset + 1);
				}
				$article->content = substr($article->content, 0, $offset);
			} else {
				$article->content = substr($article->content, 0, 400);
			}
			?><article>
				<h3><a href="?display=article&id=<?php echo $article->id ?>"><?php echo $article->title; ?></a></h3>
				<h6>Written by <a href="?display=article&author=<?php echo $user->id; ?>"><?php echo $user->fullname; ?></a> on <?php echo $article->creation_date; ?>.</h6>
				<?php echo $article->content; ?>
				<?php echo '<a href="?display=article&id='. $article->id .'" >More &rarr;</a>'
			?></article><?php 
		}
	} else {
		?><h5>No articles were found</h5><?php
	}
}

?>
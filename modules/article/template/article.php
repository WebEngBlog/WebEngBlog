<?php
/*******************************************************************************
 * article template for the frontend
 *
 * @version		1.1
 *******************************************************************************/

?><article class="content"><?php

//Check if one article is displayed or more
if (isset($_GET["id"]) && $_GET["id"] > 0) {
	//Load the article
	$article = Modul::loadModul("article", ROOT)->getArticle((int) $_GET["id"]);
	
	//Check if id of the article is valid
	if ($article->id != $_GET["id"]) {
		?><h5>No article with the given id was found</h5><?php
	} else {
		//Display the article
		$user = R::load("user", $article->author);
		$article->content = str_replace("\n", "<br>", $article->content);

		?><h3><a href="?display=article;comment&amp;id=<?php echo $article->id ?>"><?php echo $article->title; ?></a></h3>
		<h6>Written by <a href="?display=article&amp;author=<?php echo $user->id; ?>"><?php echo $user->fullname; ?></a> on <?php echo $article->creation_date; ?>.</h6>
		<p><?php echo $article->content; ?></p><?php
			
		$tags = explode(";", html_entity_decode($article->tags));
		foreach ($tags as $tag) {
			$tag = htmlentities($tag);
			?><a href="?display=article&amp;tag=<?php echo $tag; ?>"><?php echo $tag; ?> </a><?php
		}
	}	
} else {
	//Get the artciles specified by the parameters
	if (isset($_GET["tag"])) {
		$posts = Modul::loadModul("article", ROOT)->getAllArticlesWithTag($_GET["tag"]);
		?><h5>All articles with tag: "<?php echo $_GET["tag"]; ?>"</h5><?php 
	} elseif (isset($_GET["author"]) && $_GET["author"] > 0) {
		$posts = Modul::loadModul("article", ROOT)->getAllArticlesWithAuthor((int) $_GET["author"]);
		$user = R::load("user", (int) $_GET["author"]);
		?><h5>All articles of author: "<?php echo $user->fullname; ?>"</h5><?php
	} elseif (isset($_GET["search"]) && trim($_GET["search"]) !== "") {
		$posts = Modul::loadModul("article", ROOT)->getAllArticlesWithSearch($_GET["search"]);
		?><h5>All search results for: "<?php echo $_GET["search"]; ?>"</h5><?php
	} else {
		$posts = Modul::loadModul("article", ROOT)->getAllArticles();
	}

	//Display the preview of the articles
	if (count($posts) > 0) {
		foreach ($posts as $article) {
			$user = R::load("user", $article->author);
			//Display line breaks
			$article->content = str_replace("\n", "<br>", $article->content);
			
			//Cut the article after 3 line breaks or after 400 characters
			if(substr_count($article->content, "<br>") > 3) {
				$offset = 0;
				for($i = 1; $i <= 3; $i++) {
					$offset = strpos($article->content, "<br>", $offset + 1);
				}
				$article->content = substr($article->content, 0, $offset);
			} else {
				$article->content = substr($article->content, 0, 400);
			}
			//Display the article
			?><h3><a href="?display=article;comment&amp;id=<?php echo $article->id ?>"><?php echo $article->title; ?></a></h3>
				<h6>Written by <a href="?display=article&amp;author=<?php echo $user->id; ?>"><?php echo $user->fullname; ?></a> on <?php echo $article->creation_date; ?>.</h6>
				<p><?php echo $article->content; ?>
				<a href="?display=article;comment&amp;id=<?php echo $article->id; ?>">More &rarr;</a></p><?php 
		}
	} else {
		?><h5>No articles were found</h5><?php
	}
}

?>

</article>
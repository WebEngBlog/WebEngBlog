<?php
/*******************************************************************************
* comments template for the backend (admin area)
* 
* @author 		Tobias Röding
* @copyright	Tobias Röding, 24.10.12
* @version		0.9
*******************************************************************************/
?>
<?php
if ($_GET["func"] == "delete" && isset($_GET["id"]) && $_GET["id"] > 0) {

$comment = Modul::loadModul("comment", ADMIN)->getComment((int) $_GET["id"]);
?>

<article>
	<h3>Delete Comment</h3><br>
	<form action="" method="post">
		<p>Do you really want to delete the comment?</p>
		<input id="btn_delete" type="submit" class="radius medium button" value="Delete" />
		<a href="?display=comment&article=<?php echo $comment->article; ?>" class="radius medium button">Back</a>
		<input type="hidden" name="action" value="comment" />
		<input type="hidden" name="delete" value="true" />
	</form>
</article>

<?php
} elseif(isset($_GET["article"]) && $_GET["article"] > 0) {
	
$comments = Modul::loadModul("comment", ADMIN)->getAllCommentsWithArticleID((int) $_GET["article"]);
$article = Modul::loadModul("article", ADMIN)->getArticle((int) $_GET["article"]);
?>
<article>
	<h5>Comments for the article: <?php echo $article->title; ?></h5> 
	<table>
		<colgroup>
    		<col width="100">
    		<col width="500">
    		<col width="100">
  		</colgroup>
<?php
	foreach ($comments as $value) {
?>
		<tr>
			<td><?php echo $value->author; ?></td>
			<td><?php echo $value->content; ?></td>
			<td><a href="?display=comment&func=delete&id=<?php echo $value->id; ?>">Delete</a></td>
		</tr>

<?php 
	}
?>
	</table>	
</article>	
<?php
} else {
?>
<article>
		<h5>No comment found</h5>
</article>
<?php
}
?>

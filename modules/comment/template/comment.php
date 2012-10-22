<?php
/*******************************************************************************
* comment template for the frontend
* 
* @author 		Tobias Röding
* @copyright	@author, 14.10.2012
* @version		0.9
*******************************************************************************/
?>

<?php
if (isset($_GET["id"]) && $_GET["id"] > 0) {

$posts = Modul::loadModul("comment", ROOT)->getComments((int) $_GET["id"]);
?>
	<h5>Comment</h5>

<?php
	foreach ($posts as $value) {
?>

		<article class="comment">
<?php
		if ($value->id > 0) {
?>
			<p>Autor: <?php echo $value->author; ?></p>
			<p><?php echo $value->content; ?></p>
<?php
		} else {
?>
		<p>No Comment found</p>
<?php
		}
?>
		</article>
<?php
	}
}
?>
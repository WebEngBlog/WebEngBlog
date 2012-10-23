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

if (isset($_GET["id"]) && $_GET["id"] > 0 && R::load("article", $_GET["id"])->id == $_GET["id"]) {	
	?><article class="content"><?php
	
	$comment = Modul::loadModul("comment", ROOT);
	$posts = $comment->getComments((int) $_GET["id"]);
	
	?><div class="panel"><?php
		if ($comment->getError() !== false) {
			?><p><label class="error"><?php echo $comment->getError(); ?></label></p><?php
		}
		?><form action="?display=article;comment&id=<?php echo $_GET["id"]; ?>" method="post">
			<label id="lbl_author" for="author">Author</label>
			<input id="in_author" class="input_field" type="text" name="author" value="<?php echo $comment->getAuthor(); ?>" /><br>
		    <textarea id="in_content" class="input_field" name="content" cols="50" rows="5"><?php echo $comment->getContent(); ?></textarea>
			<input id="btn_post" type="submit" class="radius medium button" value="Post" />
			<input type="hidden" name="action" value="comment" />
		</form></div></article><?php

	foreach ($posts as $value) {

		?><?php
		
		if ($value->id > 0) {
			?><div class="panel">
				<p><b><?php echo $value->author; ?></b> wrotes at <b><?php echo $value->created; ?></b>:</p>
				<p><?php echo $value->content; ?></p>
			</div><?php
		} else {
			?><p>No Comment found</p><?php
		}
	}
}


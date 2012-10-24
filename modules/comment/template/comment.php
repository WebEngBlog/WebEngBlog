<?php
/*******************************************************************************
* comment template for the frontend
* 
* @author 		Tobias Röding
* @copyright	@author, 14.10.2012
* @version		0.9
*******************************************************************************/

if (isset($_GET["id"]) && $_GET["id"] > 0 && R::load("article", $_GET["id"])->id == $_GET["id"]) {	
	?><article id="comment" class="content"><?php
	
	$comment = Modul::loadModul("comment", ROOT);
	$posts = $comment->getComments((int) $_GET["id"]);	
	
	?><div class="panel"><?php
		if ($comment->getError() !== false) {
			?><p><label class="error"><?php echo $comment->getError(); ?></label></p><?php
		}
		?><form action="?display=article;comment&amp;id=<?php echo $_GET["id"]; ?>" method="post">
			<label id="lbl_author" for="in_author">Author</label>
			<input id="in_author" class="input_field" type="text" name="author" value="<?php echo $comment->getAuthor(); ?>" /><br>
		    <textarea id="in_content" class="input_field" name="content" cols="50" rows="5"><?php echo $comment->getContent(); ?></textarea>
			<input id="btn_post" type="submit" class="radius medium button" value="Post" />
			<input type="hidden" name="action" value="comment" />
		</form></div>
		
	<div id="comments"><?php

	foreach ($posts as $value) {		
		if ($value->id > 0) {
			?><div class="panel">
				<p><b><?php echo $value->author; ?></b> wrotes at <b><?php echo date("d.m.Y, H:i", strtotime($value->created)); ?></b>:</p>
				<?php echo $value->content; ?>
			</div><?php
		} else {
			?><p>No Comment found</p><?php
		}
	}
	?></div></article>
	
	<script type="text/javascript">
	$(function() {
		var article = <?php echo $_GET["id"]; ?>;
		var since = "<?php echo count($posts) == 0 ? "1970-01-01 09:00:00" : array_shift($posts)->created; ?>";

		{var old = $("#btn_post");
		old.clone().attr("type", "button").insertBefore(old).click(function() {
			var author = $.trim($("#in_author").val());

			if (author.length == 0) {
				alert("Please insert an author");
				return;
			}
			if (author.length > 20) {
				alert("Max 20 characters as author");
				return;
			}

			if (/[^a-zA-Z0-9_\-]+/.test(author)) {
				alert("Only the following characters are allowed for author: a-z A-Z 0-9 _-");
				return;
			}

			var content = $.trim($("#in_content").val());

			if (content.length == 0) {
				alert("Please insert some content");
				return;
			}
			
			$.post("api/index.php", {display: "comment", article: article, 
				author: author, content: content}, function(data) {
					if (data == 1) {
						$("#in_author").val("");
						$("#in_content").val("");
						updateComments();
					} else {
						alert("Comment could not be posted");
					}
				}
			);
		});
		old.remove();}

		function updateComments() {
			$.post("api/index.php", {display: "comment", article: article, 
				since: since}, function(data) {
					data = $.parseJSON(data);

					if (data.since) {
						since = data.since;
					}
					
					$.each(data.comments, function (key, value) {
						$("#comments").prepend("<div class=\"panel\" style=\"display:none;\"><p><b>" + value.author
								+ "</b> wrotes at <b>" + value.created + "</b></p>" 
								+ value.content + "</div>");

						$("#comments div").first().fadeIn("slow");
					});
				}
			);
		}

		setInterval(function(){updateComments();}, 5000);
	});
		
	</script><?php
}

?>
<script type="text/javascript">
	$(function() {
		{	
			$("#search-box").width($("#search").width());
			
			var oldText = "";
			$("#search").keyup(function() {
				var text = $(this).val();

				if (text == "") {
					oldText = "";
					$("#search-box").empty();
				}

				if (text != oldText) {
					$.post("api/index.php", {display: "search", search: text}, function(data) {
						$("#search-box").empty();
						$.each($.parseJSON(data), function (key, value) {
							$("#search-box").append("<tr><td class=\"search-result\"><a href=\"?display=article;comment&amp;id="
									+ value.id + "\">" + value.title + "</a></td></tr>");	
						});
					});	
				
					oldText = text;
				}
			});
		}
	});
</script>
<form action="index.php" method="get">
	<input id="search" class="" type="text" name="search" autocomplete="off" />
	<input type="hidden" name="display" value="article" />
	<table id="search-box"></table>
</form>
<?php

?>
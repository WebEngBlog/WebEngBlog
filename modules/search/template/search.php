<script type="text/javascript">
	$(function() {
		{
			var oldText = "";
			//Prepare the width of the results
			$("#search-box").width($("#search").width());
			
			$("#search").keyup(function() {
				var text = $(this).val();

				if (text == "") {
					oldText = "";
					$("#search-box").empty();
				}

				//Display the results if a new search string was entered
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

		/*	$("#search").focusin(function() {
				$("#search-box").css("visibility", "visible");
			});
		*/

		/*	$("#search").focusout(function() {
				$("#search-box").css("visibility", "hidden");
			});
		*/
		}
	});
</script>
<form action="index.php" method="get">
	<input id="search" class="" type="text" name="search"
		autocomplete="off" /> <input type="hidden" name="display"
		value="article" />
	<table id="search-box"></table>
</form>
<?php

?>
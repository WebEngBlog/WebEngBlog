<?php

$tags = Modul::loadModul("tag")->getTags();

$min = min($tags);
$max = max($tags);

if ($min === $max)
	$max++;

$div = (Tag::MAX_SIZE - Tag::MIN_SIZE) / ($max - $min);

foreach ($tags as $tag => $count) {
	?><a href="?display=article&amp;tag=<?php echo $tag; ?>" style="font-size:<?php echo Tag::MIN_SIZE + ($count - $min) * $div; ?>pt;"><?php echo $tag; ?> </a><?php
}

?>	
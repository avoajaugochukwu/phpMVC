




	<hr>
	<?php foreach ($post as $item): ?>
			<a href="<?php echo ASSET . 'blog/' . $item['postUrl'] ?>"><p><?php echo $item['postTitle'] ?></p></a>
	<?php endforeach; ?>
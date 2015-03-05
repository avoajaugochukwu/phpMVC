



<div class="home-jumbotron">
	<div class="home-jumbotron-inner">
		<h1>Nigerian web developer</h1>
		<h2>By Avoaja Ugochukwu</h2>
	</div>
</div>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
				<?php foreach ($post as $item): ?>
					<div class="blog-post-thumbnail">
						<a href="<?php echo ASSET . 'blog/' . $item['postUrl'] ?>"><h3><?php echo $item['postTitle'] ?></h3></a>
						<span><?php echo 'By ' . $item['postAuthor']; ?></span>
						<p><?php echo $item['postContent']; ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>


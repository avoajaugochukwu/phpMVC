<div class="container">
	<div class="row">
	<h1 class="page-header"><?php echo $heading ?></h1>
		<a class="btn btn-primary" href="<?php echo ASSET . 'admin/post/create' ?>">Add post</a>
		<table class="table table-striped table-bordered table-hover">
			<tr>
				<th>Post</th>
				<th></th>
				<th>Action</th>
			</tr>
			<?php foreach ($posts as $post): ?>
			<tr>
				<td>
					<p><?php echo $post['post_title'] ?></p>
				</td>
				<td>
					<span>By <span style="color:#0b4;">
					<?php echo $post['post_author'] . ' in '?>
				</span><?php echo $post['post_category'] ?></span>
				</td>
				<td>
					<p>
					
					<form class="" method="POST" action="<?= ASSET ?>admin/post/delete/<?php echo $post['post_id']; ?>">
						<a href="<?php echo ASSET . 'admin/post/edit/' . $post['post_id'] ?>" 
						class="btn btn-lg btn-default">
						Edit
					</a>
						<input type="submit" name="action" class="btn btn-lg btn-danger" value="Delete">
					</form>
					</p>
					
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>



<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<br><br>
			<form method="POST" class="form-horizontal">
				<a href="<?php echo ASSET . 'admin/' ?>post/create/" class="btn btn-lg btn-primary">Add Post</a>
				<input type="submit" class="btn btn-danger" name="action" value="Logout">
			</form>
		</div>
	</div>
</div>
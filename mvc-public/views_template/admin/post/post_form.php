		<!-- Scripts for post editor added as required -->
		<script type="text/javascript" src="<?php echo ASSET; ?>mvc-public/asset/js/ckeditor1/ckeditor.js"></script>    
		<style type="text/css">select, .select {display: inline;}.btn-primary{line-height: 40px;}</style>
		<script type="text/javascript">window.onload = function() {CKEDITOR.replace('editor1');}</script>
<div class="container">
	<div class="row">
		<h1 class="page-header"><?php echo $heading ?></h1>
		<form action="<?= ASSET ?>admin/post/<?php echo $action ?>" method="POST" class="form-vertical col-lg-10 col-lg-offset-1 well">

			<label><h2>Title</h2></label>
					<input type="text" name="title" value="<?php echo $post_title ?>" class="form-control">
					<label>Keyword; in commas</label>
					<input type="text" name="keyword" value="<?php echo $post_keyword ?>" class="form-control">
					<label>Description</label>
					<input type="text" name="description" value="<?php echo $post_description ?>" class="form-control">
			<label><h2>Post</h2></label>
				<textarea class="ckeditor1" name="editor1" class="form-control"><?php echo $post_content ?></textarea>
				<script type="text/javascript">
					CKEDITOR.replace('editor1');
				</script>


			<div class="col-lg-10">
				<br>
				<!-- AUTHOR -->
				<select class="select btn" <?php if($action == 'update'){echo 'disabled';} ?> name="author">
					<option value="">
						<?php if (isset($post_author)) {
								echo $post_author;
							}
							else {
								echo 'Choose Author';
								} ?>
					</option>
					<?php foreach ($authors as $author): ?>
					<option value="<?php echo $author['author_id'] ?>"><?php echo $author['name']; ?></option>
				<?php endforeach; ?>
				</select>
			<!-- END AUTHOR -->



				<!-- CATEGORY -->
				<select class="select btn" name="category">
					<option value="">
						<?php if (empty($post_category) || $post_category == '') {
								echo 'Choose Category';
							}
							else {
								echo $post_category;
								} ?>
					</option>
					<?php foreach ($categories as $category): ?>
					<option value="<?php echo $category['category_id'] ?>"
					<?php if ($category['category'] == $post_category) {
						echo ' selected';
						} ?>
					><?php echo $category['category'] ?></option>
					<?php endforeach; ?>
				</select>
			<!-- END CATEGORY -->
			</div>


			<input type="hidden" name="post_id" value="<?php echo $post_id ?>">

			<br><br>
			<input type="submit" name="action" value="<?php echo $action ?>" class="btn btn-success btn-lg form-control">
		</form>
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
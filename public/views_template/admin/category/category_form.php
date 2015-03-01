<h1><?php echo $heading; ?></h1>

<form class="col-lg-4 col-lg-offset-4 well" method="POST" action="<?= ASSET ?>admin/category/<?php echo $action ?>">
	<input type="hidden" name="categoryID" value="<?php echo $categoryID ?>">
	<input type="text" name="category" class="form-control" value="<?php echo $category; ?>"><br><br>
	<input type="submit" name="action" class="btn btn-block btn-success" value="<?php echo $heading ?>">
</form>
		</div>
	</div>
	<div class="container">
		<div class="row">

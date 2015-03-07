<div class="container">
	<div class="row">
		<h1 class="page-header"><?php echo $heading ?></h1>

		<form class="col-lg-4 col-lg-offset-4 well" method="POST" action="<?= ASSET ?>admin/category/<?php echo $action ?>">
			<input type="hidden" name="categoryID" value="<?php echo $categoryID ?>">
			<input type="text" name="category" class="form-control" value="<?php echo $category; ?>"><br><br>
			<input type="submit" name="action" class="btn btn-block btn-success" value="<?php echo $heading ?>">
		</form>

	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<br><br>
			<form method="POST" class="form-horizontal">
				<a href="<?php echo ASSET . 'admin/' ?>category/create/" class="btn btn-lg btn-primary">Add Category</a>
				<input type="submit" class="btn btn-danger" name="action" value="Logout">
			</form>
		</div>
	</div>
</div>
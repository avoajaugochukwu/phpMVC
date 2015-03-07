

<div class="container">
	<div class="row">
		<h1 class="page-header"><?php echo $heading ?></h1>
		<div class="col-lg-6 col-lg-offset-3">
			<table class="table table-striped table-bordered table-hover">
				<?php foreach ($category as $item): ?>
				<tr>
					<td class="items">
						<p><?php echo $item['category'] ?></p>
					</td>
					<td>

							<a href="<?php echo ASSET . 'admin/category/edit/' . $item['categoryID'] ?>" 
								class="btn btn-lg btn-default col-lg-offset3">
								Edit
							</a>
							<form class="col-lg-4 col-lg-offset-4" method="POST" action="<?= ASSET ?>admin/category/delete/<?php echo $item['categoryID']; ?>">
								<input type="submit" name="action" class="btn btn-lg btn-danger" value="Delete">
							</form>
						
					</td>
				<?php endforeach; ?>
				</tr>
			</table>
		</div>
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
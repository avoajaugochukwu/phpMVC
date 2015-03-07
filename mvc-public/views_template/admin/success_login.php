<h1>
	
	If you got to this point it means you successfully logged in
</h1>



<form method="POST">
<input type="submit" class="btn btn-danger" name="action" value="Logout">
</form>



	<?php foreach ($data as $item): ?>
		<a href="<?php echo ASSET . 'admin/category/edit/' . $item['categoryID'] ?>"><p><?php echo $item['category'] ?></p></a>
	<?php endforeach; ?>
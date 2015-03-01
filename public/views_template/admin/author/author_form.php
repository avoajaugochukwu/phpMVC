<h1><?php echo $heading; ?></h1>

<form class="col-lg-4 col-lg-offset-4 well" method="POST" action="<?= ASSET ?>admin/author/<?php echo $action ?>">
	<input type="hidden" name="memberID" value="<?php echo $memberID ?>">
	Username
	<input type="text" name="username" class="form-control" value="<?php echo $username; ?>"><br><br>
	Email
	<input type="text" name="email" class="form-control" value="<?php echo $email; ?>"><br><br>
	Password
	<input type="text" name="password" class="form-control" value="<?php echo $password; ?>">
	<input type="submit" name="action" class="btn btn-block btn-success" value="<?php echo $heading ?>">
</form>
		</div>
	</div>
	<div class="container">
		<div class="row">

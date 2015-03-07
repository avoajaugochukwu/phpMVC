<div class="container">
	<div class="row">
		<h1 class="page-header"><?php echo $heading ?></h1>

		<form class="col-lg-4 col-lg-offset-4 well" method="POST" action="<?= ASSET ?>admin/author/<?php echo $action ?>">
			<input type="hidden" name="memberID" value="<?php echo $memberID ?>">
			Username
			<input type="text" name="username" class="form-control" value="<?php echo $username; ?>"><br><br>
			Email
			<input type="text" name="email" class="form-control" value="<?php echo $email; ?>"><br><br>
			Password
			<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
			<br>
			<input type="submit" name="action" class="btn btn-block btn-success" value="<?php echo $heading ?>">
		</form>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<br><br>
			<form method="POST" class="form-horizontal">
				<a href="<?php echo ASSET . 'admin/' ?>author/create/" class="btn btn-lg btn-primary">Add Author</a>
				<input type="submit" class="btn btn-danger" name="action" value="Logout">
			</form>
		</div>
	</div>
</div>
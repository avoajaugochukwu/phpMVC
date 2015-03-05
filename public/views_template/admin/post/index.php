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
									<a href="<?php echo ASSET . 'admin/post/edit/' . $post['post_id'] ?>" 
										class="btn btn-lg btn-default">
										Edit
									</a>
									<form class="col-lg-4 col-lg-offset-4" method="POST" action="<?= ASSET ?>admin/post/delete/<?php echo $post['post_id']; ?>">
										<input type="submit" name="action" class="btn btn-lg btn-danger" value="Delete">
									</form>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
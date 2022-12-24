<article>
	<div class="full-post">
		<?php if ($post['published'] != true): ?>
			<h2 class="post-title">this post doesnt exist</h2>
		<?php else: ?>
			<h2 class="post-title"><?php echo $post['title'] ?></h2>
			<div class="post-body">
				<?php echo html_entity_decode($post['body']) ?>
			</div>
		<?php endif ?>
	</div>
</article>


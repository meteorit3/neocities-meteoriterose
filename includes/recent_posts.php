<h2 class="content-title">RECENT POSTS</h2>
<?php
$post_ids = getRecentPosts(10);
foreach($post_ids as $id):
	$post = getPost($id);
	displayPostInfo($post);
endforeach; ?>
<hr>


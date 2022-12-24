<?php 
$tagged_posts = getTaggedPosts($tag,10);
?>
<?php 
foreach($tagged_posts as $id): 
	$post = getPost($id);
	displayPostInfo($post);
endforeach; ?>



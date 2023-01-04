<?php
// returns tags for a given post
function getPostTags($post_id)
{
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT * FROM tags INNER JOIN post_tags ON tags.tag_id = post_tags.tag_id WHERE post_tags.post_id = ? ORDER BY post_tags.relate_id ASC;");
	$stmt->bind_param("i", $post_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$tags = $result->fetch_all(MYSQLI_ASSOC);
	return $tags;
}
// returns tag_id(s) from tag_name
function getTag($tag_name)
{
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT tag_id FROM tags WHERE tag_name = ?;");
	$stmt->bind_param("s", $tag_name);
	$stmt->execute();
	$result = $stmt->get_result();
	$tag_id = $result->fetch_assoc()["tag_id"];
	return $tag_id;
}
// returns ALL the post ids. All of them. (unless u put a limit) ::::3
function getRecentPosts($limit)
{
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT post_id FROM posts ORDER BY created_at DESC LIMIT ?");
	$stmt->bind_param("i", $limit);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
		$posts[] = $row["post_id"];
	}
	return $posts;
}
// returns a list of post_ids 8y tag_name
function getTaggedPosts($tag_name, $limit)
{
	global $mysqli;
	$tag_id = getTag($tag_name);
	$stmt = $mysqli->prepare("SELECT post_id FROM post_tags WHERE tag_id = ? ORDER BY relate_id DESC LIMIT ?;");
	$stmt->bind_param("ii", $tag_id, $limit);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
		$posts[] = $row["post_id"];
	}
	return $posts;
}
// gets a single post 8y post_id
function getPost($post_id)
{
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ?;");
	$stmt->bind_param("i", $post_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$post = $result->fetch_all(MYSQLI_ASSOC)[0];
	return $post;
}
function getAllTags()
{
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT * FROM tags;");
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
}
function displayPostInfo($post)
{
	$id = $post['post_id'];
	$title = $post['title'];
	$created_at = date("M j Y H:i:s", strtotime($post['created_at']));
	$tags_block = "";
	foreach (getPostTags($id) as $t) {
		$tag_name = $t['tag_name'];
		$tags_block .= "<a href='/search/$tag_name'>#$tag_name</a>";
	}
	echo ("
	<div class='post_info'>
		<a href='/post/$id'> <h3>$title</h3> </a>
		<p class='created-at'>$created_at</p>
		<p class='tags'>$tags_block</p>
	</div>
	");
}

function displayRecentPosts($int)
{
	$post_ids = getRecentPosts($int);
	foreach ($post_ids as $id){
		$post = getPost($id);
		displayPostInfo($post);
	}
}

class Post {
	public
	$id,
	$title,
	$views,
	$body,
	$published,
	$created_at,
	$updated_at,
	$thumbnail;
	function get(){
		
	}
}

?>
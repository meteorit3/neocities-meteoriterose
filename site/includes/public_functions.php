<?php
// returns tags for a given post
function getPostTags($post_id) {
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT * FROM tags INNER JOIN post_tags ON tags.tag_id = post_tags.tag_id WHERE post_tags.post_id = ? ORDER BY post_tags.relate_id ASC;");
	$stmt->bind_param("i", $post_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$tags = $result->fetch_all(MYSQLI_ASSOC);
	return $tags;
}
// returns tag_id(s) from tag_name
function getTag($tag_name) {
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT tag_id FROM tags WHERE tag_name = ?;");
	$stmt->bind_param("s", $tag_name);
	$stmt->execute();
	$result = $stmt->get_result();
	$tag_id = $result->fetch_assoc()["tag_id"];
	return $tag_id;
}
// returns ALL the post ids. All of them. (unless u put a limit) ::::3
function getRecentPosts($limit) {
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT post_id FROM posts ORDER BY created_at DESC LIMIT ?");
	$stmt->bind_param("i", $limit);
	$stmt->execute();
	$result = $stmt->get_result();
	while($row = $result->fetch_assoc()) {
		$posts[] = $row["post_id"];
	}
	return $posts;
}
// returns a list of post_ids 8y tag_name
function getTaggedPosts($tag_name, $limit) {
	global $mysqli;
	$tag_id = getTag($tag_name);
	$stmt = $mysqli->prepare("SELECT post_id FROM post_tags WHERE tag_id = ? ORDER BY relate_id DESC LIMIT ?;");
	$stmt->bind_param("ii", $tag_id, $limit);
	$stmt->execute();
	$result = $stmt->get_result();
	while($row = $result->fetch_assoc()) {
		$posts[] = $row["post_id"];
	}
	return $posts;
}
// gets a single post 8y post_id
function getPost($post_id){
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ?;");
	$stmt->bind_param("i", $post_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$post = $result->fetch_all(MYSQLI_ASSOC)[0];
	return $post;
}
function getAllTags(){
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT * FROM tags;");
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
}
?>

<?php
function displayPostInfo($post){ ?>
	<div class="post-title">
		<div class="post_info">
			<a href="<?php echo("/post/".$post['post_id']); ?>">
				<h3><?php echo $post['title']; ?></h3>
			</a>
			<span class="created-at">
				<?php echo date("M j Y H:i:s", strtotime($post['created_at'])); ?>
			</span><br>
				<span class="tags">
				<?php foreach(getPostTags($post['post_id']) as $t): ?>
				<a href="<?php echo("/search/".$t['tag_name'])?>">
						@<?php echo $t['tag_name'] ?>
					</a>
				<?php endforeach ?>
			</span>
		</div>
	</div>
<?php } ?>

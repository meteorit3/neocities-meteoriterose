<?php
function render(string $filepath, array $vars = [])
{
	$output = NULL;
	if (file_exists($filepath)) {
		extract($vars);
		ob_start();
		include($filepath);
		$output = ob_get_clean();
	}
	return $output;
}
function query($statement, $types, $params)
{
	global $mysqli;
	$stmt = new mysqli_stmt($mysqli, $statement);
	if ($types != "") {
		$stmt->bind_param($types, ...$params);
	}
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
}

class Post
{
	public
	$post_id,
	$title,
	$views,
	$body,
	$published,
	$created_at,
	$updated_at,
	$thumbnail,
	$tags;

	function __construct(array $post = [], array $tags = [])
	{
		$this->populate($post, $tags);
	}
	function populate(array $post = [], array $tags = [])
	{
		foreach (get_class_vars(get_class($this)) as $name => $value) {
			if (array_key_exists($name, $post)) {
				$this->$name = $post[$name];
			}
		}
		if ($tags != []) {
			$this->tags = $tags;
		}
	}
	function get_post()
	{
		$post = query("
		SELECT * FROM posts 
		WHERE post_id = ?;",
					"i",
					[$this->post_id]
				)
			->fetch_all(MYSQLI_ASSOC)[0];
		$this->populate($post, []);
	}
	function get_tags()
	{
		$result = query("
		SELECT tags.tag_name FROM tags 
		INNER JOIN post_tags ON tags.tag_id = 
		post_tags.tag_id WHERE post_tags.post_id = ? 
		ORDER BY post_tags.relate_id ASC;",
					"i",
					[$this->post_id]
				)
			->fetch_all(MYSQLI_ASSOC);
		for ($i = 0; $i < count($result); $i++) {
			$tags[$i] = $result[$i]['tag_name'];
		}
		$this->populate([], $tags);
	}
	function get()
	{
		$this->get_post();
		$this->get_tags();
	}
	function display_info()
	{
		$creationtime = date("M j Y H:i:s", strtotime($this->created_at));
		$tagsblock = "";
		foreach ($this->tags as $t) {
			$name = $t;
			$tagsblock .= "<a href='/search/$name'>#$name </a>";
		}
		return
			"<div class='post-info'>
			<h3><a href='/post/$this->post_id'>$this->title</a></h3>
			<p class='created-at'>$creationtime</p>
			<p class='tags'>$tagsblock</p>
		 </div>";
	}

	function upload()
	{
		// first upload the post. then create any necessary tags. 
		// then create links between the post and all relevant tags
		$querytags = query("SELECT * FROM TAGS", "", []);
		$extanttags = [];
		for ($i = 0; $i < $querytags->num_rows; $i++) {
			$extanttags[] = $querytags->fetch_row()[0];
		}
		$newtags = array_diff($this->tags, $extanttags);
		foreach ($newtags as $t) {
			query("INSERT INTO tags (tag_name) VALUES (?)", "s", [$t]);
			query("INSERT INTO post_tags (post_id, tag_id) VALUES (?, (SELECT tag_id FROM tags WHERE tag_name = ?))", "is", [$this->post_id, $t]);
		}
	}
}

class Posts
{
	public $list;

	function append(array $posts_array)
	{
		foreach ($posts_array as $p) {
			$post = new Post;
			$post->populate($p);
			$post->get_tags();
			$this->list[] = $post;
		}
	}
	function recent(int $limit)
	{
		$this->append(
				query("
		SELECT * FROM posts 
		ORDER BY created_at 
		DESC LIMIT ?",
					"i",
					[$limit]
				)
				->fetch_all(MYSQLI_ASSOC)
		);
	}
	function filter(string $tag_name)
	{
		$this->append(
				query("
		SELECT * FROM posts 
		INNER JOIN post_tags ON posts.post_id = 
		post_tags.post_id WHERE post_tags.tag_id = 
		(SELECT tag_id FROM tags WHERE tag_name = ?) 
		ORDER BY posts.created_at DESC",
					"s",
					[$tag_name]
				)
				->fetch_all(MYSQLI_ASSOC)
		);
	}
	function display_infos()
	{
		$output = "";
		foreach ($this->list as $post) {
			$output .= $post->display_info();
		}
		return $output;
	}
}

?>
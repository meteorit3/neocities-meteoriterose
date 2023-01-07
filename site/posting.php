<?php
require_once('config.php');
require_once('includes/public_functions.php');

$post = new Post;

var_dump($argc);
var_dump($argv);
/* 	
argv[1]: Title
argv[2]: Tags (seper8ed 8y Commas)
argv[3]: Image Paths (seper8ed 8y Commas, or none)
argv[4]: Thum8nail Path (or none)
argv[5]: 8ody Path
argv[6]: Pu8lished (0 or 1)
*/

// this way is uglier 8ut pro8s slightly Faster  idk
$post->title = $argv[1];
$post->body = file_get_contents($argv[5]);
$post->tags = explode(",", $argv[2]);
$post->published = (int) $argv[6];
if ($argv[4] != "none") {
	$post->thumbnail = $argv[4];
}

// find which tags r new and which already exist in data8ase
$query = query("SELECT tag_name FROM tags", "", []);
$extanttags = [];
for ($i = 0; $i < $query->num_rows; $i++) {
	$extanttags[] = $query->fetch_row()[0];
}
$newtags = array_diff($post->tags, $extanttags);

// insert new tags into data8ase
foreach ($newtags as $t) {
	query("INSERT INTO tags (tag_name) VALUES (?);", "s", [$t]);
}

//insert post into data8ase
query(
	"INSERT INTO posts (title, body, published, thumbnail) VALUES (?, ?, ?, ?);",
	"ssis",
	[
		$post->title,
		$post->body,
		$post->published,
		$post->thumbnail,
	]
);
//get the new post_id
$id = query("SELECT post_id FROM posts ORDER BY created_at DESC;", "", [])
	->fetch_row()[0];
echo $id;

//insert relations into post_tags
foreach ($post->tags as $tag_name) {
	query("INSERT INTO post_tags (post_id, tag_id) 
	VALUES (?, (SELECT tag_id FROM tags WHERE tag_name = ?))",
		"is",
		[$id, $tag_name]
	);
}
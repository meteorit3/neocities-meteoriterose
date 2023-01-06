<?php
require_once('config.php');
require_once('includes/public_functions.php');

$post = new Post;

$post->tags = ['BLUE', 'Vrixy', 'PHP', 'TRANS GENDER'];

$query = query("SELECT tag_name FROM tags", "", []);
$extanttags = [];
for ($i = 0; $i < $query->num_rows; $i++) {
	$extanttags[] = $query->fetch_row()[0];
}
$newtags = array_diff($post->tags, $extanttags);

foreach($newtags as $t) {
	query("INSERT INTO tags (tag_name) VALUES (?)", "s", [$t]);
}

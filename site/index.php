<?php
declare(strict_types=1);
require_once('config.php');
require_once('includes/public_functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<?php
if (isset($_SERVER['REQUEST_URI'])) {
	$host = $_SERVER['HTTP_HOST'];

	$path = ltrim($_SERVER['REQUEST_URI'], '/'); // Trim leading slash(es)
	$elements = explode('/', $path); // Split path on slashes
	if (empty($elements[0])) { // No path elements means home
		$title = "welcome 2 MeteoriteRose";
		$body = render("includes/home.php");
	} else
		switch (array_shift($elements)) // Pop off first item and switch
		{
			case 'art':
			case 'linkspam':
			case 'projects':
				$title = "well put something here eventually :3";
				$body = render("includes/content.php", ['title' => $title, 'content' => ""]);
				break;
			case 'search':
				$tag = urldecode(array_shift($elements));
				$filtered = new Posts;
				$filtered->filter($tag);
				$title = "Posts Tagged #" . $tag;
				$body = render("includes/content.php", ['title' => $title, 'content' => $filtered->display_infos()]);
				break;
			case 'post':
				$id = array_shift($elements);
				$post = new Post(["post_id" => $id]);
				$post->get();
				$title = $post->title;
				$body = render("includes/content.php", ['title' => $title, 'content' => $post->body]);
				break;
			case 'recent':
				$title = "Recent Blog Posts";
				$recent = new Posts;
				$recent->recent(15);
				$body = render("includes/content.php", ['title' => $title, 'content' => $recent->display_infos()]);
				break;
			case 'five-dollar-webring':
				$title = "Five Dollar Webring";
				$index = "
						<div id='index'>
						<script type=\"text/javascript\" src=\"scriptURL/onionring-variables.js\"></script>
						<script type=\"text/javascript\" src=\"scriptURL/onionring-index.js\"></script>
						</div>";
				$body = render("includes/content.php", ['title' => $title, 'content' => $index]);
			default:
				header('404 not found');
		}

	include('includes/head.php');
	echo ($body);
}
?>

</html>
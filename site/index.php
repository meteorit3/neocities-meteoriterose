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
	$title = "UNDER CONSTRUCTION!!!! this shit is 8orken as fuck !!!";

	$path = ltrim($_SERVER['REQUEST_URI'], '/'); // Trim leading slash(es)
	$elements = explode('/', $path); // Split path on slashes
	if (empty($elements[0])) { // No path elements means home
		$body = render("includes/home.php");
	} else
		switch (array_shift($elements)) // Pop off first item and switch
		{
			case 'art' or 'linkspam' or 'projects':
				$title = "well put something here eventually :3";
				$body = render("includes/content.php", ['title' => $title, 'content' => ""]);
				break;
			case 'search':
				$tag = urldecode(array_shift($elements));
				$title = "Posts Tagged #" . $tag;
				$filtered = new Posts;
				$filtered->filter($tag);
				$content = $filtered->display_infos();
				$body = render("includes/content.php", ['title' => $title, 'content' => $content]);
				break;
			case 'post':
				$id = array_shift($elements);
				$post = new Post(["post_id" => $id]);
				$post->get();
				$content = $post->body;
				$content .= "";
				$body = render("includes/content.php", ['title' => $post->title, 'content' => $post->body]);
				break;
			case 'recent':
				$title = "Recent Blog Posts";
				$recent = new Posts;
				$recent->recent(15);
				$content = $recent->display_infos();
				$body = render("includes/content.php", ['title' => $title, 'content' => $content]);
			default:
				header('404 not found');
		}

	include('includes/head.php');
	echo ($body);
}
?>

</html>
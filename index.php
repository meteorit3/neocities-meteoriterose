<?php
require_once('config.php');
require_once('includes/public_functions.php'); 
?>

<!DOCTYPE html>
<html>

<?php
if (isset($_SERVER['REQUEST_URI'])){
	$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
	$elements = explode('/', $path);                // Split path on slashes
	if(empty($elements[0])) {                       // No path elements means home
		$title = "UNDER CONSTRUCTION";
		$content = "includes/recent_posts.php";
	} else switch(array_shift($elements))             // Pop off first item and switch
	{
case 'art':
	$title = "COOL ART :]";
	$content = "includes/filtered_posts.php";
	$tag = "art";
	break;
case 'search':
	$tag = array_shift($elements);
	$title = "search for".$tag;
	$content = "includes/filtered_posts.php";
	break;
case 'post':
	$id = array_shift($elements);
	$post = getPost($id);
	$content = "includes/single_post.php";
default:
	header('404 not found');
	}
	include('includes/head.php');
	include('includes/body.php');

}
?>
</html>

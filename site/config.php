<?php
session_start();

//CONNECT TO DATABASE
$mysqli = new mysqli("localhost", "http", "", "blog");
if (!$mysqli) {
	die("ERROR CONNECTING TO DATABASE. ".mysqli_connect_error());
}

//DEFINE GLOBAL CONSTANTS
define ('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'http://localhost/blog');
?>

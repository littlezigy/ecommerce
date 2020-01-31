<?php
require __DIR__ . "/views/main.view.php";
require __DIR__ . "/views/pages.view.php";

include_once("./includes/header.php");

$url = (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : "/";
//$urlarray =  (isset($_SERVER['PATH_INFO'])) ? explode('/', $_SERVER['PATH_INFO']) : '/';
$page = new Page();

if($url === '/') {
	$page->home();
} else {
	if($url === '/login') {
		if(isset($_SESSION['user'])) {
			var_dump(xdebug_get_declared_vars());
			echo "Welcome " . $_SESSION['user'];
			echo "<script>window.location.replace('/')</script>";

			exit();
		}

		$page->login();
	} else if ($url == '/dashboard') {
		require __dir__ . "/controllers/login.php";
		$logincontroller = new Login();
	} else if($url === '/dashboard/orders') {
		echo "<!-- User orders -->";
		$page->user_orders('buyer_orders');
	}
	else {
		$page->regular('notFound');
	}
}
?>

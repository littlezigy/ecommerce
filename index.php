<?php
require __DIR__ . "/views/main.view.php";
require __DIR__ . "/views/pages.view.php";
require __DIR__ . "/models/main.model.php";
require __DIR__ . "/models/env.php";
require __DIR__ . "/models/api.php";
require __DIR__ . "/models/curl.php";

require __DIR__ . "/models/productlist.model.php";

include_once("./includes/header.php");

$url = (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : "/";
//$urlarray =  (isset($_SERVER['PATH_INFO'])) ? explode('/', $_SERVER['PATH_INFO']) : '/';
$page = new Page();

if($url === '/') {
	require __DIR__ . "/controllers/home.controller.php";
	$curl = new Curl();
	$api = new API($curl);
	$productlist = new ProductList($api, 3);
	$homecontroller = new HomeController();
	$homecontroller->loadHomePage($productlist);
	$page->home($productlist);
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
	} else if ($url === '/products') {
		$curl = new Curl();
		$api = new API($curl);
		$products = new ProductList($api);
		$page->products($products);
	}
	else {
		$page->regular('notFound');
	}
}
?>

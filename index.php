<?php
 include_once("./includes/header.php");
 $url = 'http://localhost:3001/api/v1/products?sort=bestof&limit=3';
 $response = file_get_contents($url);
 $products = json_decode($response);
 ?>
<header class = 'font1 text-white text-center'>
	<nav class = 'text-white bold'>
		<a><img class = 'logo' src = './images/43643.png'></a>
		<div>
			<li><a>Login</a></li>
			<li><a>Cart</a></li>
		</div>
	</nav>
	<div>
		<div id = 'headertext' class = 'font4'>
			<p id = 'headertitle'>ColorStores</p>
			<p class = 'medium'>Like it? Get it</p>
		</div>
	</div>
</header>
<section>
	<!----Blurb section-->
</section>

<section id = 'showcase' class = 'p6'>
	<p class = 'biggest text-center'>Best Performing Items</p>
	<div class = 'products'>
	<?php
		 foreach($products as $product) {
		   echo "<div class = 'card product'>";
		   echo "<img class = 'product'/>";
		   echo "<p class = 'text-right price'>N ". $product->price . "</p>";
		   echo "<p class = 'text-center text-2'>" . $product->name . "</p>";
		   if($product->brand) echo "<p class = 'brand small text-right'> by " . $product->brand . "</p>";
		   else echo "<br />";
		   echo "<p class = 'description'>";
		   if($product->desc) echo $product->desc . "</p>";
		   else echo "This is a great product judging by the fact that it is in this category</p>";
		   echo "<p class = 'stock'>Quantity in stock " . $product->instock . "</p>";
		   echo "</div>";
		 }

	?>
	</div>
</section>

<?php
include_once("./includes/footer.php");
?>

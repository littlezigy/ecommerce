<?php
	include_once("./includes/header.php");
	$url = 'http://localhost:3001/api/v1/products?sort=bestof&limit=3';
	$response = file_get_contents($url);
	$products = json_decode($response);
	if(isset($_SESSION['user'])) { 
		$ch = curl_init('http://localhost:3001/api/v1/user/personalize');
		$headers = [];
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_COOKIE, $_SESSION['cookies']);
		curl_setopt($ch, CURLOPT_HEADERFUNCTION, 
						function($curl, $header) use (&$headers) {
							$len = strlen($header);
							$header = explode(':', $header, 2);
							if(count($header)<2) {
								return $len;}
							$headers[strtolower(trim($header[0]))][] = trim($header[1]);
							return $len;
						});

		$personalized  = curl_exec($ch); 
		curl_close($ch);
		
		$personalized = json_decode($personalized);
		if(!isset($personalized->success)) {
			$_SESSION = array();
			session_destroy();
		}
		$bestproducts = $personalized->data->best;
	}
?>
<header class = 'font1 text-white text-center'>
	<nav class = 'text-white bold'>
		<a><img class = 'logo' src = './images/43643.png'></a>
		<div>
			<?php 
				if(isset($_SESSION['user'])) echo "Welcome ".$_SESSION['user'];
				else echo "<li><a href = 'pages/login.php'>Login</a></li>";
			?>
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
<section class = 'p6'>
	<p class = 'biggest text-center'>See Items from your favorite categories</p>
	<div class = 'products carousel'>
	<?php foreach($bestproducts as $product) {
	?>
		<div class = 'card product'>
			<img class = 'product' />
			<p class = 'text-right price'>N <?= $product->productprice ?></p>
			<p class = 'text-center text-2'><?= $product->productname ?></p>
			<?php if($product->productbrand) echo "<p class = 'brand small text-right'> by " . $product->productbrand . "</p>";
		   else echo "<br />";
		   echo "<p class = 'description text-justify'>";
		   if($product->productsdesc) echo $product->productsdesc . "</p>";
		   else echo "This is a great product judging by the fact that it is in this category</p>";
		   echo "<p class = 'stock'>Quantity in stock " . $product->productstock . "</p>";
		   echo "</div>";
	}?>
	</div>
	<button class = 'carousel-button'> > </button>
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
		   echo "<p class = 'description text-justify'>";
		   if($product->shortdesc_) echo $product->shortdesc_ . "</p>";
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

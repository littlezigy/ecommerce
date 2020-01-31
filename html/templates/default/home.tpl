<!--Home template -->
<header class = 'font1 text-white text-center'>
	<nav class = 'text-white bold'>
		<a><img class = 'logo' src = './images/43643.png'></a>
		<div>
			<?php 
				if(isset($_SESSION['user'])) echo "Welcome ".$_SESSION['user'];
				else echo "<li><a href = 'login'>Login</a></li>";
			?>
			<li><a href = 'cart'>Cart</a></li>
		</div>
	</nav>
	<div>
		<div id = 'headertext' class = 'font2'>
			<p id = 'headertitle'>ColorStores</p>
			<p class = 'medium'>Like it? Get it</p>
		</div>
	</div>
</header>

<section id = 'showcase'>
	<p class = 'biggest text-center'>Best Performing Items</p>
	<div class = 'products'>
		<?php foreach($bestproducts as $product) { ?>
			<div class = 'products carousel'>
				<div class = 'card product'>
					<img class = 'product' />
					<p class = 'text-right price'>N <?= $product['price'] ?></p>
					<p class = 'text-center text-2'><?= $product['productname'] ?></p>
					<p class = 'brand small text-right'> by <?=$product['brand']?></p>
					<p class = 'description text-justify'>
						<?=$product['shortdesc_']?> 	
					</p>
				   <p class = 'stock'>Quantity in stock <?=$product['qty_available']?></p>
				</div>
			</div>
			<button class = 'carousel-button'> </button>
		<?php }?>
	</div>
	</section>

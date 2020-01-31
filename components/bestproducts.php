<?php 
	if(isset($_SESSION['user'])) { 
		echo "<section>";
		foreach($bestproducts as $product) { ?>
			<p class = 'biggest text-center'>See Items from your favorite categories</p>
			<div class = 'products carousel'>
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
				echo "</div>";
				echo "<button class = 'carousel-button'> > </button>";
				echo "</section>";
		}
	}
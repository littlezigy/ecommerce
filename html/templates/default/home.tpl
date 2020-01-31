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
	
	</div>
	</section>

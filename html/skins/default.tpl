<body class = 'font1'>
    <?php if(!isset($no_navbar)) {?>

        <nav class = 'blue text-white'>
            <a href = '/'><img class = 'logo' src = '/images/logo.png'></a>
            <div>
                <li><a href = 'login'>Login</a></li>
                <li><a href = 'cart'>Cart</a></li>
            </div>
        </nav>
    <?php }?>

<div id = 'page'>
    <?=$page_contents?>
</div>

<footer class = 'text-center'>
	<p>My Account</p>
	<p><a>View Cart</a></p>
	<p>Hi there. ColorStore is a demo ecommerce webapp.</p>
	
	<p><a>Admin Panel</a></p>
	<script src = "/scripts/main.js"></script>
</footer>
</body>
</html>

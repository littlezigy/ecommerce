<div id = 'loginpage'>  
    <div id = 'login'>
		<div></div>
		<div class = 'circularcutout darkpurple'></div>
        <form class = 'bordezr1' action = "../controllers/login.php" method = 'post' id = 'login'>
			<p class = 'title-1 text-darkpurple'>Login</p>
			<br /><br />
            <input type = 'email' placeholder = 'Email Address' name = 'email' class = 'darkpurple-border'>
		    <label for = 'email' class = 'bold small'>Email Address</label>
            <input type = 'password' id = 'password'  name = 'password' class = 'darkpurple-border' placeholder = 'Enter password'>
		    <label for ='password' class = 'bold small'>Password</label>
	    	<input class = 'darkpurple text-white' type = 'submit' name = 'login' value = 'Login'>
		    <p class = 'small'>Don't have an account? <a onclick = 'document.querySelector("form#login").style.display="none";
											document.querySelector("form#signup").style.display="block";'>Create one</a></p>
        </form>

		<form class = 'border1' action = "../controllers/login.php" method = 'post' id = 'signup' style='display:none;'>
			<p class = 'title-1 text-darkpurple'>Sign Up</p>
			<br /><br />
            <input type = 'email' placeholder = 'Email Address' name = 'email' class = 'darkpurple-border'>
		    <label for = 'email' class = 'bold small'>Email Address</label>
            <input type = 'password' id = 'password'  name = 'password' class = 'darkpurple-border' placeholder = "Password">
		    <label for ='password' class = 'bold small'>Password</label>
			<input type = 'password' id = 'c-password'  name = 'c-password' class = 'darkpurple-border' placeholder = 'Confirm Password'>
		    <label for ='c-password' class = 'bold small'>Confirm Password</label>
	    	<input class = 'darkpurple text-white' type = 'submit' name = 'login' value = 'Register'>

			<p class = 'small'>Don't have an account? <a onclick = 'document.querySelector("form#login").style.display="block";
											document.querySelector("form#signup").style.display="none";'>Log in</a></p>
        </form>
    </div>
</div>
<?php
include_once("../includes/header.php");
include_once("../includes/nav.php");

if(isset($_SESSION['user'])) {
	echo "Welcome " . $_SESSION['user'];
	echo "<script>window.location.replace('/')</script>";

	exit();
} else if (isset( $_POST['login'] )) {
	$jsonstr = '{"email": "'.$_POST['email'] . '", "password": "' . $_POST['password']. '"}';
	$headers = [];
	$ch = curl_init('http://localhost:3001/api/v1/auth/login');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonstr);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
								'Content-Type: application/json',
								'Content-Length: '. strlen($jsonstr))
				);
	curl_setopt($ch, CURLOPT_HEADERFUNCTION, 
					function($curl, $header) use (&$headers) {
						$len = strlen($header);
						$header = explode(':', $header, 2);
						if(count($header)<2) {
							return $len;}
						$headers[strtolower(trim($header[0]))][] = trim($header[1]);
						if(count($header) === 2) {
							$headername = strtolower($header[0]);
							if($headername === 'set-cookie') {
								$cookies = $header[1];
								$cookies = explode(";", $cookies);

								foreach($cookies as $index) {
									if(strpos($index, "connect.sid") !== FALSE) {
										$_SESSION['cookies'] = $index;
									}
								}
							}
						}
						return $len;
					});

	$response  = curl_exec($ch); echo "Headers<br />";
	$opts = array('http' => 
				array(
						'method' => 'POST',
						'header' => 'Content-type: application/json',
						'content' => $jsonstr
				)
			);
	$res = json_decode($response);
	if($res->success === true) 	{
		echo "You are logged in!";
		echo "<script>window.location.replace('/')</script>";
		$_SESSION['user'] = $res->data->firstname;
		exit();
	}
}
?>
<div id = 'loginpage'>    
    <div id = 'login'>
		<div></div>
		<div class = 'circularcutout darkpurple'></div>
        <form class = 'border1' action = "#" method = 'post'>
			<p class = 'title-1 text-darkpurple'>Login</p>
			<br /><br />
            <input type = 'email' placeholder = 'Email Address' name = 'email' class = 'darkpurple-border'>
		    <label for = 'email' class = 'bold small'>Email Address</label>
            <input type = 'password' id = 'password'  name = 'password' class = 'darkpurple-border'>
		    <label for ='password' class = 'bold small'>Password</label>
	    	<input class = 'darkpurple text-white' type = 'submit' name = 'login' value = 'Login'>
		    <p class = 'small'>Don't have an account? Create one</p>
        </form>
    </div>
</div>

<?php
include_once("../includes/footer.php");
?>

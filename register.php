<?PHP

error_reporting(1);

$FILENAME = "emails.txt";

// Check to make sure we have the right headers
if (isset($_POST["action"]) && $_POST["action"] == "register") {
	
	// Send success note
	header("Access-Control-Allow-Origin: *");
	header("Content-type: application/json");
	
	$name = explode(' ', $_POST["name"]);
	$email = $_POST["email"];
	
	if (!file_exists($FILENAME)) {
		file_put_contents($FILENAME, json_encode(array()));
	}
	
	$emls = json_decode(file_get_contents($FILENAME));
	
	
	$data;
	if (count($name) > 4) {
		die(json_encode(array(success => false, error => "Too many spaces in name. Please have less than 3 spaces in your name.")));
	}
	
	if (in_array($email, $emls)) {
		die(json_encode(array(success => false, error => "Email already in use! Please try another email or visit <a href='https://www.pley.com/login-forgot-psw'>forgot my password</a>.")));	
	}
	
	array_push($emls, $email);
	file_put_contents($FILENAME, json_encode($emls));
	echo json_encode(array(success => true));
	
} else {
	header('HTTP/1.0 400 Bad Request');
	die();
}

?>
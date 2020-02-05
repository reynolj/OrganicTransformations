<?php

require_once('../variables.php');

if (   !isset($_POST['username'])
	|| !isset($_POST['email'])
	|| !isset($_POST['password'])
	|| !isset($_POST['confirm_password'])
	|| !isset($_POST['phone_number'])
	|| !isset($_POST['birthday'])
	|| !isset($_POST['first_name'])
	|| !isset($_POST['last_name'])
	 ) {
	die("Error: Invalid Parameters");
}


//Sanitize & Validate All Inputs
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone_number = $_POST['phone_number'];
$birthday = $_POST['birthday'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

//Make sure 'username' only includes a-z, A-Z, numbers, and dashes.
if( preg_match("/^[a-zA-Z0-9]*$/u", $username) != 1 ){
	die("Username can only contain letters and numbers.");
}

//Clean email and check if valid
$email = filter_var($email, FILTER_SANITIZE_EMAIL); //Remove illegal characters
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Validate email
	die("Email address is invalid.");
}

//Make sure the password is the correct length
if( !(strlen($password) > 9 && strlen($password) < 50) ){
	die("That password is not long enough.");
}

//Make sure that the password fields match
if( $password != $confirm_password ){
	die("Passwords do not match.");
}

$phone_number


$birthday


//Make sure 'first_name' and 'last_name' only includes a-z, A-Z, and spaces.
if( preg_match("/^[a-zA-Z ]*$/u", $first_name) != 1 ){
	die("First name can only contain letters.");
}
if( preg_match("/^[a-zA-Z ]*$/u", $last_name) != 1 ){
	die("Last name can only contain letters.");
}




try {
	//Create connection
	$con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

	//Check if that USERNAME exists
	$stmt = $con->prepare("SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
	$stmt->execute([$username, $email]);
    if($stmt->fetchColumn()){
    	die("That username or email already exists.");
    }
    
	//Create the user
    $stmt = $con->prepare("INSERT INTO users (username, name, email, password, active, joincode, joindate) VALUES (?, ?, ?, ?, ?, ?, NOW())");
	$success = $stmt->execute([ $username, $name, strtolower($email), $_POST['password'], $active, $_POST['joincode'] ]);
	if(  $success  ){
		die("created");
	}else{
		die("Error: Something went wrong.");
	}

} catch(PDOException $e) {
	die("Failed: Something went wrong..");
	// die( "Failed to add break - " . $e->getMessage());
}








?>
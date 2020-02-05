<?php



if(!isset($_POST['username']) || !isset($_POST['password'])
	// || strlen($_POST['username']) < 5 || strlen($_POST['password']) < 5 
	){
	die("Error: Invalid Parameters");
}

$username = $_POST['username'];
$password = $_POST['password'];





?>
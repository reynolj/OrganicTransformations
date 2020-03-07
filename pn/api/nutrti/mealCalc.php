<?php
require_once("../auth/login_check.php"); //Make sure the user is logged in

session_start(); //Start the session (so you can use the $_SESSION['###'] variable)

require_once("../../variables.php"); //Get the database connection patameters




try {
  //Create connection
  $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

  //Query their information from the database
  $stmt = $con->prepare("SELECT blood_type, body_type, etc, etc FROM users WHERE user_id = ?");
  $stmt->execute([ $_SESSION['user_id'] ]);
  $data = $stmt->fetch();
  if( !$data ){
    die("That user doesn't exist.");
  }

  //Do calculations here
  #  $data['blood_type']
  #  $data['body_type']
  #  $data['target_fat]
  #  $data['current_weight']
  #  $data['sex']
  #  $data['desired_outcome']
  #  $data['current_fat']

  $result = $data['current_weight'] * ($data['target_fat'] / 100) / 2



} catch(PDOException $e) {
  die("Sorry, something went wrong. Try again later.");
  // die( "Failed to add break - " . $e->getMessage());
}

?>
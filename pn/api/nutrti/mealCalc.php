<?php
require_once("../auth/login_check.php"); //Make sure the user is logged in

session_start(); //Start the session (so you can use the $_SESSION['###'] variable)

require_once("../../variables.php"); //Get the database connection patameters




try {
  //Create connection
  $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

  //Query their information from the database
  $stmt = $con->prepare("SELECT blood_type, body_type, activit_lvl, current_fat, target_fat, plan_weight, 
                        sex, desired_outcome, FROM users WHERE user_id = ?");
  $stmt->execute([ $_SESSION['user_id'] ]);
  $data = $stmt->fetch();
  if( !$data ){
    die("That user doesn't exist.");
  }

  //Do calculations here
  $blood_type = $data['blood_type'];
  $body_type = $data['body_type'];
  $target_fat = $data['target_fat'];
  $plan_weight = $data['plan_weight'];
  $sex = $data['sex'];
  $desired_outcome = $data['desired_outcome'];
  $current_fat = $data['current_fat'];
  $activity_lvl = $data['activity_lvl'];

  $protein = 0;
  $starch = 0;
  $veg = 3;
  $fruit = 0;
  $fat = 0;


  if($desired_outcome = "Burn fat/lose weight"){
      $protein = ($plan_weight - ($plan_weight * ($current_fat / 100)))/2;

      if($activity_lvl == "No exercise"){
          $fat = 85;
          $fruit = 20;}
      elseif($activity_lvl == "1-2 days/wk of exercise"){
          $fat = 95;
          $fruit = 25;}
      else{$fat = 105; $fruit =30;}

      if($body_type == "Ectomorph" && $sex == "Male" && $plan_weight < 160){
          $veg = 2;
      }
  }

  $result = ;



} catch(PDOException $e) {
  die("Sorry, something went wrong. Try again later.");
  // die( "Failed to add break - " . $e->getMessage());
}

?>
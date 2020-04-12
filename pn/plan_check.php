<?php
  require("variables.php");
  //session_start();
  try {
    //Create connection
    $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    //Authenticate user
    $stmt = $con->prepare(
      "SELECT p.plan_id, p.plan_name, u.premium_state FROM plans p 
                  LEFT JOIN users as u ON (u.user_id = ?)              
                  WHERE UPPER(p.plan_name) = ?");
    $stmt->execute([ $_SESSION['user_id'], $tier]);
    $data = $stmt->fetch();

    if(!$data){
      die("Something went wrong. Couldn't get plan information");
    }
  } catch(PDOException $e) {
    die("Sorry, something went wrong. Try again later.");
    // die( "Failed to add break - " . $e->getMessage());
  }

  if ( !$_SESSION['is_admin'] && $data['premium_state'] < $data['plan_id'] ){
    header("Location: my_plan.php?required_plan=" . $data['plan_name']  );
    exit();
  }
?>



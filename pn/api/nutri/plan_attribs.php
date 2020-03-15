<?php

require_once("../auth/login_check.php"); //Make sure the user is logged in
require_once("../../variables.php"); //Get the database connection patameters


try {
    $user_id = intval($_SESSION['user_id']);
    $blood_type = $_POST['blood_type'];
    $body_type= $_POST['body_type'];
    $target_fat = intval($_POST['target_fat']);
    $plan_weight = intval($_POST['plan_weight']);
    $sex = $_POST['sex'];
    $desired_outcome = $_POST['desired_outcome'];
    $current_fat = intval($_POST['current_fat']);
    $activity_lvl = intval($_POST['activity_lvl']);

    $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    //This prepared statement takes the arguments AS IS.
    //YOU MUST MAKE THEM THE RELEVANT DATA TYPES BEFORE CALLING.
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $stmt = $con->prepare("
        UPDATE users
        SET 
            blood_type = ?,
            body_type = ?,
            target_fat = ?,
            plan_weight = ?,
            sex = ?,
            desired_outcome = ?,
            current_fat = ?,
            activity_lvl = ?
        WHERE user_id = ?;
    ");
    $stmt->execute([$blood_type, $body_type, $target_fat, $plan_weight, $sex, $desired_outcome, $current_fat, $activity_lvl, $user_id]);
} catch(PDOException $e) {
    die("Request failed");
}



/*
if( $plan_weight > 300 ){
    die("PLease consult a physician before using our site");
}

//Check their age requirement
if (time() < strtotime('+18 years', strtotime($birthdate))) {
    die('Sorry, you are not old enough to sign up.');
}*/





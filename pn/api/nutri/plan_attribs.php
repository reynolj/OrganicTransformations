<?php

require_once("../auth/login_check.php"); //Make sure the user is logged in

session_start(); //Start the session (so you can use the $_SESSION['###'] variable)

require_once("../../variables.php"); //Get the database connection patameters



if (   !isset($_POST['blood_type'])
    || !isset($_POST['body_type'])
    || !isset($_POST['target_fat'])
    || !isset($_POST['plan_weight'])
    || !isset($_POST['sex'])
    || !isset($_POST['desired_outcome'])
    || !isset($_POST['current_fat'])
    || !isset($_POST['activity_lvl'])
) {
    die("Error: Invalid Parameters");
}

//Sanitize & Validate All Inputs
$blood_type = $_POST['blood_type'];
$body_type= ($_POST['body_type']);
$target_fat = $_POST['target_fat'];
$plan_weight = $_POST['plan_weight'];
$sex = $_POST['sex'];
$desired_outcome = $_POST['desired_outcome'];
$current_fat = $_POST['current_fat'];
$activity_lvl = $_POST['activity_lvl'];



/*
if( $plan_weight > 300 ){
    die("PLease consult a physician before using our site");
}

//Check their age requirement
if (time() < strtotime('+18 years', strtotime($birthdate))) {
    die('Sorry, you are not old enough to sign up.');
}*/




?>
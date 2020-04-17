<?php
require("../auth/login_check.php"); //Make sure the users is logged in
require_once('../../variables.php');

//Sends and records a users newly created subscription ID from PayPal to db
try {
    if(!isset($_POST['subscription_id'])){
        die('Error: No Subscription is set');
    }

    $user_id = intval($_SESSION['user_id']);
    $subscription_id = $_POST['subscription_id'];

    $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    //This prepared statement takes the arguments AS IS.
    //YOU MUST MAKE THEM THE RELEVANT DATA TYPES BEFORE CALLING.
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $stmt = $con->prepare("
        INSERT INTO subscriptions (subscription_id, user_id) values (?, ?)
    ");
    $stmt->execute([$subscription_id, $user_id]);
    $result = $stmt->fetchAll();

    die(json_encode($result));
} catch(PDOException $e) {
    die("Request failed");
}
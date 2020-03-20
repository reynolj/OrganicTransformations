<?php
require("../auth/login_check.php"); //Make sure the users is logged in
require_once('../../variables.php');

try {
    $user_id = intval($_SESSION['user_id']);
    $goal = $_POST['goal'];

    $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    //This prepared statement takes the arguments AS IS.
    //YOU MUST MAKE THEM THE RELEVANT DATA TYPES BEFORE CALLING.
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $stmt = $con->prepare("
        DELETE FROM goals
        WHERE 
            user_id = ? AND 
            goal = ? 
        LIMIT 1;
    ");
    $stmt->execute([$user_id, $goal]);
}
catch(PDOException $e) {
    die("Request failed");
}
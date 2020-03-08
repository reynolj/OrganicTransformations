<?php
require("../auth/login_check.php"); //Make sure the users is logged in
require_once('../../variables.php');

try {
    $user_id = intval($_SESSION['user_id']);
    $guide_id = intval($_POST['guide_id']);
    $adding = $_POST['adding'];

    $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    //This prepared statement takes the arguments AS IS.
    //YOU MUST MAKE THEM THE RELEVANT DATA TYPES BEFORE CALLING.
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

    if($adding == 1) {
        $stmt = $con->prepare("
        INSERT INTO favorite_guides SET 
        guide_id = ?, 
        user_id = ?;
        ");
    }
    else {
        $stmt = $con->prepare("
        DELETE FROM favorite_guides WHERE 
        guide_id = ? AND 
        user_id = ?;
        ");
    }
    $stmt->execute([$guide_id, $user_id]);
}
catch(PDOException $e) {
    die("Request failed");
}
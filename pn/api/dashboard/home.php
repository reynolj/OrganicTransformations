<?php
require("../auth/login_check.php"); //Make sure the users is logged in
require_once('../../variables.php');

try {
    $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    //This is prepared statement takes the arguments AS IS.
    //YOU MUST MAKE THEM THE RELEVANT DATA TYPES BEFORE CALLING.
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $stmt = $con->prepare("
        SELECT guide_name, thumbnail, subscription_level, date_last_modified 
        FROM guides 
        WHERE guide_id IN (SELECT guide_id FROM tags WHERE tag = ?) 
        ORDER BY date_last_modified
        LIMIT ?");
    $stmt->execute([$_POST['tag'], $_POST['number']]);

    $result = $stmt->fetchAll();

    echo json_encode($result);
}
catch(PDOException $e) {
    die("Request failed");
}
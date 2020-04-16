<?php

require("../auth/login_check.php"); //Make sure the users is logged in
require_once('../../variables.php');
try {

    $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);


    //Get the users subscription level
    $stmt = $con->prepare("SELECT is_active, is_admin, premium_state FROM users WHERE user_id = ?");
    $stmt->execute([ $_SESSION['user_id'] ]);
    $user_data = $stmt->fetch();

    if(!$user_data || $user_data['is_active'] != 1){
        //Bad user
        $status->result = "ERROR";
        $status->message = "Sorry, you must be an active user to view that.";
        die(json_encode($status));
    }

    $stmt = $con->prepare("SELECT guide_id, thumbnail, date_created, date_last_modified, guide_name, subscription_level, content FROM guides WHERE guide_id = ?");
    $stmt->execute([$_POST['guide_id']]);

    $data = $stmt->fetch();

    //Make sure the guide was found
    if (!$data) {
        $status->result = "ERROR";
        $status->message = "That guide does not exist.";
        die(json_encode($status));
    }

    //Make sure the user is allowed to view that guide
    if( $data['subscription_level'] > $user_data['premium_state'] ){
        $status->result = "ERROR";
        $status->message = "Sorry! You don't have permission to view this guide. Please upgrade your account.";
        die(json_encode($status));
    }

    $status->result = "SUCCESS";
    $status->guide_data = $data;
    die(json_encode($status));


} catch (PDOException $e) {
    $status->result = "ERROR";
    $status->message = "Something went wrong. Please try again later.";
    die(json_encode($status));
}
?>
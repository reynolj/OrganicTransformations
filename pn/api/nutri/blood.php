<?php
require_once("../auth/login_check.php"); //Make sure the user is logged in
require_once("../../variables.php"); //Get the database connection patameters




try {
    $user_id = intval($_SESSION['user_id']);

    $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $stmt = $con->prepare("
        SELECT blood_type
        FROM users
        WHERE user_id = ?;
    ");

    $stmt->execute([$user_id]);
    $data = $stmt->fetchAll();


    $blood = $data[0][0];
    $out = '';

    switch ($blood){


        case "A+":
            $out = "If you are A+ you should drink large amounts of beer";
            break;

        case "A-":
            $out = "If you are A- you should consume large amounts of vodka";
            break;

        case "B+":
            $out = "B+ msg";
            break;

        case "B-":
            $out = "B- msg";
            break;

        case "AB+":
            $out = "AB+ msg";
            break;

        case "AB-":
            $out = "AB- msg";
            break;

        case "O+":
            $out = "O+ msg";
            break;

        case "O-":
            $out = "O- msg";
            break;

        default:
            $out = "Did you know that certain blood types react differently to different foods?
                  We highly recommend you go get blood work done to determine your blood type
                  so our program can help you achieve the best possible results through optimal nutrition";

    }

    die($out);

} catch(PDOException $e) {
    die("Sorry, something went wrong. Try again later.");
    // die( "Failed to add break - " . $e->getMessage());
}

?>
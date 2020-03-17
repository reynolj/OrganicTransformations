<?php
require_once("../auth/login_check.php"); //Make sure the user is logged in
require_once("../../variables.php"); //Get the database connection patameters




try {
    $user_id = intval($_SESSION['user_id']);

    $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $stmt = $con->prepare("
        SELECT blood_type, body_type, target_fat, plan_weight, sex, desired_outcome, current_fat , activity_lvl
        FROM users
        WHERE user_id = ?;
    ");

    $stmt->execute([$user_id]);
    $data = $stmt->fetchAll();

    //Do calculations here
    $blood_type = $data['blood_type'];
    $body_type = $data['body_type'];
    $target_fat = $data['target_fat'];
    $plan_weight = $data['plan_weight'];
    $sex = $data['sex'];
    $desired_outcome = $data['desired_outcome'];
    $current_fat = $data['current_fat'];
    $activity_lvl = $data['activity_lvl'];

    $protein = $data['plan_weight'];
    $starch = 0;
    $veg = 3;
    $fruit1 = 10;
    $fruit2 = 0;
    $fruit3 = 0;
    $fruit4 = 0;
    $fruit5 = 0;
    $fat = 0;

    if($desired_outcome = "Burn fat/lose weight"){


        if($activity_lvl == "No exercise"){
            $fat = 85/5;
            $fruit2 = 5;
            $fruit5 = 5;}
        elseif($activity_lvl == "1-2 days/wk of exercise"){
            $fat = 95/5;
            $fruit2 = 5;
            $fruit5 = 10;}
        else{$fat = 105/5;
             $fruit2 = 10;
             $fruit4 =5;
             $fruit5 = 5;}

        if($body_type == "Ectomorph" && $sex == "Male" && $plan_weight < 160){
            $veg = 2;
        }
    }

    $meals = [
        ["Meal"=>"1", "Protein"=>$data['plan_weight'], "Starch"=>$starch, "Vegetables"=>$veg, "Fruits"=>$fruit1, "Fats"=>$fat],
        ["Meal"=>"2", "Protein"=>$data['plan_weight'], "Starch"=>$starch, "Vegetables"=>$veg, "Fruits"=>$fruit2, "Fats"=>$fat],
        ["Meal"=>"3", "Protein"=>$activity_lvl, "Starch"=>$starch, "Vegetables"=>$veg, "Fruits"=>$fruit3, "Fats"=>$fat],
        ["Meal"=>"4", "Protein"=>$activity_lvl, "Starch"=>$starch, "Vegetables"=>$veg, "Fruits"=>$fruit4, "Fats"=>$fat],
        ["Meal"=>"5", "Protein"=>$activity_lvl, "Starch"=>$starch, "Vegetables"=>$veg, "Fruits"=>$fruit5, "Fats"=>$fat]
    ];

    die(json_encode($meals));







} catch(PDOException $e) {
    die("Sorry, something went wrong. Try again later.");
    // die( "Failed to add break - " . $e->getMessage());
}

?>
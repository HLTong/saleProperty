<?php

include("dbFunctions.php");

$actionDate = $_POST['actionDate'];
$projectName = $_POST['projectName'];
$buyer = $_POST['buyer'];
$mobile = $_POST['mobile'];
$site = $_POST['site'];
$knowledge = $_POST['knowledge'];
$interest = $_POST['interest'];
$followUp = $_POST['followUp'];
$deal = $_POST['deal'];
$dealClosed = $_POST['dealClosed'];
$id = $_POST['prospect_id']; //from the hidden form field 'id'

$updateQuery = "UPDATE prospect "
        . "SET action_date='$actionDate', project_name='$projectName', buyer_name='$buyer', "
        . "buyer_mobile='$mobile', site_visit='$site', buyer_knowledge='$knowledge',"
        . "buyer_interest='$interest', followup_action='$followUp', dead_deal='$deal', "
        . "deal_closed='$dealClosed'  WHERE prospect_id=$id";

$edit = mysqli_query($link, $updateQuery) or die(mysqli_error($link));



    if ($edit) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }
    echo json_encode($response);
?>


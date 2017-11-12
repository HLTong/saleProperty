<?php

include("dbFunctions.php");

$buyer_mobile = $_POST['buyer_mobile'];
$buyer_email = $_POST['buyer_email'];
$site_visit = $_POST['site_visit'];
$buyer_knowledge = $_POST['buyer_knowledge'];
$buyer_interest = $_POST['buyer_interest'];
$followup_action = $_POST['followup_action'];
$dead_deal = $_POST['dead_deal'];
$deal_closed = $_POST['deal_closed'];
$id = $_POST['prospect_id']; //from the hidden form field 'id'

$updateQuery = "UPDATE prospect SET
                
                buyer_mobile= '$buyer_mobile',
                buyer_email = '$buyer_email',
		site_visit = '$site_visit', 
                buyer_knowledge = '$buyer_knowledge',
                buyer_interest = '$buyer_interest',
                followup_action = '$followup_action',
                dead_deal = '$dead_deal',
                deal_closed = '$deal_closed'
                WHERE prospect_id = $id";

$edit = mysqli_query($link, $updateQuery) or die(mysqli_error($link));



    if ($edit) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }
    echo json_encode($response);
?>


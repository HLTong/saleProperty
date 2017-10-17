<?php
session_start();
include("dbFunctions.php");

$status = $_GET['status'];
$id = $_GET['activity_id']; //from the hidden form field 'id'



if($status == "Reserved"){

$updateQuery = "UPDATE activity SET
		status='Reservation Approved'
                WHERE activity_id= '" . $id . "' ";

$edit = mysqli_query($link, $updateQuery) or die(mysqli_error($link));

    if ($edit) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }

}

if($status == "Reservation Approved"){
    
    $updateQuery = "UPDATE activity SET
                status='Contract Signed And Submitted'
                WHERE activity_id= '" . $id . "' ";

    $edit = mysqli_query($link, $updateQuery) or die(mysqli_error($link));

        if ($edit) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }
    
    
}


if($status == "Contract Signed And Submitted"){
    
    $updateQuery = "UPDATE activity SET
                status='Sold'
                WHERE activity_id= '" . $id . "' ";

    $edit = mysqli_query($link, $updateQuery) or die(mysqli_error($link));

        if ($edit) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }
    
}

    echo json_encode($response);
    
    
    ?>
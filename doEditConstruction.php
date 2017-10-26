<?php

include("dbFunctions.php");

$construction_status = $_POST['construction_status'];
$latest_handover = $_POST['latest_handover'];
$latest_construct_complete = $_POST['latest_construct_complete'];
$expect_handover = $_POST['expect_handover'];
$expect_construct_complete = $_POST['expect_construct_complete'];
$id = $_POST['construction_id']; //from the hidden form field 'id'

$updateQuery = "UPDATE construction SET
                
                construction_status = '$construction_status',
		latest_handover = '$latest_handover', 
                latest_construct_complete = '$latest_construct_complete',
                expect_handover = '$expect_handover',
                expect_construct_complete = '$expect_construct_complete'
                WHERE construction_id= $id";

$edit = mysqli_query($link, $updateQuery) or die(mysqli_error($link));



    if ($edit) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }
    echo json_encode($response);
?>


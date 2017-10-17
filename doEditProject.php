<?php

include("dbFunctions.php");

$name = $_POST['name'];
$startDate = $_POST['start_date'];
$id = $_POST['project_id']; //from the hidden form field 'id'

$updateQuery = "UPDATE project SET name='$name', start_date='$startDate' WHERE project_id=$id";

$edit = mysqli_query($link, $updateQuery) or die(mysqli_error($link));



    if ($edit) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }
    echo json_encode($response);
?>


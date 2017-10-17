<?php
session_start();
include("dbFunctions.php");

$agent_id= $_POST['agent_id'];
$company = $_POST['company'];
$name = $_POST['name'];
$username = $_POST['username'];
$mobile = $_POST['mobile'];


$_SESSION['company_id'] = $company;
$_SESSION['name'] = $name;
$_SESSION['username'] = $username;
$_SESSION['mobile'] = $mobile;


$updateQuery = "UPDATE agent SET name='$name', company_id='$company', username='$username',  mobile='$mobile' WHERE agent_id=$agent_id";

$edit = mysqli_query($link, $updateQuery) or die(mysqli_error($link));



    if ($edit) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }
    echo json_encode($response);
?>

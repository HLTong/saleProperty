<?php

include("dbFunctions.php");

$target_sale_price = $_POST['target_sale_price'];
$block = $_POST['block'];
$unit = $_POST['unit'];
$street = $_POST['street'];
$description = $_POST['description'];
$id = $_POST['property_id']; //from the hidden form field 'id'

$updateQuery = "UPDATE property SET
		target_sale_price='$target_sale_price', 
                block='$block',
                unit='$unit',
                street='$street',
                description='$description'
                WHERE property_id= $id";

$edit = mysqli_query($link, $updateQuery) or die(mysqli_error($link));




    if ($edit) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }
    echo json_encode($response);
?>

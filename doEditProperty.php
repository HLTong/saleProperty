<?php

include("dbFunctions.php");

$standard_price = $_POST['standard_price'];
$all_in_price = $_POST['all_in_price'];
$promo_price = $_POST['promo_price'];
$block = $_POST['block'];
$unit = $_POST['unit'];
$street = $_POST['street'];
$description = $_POST['description'];
$id = $_POST['property_id']; //from the hidden form field 'id'

$updateQuery = "UPDATE property SET
		standard_price='$standard_price',
                all_in_price = '$all_in_price',
                promo_price = '$promo_price',    
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

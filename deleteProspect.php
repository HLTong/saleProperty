<?php


include("dbFunctions.php");

$id = $_GET['id'];

$query = "DELETE FROM prospect WHERE prospect_id=$id";
//echo $insertQuery;
$status = mysqli_query($link, $query) or die(mysqli_error($link));

if ($status) {
    $response["success"] = "1";
} else {
    $response["success"] = "0";
}
echo json_encode($response);

?>


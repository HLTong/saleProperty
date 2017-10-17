<?php

include "dbFunctions.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
     $category = array();
    $query = "SELECT * FROM property where property_id = $id";
    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_assoc($result);
    if(!empty($row)) {
        $category = $row;
    }
    mysqli_close($link);

    echo json_encode($category);
}
?>

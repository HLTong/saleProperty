<?php
session_start();

include "dbFunctions.php";
$actual_sale_price = $_POST['actual_sale_price'];
$propertyID = $_POST['property_id'];
$paymentType = $_POST['payment_type'];
$agentID = $_SESSION['agent_id'];
$status = "Reserved";
header("location:index.php");

$queryInsert = "UPDATE property SET
                actual_sale_price='$actual_sale_price',
                payment_type = '$paymentType'
                WHERE property_id= $propertyID";

$resultInsert = mysqli_query($link, $queryInsert) or die;
mysqli_close($link);


    include "dbFunctions.php";
    
    $queryStatus = "UPDATE property 
        SET property_status = 'Taken' 
        WHERE property_id = '" . $propertyID . "'"; 
 

$resultStatus = mysqli_query($link, $queryStatus) or die; 
mysqli_close($link);


include "dbFunctions.php";

$queryInsert = "INSERT INTO activity 
                        (property_id, agent_id, status)
                        VALUES ('$propertyID','$agentID','$status')"; 

$resultInsert = mysqli_query($link, $queryInsert) or die;
mysqli_close($link);


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sale Property</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/validator.min.js" type="text/javascript"></script>
        <script src="js/jquery.raty.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/feedback.js" type="text/javascript"></script>
    </head>
    
    <body>
         <?php
        include("navbar.php");
        ?>
        
        <div class="container">
          <h3>The property has been added!<br/></h3><br>
             Go back to <a href='index.php'>Home</a> 
        </div>
    </body>
</html>
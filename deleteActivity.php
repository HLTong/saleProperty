<?php
session_start();
include("dbFunctions.php");
$id = $_GET['activity_id'];
$property_id = $_GET['property_id'];
$query = "DELETE FROM activity WHERE activity_id=$id";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
mysqli_close($link);

include "dbFunctions.php";
    
    $updateQuery = "UPDATE property 
        SET status = 'Active' 
        WHERE property_id = '" . $property_id . "'"; 

$edit = mysqli_query($link, $updateQuery) or die(mysqli_error($link));
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
          <h3>The activity has been deleted!<br/></h3><br>
             Go back to <a href='index.php'>Home</a> 
        </div>
        
    </body>
</html>
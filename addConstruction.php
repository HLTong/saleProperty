<?php
session_start();
include "dbFunctions.php";
$propertyID = $_POST['property_id'];
$construction_status = $_POST['construction_status'];
$latest_handover = $_POST['latest_handover'];
$latest_construct_complete = $_POST['latest_construct_complete'];
$expect_handover = $_POST['expect_handover'];
$expect_construct_complete = $_POST['expect_construct_complete'];


$progress_status = $_POST['progress_status'];
$text = "";

for($i=0; $i<count($progress_status);$i++){
    $text = $text . $progress_status[$i]." ";  
    
    
}



        $queryInsert = "INSERT INTO construction 
                        (property_id, construction_status, latest_handover, latest_construct_complete, expect_handover, expect_construct_complete, progress_status)
                        VALUES ('$propertyID', '$construction_status', '$latest_handover', '$latest_construct_complete', '$expect_handover', '$expect_construct_complete', '$text')";
        $resultInsert = mysqli_query($link, $queryInsert) or die;
        

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Construction</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="./css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <script src="./js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="./js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./js/validator.min.js" type="text/javascript"></script>
        <script src="./js/jquery.raty.min.js" type="text/javascript"></script>
        <script src="./js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="./js/feedback.js" type="text/javascript"></script>
    </head>
    
    <body>
        <?php
        include("navbar.php");       
        ?>
        
        <div class="container">
          <h3>This construction Details has been added!<br/></h3><br>
             Go back to <a href='index.php'>Home</a> 
             
             <?php echo $text;?>
        </div>
    </body>
</html>
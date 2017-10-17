<?php

include "dbFunctions.php";

$name = $_POST['name'];
$startDate = $_POST['start_date'];

$targetPath = "img/";

//TODO: modify the following code to store the name of the image file into variable $fileName
$fileName = basename($_FILES['image']['name']);

//TODO: modify the following code to store the intended complete path to store the image file into variable $completePath
$completePath = $targetPath . $fileName;
        
if (move_uploaded_file($_FILES['image']['tmp_name'], $completePath)) {
    $queryInsert = "INSERT INTO project 
        (name, start_date, image)
        VALUES ('$name','$startDate','$fileName')";
    
    $resultInsert = mysqli_query($link, $queryInsert) or die;
    mysqli_close($link);
    }
session_start();  
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Project</title>
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
          <h3>The Project <?php echo $name; ?> has been created!<br/></h3><br>
             Go back to <a href='project.php'>Browse Project</a> 
        </div>
    </body>
</html>
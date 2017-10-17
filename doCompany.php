<?php
include "dbFunctions.php";
$company = $_POST['company'];
$telNo = $_POST['tel'];

        $queryInsert = "INSERT INTO company 
                        (company_name, tel_number)
                        VALUES ('$company','$telNo')";
        $resultInsert = mysqli_query($link, $queryInsert) or die;
        
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Company</title>
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
          <h3>The company <?php echo $company; ?> has been created!<br/></h3><br>
             Go back to <a href='index.php'>Home</a> 
        </div>
    </body>
</html>
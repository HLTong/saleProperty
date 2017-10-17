<?php
include "dbFunctions.php";
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$company = $_POST['company'];
$username = $_POST['username'];
$role = $_POST['role'];
$password = SHA1($_POST['password']);
$ComfirmPassword = SHA1($_POST['ComfirmPassword']);

if ($password != $ComfirmPassword ) 
    {
    $message = "<h3>Your confirm new password doesn't match with your new password.<br/><h3><br> "
            . "Please <a href='register.php'>register</a> again!";
    } 

else 
    { 
    $queryCheck = "SELECT * FROM agent WHERE username='$username'"; 
    $resultCheck = mysqli_query($link, $queryCheck) or die(mysqli_error($link));

    if (mysqli_num_rows($resultCheck) == 1) 
        { 
        $message = "<h3>Username already exists.<br/><h3><br> "
                . "Please <a href='register.php'>register</a> again!";
        } 
    
    else 
        {
        $queryInsert = "INSERT INTO agent 
                        (username, password, company_id, mobile, name, role)
                        VALUES ('$username','$password','$company','$mobile',
                        '$name', '$role')";
        
        $resultInsert = mysqli_query($link, $queryInsert) or die;
        $message = "Hi " . strtolower($name)  . 
                    " , you has been registered as an agent";
        $message .= "<br/> You can now <a href='login.php'>login</a>";
        }   
    }
mysqli_close($link);
?>

<?php 
session_start();
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
        <?php
        echo $message;
        ?>
        </div>
        
    </body>
</html>
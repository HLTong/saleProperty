<?php
session_start();
include("dbFunctions.php");

$query = "SELECT * FROM agent WHERE username='" . $_SESSION['username'] . "'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$row = mysqli_fetch_array($result);

$oldPassword = $_POST['oldPassword'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

if (SHA1($oldPassword) == $row['password'] && $password == $password2) 
    {
    $queryUpdate = "UPDATE agent
                    SET password = SHA1('$password') 
                    WHERE username = '" . $_SESSION['username'] . "'";
    
    $resultUpdate = mysqli_query($link, $queryUpdate) or 
            die("The password changed unsuccessful!");
    
    $message = "<h3>Your password has been successfully changed!<br/></h3><br> Go back to <a href='index.php'>Home</a>"; 
    } 
    
else 
    {
    $message = "<h3>Password mismatched. No changes is made!<br/></h3><br> <a href='changePassword.php'>Please Try Again!</a>";
    }
    
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
        <?php
        echo $message;
        ?>
        </div>

    </body>
</html>
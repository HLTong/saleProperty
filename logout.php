<?php
session_start();
if (isset($_SESSION['username'])) {
    $message = "<h3>You have just logged out, " . $_SESSION['name'] ."!<br/></h3><br> Go back to <a href='login.php'>Login</a>";
    $_SESSION = array();
    session_destroy(); 
}
?>

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
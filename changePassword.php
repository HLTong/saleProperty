<?php
session_start();
include("dbFunctions.php");
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
        <h2>Change My Password<br></br></h2>     
        <form id="ChangePassword" class="form-horizontal" role="form" action="doChangePassword.php" method="post" data-toggle="validator">
        
            <div class="form-group"> 
                <label class="control-label col-sm-2" for="oldPassword">Old Password:</label> 
                <div class="col-sm-6"> 
                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" required> 
                </div> 
            </div> 
            
            <br>
            
             <div class="form-group"> 
                <label class="control-label col-sm-2" for="password">New Password:</label> 
                <div class="col-sm-6"> 
                    <input type="password" class="form-control" id="password" name="password" required> 
                </div> 
            </div> 
            
            <br>
            
             <div class="form-group"> 
                <label class="control-label col-sm-2" for="password2">Confirm New Password:</label> 
                <div class="col-sm-6"> 
                    <input type="password" class="form-control" id="password2" name="password2" required> 
                </div> 
            </div> 
            
            <br>

            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10"> 
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>  </div>
                 
    </body>
</html>
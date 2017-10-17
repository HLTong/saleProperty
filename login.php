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
            <h3>Login Page<br/><br></h3>
            <form id="defaultForm" class="form-horizontal" role="form" action="doLogin.php" method="post" data-toggle="validator">
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="username">Username:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="username" name="username" 
                        required data-error="Username is required"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    
                    <div class="ui-widget">
                    <label class="control-label col-sm-2" for="password">Password:</label>
                    <div class="col-sm-6"> 
                        <input type="password" class="form-control" id="password" name="password"  
                               requried data-error="Password is required"/> 
                        <div class="help-block with-errors"></div>
                    </div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </div>
            </form> 
        </div>
    </body>
</html>
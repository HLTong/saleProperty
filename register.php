<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
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
        include("dbFunctions.php");
        
        $querySelect = "SELECT * FROM company  ";
        $resultSelect = mysqli_query($link, $querySelect) or die(mysqli_error($link));
        
        while ($rowSelect = mysqli_fetch_assoc($resultSelect))
            {
                $arrResult[]=$rowSelect;
            }
        ?>
        
        <div class="container">
            <h3>Agent Registration<br/><br></h3>
            <form id="defaultForm" class="form-horizontal" role="form" action="doRegister.php" method="post" data-toggle="validator">
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Full Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" name="name" 
                        required data-error="Full name is required"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>

                <div class="form-group">
                    <div class="ui-widget">
                    <label class="control-label col-sm-2" for="mobile">Contact Number:</label>
                    <div class="col-sm-6"> 
                        <input type="text" class="form-control" id="mobile" name="mobile"  
                               requried required data-error="Mobile number is required"/>
                        <div class="help-block with-errors"></div>
                    </div>
                    </div>
                </div>
                
                <br>
               
                <div class="form-group">
                    <label class="control-label col-sm-2">Company:</label>
                    <div class="col-sm-6" name="company">
                        <select class="form-control" id="company" name="company">
                            <?php for ($i=0 ; $i<count($arrResult); $i++){   ?>
                            <option value="<?php echo $arrResult[$i]['company_id']; ?>"> 
                                <?php echo $arrResult[$i]['company_name']; ?> </option>
                            <?php } ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
               
            <h3>Account information <br/><br></h3>
                
            <div class="form-group">
                <label class="control-label col-sm-2" for="username">Username:</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="name" name="username" 
                       required data-minlength="6" data-minlength-error="Your name at least must have 6 letters" 
                       required data-error="Username is required"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
                
            
                
            <br>
                
            <div class="form-group">
                <label class="control-label col-sm-2" for="password">Password:</label>
                <div class="col-sm-6">
                <input type="password" class="form-control" id="password" name="password" 
                       required data-minlength="6" data-minlength-error="Your password should be minimum 6 letters" 
                       required data-error="Password is required"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
                
            <br>
                
            <div class="form-group">
                <label class="control-label col-sm-2" for="ComfirmPassword">Confirm Password:</label>
                <div class="col-sm-6">
                <input type="password" class="form-control" id="ComfirmPassword" name="ComfirmPassword" 
                       required data-minlength="6" data-minlength-error="Your password should be minimum 6 letters" accept=" 
                       "required data-error="Password is required"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
                
            <br>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </div> 
            </form>
        </div>
    </body>
</html>

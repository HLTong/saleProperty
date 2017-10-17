<?php
session_start();
include("dbFunctions.php");
$id = $_GET['prospect_id'];
$query = "SELECT * FROM prospect WHERE prospect_id=$id";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
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
        while($row=mysqli_fetch_assoc($result)){
        ?>
        
        <div class="container">
        <h2>Edit Prospect</h2> 
            <form id="defaultForm" class="form-horizontal" role="form" action="doEditProspect.php" method="post" data-toggle="validator">
                
                <input type="hidden" class="form-control" id="prospect_id" name="prospect_id" value="<?php echo $id; ?>"> 
                
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="actionDate">Date of Visit/Call:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="actionDate" name="actionDate" 
                        required data-error="Date is required" value="<?php echo $row['actionDate']; ?> " >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Project Name:</label>
                    <div class="col-sm-8" name="projectName">
                        
                    <select class="form-control" id="projectName" name="projectName" required value="<?php echo $row['projectName']; ?> " >
                        <option value="">-- Please Select --</option>
                        <option value="ABC">ABC</option>
                        <option value="DEF">DEF</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer">Name of Buyer:</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="buyer" name="buyer" 
                       required data-error="Username is required" value="<?php echo $row['buyer']; ?> " >
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="mobile">Contact Number:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="mobile" name="mobile"  
                               requried required data-error="Mobile number is required" value="<?php echo $row['mobile']; ?> " >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Site Visit:</label>
                    <div class="col-sm-8" name="site">
                        
                    <select class="form-control" id="site" name="site" value="<?php echo $row['site']; ?> " >
                        <option value="">-- Please Select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br> 
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="knowledge">Buyer's Knowledge:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="knowledge" name="knowledge" value="<?php echo $row['knowledge']; ?> " >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="interest">Buyer's Interest & Rejection:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="interest" name="interest" value="<?php echo $row['interest']; ?> " >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="followUp">Follow-up Actions:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="followUp" name="followUp" value="<?php echo $row['followUp']; ?> " >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Dead Deal:</label>
                    <div class="col-sm-8" name="deal">
                        
                    <select class="form-control" id="deal" name="deal" value="<?php echo $row['deal']; ?> " >
                        <option value="">-- Please Select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="dealClosed">Deal Closed:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="dealClosed" name="dealClosed" value="<?php echo $row['dealClosed']; ?> " >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
          
        <?php } ?> 
            <br>
              
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-primary">Edit Prospect</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
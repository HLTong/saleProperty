<?php
session_start();
include("dbFunctions.php");
$id = $_GET['activity_id'];
$query = "SELECT description, status, actual_start_date, actual_end_date,property_id FROM activity WHERE activity_id=$id";
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
        <h2>Edit Activity</h2> 
            <form id="defaultForm" class="form-horizontal" role="form" action="doEditActivity.php" method="post" data-toggle="validator">
                
                <input type="hidden" class="form-control" id="activity_id" name="activity_id" value="<?php echo $id; ?>"> 
                <input type="hidden" class="form-control" id="property_id" name="property_id" value="<?php echo $row['property_id']; ?>"> 
                
                <div class="form-group"> 
                    <label class="control-label col-sm-2" for="description">Description:</label>
                    <div class="col-sm-6"> <input type="text" class="form-control" id="description" name="description" 
                               value="<?php echo $row['description']; ?> ">
                    </div>
                </div>
                
                <br> 
                
                <div class="form-group"> 
                    <label class="control-label col-sm-2">Status: </label> 
                    <div class="col-sm-6" name="status"> 
                        <select class="form-control" id="status" name="status" required> 
                            <option value="Reserved">Reserved</option> 
                            <option value="Sold">Sold</option> 
                            <option value="Handover">Handover</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group"> 
                    <label class="control-label col-sm-2" for="actual_start_date">Actual Start Date:</label> 
                    <div class="col-sm-6"> <input type="text" class="form-control" id="actual_start_date" 
                                name="actual_start_date" placeholder="<?php echo $row['actual_start_date']; ?> "> 
                    </div> 
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="actual_end_date">Actual End Date:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="actual_end_date" 
                               name="actual_end_date" placeholder="<?php echo date($row['actual_end_date']); ?> ">
                    </div>
                </div>
        <?php } ?>
                <br>
                
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-primary">Edit Activity</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
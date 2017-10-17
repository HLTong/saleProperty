<?php
session_start();
include("dbFunctions.php");
$id = $_GET['property_id'];
$query = "SELECT target_sale_price, actual_sale_price, description FROM property WHERE property_id=$id";
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
        <h2>Edit Property</h2> 
            <form id="defaultForm" class="form-horizontal" role="form" action="doEditProperty.php" method="post" data-toggle="validator">
                
                <input type="hidden" class="form-control" id="property_id" name="property_id" value="<?php echo $id; ?>"> 
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="target_sale_price">Target Sale Price:</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="target_sale_price" name="target_sale_price" required 
                       data-error="Target Sale Price is required" value="<?php echo $row['target_sale_price']; ?> ">
                <div class="help-block with-errors"></div>
                </div>
            </div>
                
            <br>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="actual_sale_price">Actual Sale Price:</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="target_sale_price" name="actual_sale_price" required 
                       data-error="Actual Sale Price is required" value="<?php echo $row['actual_sale_price']; ?> ">
                <div class="help-block with-errors"></div>
                </div>
            </div>
            
            <br>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description:</label>
                <div class="col-sm-6"><textarea class="form-control" id="description" name="description" 
                        value="<?php echo $row['description']; ?> "></textarea>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <?php } ?>
            
            <br>

                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-primary">Edit Property</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>

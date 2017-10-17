<?php
session_start();
include("dbFunctions.php");
$id = $_GET['project_id'];
$query = "SELECT * FROM project WHERE project_id=$id";
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
        <h2>Edit Project</h2> 
            <form id="defaultForm" class="form-horizontal" role="form" action="doEditProject.php" method="post" data-toggle="validator">
                
                <input type="hidden" class="form-control" id="project_id" name="project_id" value="<?php echo $id; ?>"> 
                
                <div class="form-group"> 
                    <label class="control-label col-sm-2" for="name">Project Name:</label>
                    <div class="col-sm-6"> 
                        <input type="text" class="form-control" id="name" name="name" required 
                               data-error="Project title is required" value="<?php echo $row['name']; ?> " >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
               
                <div class="form-group">
                <label class="control-label col-sm-2" for="start_date">Start Date:</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" id="start_date" name="start_date" required 
                       data-error="Start date is required" placeholder="<?php echo $row['start_date']; ?> ">
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <br>
          
        <?php } ?> 
            <br>
              
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-primary">Edit Project</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
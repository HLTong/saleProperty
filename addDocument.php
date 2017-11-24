<!DOCTYPE html>
<html>
    <head>
        <title>Add document</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="./css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <script src="./js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="./js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./js/validator.min.js" type="text/javascript"></script>
        <script src="./js/jquery.raty.min.js" type="text/javascript"></script>
        <script src="./js/jquery-ui.min.js" type="text/javascript"></script>
        

   
    </head>
    
    <body>
        <?php
        session_start();
        include("navbar.php");
        include("dbFunctions.php");
        
        $projectID = $_POST['projectID'];
        $projectName = $_POST['projectName'];
        $propertyID = $_POST['property_id'];
        $title = $_POST['title'];
        $creation_date = date("Y-m-d");
        
        $targetPath = "file/";

        //TODO: modify the following code to store the name of the image file into variable $fileName
        $fileName = basename($_FILES['document']['name']);

        //TODO: modify the following code to store the intended complete path to store the image file into variable $completePath
        $completePath = $targetPath . $fileName;
     
        if (move_uploaded_file($_FILES['document']['tmp_name'], $completePath)) {
            $queryInsert = "INSERT INTO document
                (property_id, title, creation_date, url)
                VALUES ('$propertyID','$title','$creation_date','$fileName') ";
            
            $resultInsert = mysqli_query($link, $queryInsert) or die;
            
            
        }else {
            echo $fileName;
        }
     
        ?>
        
        <?php if ($_SESSION['role']=="agent") { ?>
        <meta http-equiv="refresh" content="2;url=propertyDetails.php?propertyID=<?php echo $propertyID ?>&projectName=<?php echo $projectName?>&projectID=<?php echo $propertyID?>">
        <?php } else {?>
        <meta http-equiv="refresh" content="2;url=activity.php?property_id=<?php echo $propertyID ?>">
        <?php } ?>

        <div class="container">
          <h3>The Document has been added!<br/></h3><br> 
          <?php if ($_SESSION['role']=="agent") { ?>
         Go back to <a href="propertyDetails.php?propertyID=<?php echo $propertyID ?>&projectName=<?php echo $projectName?>&projectID=<?php echo $propertyID?>"> View project</a> 
          <?php mysqli_close($link); } else {?>
         
         Go back to <a href="activity.php?property_id=<?php echo $propertyID ?>"> View Activity</a> 
         

          <?php } ?>
        </div>
    </body>
</html>

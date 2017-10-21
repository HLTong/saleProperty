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
        session_start();
        include("navbar.php");
        include("dbFunctions.php");
        
        $project_id = $_POST['project_id'];
        $project_name = $_POST['project_name'];
        $block = $_POST['block'];
        $unit = $_POST['unit'];
        $street = $_POST['street'];
        $target_sale_price = $_POST['target_sale_price'];
        $description = $_POST['description'];
        
        $targetPath = "img/";

        //TODO: modify the following code to store the name of the image file into variable $fileName
        $fileName = basename($_FILES['image']['name']);

        //TODO: modify the following code to store the intended complete path to store the image file into variable $completePath
        $completePath = $targetPath . $fileName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $completePath)) {
            $queryInsert = "INSERT INTO property
                (project_id, block, unit, street, property_status, target_sale_price, description, image)
                VALUES ('$project_id','$block','$unit','$street','Available','$target_sale_price','$description','$fileName')";
            
            $resultInsert = mysqli_query($link, $queryInsert) or die;
            
            mysqli_close($link);
        }
        ?>

        <div class="container">
          <h3>The property <?php echo $street; ?> has been created!<br/></h3><br>
             Go back to <a href="property.php?property_id=<?php echo $project_id; ?>&projectName=<?php echo $project_name; ?>"> View This Property</a> 
        </div>
    </body>
</html>

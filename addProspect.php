<?php
session_start();
include "dbFunctions.php";
$actionDate = $_POST['actionDate'];
$projectName = $_POST['projectName'];
$buyer = $_POST['buyer'];
$mobile = $_POST['mobile'];
$site = $_POST['site'];
$knowledge = $_POST['knowledge'];
$interest = $_POST['interest'];
$followUp = $_POST['followUp'];
$deal = $_POST['deal'];
$dealClosed = $_POST['dealClosed'];
$agentID = $_SESSION['agent_id'];

        $queryInsert = "INSERT INTO prospect 
                        (agent_id, action_date, project_name, buyer_name, buyer_mobile, site_visit, buyer_knowledge, buyer_interest, followup_action, dead_deal, deal_closed)
                        VALUES ('$agentID', '$actionDate', '$projectName', '$buyer', '$mobile', '$site', '$knowledge', '$interest', '$followUp', '$deal', '$dealClosed')";
        $resultInsert = mysqli_query($link, $queryInsert) or die;
        

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Prospect</title>
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
          <h3>This prospect has been added to your list!<br/></h3><br>
             Go back to <a href='index.php'>Home</a> 
        </div>
    </body>
</html>
<?php
session_start();
include "dbFunctions.php";
$action_date = $_POST['action_date'];
$project_name = $_POST['project_name'];
$buyer_name = $_POST['buyer_name'];
$buyer_mobile = $_POST['buyer_mobile'];
$site_visit = $_POST['site_visit'];
$buyer_knowledge = $_POST['buyer_knowledge'];
$buyer_interest = $_POST['buyer_interest'];
$followup_action = $_POST['followup_action'];
$dead_deal = $_POST['dead_deal'];
$deal_closed = $_POST['deal_closed'];
$agent_id = $_SESSION['agent_id'];
header("location:prospect.php");

        $queryInsert = "INSERT INTO prospect 
                        (agent_id, project_id, action_date, buyer_name, buyer_mobile, site_visit, buyer_knowledge, buyer_interest, followup_action, dead_deal, deal_closed)
                        VALUES ('$agent_id', '$project_name', '$action_date', '$buyer_name', '$buyer_mobile', '$site_visit', '$buyer_knowledge', '$buyer_interest', '$followup_action', '$dead_deal', '$deal_closed')";
        $resultInsert = mysqli_query($link, $queryInsert) or die;
        

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Prospect</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="./css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <script src="./js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="./js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./js/validator.min.js" type="text/javascript"></script>
        <script src="./js/jquery.raty.min.js" type="text/javascript"></script>
        <script src="./js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="./js/feedback.js" type="text/javascript"></script>
    </head>
    
    <body>
        <?php
        include("navbar.php");       
        ?>
        
        <div class="container">
          <h3>This prospect has been added to your list!<br/></h3><br>
             Go back to <a href='./index.php'>Home</a> 
        </div>
    </body>
</html>
<?php
session_start();
include("dbFunctions.php");
$msg = "";

if (isset($_POST['username'])) {
    //retrieve form data
    $username = $_POST['username'];
    $password = SHA1($_POST['password']);

    //match the username and password entered with database record
    $query = "SELECT * FROM agent WHERE username='" . $username . "' AND password = '" . $password . "' ";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    //if record is found, store id and username into session
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['agent_id'] = $row['agent_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['mobile'] = $row['mobile'];
        $_SESSION['company_id'] = $row['company_id'];
        header("location:index.php");
        }
        
    else {
        $message = "<h3>Sorry, you must enter a valid username and password to log in!<br/></h3><br> "
                . "<a href='login.php'>Back to Login Page</a>";
    }
}
?>

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
        <?php
        echo $message;
        ?>
        </div>

    </body>
</html>
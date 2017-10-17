<!-- Navigational Bar -->
<nav class="navbar navbar-default" role="navigation">
    
    <div class="navbar-header"> <a class="navbar-brand" href="#">Sale Property Tracking System</a> </div>
    <div>

        <?php if (isset($_SESSION['username'])) { ?>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="project.php">Browse Project</a></li>
                    <li><a href="prospect.php">Prospect</a></li>
                </ul>
        
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Welcome, <?php echo $_SESSION['name']; ?> </a> </li>
                    <li><a href="logout.php">Logout</a></li>
                    <li>&nbsp &nbsp &nbsp &nbsp</li>
                </ul>
        
        <?php } else { ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php">Login</a></li>
                <li>&nbsp &nbsp &nbsp &nbsp</li>
            </ul>
        <?php } ?>    
        
    </div> 
</nav>
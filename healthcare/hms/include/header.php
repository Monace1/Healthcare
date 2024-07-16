<?php 
//error_reporting(0); 
?>
<header class="navbar navbar-default navbar-static-top">
   
    <div class="navbar-header">
        <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
            <i class="ti-align-justify"></i>
        </a>
        <a class="navbar-brand" href="#">
            <h2 style="padding-top:2%">HMS</h2>
        </a>
        <a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
            <i class="ti-align-justify"></i>
        </a>
        <a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <i class="ti-view-grid"></i>
        </a>
    </div>

    <div class="navbar-collapse collapse">
        <ul class="nav navbar-right">
            <li style="padding-top:2%">
                <h2>HealthCare Management System</h2>
            </li>

            <li class="dropdown current-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/images/" alt="">
                    <span class="username">
                        <?php
                        $query = "SELECT fullName FROM users WHERE id = '".$_SESSION['id']."'";
                        $result = mysqli_query($conn, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            echo htmlspecialchars($row['fullName']);
                        }
                        ?>
                        <i class="ti-angle-down"></i>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-dark">
                    <li>
                        <a href="edit-profile.php">
                            My Profile
                        </a>
                    </li>
                    <li>
                        <a href="change-password.php">
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            Log Out
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        </div>
    </div>
    
</header>

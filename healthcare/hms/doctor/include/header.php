<?php
// error_reporting(0);

$mysqli = new mysqli("localhost", "root", "root", "hms");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

?>
<header class="navbar navbar-default navbar-static-top">
    <div class="navbar-header">
        <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
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
                <h2>Healthcare Management System</h2>
            </li>

            <li class="dropdown current-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/images/grid-img1.png" alt="Peter"> <span class="username">
                        <?php
                        // Assuming $_SESSION['id'] is properly sanitized or validated to prevent SQL injection
                        $id = $mysqli->real_escape_string($_SESSION['id']);
                        $query = "SELECT fullName FROM users WHERE id='$id'";
                        $result = $mysqli->query($query);

                        if ($result) {
                            if ($row = $result->fetch_assoc()) {
                                echo $row['fullName'];
                            }
                            $result->free();
                        } else {
                            echo "Error: " . $mysqli->error;
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
            <!-- end: USER OPTIONS DROPDOWN -->
        </ul>
        <!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
        <div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
            <div class="arrow-left"></div>
            <div class="arrow-right"></div>
        </div>
        <!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
    </div>
    <!-- end: NAVBAR COLLAPSE -->
</header>

<?php
// Close mysqli connection
$mysqli->close();
?>

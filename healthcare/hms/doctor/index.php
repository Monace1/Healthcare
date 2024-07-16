<?php
session_start();

$mysqli_hostname = "localhost";
$mysqli_user = "root";
$mysqli_password = "root";
$mysqli_database = "hms";

$mysqli = new mysqli($mysqli_hostname, $mysqli_user, $mysqli_password, $mysqli_database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    
    $stmt = $mysqli->prepare("SELECT id FROM doctors WHERE docEmail=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id);
        $stmt->fetch();

        $_SESSION['dlogin'] = $username;
        $_SESSION['id'] = $id;

        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 1;

        // Prepare statement for inserting login details
        $log = $mysqli->prepare("INSERT INTO doctorslog (uid, username, userip, status) VALUES (?, ?, ?, ?)");
        $log->bind_param("issi", $_SESSION['id'], $_SESSION['dlogin'], $uip, $status);
        $log->execute();
        $log->close();

        $extra = "dashboard.php";
        header("Location: $extra");
        exit();
    } else {
        $_SESSION['dlogin'] = $username;
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 0;

        // Prepare statement for failed login attempt
        $log = $mysqli->prepare("INSERT INTO doctorslog (username, userip, status) VALUES (?, ?, ?)");
        $log->bind_param("ssi", $_SESSION['dlogin'], $uip, $status);
        $log->execute();
        $log->close();

        $_SESSION['errmsg'] = "Invalid username or password";
        $extra = "index.php";
        header("Location: $extra");
        exit();
    }

    $stmt->close();
}

// Close mysqli connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link rel="stylesheet" href="vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="vendor/perfect-scrollbar/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="vendor/switchery/switchery.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color">
</head>
<body class="login">
<div class="row">
    <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="logo margin-top-30">
            <h2> HMS | Doctor Login</h2>
        </div>

        <div class="box-login">
            <form class="form-login" method="post">
                <fieldset>
                    <legend>Sign in to your account</legend>
                    <p>
                        Please enter your name and password to log in.<br />
                        <span style="color:red;"><?php echo isset($_SESSION['errmsg']) ? $_SESSION['errmsg'] : ''; ?><?php $_SESSION['errmsg'] = ''; ?></span>
                    </p>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>
                    <div class="form-group form-actions">
                        <span class="input-icon">
                            <input type="password" class="form-control password" name="password" placeholder="Password">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary pull-right" name="submit">
                            Login <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>
                </fieldset>
            </form>

            <div class="copyright">
                &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> HMS</span>. <span>All rights reserved</span>
            </div>

        </div>

    </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/modernizr/modernizr.js"></script>
<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="vendor/switchery/switchery.min.js"></script>
<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/login.js"></script>
<script>
    jQuery(document).ready(function() {
        Main.init();
        Login.init();
    });
</script>
</body>
</html>

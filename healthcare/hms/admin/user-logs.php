<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

$mysqli = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$msg = '';
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    $_SESSION['msg'] = '';
}

$query = "SELECT * FROM userlog";
$result = $mysqli->query($query);
if (!$result) {
    die('Error: ' . $mysqli->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | User Session Logs</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
          rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color"/>
</head>
<body>
<div id="app">
    <?php include('include/sidebar.php'); ?>
    <div class="app-content">
        <?php include('include/header.php'); ?>

        <div class="main-content">
            <div class="wrap-content container" id="container">
                
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Admin | User Session Logs</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <span>Admin</span>
                            </li>
                            <li class="active">
                                <span>User Session Logs</span>
                            </li>
                        </ol>
                    </div>
                </section>
                
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="color:red;"><?php echo htmlentities($msg); ?></p>
                            <table class="table table-hover" id="sample-table-1">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="hidden-xs">User id</th>
                                    <th>Username</th>
                                    <th>User IP</th>
                                    <th>Login time</th>
                                    <th>Logout Time</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $cnt = 1;
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td class="center"><?php echo $cnt; ?>.</td>
                                        <td class="hidden-xs"><?php echo $row['uid']; ?></td>
                                        <td class="hidden-xs"><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['userip']; ?></td>
                                        <td><?php echo $row['loginTime']; ?></td>
                                        <td><?php echo $row['logout']; ?></td>
                                        <td>
                                            <?php echo ($row['status'] == 1) ? 'Success' : 'Failed'; ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $cnt++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
           
            </div>
        </div>
    </div>

    <?php include('include/footer.php'); ?>
   
    <?php include('include/setting.php'); ?>

</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/modernizr/modernizr.js"></script>
<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="vendor/switchery/switchery.min.js"></script>

<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="vendor/autosize/autosize.min.js"></script>
<script src="vendor/selectFx/classie.js"></script>
<script src="vendor/selectFx/selectFx.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>

<script src="assets/js/main.js"></script>

<script src="assets/js/form-elements.js"></script>
<script>
    jQuery(document).ready(function () {
        Main.init();
        FormElements.init();
    });
</script>

</body>
</html>

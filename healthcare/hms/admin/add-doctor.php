<?php
session_start();

include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    
    $docspecialization = $_POST['Doctorspecialization'];
    $docname = $_POST['docname'];
    $docaddress = $_POST['clinicaddress'];
    $docfees = $_POST['docfees'];
    $doccontactno = $_POST['doccontact'];
    $docemail = $_POST['docemail'];
    $password = md5($_POST['npass']);


    $mysqli = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

   
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("INSERT INTO doctors (specilization, doctorName, address, docFees, contactno, docEmail, password) VALUES (?, ?, ?, ?, ?, ?, ?)");


    $stmt->bind_param("sssssss", $docspecialization, $docname, $docaddress, $docfees, $doccontactno, $docemail, $password);

    $result = $stmt->execute();

    if ($result) {
        echo "<script>alert('Doctor info added Successfully');</script>";
        echo "<script>document.location = 'Manage-doctors.php'; </script>";
    } else {
        echo "<script>alert('Error: " . $mysqli->error . "');</script>";
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Add Doctor</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
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
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <script type="text/javascript">
        function valid() {
            if (document.adddoc.npass.value != document.adddoc.cfpass.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.adddoc.cfpass.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div id="app">
    <?php include('include/sidebar.php');?>
    <div class="app-content">
        <?php include('include/header.php');?>
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Admin | Add Doctor</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <span>Admin</span>
                            </li>
                            <li class="active">
                                <span>Add Doctor</span>
                            </li>
                        </ol>
                    </div>
                </section>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row margin-top-30">
                                <div class="col-lg-8 col-md-12">
                                    <div class="panel panel-white">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">Add Doctor</h5>
                                        </div>
                                        <div class="panel-body">
                                            <form role="form" name="adddoc" method="post" onSubmit="return valid();">
                                                <div class="form-group">
                                                    <label for="DoctorSpecialization">
                                                        Doctor Specialization
                                                    </label>
                                                    <select name="Doctorspecialization" class="form-control" required="required">
                                                        <option value="">Select Specialization</option>
                                                        <?php
                                                        // Database connection parameters
                                                        $mysqli = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

                                                        // Check connection
                                                        if ($mysqli->connect_error) {
                                                            die("Connection failed: " . $mysqli->connect_error);
                                                        }

                                                        // Query to select all rows from doctorspecilization table
                                                        $query = "SELECT * FROM doctorspecilization";
                                                        $result = $mysqli->query($query);

                                                        // Fetching data row by row
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<option value="' . htmlentities($row['specilization']) . '">' . htmlentities($row['specilization']) . '</option>';
                                                        }

                                                        // Close connection
                                                        $mysqli->close();
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="doctorname">
                                                        Doctor Name
                                                    </label>
                                                    <input type="text" name="docname" class="form-control" placeholder="Enter Doctor Name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">
                                                        Doctor Clinic Address
                                                    </label>
                                                    <textarea name="clinicaddress" class="form-control" placeholder="Enter Doctor Clinic Address"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fess">
                                                        Doctor Consultancy Fees
                                                    </label>
                                                    <input type="text" name="docfees" class="form-control" placeholder="Enter Doctor Consultancy Fees">
                                                </div>
                                                <div class="form-group">
                                                    <label for="fess">
                                                        Doctor Contact no
                                                    </label>
                                                    <input type="text" name="doccontact" class="form-control" placeholder="Enter Doctor Contact no">
                                                </div>
                                                <div class="form-group">
                                                    <label for="fess">
                                                        Doctor Email
                                                    </label>
                                                    <input type="email" name="docemail" class="form-control" placeholder="Enter Doctor Email id">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">
                                                        Password
                                                    </label>
                                                    <input type="password" name="npass" class="form-control" placeholder="New Password" required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword2">
                                                        Confirm Password
                                                    </label>
                                                    <input type="password" name="cfpass" class="form-control" placeholder="Confirm Password" required="required">
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-o btn-primary">
                                                    Submit
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php include('include/footer.php');?>
    <!-- end: FOOTER -->
    <!-- start: SETTINGS -->
    <?php include('include/setting.php');?>
    <!-- end: SETTINGS -->
</div>
<!-- start: MAIN JAVASCRIPTS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/modernizr/modernizr.js"></script>
<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="vendor/switchery/switchery.min.js"></script>
<!-- end: MAIN JAVASCRIPTS -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js">
<script src="vendor/autosize/autosize.min.js"></script>
<script src="vendor/selectFx/classie.js"></script>
<script src="vendor/selectFx/selectFx.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: CLIP-TWO JAVASCRIPTS -->
<script src="assets/js/main.js"></script>
<!-- start: JavaScript Event Handlers for this page -->
<script src="assets/js/form-elements.js"></script>
<script>
    jQuery(document).ready(function() {
        Main.init();
        FormElements.init();
    });
</script>
<!-- end: JavaScript Event Handlers for this page -->
<!-- end: CLIP-TWO JAVASCRIPTS -->
</body>
</html>


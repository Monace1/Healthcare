<?php
session_start();
include('include/config.php');
include('include/checklogin.php');

if(isset($_POST['submit'])) {
    // Sanitize and prepare form data
    $docspecialization = mysqli_real_escape_string($conn, $_POST['Doctorspecialization']);
    $docname = mysqli_real_escape_string($conn, $_POST['docname']);
    $docaddress = mysqli_real_escape_string($conn, $_POST['clinicaddress']);
    $docfees = mysqli_real_escape_string($conn, $_POST['docfees']);
    $doccontactno = mysqli_real_escape_string($conn, $_POST['doccontact']);
    $docemail = mysqli_real_escape_string($conn, $_POST['docemail']);
    $sessionEmail = mysqli_real_escape_string($conn, $_SESSION['dlogin']);

    // Update query
    $sql = "UPDATE doctors SET specilization='$docspecialization', doctorName='$docname', address='$docaddress', docFees='$docfees', contactno='$doccontactno' WHERE docEmail='$sessionEmail'";

    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Doctor Details updated Successfully');</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch current doctor details for editing
$sessionEmail = mysqli_real_escape_string($conn, $_SESSION['dlogin']);
$query = "SELECT * FROM doctors WHERE docEmail='$sessionEmail'";
$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor | Edit Doctor Details</title>
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
</head>
<body>
    <div id="app">
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- Page content goes here -->
                    <section id="page-title">
                        <!-- Page title section -->
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Edit Doctor</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="adddoc" method="post" onSubmit="return valid();">
                                                    <div class="form-group">
                                                        <label for="DoctorSpecialization">Doctor Specialization</label>
                                                        <select name="Doctorspecialization" class="form-control" required>
                                                            <option value="<?php echo htmlentities($data['specilization']);?>">
                                                                <?php echo htmlentities($data['specilization']);?>
                                                            </option>
                                                            <?php
                                                            $query = "SELECT * FROM doctorspecilization";
                                                            $ret = mysqli_query($conn, $query);
                                                            while($row = mysqli_fetch_assoc($ret)) {
                                                            ?>
                                                            <option value="<?php echo htmlentities($row['specilization']);?>">
                                                                <?php echo htmlentities($row['specilization']);?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="doctorname">Doctor Name</label>
                                                        <input type="text" name="docname" class="form-control" value="<?php echo htmlentities($data['doctorName']);?>" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Doctor Clinic Address</label>
                                                        <textarea name="clinicaddress" class="form-control"><?php echo htmlentities($data['address']);?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Doctor Consultancy Fees</label>
                                                        <input type="text" name="docfees" class="form-control" required value="<?php echo htmlentities($data['docFees']);?>" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Doctor Contact no</label>
                                                        <input type="text" name="doccontact" class="form-control" required value="<?php echo htmlentities($data['contactno']);?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Doctor Email</label>
                                                        <input type="email" name="docemail" class="form-control" readonly value="<?php echo htmlentities($data['docEmail']);?>">
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">Update</button>
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
            <?php include('include/footer.php');?>
            <?php include('include/setting.php');?>
        </div>
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
  
<script src="assets/js/form-elements.js"></script>
<script>
    jQuery(document).ready(function() {
        Main.init();
        FormElements.init();
    });
</script>

</body>
</html>

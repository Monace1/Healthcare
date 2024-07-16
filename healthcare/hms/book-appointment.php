<?php
error_reporting(0);
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $specialization = $_POST['Doctorspecialization'];
    $doctorid = $_POST['doctor'];
    $userid = $_SESSION['id'];
    $fees = $_POST['fees'];
    $appdate = $_POST['appdate'];
    $time = $_POST['apptime'];
    $userstatus = 1;
    $docstatus = 1;

    $stmt = $conn->prepare("INSERT INTO appointment (doctorSpecialization, doctorId, userId, consultancyFees, appointmentDate, appointmentTime, userStatus, doctorStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiisiii", $specialization, $doctorid, $userid, $fees, $appdate, $time, $userstatus, $docstatus);

    if ($stmt->execute()) {
        echo "<script>alert('Your appointment has been successfully booked.');</script>";
    } else {
        echo "<script>alert('Error booking appointment. Please try again later.');</script>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient | Book Appointment</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link rel="stylesheet" href="vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="vendor/perfect-scrollbar/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color">

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                startDate: new Date() 
            });

            $('.timepicker').timepicker({
                showMeridian: false,
                minuteStep: 15,
                defaultTime: false
            });

            function getDoctors(val) {
                $.ajax({
                    type: "POST",
                    url: "get_doctor.php",
                    data: 'specilizationid=' + val,
                    success: function (data) {
                        $("#doctor").html(data);
                    }
                });
            }

            function getFee(val) {
                $.ajax({
                    type: "POST",
                    url: "getfee.php",
                    data: 'doctor=' + val,
                    success: function (data) {
                        $("#fees").val(data);
                    }
                });
            }

            $('select[name="Doctorspecialization"]').change(function () {
                getDoctors($(this).val());
            });

            $('select[name="doctor"]').change(function () {
                getFee($(this).val());
            });
        });
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
                            <h1 class="mainTitle">Patient | Book Appointment</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><span>Patient</span></li>
                            <li class="active"><span>Book Appointment</span></li>
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
                                            <h5 class="panel-title">Book Appointment</h5>
                                        </div>
                                        <div class="panel-body">
                                            <form role="form" name="book" method="post">
                                                <div class="form-group">
                                                    <label for="Doctorspecialization">Doctor Specialization</label>
                                                    <select name="Doctorspecialization" class="form-control" required>
                                                        <option value="">Select Specialization</option>
                                                        <?php
                                                        $ret = mysqli_query($conn, "SELECT * FROM doctorspecilization");
                                                        while ($row = mysqli_fetch_array($ret)) {
                                                            echo "<option value='" . htmlentities($row['specilization']) . "'>" . htmlentities($row['specilization']) . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="doctor">Doctors</label>
                                                    <select name="doctor" id="doctor" class="form-control" required>
                                                        <option value="">Select Doctor</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fees">Consultancy Fees</label>
                                                    <input type="text" name="fees" id="fees" class="form-control" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="appdate">Appointment Date</label>
                                                    <input type="date" name="appdate" class="form-control datepicker" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="apptime">Appointment Time</label>
                                                    <input type="time" name="apptime" class="form-control timepicker" required>
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-o btn-primary">Submit</button>
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
</div>

</body>
</html>

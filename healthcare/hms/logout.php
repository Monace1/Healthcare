<?php
session_start();
include('include/config.php');

// Update logout time in userlog table
if(isset($_SESSION['id'])) {
    $ldate = date('Y-m-d H:i:s'); // Use MySQL datetime format for consistency
    $uid = $_SESSION['id'];

    // Perform the update query
    $query = "UPDATE userlog SET logout = '$ldate' WHERE uid = '$uid' ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($result) {
        // Logout user
        session_unset();
        session_destroy();
        $_SESSION['errmsg'] = "You have successfully logged out";
    } else {
        $_SESSION['errmsg'] = "Failed to update logout time";
    }
} else {
    $_SESSION['errmsg'] = "Session ID not found";
}

// Redirect to login page
echo "<script>window.location.href='./user-login.php';</script>";
?>

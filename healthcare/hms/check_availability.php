<?php 
require_once("include/config.php");

if(!empty($_POST["email"])) {
    $email = $_POST["email"];
    
    $query = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $query->store_result();
    $count = $query->num_rows;
    
    if($count > 0) {
        echo "<span style='color:red'> Email already exists.</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        echo "<span style='color:green'> Email available for Registration.</span>";
        echo "<script>$('#submit').prop('disabled', false);</script>";
    }
    
    $query->close();
}
?>


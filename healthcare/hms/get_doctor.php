<?php
include('include/config.php');

if (!empty($_POST["specilizationid"])) {
    $specilizationid = $_POST["specilizationid"];
    
    $stmt = $conn->prepare("SELECT id, doctorName FROM doctors WHERE specilization = ?");
    $stmt->bind_param("s", $specilizationid);
    $stmt->execute();
    $stmt->bind_result($id, $doctorName);
    
    echo '<option selected="selected">Select Doctor</option>';
    
    while ($stmt->fetch()) {
        echo '<option value="' . htmlentities($id) . '">' . htmlentities($doctorName) . '</option>';
    }
    
    $stmt->close();
}

if (!empty($_POST["doctor"])) {
    $doctorid = $_POST["doctor"];
    
    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT docFees FROM doctors WHERE id = ?");
    $stmt->bind_param("i", $doctorid);
    $stmt->execute();
    $stmt->bind_result($docFees);
    $stmt->fetch();
    
    echo '<option value="' . htmlentities($docFees) . '">' . htmlentities($docFees) . '</option>';
    
    $stmt->close();
}

$conn->close();
?>

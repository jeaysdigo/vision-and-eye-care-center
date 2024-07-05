<?php
require 'connect.php';
if(isset($_POST['appointmentId'])) {

    $appointmentId = $_POST['appointmentId'];
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE appointments SET Status = 'Completed' WHERE AppointmentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointmentId);

    if ($stmt->execute() === TRUE) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "error";
}
?>

<?php
require 'connect.php';
if(isset($_POST['appointmentId'])) {
    // Get the appointment ID from the POST request
    $appointmentId = $_POST['appointmentId'];
    
    

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to update appointment status to "Cancelled"
    $sql = "UPDATE appointments SET Status = 'Approved' WHERE AppointmentID = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointmentId);

    // Execute the update statement
    if ($stmt->execute() === TRUE) {
        // Appointment successfully cancelled
        echo "success";
    } else {
        // Failed to cancel appointment
        echo "error";
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If appointmentId is not set in the POST request
    echo "error";
}
?>

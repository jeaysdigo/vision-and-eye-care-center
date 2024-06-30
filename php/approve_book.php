<?php
require 'connect.php';

if (isset($_POST['appointmentId'])) {
    // Get the appointment ID from the POST request
    $appointmentId = $_POST['appointmentId'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to update appointment status to "Approved"
    $sql = "UPDATE appointments SET Status = 'Approved' WHERE AppointmentID = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $appointmentId);

    // Execute the update statement
    if ($stmt->execute() === TRUE) {
        // Fetch appointment details for notification
        $fetchSql = "SELECT appointments.PatientID, appointments.AppointmentDate, doctors.FirstName, doctors.LastName
                     FROM appointments
                     JOIN doctors ON appointments.DoctorID = doctors.DoctorID
                     WHERE appointments.AppointmentID = ?";
        $fetchStmt = $conn->prepare($fetchSql);
        $fetchStmt->bind_param("i", $appointmentId);
        $fetchStmt->execute();
        $fetchStmt->bind_result($patientId, $appointmentDate, $doctorFirstName, $doctorLastName);
        $fetchStmt->fetch();
        $fetchStmt->close();

        // Prepare SQL statement to insert notification
        $notificationTitle = 'Appointment Approved!';
        $notificationMessage = "Your appointment on " . date('F j, Y \a\t g:i A', strtotime($appointmentDate)) . " has been approved by Dr. $doctorFirstName $doctorLastName.";
        $notificationType = 'Appointment';

        $insertSql = "INSERT INTO notifications (user_id, title, message, type, is_read, created_at, updated_at)
                      VALUES (?, ?, ?, ?, 0, NOW(), NOW())";
        $insertStmt = $conn->prepare($insertSql);
        if ($insertStmt === false) {
            die("Error preparing insert statement: " . $conn->error);
        }

        $insertStmt->bind_param("isss", $patientId, $notificationTitle, $notificationMessage, $notificationType);

        // Execute the insert statement
        if ($insertStmt->execute() === TRUE) {
            echo "success";
        } else {
            echo "error: " . $insertStmt->error;
        }

        // Close prepared statement
        $insertStmt->close();
    } else {
        echo "error: " . $stmt->error;
    }

    // Close update statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "error: No appointment ID provided.";
}
?>

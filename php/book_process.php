<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $selectedDate = htmlspecialchars($_POST['selectedDate']);
    $service = htmlspecialchars($_POST['service']);
    $note = htmlspecialchars($_POST['note'] ?? '-'); // Use default if note is not provided
    $doctorId = htmlspecialchars($_POST['doctorId']);
    $selectedTime24h = htmlspecialchars($_POST['selectedTime24h']);
    $patientId = $_SESSION['patientId']; 
    
    // Convert selectedDate and selectedTime24h to a single datetime value
    $appointmentDateTime = date('Y-m-d H:i:s', strtotime("$selectedDate $selectedTime24h"));

    // Prepare an insert statement
    $sql = "INSERT INTO appointments (PatientID, DoctorID, AppointmentDate, Notes, Status, ServiceID)
            VALUES (?, ?, ?, ?, 'InReview', ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("iissi", $patientId, $doctorId, $appointmentDateTime, $note, $service);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "success"; // Appointment scheduled successfully
        } else {
            echo "error: " . $stmt->error; // Error inserting data
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error: Could not prepare SQL statement.";
    }

    // Close connection
    $conn->close();
} else {
    echo "Error: Form submission method is not POST.";
}
?>

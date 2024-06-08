<?php
// Include database connection file
require 'connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $selectedDate = $_POST['selectedDate'];
    $selectedTime24h = $_POST['selectedTime24h'];
    $patientId = $_SESSION['patientId']; // Assuming you have a patient ID available from the form
    
    // Convert selectedDate and selectedTime24h to a single datetime value
    $appointmentDateTime = date('Y-m-d H:i:s', strtotime("$selectedDate $selectedTime24h"));
    
   $sql = "INSERT INTO appointments (PatientID, AppointmentDate, Notes, Status, ServiceID)
            VALUES (33, $appointmentDateTime, 'default_note', 'Scheduled',22)";

    if (mysqli_query($conn, $sql)) {
        echo "success"; // User registered successfully
    } else {
        echo "error"; // Error inserting data
    }

    // Close statement
    $stmt->close();
} else {
    echo "Error: Form submission method is not POST.";
}
?>

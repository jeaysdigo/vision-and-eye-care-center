<?php
require_once "connect.php"; // Ensure this file includes your database connection details

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the doctor_id parameter is set in the GET request
if (isset($_GET['patient_id'])) {
    // Sanitize the input to prevent SQL injection
    $patient_id = $conn->real_escape_string($_GET['patient_id']);

    // Query to fetch doctor details based on DoctorID
    $sql = "SELECT * FROM patients WHERE PatientID = $patient_id";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Send the doctor details as JSON response
        echo json_encode([
            'first_name' => $row['FirstName'],
            'last_name' => $row['LastName'],
            'email' => $row['Email'],
            'bday' => $row['DateOfBirth'],
            'gender' => $row['Gender'],
            'contact' => $row['ContactNumber'],
            'occupation' => $row['Occupation'],
            'address' => $row['Address'],
            'municipality' => $row['Municipality'],
            'city' => $row['City'],
            'zipcode' => $row['ZipCode'],
            // Add other fields if needed
        ]);
    } else {
        // Doctor not found
        echo json_encode(['error' => 'Patient not found']);
    }
} else {
    // Doctor ID parameter not provided
    echo json_encode(['error' => 'Patient ID parameter not provided']);
}

// Close connection
$conn->close();
?>

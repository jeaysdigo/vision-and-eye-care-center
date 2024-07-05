<?php
require_once "connect.php"; // Ensure this file includes your database connection details

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the necessary POST parameters are set
if (isset($_POST['doctor_id'])) {
    // Sanitize and validate input data
    $doctor_id = $conn->real_escape_string($_POST['doctor_id']);
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $bday = $conn->real_escape_string($_POST['bday']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $address = $conn->real_escape_string($_POST['address']);
    $municipality = $conn->real_escape_string($_POST['municipality']);
    $city = $conn->real_escape_string($_POST['city']);
    $zipcode = $conn->real_escape_string($_POST['zipcode']);

    // Query to update doctor details in the database
    $sql = "UPDATE doctors SET 
            FirstName = '$first_name',
            LastName = '$last_name',
            Email = '$email',
            DateOfBirth = '$bday',
            Gender = '$gender',
            ContactNumber = '$contact',
            Address = '$address',
            Municipality = '$municipality',
            City = '$city',
            ZipCode = '$zipcode'
            WHERE DoctorID = $doctor_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Success message
        echo json_encode(['success' => 'Doctor details updated successfully']);
    } else {
        // Error message
        echo json_encode(['error' => 'Error updating doctor details: ' . $conn->error]);
    }
} else {
    // Error message if POST parameters are not provided
    echo json_encode(['error' => 'Required parameters not provided']);
}

// Close connection
$conn->close();
?>

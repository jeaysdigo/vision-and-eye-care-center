<?php
session_start();
require_once 'connect.php'; // Include your database connection file

// Function to respond with a JSON message
function jsonResponse($status, $message) {
    echo json_encode(array("status" => $status, "message" => $message));
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['patientId']) && !isset($_SESSION['doctorId'])) {
    jsonResponse("error", "Unauthorized access.");
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    // Basic validation
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        jsonResponse("error", "All fields are required.");
    }

    if ($newPassword !== $confirmPassword) {
        jsonResponse("error", "New password and confirm password do not match.");
    }

    // Determine user type and set query parameters
    if (isset($_SESSION['patientId'])) {
        $userId = $_SESSION['patientId'];
        $table = 'patients';
        $idField = 'PatientID';
    } elseif (isset($_SESSION['doctorId'])) {
        $userId = $_SESSION['doctorId'];
        $table = 'doctors';
        $idField = 'DoctorID';
    } else {
        jsonResponse("error", "User not identified.");
    }

    // Fetch the hashed password from the database
    $stmt = $conn->prepare("SELECT password FROM $table WHERE $idField = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify the current password
    if (!password_verify($currentPassword, $storedPassword)) {
        jsonResponse("error", "Current password is incorrect.");
    }

    // Update the password in the database
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE $table SET password = ? WHERE $idField = ?");
    $stmt->bind_param("si", $hashedPassword, $userId);

    if ($stmt->execute()) {
        jsonResponse("success", "Password updated successfully.");
    } else {
        jsonResponse("error", "Error updating password.");
    }

    $stmt->close();
    $conn->close();
}
?>

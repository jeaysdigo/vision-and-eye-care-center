<?php
require_once 'connect.php';

// Function to sanitize user input
function sanitizeInput($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
}

// Function to check if user exists and retrieve user details
function getUserDetails($conn, $input) {
    // Check if the input is a valid email or phone number
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        // Input is an email, proceed with email validation
        $condition = "Email = ?";
    } else {
        // Input is assumed to be a phone number
        // Convert Philippine country code (+63) to 0
        if (substr($input, 0, 3) === "+63") {
            $input = "0" . substr($input, 3);
        }

        // Construct the condition for phone number validation
        $condition = "ContactNumber = ?";
    }

    // Check if the user exists in the patients table
    $sql_patient = "SELECT * FROM patients WHERE $condition";
    $stmt_patient = mysqli_prepare($conn, $sql_patient);
    mysqli_stmt_bind_param($stmt_patient, "s", $input);
    mysqli_stmt_execute($stmt_patient);
    $result_patient = mysqli_stmt_get_result($stmt_patient);

    // Check if the user exists in the doctors table
    $sql_doctor = "SELECT * FROM doctors WHERE $condition";
    $stmt_doctor = mysqli_prepare($conn, $sql_doctor);
    mysqli_stmt_bind_param($stmt_doctor, "s", $input);
    mysqli_stmt_execute($stmt_doctor);
    $result_doctor = mysqli_stmt_get_result($stmt_doctor);

    $user_details = [];

    // Check if user exists as patient
    if (mysqli_num_rows($result_patient) > 0) {
        $user_details['type'] = 'patient';
        $user_details['result'] = $result_patient;
    } 
    // Check if user exists as doctor
    elseif (mysqli_num_rows($result_doctor) > 0) {
        $user_details['type'] = 'doctor';
        $user_details['result'] = $result_doctor;
    }

    return $user_details;
}

// Main process on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $input = sanitizeInput($conn, $_POST['email']);
    $password = sanitizeInput($conn, $_POST['password']);

    // Get user details from database
    $user_details = getUserDetails($conn, $input);

    if (empty($user_details)) {
        echo "Email or phone number not found.";
        exit();
    }

    // Fetch user details
    $row = mysqli_fetch_assoc($user_details['result']);

    // Check password for patient
    if ($user_details['type'] === 'patient') {
        if (password_verify($password, $row['Password'])) {
            // Password is correct, start a new session
            session_start();
            // Store patient data in session variables
            $_SESSION['patientId'] = $row['PatientID'];
            $_SESSION['firstName'] = $row['FirstName'];
            $_SESSION['lastName'] = $row['LastName'];
            $_SESSION['email'] = $row['Email'];
            echo "SuccessPatient";
            exit();
        } else {
            echo "Incorrect password.";
            exit();
        }
    }
    // Check password for admin (doctor)
    elseif ($user_details['type'] === 'doctor' && $row['isAdmin'] == 1) {
        if (password_verify($password, $row['Password'])) {
            // Admin found, start a new session
            session_start();
            // Store admin (doctor) data in session variables
            $_SESSION['isAdmin'] = true;
            $_SESSION['doctorId'] = $row['DoctorID'];
            echo "Admin";
            exit();
        } else {
            echo "Incorrect password.";
            exit();
        }
    }
    // Check password for regular doctor
    elseif ($user_details['type'] === 'doctor' && $row['isAdmin'] == 0) {
        if (password_verify($password, $row['Password'])) {
            // Doctor found, start a new session
            session_start();
            // Store doctor data in session variables
            $_SESSION['doctorId'] = $row['DoctorID'];
            $_SESSION['firstName'] = $row['FirstName'];
            $_SESSION['lastName'] = $row['LastName'];
            $_SESSION['email'] = $row['Email'];
            echo "SuccessDoctor";
            exit();
        } else {
            echo "Incorrect password.";
            exit();
        }
    }

    echo "Invalid user type or incorrect password."; // Catch-all error message
}

// Close database connection
mysqli_close($conn);
?>

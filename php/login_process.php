<?php
// Include database connection file
include_once 'connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $input = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the input is a valid email or phone number
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        // Input is an email, proceed with email validation
        $condition = "Email = '$input'";
    } else {
        // Input is assumed to be a phone number
        // Convert Philippine country code (+63) to 0
        if (substr($input, 0, 3) === "+63") {
            $input = "0" . substr($input, 3);
        }

        // Construct the condition for phone number validation
        $condition = "ContactNumber = '$input'";
    }

    // Check if the input exists in the patients table
    $sql_check_patient = "SELECT * FROM patients WHERE $condition";
    $result_check_patient = mysqli_query($conn, $sql_check_patient);

    // Check if the input exists in the doctors table
    $sql_check_doctor = "SELECT * FROM doctors WHERE $condition";
    $result_check_doctor = mysqli_query($conn, $sql_check_doctor);

    if (($result_check_patient && mysqli_num_rows($result_check_patient) == 0) && 
        ($result_check_doctor && mysqli_num_rows($result_check_doctor) == 0)) {
        echo "User not found. Please check your email or phone number.";
        exit();
    }

    // Check if the user is a patient and the password is correct
    $sql_patient = "SELECT * FROM patients WHERE $condition AND Password = '$password'";
    $result_patient = mysqli_query($conn, $sql_patient);

    if ($result_patient && mysqli_num_rows($result_patient) == 1) {
        $row = mysqli_fetch_assoc($result_patient);
        // Password is correct, start a new session
        session_start();
        // Store data in session variables
        $_SESSION['patientId'] = $row['PatientID'];
        $_SESSION['firstName'] = $row['FirstName'];
        $_SESSION['lastName'] = $row['LastName'];
        $_SESSION['email'] = $row['Email'];
        header("Location: ../index.php");
        exit();
    } else {
        // Check if the user is a doctor (admin) and the password is correct
        $sql_admin = "SELECT * FROM doctors WHERE $condition AND Password = '$password' AND isAdmin = 1";
        $result_admin = mysqli_query($conn, $sql_admin);

        if ($result_admin && mysqli_num_rows($result_admin) == 1) {
            // Admin found
            // Start a new session
            session_start();
            // Store data in session variables
            $_SESSION['isAdmin'] = true;
            header("Location: ../admin.php");
            exit();
        } else {
                 // Check if the user is a doctor (admin) and the password is correct
                $sql_admin = "SELECT * FROM doctors WHERE $condition AND Password = '$password' AND isAdmin = 0";
                $result_admin = mysqli_query($conn, $sql_admin);

                if ($result_admin && mysqli_num_rows($result_admin) == 1) {
                    $row = mysqli_fetch_assoc($result_admin);
                    // Admin found
                    // Start a new session
                    session_start();
                    // Store data in session variables
                    $_SESSION['doctorId'] = $row['DoctorID'];
                    $_SESSION['firstName'] = $row['FirstName'];
                    $_SESSION['lastName'] = $row['LastName'];
                    $_SESSION['email'] = $row['Email'];
                    header("Location: ../doctor_index.php");
                    exit();
                } else {
                    echo "Incorrect password.";
                }
        }
    }

    // Close database connection
    mysqli_close($conn);
}
?>

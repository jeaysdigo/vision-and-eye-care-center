<?php
// Include database connection file
require_once 'connect.php';

// Function to sanitize user input
function sanitizeInput($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
}

// Function to check if email or phone number already exists
function checkIfExists($conn, $table, $field, $value) {
    $sql = "SELECT * FROM $table WHERE $field = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $value);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    return mysqli_stmt_num_rows($stmt) > 0;
}

// Function to insert user data
function insertUser($conn, $first_name, $last_name, $email, $hashed_password, $bday, $gender, $contact, $occupation, $address, $municipality, $city, $zipcode) {
    $sql = "INSERT INTO patients (FirstName, LastName, Email, Password, DateOfBirth, Gender, ContactNumber, Occupation, Address, Municipality, City, ZipCode) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssssss", $first_name, $last_name, $email, $hashed_password, $bday, $gender, $contact, $occupation, $address, $municipality, $city, $zipcode);
    return mysqli_stmt_execute($stmt);
}

// Main process on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $first_name = sanitizeInput($conn, $_POST['first_name']);
    $last_name = sanitizeInput($conn, $_POST['last_name']);
    $email = sanitizeInput($conn, $_POST['email']);
    $password = sanitizeInput($conn, $_POST['password']);
    $confirm_password = sanitizeInput($conn, $_POST['confirm_password']);
    $bday = sanitizeInput($conn, $_POST['bday']);
    $gender = sanitizeInput($conn, $_POST['gender']);
    $contact = sanitizeInput($conn, $_POST['contact']);
    $occupation = sanitizeInput($conn, $_POST['occupation']);
    $address = sanitizeInput($conn, $_POST['address']);
    $municipality = sanitizeInput($conn, $_POST['municipality']);
    $city = sanitizeInput($conn, $_POST['city']);
    $zipcode = sanitizeInput($conn, $_POST['zipcode']);

    // Validate password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match";
        exit();
    }

    // Convert Philippine country code (+63) to 0
    if (substr($contact, 0, 3) === "+63") {
        $contact = "0" . substr($contact, 3);
    } else if (substr($contact, 0, 2) === "63") {
        $contact = "0" . substr($contact, 2);
    }

    // Check if email or phone number already exists
    if (checkIfExists($conn, "patients", "ContactNumber", $contact)) {
        echo "Phone number already in use";
        exit();
    }

    if (checkIfExists($conn, "patients", "Email", $email)) {
        echo "Email already in use";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into database
    if (insertUser($conn, $first_name, $last_name, $email, $hashed_password, $bday, $gender, $contact, $occupation, $address, $municipality, $city, $zipcode)) {
        echo "User registered successfully";
    } else {
        error_log("Error registering user");
        echo "Error registering user";
    }

    // Close database connection
    mysqli_close($conn);
}
?>

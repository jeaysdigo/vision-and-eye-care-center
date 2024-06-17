<?php
// Include database connection file
include_once 'connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $bday = mysqli_real_escape_string($conn, $_POST['bday']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $municipality = mysqli_real_escape_string($conn, $_POST['municipality']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);

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

    // Check if the phone number already exists in the database
    $sql_check_number = "SELECT * FROM patients WHERE ContactNumber = '$contact'";
    $result_check_number = mysqli_query($conn, $sql_check_number);

    if ($result_check_number && mysqli_num_rows($result_check_number) > 0) {
        echo "Phone number already in use";
        exit();
    }

    // Check if the email already exists in the database
    $sql_check_email = "SELECT * FROM patients WHERE Email = '$email'";
    $result_check_email = mysqli_query($conn, $sql_check_email);

    if ($result_check_email && mysqli_num_rows($result_check_email) > 0) {
        echo "Email already in use";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into database
    $sql = "INSERT INTO patients (FirstName, LastName, Email, Password, DateOfBirth, Gender, ContactNumber, Occupation, Address, Municipality, City, ZipCode)
            VALUES ('$first_name', '$last_name', '$email', '$hashed_password', '$bday', '$gender', '$contact', '$occupation', '$address', '$municipality', '$city', '$zipcode')";

    if (mysqli_query($conn, $sql)) {
        echo "User registered successfully";
    } else {
        error_log("Error: " . mysqli_error($conn));
        echo "Error registering user";
    }

    // Close database connection
    mysqli_close($conn);
}
?>

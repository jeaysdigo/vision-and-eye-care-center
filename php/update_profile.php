<?php
// Include the connect.php file
require_once 'connect.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize_input($data) {
    // Remove leading and trailing whitespace
    $data = trim($data);
    // Remove backslashes
    $data = stripslashes($data);
    // Prevent XSS attacks
    $data = htmlspecialchars($data);
    return $data;
}

// Handle form submission via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['patient_id'])) {
    // Sanitize inputs
    $patient_id = sanitize_input($_POST["patient_id"]);
    $first_name = sanitize_input($_POST["first_name"]);
    $last_name = sanitize_input($_POST["last_name"]);
    $email = sanitize_input($_POST["email"]);
    $bday = sanitize_input($_POST["bday"]);
    $gender = sanitize_input($_POST["gender"]);
    $contact = sanitize_input($_POST["contact"]);
    $occupation = sanitize_input($_POST["occupation"]);
    $address = sanitize_input($_POST["address"]);
    $municipality = sanitize_input($_POST["municipality"]);
    $city = sanitize_input($_POST["city"]);
    $zipcode = sanitize_input($_POST["zipcode"]);

 // Check if email is unique in patients table
$stmt_check_email = $conn->prepare("SELECT PatientID FROM patients WHERE Email=? AND PatientID != ?");
$stmt_check_email->bind_param("si", $email, $patient_id);
$stmt_check_email->execute();
$result_email = $stmt_check_email->get_result();

// Check if contact number is unique in patients table
$stmt_check_contact = $conn->prepare("SELECT PatientID FROM patients WHERE ContactNumber=? AND PatientID != ?");
$stmt_check_contact->bind_param("si", $contact, $patient_id);
$stmt_check_contact->execute();
$result_contact = $stmt_check_contact->get_result();

// Check if email is unique in doctors table
$stmt_check_email2 = $conn->prepare("SELECT DoctorID FROM doctors WHERE Email=? AND DoctorID != ?");
$stmt_check_email2->bind_param("si", $email, $patient_id); // Use DoctorID here instead of PatientID
$stmt_check_email2->execute();
$result_email2 = $stmt_check_email2->get_result();

// Check if contact number is unique in doctors table
$stmt_check_contact2 = $conn->prepare("SELECT DoctorID FROM doctors WHERE ContactNumber=? AND DoctorID != ?");
$stmt_check_contact2->bind_param("si", $contact, $patient_id); // Use DoctorID here instead of PatientID
$stmt_check_contact2->execute();
$result_contact2 = $stmt_check_contact2->get_result();


    // If email or contact number already exists for another user
    if ($result_email->num_rows > 0) {
        $response = array("success" => false, "message" => "Email address is already in use.");
        echo json_encode($response);
    } elseif ($result_contact->num_rows > 0) {
        $response = array("success" => false, "message" => "Contact number is already in use.");
        echo json_encode($response);
    } elseif ($result_email2->num_rows > 0) {
        $response = array("success" => false, "message" => "Contact number is already in use.");
        echo json_encode($response);
    } elseif ($result_contact2->num_rows > 0) {
        $response = array("success" => false, "message" => "Contact number is already in use.");
        echo json_encode($response);
    } else {
        // Update user profile
        $stmt_update = $conn->prepare("UPDATE patients SET FirstName=?, LastName=?, Email=?, DateOfBirth=?, Gender=?, ContactNumber=?, Occupation=?, Address=?, Municipality=?, City=?, ZipCode=? WHERE PatientID=?");
        $stmt_update->bind_param("sssssssssssi", $first_name, $last_name, $email, $bday, $gender, $contact, $occupation, $address, $municipality, $city, $zipcode, $patient_id);

        // Execute update
        if ($stmt_update->execute()) {
            $response = array("success" => true);
            echo json_encode($response);
        } else {
            $response = array("success" => false, "message" => "Failed to update profile: " . $conn->error);
            echo json_encode($response);
        }

        // Close statement
        $stmt_update->close();
    }

    // Close result sets and statements
    $result_email->close();
    $stmt_check_email->close();
    $result_contact->close();
    $stmt_check_contact->close();
}

// Close connection
$conn->close();
?>

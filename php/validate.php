<?php
require_once 'connect.php';
session_start();

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email'])) {
  $email = $_POST['email'];

  // Check if email exists in doctors or patients table
  $sqlDoctors = "SELECT * FROM doctors WHERE Email = '$email'";
  $sqlPatients = "SELECT * FROM patients WHERE Email = '$email'";
  
  $resultDoctors = $conn->query($sqlDoctors);
  $resultPatients = $conn->query($sqlPatients);

  if ($resultDoctors->num_rows > 0) {
    echo "Email already exists";
  } elseif ($resultPatients->num_rows > 0) {
    echo "Email already exists";
  } else {
    echo "Email available";
  }
}

if (isset($_POST['contact'])) {
  $contact = $_POST['contact'];

  // Check if contact number exists in doctors or patients table
  $sqlDoctors = "SELECT * FROM doctors WHERE ContactNumber = '$contact'";
  $sqlPatients = "SELECT * FROM patients WHERE ContactNumber = '$contact'";
  
  $resultDoctors = $conn->query($sqlDoctors);
  $resultPatients = $conn->query($sqlPatients);

  if ($resultDoctors->num_rows > 0) {
    echo "Contact number already exists";
  } elseif ($resultPatients->num_rows > 0) {
    echo "Contact number already exists";
  } else {
    echo "Contact number available";
  }
}

if (isset($_POST['case_no'])) {
  $case_no = $_POST['case_no'];

  // Check if contact number exists in doctors or patients table
  $sql = "SELECT * FROM test WHERE case_no = '$case_no'";
  
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "case_no_exist";
  } else {
    echo "case_no_available";
  }
}

$conn->close();
?>

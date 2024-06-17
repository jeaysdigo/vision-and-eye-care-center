<?php
require_once 'connect.php';
// Start the session
session_start();

// Function to sanitize inputs
function sanitizeInput($input) {
    global $conn; // Assuming $conn is your database connection

    // Use mysqli_real_escape_string to escape inputs
    return mysqli_real_escape_string($conn, trim($input));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $patientId = sanitizeInput($_POST['PatientID']);
    $doctorId = sanitizeInput($_POST['DoctorID']);
    $walkIn = sanitizeInput($_POST['walkIn']);
    $firstName = sanitizeInput($_POST['FirstName']);
    $lastName = sanitizeInput($_POST['LastName']);
    $dateOfBirth = sanitizeInput($_POST['DateOfBirth']);
    $gender = sanitizeInput($_POST['Gender']);
    $contactNumber = sanitizeInput($_POST['ContactNumber']);
    $occupation = sanitizeInput($_POST['Occupation']);
    $email = sanitizeInput($_POST['Email']);
    $address = sanitizeInput($_POST['Address']);
    $municipality = sanitizeInput($_POST['Municipality']);
    $city = sanitizeInput($_POST['City']);
    $zipCode = sanitizeInput($_POST['ZipCode']);
    $caseNo = sanitizeInput($_POST['case_no']);
    $coNo = sanitizeInput($_POST['co_no']);
    $bpSys = sanitizeInput($_POST['bp_sys']);
    $bpDia = sanitizeInput($_POST['bp_dia']);
    $respRate = sanitizeInput($_POST['resp_rate']);
    $pulseRate = sanitizeInput($_POST['pulse_rate']);
    $glassesOdSph = sanitizeInput($_POST['glasses_od_sph']);
    $glassesOdCyl = sanitizeInput($_POST['glasses_od_cyl']);
    $glassesOdAdd = sanitizeInput($_POST['glasses_od_add']);
    $glassesOsSph = sanitizeInput($_POST['glasses_os_sph']);
    $glassesOsCyl = sanitizeInput($_POST['glasses_os_cyl']);
    $glassesOsAdd = sanitizeInput($_POST['glasses_os_add']);
    $contactLensOd = sanitizeInput($_POST['contact_lens_od']);
    $contactLensOs = sanitizeInput($_POST['contact_lens_os']);
    $typeScl = isset($_POST['type_scl']) ? 1 : 0;
    $typeGp = isset($_POST['type_gp']) ? 1 : 0;
    $typeToric = isset($_POST['type_toric']) ? 1 : 0;

    // Build the SQL query with sanitized values
    $sql = "INSERT INTO test (
        PatientID,
        DoctorID,
        walkin,
        FirstName, 
        LastName, 
        DateOfBirth, 
        Gender, 
        ContactNumber, 
        Occupation, 
        Email, 
        Address, 
        Municipality, 
        City, 
        ZipCode, 
        case_no, 
        co_no, 
        bp_sys, 
        bp_dia, 
        resp_rate, 
        pulse_rate, 
        glasses_od_sph, 
        glasses_od_cyl, 
        glasses_od_add, 
        glasses_os_sph, 
        glasses_os_cyl, 
        glasses_os_add, 
        contact_lens_od, 
        contact_lens_os, 
        type_scl, 
        type_gp, 
        type_toric
    ) VALUES (
        '$patientId',
        '$doctorId',
        '$walkIn',
        '$firstName',
        '$lastName',
        '$dateOfBirth',
        '$gender',
        '$contactNumber',
        '$occupation',
        '$email',
        '$address',
        '$municipality',
        '$city',
        '$zipCode',
        '$caseNo',
        '$coNo',
        '$bpSys',
        '$bpDia',
        '$respRate',
        '$pulseRate',
        '$glassesOdSph',
        '$glassesOdCyl',
        '$glassesOdAdd',
        '$glassesOsSph',
        '$glassesOsCyl',
        '$glassesOsAdd',
        '$contactLensOd',
        '$contactLensOs',
        '$typeScl',
        '$typeGp',
        '$typeToric'
    )";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>

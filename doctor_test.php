<?php
// Include the connect.php file
require_once 'php/connect.php';
date_default_timezone_set("Asia/Manila");
// Start the session
session_start();
if (!isset($_SESSION['doctorId'])) { 
    header('location: index.php');
}

$doctorId = $_SESSION['doctorId'];
$patientId = isset($_GET['id']) ? $_GET['id'] : 999999999;
$walkin = isset($_GET['id']) ? 0 : 1;


// Initialize variables
$firstName = '';
$lastName = '';
$dateOfBirth = '';
$gender = '';
$contactNumber = '';
$occupation = '';
$email = '';
$address = '';
$municipality = '';
$city = '';
$zipCode = '';

// init step 3
$visualAcuityUnaidedDistanceOd = '';
$visualAcuityUnaidedDistanceOs = '';
$visualAcuityUnaidedDistanceOu = '';
$visualAcuityUnaidedNearOd = '';
$visualAcuityUnaidedNearOs = '';
$visualAcuityUnaidedNearOu = '';
$visualAcuityPinholeOd = '';
$visualAcuityPinholeOs = '';
$visualAcuityFarOd = '';
$visualAcuityFarOs = '';
$visualAcuityFarOu = '';
$visualAcuityNearOd = '';
$visualAcuityNearOs = '';
$visualAcuityNearOu = '';
$pupilShapeOd = '';
$pupilShapeOs = '';
$pupilDiameterOd = '';
$pupilDiameterOs = '';
$pd = '';
$de = '';
$eyesNotAligned = '';
$abnormalHeadPosture = '';
$faceTiltDirection = '';
$headTiltDirection = '';
$otherPertinentObservations = '';
$motorSensoryPushUpAmp = '';
$motorSensoryNpc = '';
$motorSensoryCornealReflexOd = '';
$motorSensoryCornealReflexOs = '';
$motorSensoryAlternateCoverTestFarSc = '';
$motorSensoryAlternateCoverTestFarCc = '';
$motorSensoryAlternateCoverTestNearSc = '';
$motorSensoryAlternateCoverTestNearCc = '';
$motorSensoryMotilityTestSmoothPursuit = '';
$motorSensoryMotilityTestSaccadic = '';
$motorSensoryPupillaryReflexDlrOd = '';
$motorSensoryPupillaryReflexDlrOs = '';
$motorSensoryPupillaryReflexIndirectOd = '';
$motorSensoryPupillaryReflexIndirectOs = '';
$motorSensoryPupillaryReflexAccommodationOd = '';
$motorSensoryPupillaryReflexAccommodationOs = '';
$motorSensoryPupillaryReflexSwingingFlashlightOd = '';
$motorSensoryPupillaryReflexSwingingFlashlightOs = '';
$motorSensoryAmslerTestOd = '';
$motorSensoryAmslerTestOs = '';
$motorSensoryProjTestOd = '';
$motorSensoryProjTestOs = '';




// Check if id is provided via GET parameter
if (isset($_GET['id'])) {
    $patientId = $_GET['id'];

    // SQL query to fetch patient data
    $sql = "SELECT * FROM patients WHERE PatientID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $patientId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // Populate variables with fetched data
            $firstName = $row['FirstName'];
            $lastName = $row['LastName'];
            $dateOfBirth = $row['DateOfBirth'];
            $gender = $row['Gender'];
            $contactNumber = $row['ContactNumber'];
            $occupation = $row['Occupation'];
            $email = $row['Email'];
            $address = $row['Address'];
            $municipality = $row['Municipality'];
            $city = $row['City'];
            $zipCode = $row['ZipCode'];
        } else {
            header('location: error.php');
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/fabric@4.5.1/dist/fabric.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    /* Stepper styles */
    .step {
      display: none;
    }
    .step.active {
      display: block;
    }
    .stepper-button {
      margin: 10px 0;
    }
  </style>
</head>
<body class="bg-gray-50">

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
      <button onclick="window.history.back();" class="text-gray-600 hover:text-blue-500 ml-2">
                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
            </button>
            <div class="text-center p-2 flex font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Comprehensive Eye Examination</div>
            <div class="w-10 h-10"></div> 
      </div>
      <div class="flex sm:justify-start justify-center">
        <div class="step-count text-left sm:text-base text-sm">
             <span id="current-step">1</span>/<span id="total-steps">5</span>
        </div>
    </div>
    </div>
  </div>
</nav>


<section class="mb-8 pb-8 max-w-4xl mx-auto mt-8 pt-8 bg-white border">
  <div class="mx-auto max-w-md flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

    <form id="form" action="php/test_process.php" method="post">
    <div class="text-gray-900 bg-blue-50 rounded-md p-4 dark:text-white mt-0 flex flex-col items-start space-y-0">
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(0)">1. Patient's Profile</button>
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(1)">2. Patient's History</button>
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(2)">3. Prelim Exam & General Observation</button>
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(3)">4. Objective Refraction</button>
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(4)">5. Subjective Refraction</button>
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(5)">6. Photometric Test</button>
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(6)">7. Supplemental Test</button>
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(7)">8. Trial Framing</button>
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(8)">9. Biomicroscopy</button>
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(9)">10. Intra-ocular Pressure</button>
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(10)">11. Posterior Segment Exam</button>
        <button type="button" class="step-button text-blue-800 text-sm hover:underline md:me-6" onclick="goToStep(11)">12. Assessment & Evaluation</button>
    </div>
 
      <!-- Step 1 -->
    <div class="step active">
        <input type="text" id="PatientID" name="PatientID" class="hidden" required value="<?php echo $patientId; ?>">
        <input type="text" id="DoctorID" name="DoctorID" class="hidden" required value="<?php echo $doctorId; ?>">
        <input type="text" id="walkIn" name="walkIn" class="hidden" required value="<?php echo $walkin; ?>">

        <p class="font-medium my-4">I. Patient's Profile</p>
        <label for="FirstName">First Name:  <span class="text-red-600 text-sm">* </span> </label>
        <input type="text" id="FirstName" name="FirstName" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $firstName; ?>"><br><br>

        <label for="LastName">Last Name:  <span class="text-red-600 text-sm">* </span></label>
        <input type="text" id="LastName" name="LastName" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $lastName; ?>"><br><br>

        <label for="DateOfBirth">Patient's Birthday:</label>
        <?php $dateOfBirth = isset($dateOfBirth) && !empty($dateOfBirth) ? $dateOfBirth : date('Y-m-d'); ?>
        <input type="date" id="DateOfBirth" name="DateOfBirth" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $dateOfBirth; ?>"><br><br>

        <label for="Gender">Gender:</label>
        <select id="Gender" name="Gender" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
          <option value="Male" <?php echo ($gender === 'Male') ? 'selected' : ''; ?>>Male</option>
          <option value="Female" <?php echo ($gender === 'Female') ? 'selected' : ''; ?>>Female</option>
          <option value="Other" <?php echo ($gender === 'Other') ? 'selected' : ''; ?>>Other</option>
        </select><br><br>

        <label for="ContactNumber">Contact Number:</label>
        <input type="text" id="ContactNumber" name="ContactNumber" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $contactNumber; ?>"><br><br>

        <label for="Occupation">Occupation:</label>
        <input type="text" id="Occupation" name="Occupation" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $occupation; ?>"><br><br>

        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $email; ?>"><br><br>

        <label for="Address">Home Address:</label>
        <input type="text" id="Address" name="Address" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $address; ?>"><br><br>

        <label for="Municipality">Municipality:</label>
        <input type="text" id="Municipality" name="Municipality" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $municipality; ?>"><br><br>

        <label for="City">City:</label>
        <input type="text" id="City" name="City" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $city; ?>"><br><br>

        <label for="ZipCode">Zip Code:</label>
        <input type="text" id="ZipCode" name="ZipCode" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $zipCode; ?>"><br><br>

        <div class="mb-4">
            <label for="case_no">Case Number: <span class="text-red-600 text-sm">* </span></label>
            <input type="text" id="case_no" name="case_no" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" required>
            <p class="text-sm text-red-600 dark:text-red-500" id="case_no-error"></p>
        </div>

        <label for="co_no">CO Number:  <span class="text-red-600 text-sm">* </span></label>
        <input type="text" id="co_no" name="co_no" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <label for="bp">Blood Pressure:</label>
        <div class="flex p-2">
            <input type="text" id="bp_sys" name="bp_sys" placeholder="SYS"class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            <p class="w-4 m-2 text-gray-600"> / </p>
            <input type="text" id="bp_dia" name="bp_dia" placeholder="DIA" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>
        </div>

        <label for="resp_rate">Respiratory Rate:</label>
        <input type="text" id="resp_rate" name="resp_rate" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <label for="pulse_rate">Pulse Rate:</label>
        <input type="text" id="pulse_rate" name="pulse_rate" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        Glasses
        <div class="flex space-x-4 mb-2">
            <div class="w-1/4">
                <p for="glasses_od">OD:</p>
            </div>
            <div class="w-1/4">
                <input type="text" id="glasses_od" name="glasses_od_sph" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" placeholder="Sph">
            </div>
            <div class="w-1/4">
                <input type="text" id="glasses_od" name="glasses_od_cyl" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" placeholder="Cyl">
            </div>
            <div class="w-1/4">
                <input type="text" id="glasses_od" name="glasses_od_add" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" placeholder="Add">
            </div>
        </div>
        
        <div class="flex space-x-4">
            <div class="w-1/4">
                <p for="glasses_os">OS:</p>
            </div>
            <div class="w-1/4">
                <input type="text" id="glasses_os_sph" name="glasses_os_sph" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" placeholder="Sph">
            </div>
            <div class="w-1/4">
                <input type="text" id="glasses_os_cyl" name="glasses_os_cyl" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" placeholder="Cyl">
            </div>
            <div class="w-1/4">
                <input type="text" id="glasses_os_add" name="glasses_os_add" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" placeholder="Add">
            </div>
        </div>

        Contact Lens
        <div class="flex space-x-4">
            <div class="w-1/4">
                <label for="contact_lens_od">OD:</label> </div>
            <div class="w-full">
                <input type="text" id="contact_lens_od" name="contact_lens_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>
            </div>
        </div>
        <div class="flex space-x-4">
            <div class="w-1/4">
                <label for="contact_lens_od">OS:</label> </div>
            <div class="w-full">
                <input type="text" id="contact_lens_os" name="contact_lens_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>
            </div>
        </div>

        <div class="space-y-2">
            <div class="flex items-center">
                <input type="checkbox" id="type_scl" name="type_scl" value="1" class="h-5 w-5 text-blue-600 rounded border-blue-300 focus:ring-indigo-500">
                <label for="type_scl" class="ml-2 text-sm text-gray-700">Type Scl</label>
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="type_gp" name="type_gp" value="1" class="h-5 w-5 text-blue-600 rounded border-blue-300 focus:ring-indigo-500">
                <label for="type_gp" class="ml-2 text-sm text-gray-700">Type GP</label>
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="type_toric" name="type_toric" value="1" class="h-5 w-5 text-blue-600 rounded border-blue-300 focus:ring-indigo-500">
                <label for="type_toric" class="ml-2 text-sm text-gray-700">Type Toric</label>
            </div>
        </div>


        <button type="button" class="stepper-button w-full h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="nextStep()">Next</button>
    </div>
    
    <!-- step 2  -->
    <div class="step">
        <p class="font-medium my-4">II. Patient's History</p>
        <label for="visual_ocular">Visual and Ocular:</label>
        <textarea id="visual_ocular" name="visual_ocular" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"></textarea><br><br>

        <p class="font-medium mb-2">Medical</p>
        <label for="medical_history_present">Present Illness:</label>
        <textarea id="medical_history_present" name="medical_history_present" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"></textarea><br><br>

        <label for="medical_history_past">Past History:</label>
        <textarea id="medical_history_past" name="medical_history_past" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"></textarea><br><br>

        <p class="font-medium mb-2">Family History:</p>
        <label for="family_history_ocular">Ocular:</label>
        <textarea id="family_history_ocular" name="family_history_ocular" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"></textarea><br><br>

        <label for="family_history_medical">Medical:</label>
        <textarea id="family_history_medical" name="family_history_medical" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"></textarea><br><br>

        <div class="space-x-4">
            <div class="flex items-center">
            <button type="button" class="w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="prevStep()">Previous</button>
            <button type="button" class="w-1/2 stepper-button h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="nextStep()">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 3 -->
    <div class="step">
        <p class="font-medium my-4">III. Prelim Exam & General Observation</p>
        <p class="font-medium">Unaided Distance </p>
        <div class="flex space-x-4 mb-4">
            <div class="w-1/3">
                <label for="visual_acuity_unaided_distance_od" class="text-sm text-gray-600">OD:</label>
                <input type="text" id="visual_acuity_unaided_distance_od" name="visual_acuity_unaided_distance_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="visual_acuity_unaided_distance_os"class="text-sm text-gray-600"> OS:</label>
                <input type="text" id="visual_acuity_unaided_distance_os" name="visual_acuity_unaided_distance_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="visual_acuity_unaided_distance_ou" class="text-sm text-gray-600">OU:</label>
                <input type="text" id="visual_acuity_unaided_distance_ou" name="visual_acuity_unaided_distance_ou" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        
        <p class="font-medium">Unaided Near</p>
        <div class="flex space-x-4 mb-4">
            <div class="w-1/3">
                <label for="visual_acuity_unaided_near_od" class="text-sm text-gray-600">OD:</label>
                <input type="text" id="visual_acuity_unaided_near_od" name="visual_acuity_unaided_near_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="visual_acuity_unaided_near_os"class="text-sm text-gray-600"> OS:</label>
                <input type="text" id="visual_acuity_unaided_near_os" name="visual_acuity_unaided_near_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="visual_acuity_unaided_near_ou" class="text-sm text-gray-600">OU:</label>
                <input type="text" id="visual_acuity_unaided_near_ou" name="visual_acuity_unaided_near_ou" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <p class="font-medium">Pinhole Vision</p>
        <div class="flex space-x-2 mb-4">
            <div class="w-1/2">
                <label for="visual_acuity_pinhole_od" class="text-sm text-gray-600">OD:</label>
                <input type="text" id="visual_acuity_pinhole_od" name="visual_acuity_pinhole_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="visual_acuity_pinhole_os"class="text-sm text-gray-600"> OS:</label>
                <input type="text" id="visual_acuity_pinhole_os" name="visual_acuity_pinhole_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <p class="font-medium">V.A with current Rx</p>
            <p class="font-medium">Far</p>
            <div class="flex space-x-4 mb-4">
                <div class="w-1/4">
                    <label for="visual_acuity_far_od" class="text-sm text-gray-600">OD:</label>
                    <input type="text" id="visual_acuity_far_od" name="visual_acuity_far_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
                <div class="w-1/4">
                    <label for="visual_acuity_far_os"class="text-sm text-gray-600"> OS:</label>
                    <input type="text" id="visual_acuity_far_os" name="visual_acuity_far_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
                <div class="w-1/4">
                    <label for="visual_acuity_far_ou" class="text-sm text-gray-600">OU:</label>
                    <input type="text" id="visual_acuity_far_ou" name="visual_acuity_far_ou" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
            </div>
            <p class="font-medium">Near</p>
            <div class="flex space-x-4 mb-4">
                <div class="w-1/4">
                    <label for="visual_acuity_near_od" class="text-sm text-gray-600">OD:</label>
                    <input type="text" id="visual_acuity_near_od" name="visual_acuity_near_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
                <div class="w-1/4">
                    <label for="visual_acuity_near_os"class="text-sm text-gray-600"> OS:</label>
                    <input type="text" id="visual_acuity_near_os" name="visual_acuity_near_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
                <div class="w-1/4">
                    <label for="visual_acuity_near_ou" class="text-sm text-gray-600">OU:</label>
                    <input type="text" id="visual_acuity_near_ou" name="visual_acuity_near_ou" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
            </div>

            <p class="font-medium">Shape</p>
            <div class="flex space-x-4 mb-4">
                <div class="w-1/4">
                    <label for="pupil_shape_od" class="text-sm text-gray-600">OD:</label>
                    <input type="text" id="pupil_shape_od" name="pupil_shape_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
                <div class="w-1/4">
                    <label for="pupil_shape_os"class="text-sm text-gray-600"> OS:</label>
                    <input type="text" id="pupil_shape_os" name="pupil_shape_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
            </div>
            <p class="font-medium">Diameter</p>
            <div class="flex space-x-4 mb-4">
                <div class="w-1/4">
                    <label for="pupil_diameter_od" class="text-sm text-gray-600">OD:</label>
                    <input type="text" id="pupil_diameter_od" name="pupil_diameter_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
                <div class="w-1/4">
                    <label for="pupil_diameter_os"class="text-sm text-gray-600"> OS:</label>
                    <input type="text" id="pupil_diameter_os" name="pupil_diameter_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
            </div>

        <label for="pd">Pupillary Distance (PD):</label>
        <input type="text" id="pd" name="pd" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <label for="de">Distance Equivalent (DE):</label>
        <input type="text" id="de" name="de" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <label for="eyes_not_aligned">
            <input type="checkbox" id="eyes_not_aligned" name="eyes_not_aligned" value="1" class="h-5 w-5 text-blue-600 rounded border-blue-300 focus:ring-indigo-500">
            Eyes Not Aligned
        </label><br><br>

        <label for="abnormal_head_posture">
            <input type="checkbox" id="abnormal_head_posture" name="abnormal_head_posture" value="1" class="h-5 w-5 text-blue-600 rounded border-blue-300 focus:ring-indigo-500">
            Abnormal Head Posture
        </label><br><br>

        <label for="face_tilt_direction">
            <input type="checkbox" id="face_tilt_direction" name="face_tilt_direction" value="1" class="h-5 w-5 text-blue-600 rounded border-blue-300 focus:ring-indigo-500">
            Face Tilt Direction
        </label><br><br>

        <label for="head_tilt_direction">
            <input type="checkbox" id="head_tilt_direction" name="head_tilt_direction" value="1" class="h-5 w-5 text-blue-600 rounded border-blue-300 focus:ring-indigo-500">
            Head Tilt Direction
        </label><br><br>

        <label for="other_pertinent_observations">Other Pertinent Observations:</label>
        <input type="text" id="other_pertinent_observations" name="other_pertinent_observations" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <label for="motor_sensory_push_up_amp"> Push-Up Amplitude:</label>
        <input type="text" id="motor_sensory_push_up_amp" name="motor_sensory_push_up_amp" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <label for="motor_sensory_npc"> NPC:</label>
        <input type="text" id="motor_sensory_npc" name="motor_sensory_npc" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <p class="font-medium">Corneal Reflex</p>
            <div class="flex space-x-2 mb-4">
                <div class="w-1/2">
                    <label for="motor_sensory_corneal_reflex_od" class="text-sm text-gray-600">OD:</label>
                    <input type="text" id="motor_sensory_corneal_reflex_od" name="motor_sensory_corneal_reflex_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
                <div class="w-1/2">
                    <label for="motor_sensory_corneal_reflex_os"class="text-sm text-gray-600"> OS:</label>
                    <input type="text" id="motor_sensory_corneal_reflex_os" name="motor_sensory_corneal_reflex_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
            </div>

        <p class="font-medium">Alternate Cover Test</p>
            <div class="flex space-x-2 mb-4">
                <div class="w-1/2">
                    Far
                </div>
                <div class="w-1/2">
                    <label for="motor_sensory_alternate_cover_test_far_sc"class="text-sm text-gray-600">SC:</label>
                    <input type="text" id="motor_sensory_alternate_cover_test_far_sc" name="motor_sensory_alternate_cover_test_far_sc" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
                <div class="w-1/2">
                    <label for="motor_sensory_alternate_cover_test_far_cc"class="text-sm text-gray-600">CC:</label>
                    <input type="text" id="motor_sensory_alternate_cover_test_far_cc" name="motor_sensory_alternate_cover_test_far_cc" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
            </div>
            <div class="flex space-x-2 mb-4">
                <div class="w-1/2">
                    Near
                </div>
                <div class="w-1/2">
                    <label for="motor_sensory_alternate_cover_test_near_sc"class="text-sm text-gray-600">SC:</label>
                    <input type="text" id="motor_sensory_alternate_cover_test_near_sc" name="motor_sensory_alternate_cover_test_near_sc" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
                <div class="w-1/2">
                    <label for="motor_sensory_alternate_cover_test_near_cc"class="text-sm text-gray-600">CC:</label>
                    <input type="text" id="motor_sensory_alternate_cover_test_near_cc" name="motor_sensory_alternate_cover_test_near_cc" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
                </div>
            </div>

        <!-- <label for="motor_sensory_alternate_cover_test_far_sc"> Alternate Cover Test Far SC:</label>
        <input type="text" id="motor_sensory_alternate_cover_test_far_sc" name="motor_sensory_alternate_cover_test_far_sc" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <label for="motor_sensory_alternate_cover_test_far_cc"> Alternate Cover Test Far CC:</label>
        <input type="text" id="motor_sensory_alternate_cover_test_far_cc" name="motor_sensory_alternate_cover_test_far_cc" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br> -->

        <!-- <label for="motor_sensory_alternate_cover_test_near_sc"> Alternate Cover Test Near SC:</label>
        <input type="text" id="motor_sensory_alternate_cover_test_near_sc" name="motor_sensory_alternate_cover_test_near_sc" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <label for="motor_sensory_alternate_cover_test_near_cc"> Alternate Cover Test Near CC:</label>
        <input type="text" id="motor_sensory_alternate_cover_test_near_cc" name="motor_sensory_alternate_cover_test_near_cc" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br> -->

        <p class="font-medium">Motility Test</p>
        <label for="motor_sensory_motility_test_smooth_pursuit">Smooth Pursuit:</label>
        <input type="text" id="motor_sensory_motility_test_smooth_pursuit" name="motor_sensory_motility_test_smooth_pursuit" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <label for="motor_sensory_motility_test_saccadic">Saccadic:</label>
        <input type="text" id="motor_sensory_motility_test_saccadic" name="motor_sensory_motility_test_saccadic" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <p class="font-medium">SENSORY</p>
        <p class="font-medium"> Pupillary Reflex </p>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p class="text-sm">DLR</p>
            </div>
            <div class="w-1/4">
                <label for="motor_sensory_pupillary_reflex_dlr_od">OD:</label>
                <input type="text" id="motor_sensory_pupillary_reflex_dlr_od" name="motor_sensory_pupillary_reflex_dlr_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/4">
                <label for="motor_sensory_pupillary_reflex_dlr_os">OS:</label>
                <input type="text" id="motor_sensory_pupillary_reflex_dlr_os" name="motor_sensory_pupillary_reflex_dlr_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p class="text-sm">Indirect</p>
            </div>
            <div class="w-1/4">
                <label for="motor_sensory_pupillary_reflex_indirect_od">OD:</label>
                <input type="text" id="motor_sensory_pupillary_reflex_indirect_od" name="motor_sensory_pupillary_reflex_indirect_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/4">
                <label for="motor_sensory_pupillary_reflex_indirect_os">OS:</label>
                <input type="text" id="motor_sensory_pupillary_reflex_indirect_os" name="motor_sensory_pupillary_reflex_indirect_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p class="text-sm">Accom</p>
            </div>
            <div class="w-1/4">
                <label for="motor_sensory_pupillary_reflex_accommodation_od">OD:</label>
                <input type="text" id="motor_sensory_pupillary_reflex_accommodation_od" name="motor_sensory_pupillary_reflex_accommodation_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/4">
                <label for="motor_sensory_pupillary_reflex_accommodation_os">OS:</label>
                <input type="text" id="motor_sensory_pupillary_reflex_accommodation_os" name="motor_sensory_pupillary_reflex_accommodation_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <p class="font-medium">Swinging Flashlight</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-1/2">
                <label for="motor_sensory_pupillary_reflex_swinging_flashlight_od">OD:</label>
                <input type="text" id="motor_sensory_pupillary_reflex_swinging_flashlight_od" name="motor_sensory_pupillary_reflex_swinging_flashlight_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="motor_sensory_pupillary_reflex_swinging_flashlight_os">OS:</label>
                <input type="text" id="motor_sensory_pupillary_reflex_swinging_flashlight_os" name="motor_sensory_pupillary_reflex_swinging_flashlight_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <p class="font-medium">Armsler Test</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-1/2">
                <label for="motor_sensory_amsler_test_od">OD:</label>
                <input type="text" id="motor_sensory_amsler_test_od" name="motor_sensory_amsler_test_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="motor_sensory_amsler_test_os">OS:</label>
                <input type="text" id="motor_sensory_amsler_test_os" name="motor_sensory_amsler_test_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <p class="font-medium">Projection Test</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-1/2">
                <label for="motor_sensory_proj_test_od">OD:</label>
                <input type="text" id="motor_sensory_proj_test_od" name="motor_sensory_proj_test_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="motor_sensory_proj_test_os">OS:</label>
                <input type="text" id="motor_sensory_proj_test_os" name="motor_sensory_proj_test_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

            <div class="space-x-4">
                <div class="flex items-center">
                <button type="button" class="w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="prevStep()">Previous</button>
                <button type="button" class="w-1/2 stepper-button h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="nextStep()">Next</button>
                </div>
            </div>
    </div>

    <!-- Step 4 -->
    <div class="step">
        <p class="font-medium  my-4">IV. Objective Refraction</p>

        <p class="font-medium">Static Retinoscopy</p> <br>
      <div class="flex">
      <div class="">
            <label for="objective_refraction_static_retinoscopy_od">OD:</label>
            <input type="text" id="objective_refraction_static_retinoscopy_od" name="objective_refraction_static_retinoscopy_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
       </div>
       <div class="">
        <label for="objective_refraction_static_retinoscopy_od_over">20/</label>
            <input type="text" id="objective_refraction_static_retinoscopy_od_over" name="objective_refraction_static_retinoscopy_od_over" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            
       </div>
      </div>
      <div class="flex">
      <div class="">
            <label for="objective_refraction_static_retinoscopy_os">OS:</label>
            <input type="text" id="objective_refraction_static_retinoscopy_os" name="objective_refraction_static_retinoscopy_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
       </div>
       <div class="">
        <label for="objective_refraction_static_retinoscopy_os_over">20/</label>
            <input type="text" id="objective_refraction_static_retinoscopy_os_over" name="objective_refraction_static_retinoscopy_os_over" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            
       </div>
      </div>
      <p class="font-medium mb-2"> Dynamic Retinoscopy </p>
       
        <label for="objective_refraction_dynamic_retinoscopy_od">OD:</label>
        <input type="text" id="objective_refraction_dynamic_retinoscopy_od" name="objective_refraction_dynamic_retinoscopy_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">

        <label for="objective_refraction_dynamic_retinoscopy_os">OS:</label>
        <input type="text" id="objective_refraction_dynamic_retinoscopy_os" name="objective_refraction_dynamic_retinoscopy_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">

        <div class="space-x-4">
            <div class="flex items-center">
            <button type="button" class="w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="prevStep()">Previous</button>
            <button type="button" class="w-1/2 stepper-button h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="nextStep()">Next</button>
            </div>
        </div> 
    </div>

    <!-- Step 5 -->
    <div class="step">
      <p class="font-medium my-4">V. Subjective Refraction</p>

      Manifest
        <div class="flex space-x-4 mb-2">
            <div class="w-1/3">
                <p>Mono:</p>
            </div>
            <div class="w-1/3">
              <label for="subjective_refraction_manifest_mono_od">OD:</label>
              <input type="text" id="subjective_refraction_manifest_mono_od" name="subjective_refraction_manifest_mono_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
              <label for="subjective_refraction_manifest_mono_os">OS:</label>
              <input type="text" id="subjective_refraction_manifest_mono_os" name="subjective_refraction_manifest_mono_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        <div class="flex space-x-4 mb-2">
            <div class="w-1/3">
                <p>Bino:</p>
            </div>
            <div class="w-1/3">
              <label for="subjective_refraction_manifest_bino_od">OD:</label>
              <input type="text" id="subjective_refraction_manifest_bino_od" name="subjective_refraction_manifest_bino_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">       
              <label for="subjective_refraction_manifest_bino_os">OS:</label>
              <input type="text" id="subjective_refraction_manifest_bino_os" name="subjective_refraction_manifest_bino_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        Visual Acuity
        <div class="flex space-x-4 mb-2">
            <div class="w-1/3">
              <label for="subjective_refraction_visual_acuity_od">OD:</label>
              <input type="text" id="subjective_refraction_visual_acuity_od" name="subjective_refraction_visual_acuity_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
              <label for="subjective_refraction_visual_acuity_os">OS:</label>
              <input type="text" id="subjective_refraction_visual_acuity_os" name="subjective_refraction_visual_acuity_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">       
              <label for="subjective_refraction_visual_acuity_ou">OU:</label>
             <input type="text" id="subjective_refraction_visual_acuity_ou" name="subjective_refraction_visual_acuity_ou" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        Cycloplegic
        <div class="flex space-x-4 mb-2">
            <div class="w-1/2">
              <label for="subjective_refraction_cycloplegic_od">OD:</label>
              <input type="text" id="subjective_refraction_cycloplegic_od" name="subjective_refraction_cycloplegic_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
              <label label for="subjective_refraction_cycloplegic_os">OS:</label>
              <input type="text" id="subjective_refraction_cycloplegic_os" name="subjective_refraction_cycloplegic_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        Visual Acuity
        <div class="flex space-x-4 mb-2">
            <div class="w-1/2">
              <label for="subjective_refraction_cycloplegic_visual_acuity_od">od:</label>
              <input type="text" id="subjective_refraction_cycloplegic_visual_acuity_od" name="subjective_refraction_cycloplegic_visual_acuity_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
              <label for="subjective_refraction_cycloplegic_visual_acuity_os">od:</label>
              <input type="text" id="subjective_refraction_cycloplegic_visual_acuity_os" name="subjective_refraction_cycloplegic_visual_acuity_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="space-x-4">
            <div class="flex items-center">
            <button type="button" class="w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="prevStep()">Previous</button>
            <button type="button" class="w-1/2 stepper-button h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="nextStep()">Next</button>
            </div>
        </div> 
    </div>
    
    <!-- Step 6 -->
    <div class="step">
        <p class="font-medium  my-4">VI. Phorometric and Vergence Tests</p>

        <p class="font-medium mb-2">Lateral Phoria</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-1/3">
                <label>Habitual:</label>
            </div>
            <div class="w-1/3">
                <label for="phorometric_test_lateral_phoria_20ft_habitual">20ft:</label>
                <input type="text" id="phorometric_test_lateral_phoria_20ft_habitual" name="phorometric_test_lateral_phoria_20ft_habitual" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="phorometric_test_lateral_phoria_16in_habitual">16in:</label>
                <input type="text" id="phorometric_test_lateral_phoria_16in_habitual" name="phorometric_test_lateral_phoria_16in_habitual" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        <div class="flex space-x-4 mb-2">
            <div class="w-1/3">
                Induced:
            </div>
            <div class="w-1/3">
                <label for="phorometric_test_lateral_phoria_20ft_induced">20ft:</label>
                <input type="text" id="phorometric_test_lateral_phoria_20ft_induced" name="phorometric_test_lateral_phoria_20ft_induced" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="phorometric_test_lateral_phoria_16in_induced">16in:</label>
                <input type="text" id="phorometric_test_lateral_phoria_16in_induced" name="phorometric_test_lateral_phoria_16in_induced" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="w-full">
            <label for="phorometric_test_lateral_phoria_16in_induced_13bg">13BG</label>
            <input type="text" id="phorometric_test_lateral_phoria_16in_induced_13bg" name="phorometric_test_lateral_phoria_16in_induced_13bg" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <p class="font-medium mb-2">Vertical Phoria</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-1/2">
                <label for="phorometric_test_vertical_phoria_20ft">20ft:</label>
                <input type="text" id="phorometric_test_vertical_phoria_20ft" name="phorometric_test_vertical_phoria_20ft" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="phorometric_test_vertical_phoria_16in">16in:</label>
                <input type="text" id="phorometric_test_vertical_phoria_16in" name="phorometric_test_vertical_phoria_16in" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <p>Duction</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-1/2">
                <label for="phorometric_test_duction_20ft">20ft:</label>
                <input type="text" id="phorometric_test_duction_20ft" name="phorometric_test_duction_20ft" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="phorometric_test_duction_16in">16in:</label>
                <input type="text" id="phorometric_test_duction_16in" name="phorometric_test_duction_16in" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <p class="font-medium mb-2">Vergence Test</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-1/3">
                <p>BI</p>
            </div>
            <div class="w-1/3">
                <label for="vergence_test_bi_20ft">20ft:</label>
                <input type="text" id="vergence_test_bi_20ft" name="vergence_test_bi_20ft" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="vergence_test_bi_16in">BI at 16in:</label>
                <input type="text" id="vergence_test_bi_16in" name="vergence_test_bi_16in" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        <div class="flex space-x-4 mb-2">
            <div class="w-1/3">
                <p>BO</p>
            </div>
            <div class="w-1/3">
                <label for="vergence_test_bo_20ft">20ft:</label>
                <input type="text" id="vergence_test_bo_20ft" name="vergence_test_bo_20ft" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="vergence_test_bo_16in">16in:</label>
                <input type="text" id="vergence_test_bo_16in" name="vergence_test_bo_16in" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <!-- Accommodation Test Fields -->
        <p class="font-medium mb-2">Accommodation Test</p>
        <div class="w-3/3">
                <label for="accommodation_test_amp_of_accom">Amplitude of Accommodation:</label>
            </div>
        <div class="flex space-x-4 mb-4">
            <div class="w-full">
                <input type="text" id="accommodation_test_amp_of_accom" name="accommodation_test_amp_of_accom" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        Unfussed Crossed Cyl
        <div class="flex space-x-4 mb-4">

            <div class="w-1/3">
                OD:
                <input type="text" id="accommodation_test_unfussed_crossed_cyl_od" name="accommodation_test_unfussed_crossed_cyl_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
            OS:
                <input type="text" id="accommodation_test_unfussed_crossed_cyl_os" name="accommodation_test_unfussed_crossed_cyl_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
              Other
            <input type="text" id="accommodation_test_unfussed_crossed_cyl_other" name="accommodation_test_unfussed_crossed_cyl_other" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        Fussed Crossed Cyl
        <div class="flex space-x-4 mb-4">
          <div class="w-1/3">
          OD:
            <input type="text" id="accommodation_test_fused_crossed_cyl_od" name="accommodation_test_fused_crossed_cyl_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
          </div>
          
              <div class="w-1/3">
                OS:
                  <input type="text" id="accommodation_test_fused_crossed_cyl_os" name="accommodation_test_fused_crossed_cyl_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
              </div>
              <div class="w-1/3">
                Other
                <input type="text" id="accommodation_test_fused_crossed_cyl_other" name="accommodation_test_fused_crossed_cyl_other" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>




        <p class="font-medium">NRA </p>
        <div class="flex space-x-4 mb-4">

            <div class="w-1/3">
                <label for="accommodation_test_nra_od" class="text-sm text-gray-600">OD:</label>
                <input type="text" id="accommodation_test_nra_od" name="accommodation_test_nra_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="accommodation_test_nra_od">OS:</label>
                <input type="text" id="accommodation_test_nra_os" name="accommodation_test_nra_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        <p class="font-medium">PRA </p>
        <div class="flex space-x-4 mb-4">
            <div class="w-1/3">
              OD
                <input type="text" id="accommodation_test_pra_od" name="accommodation_test_pra_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
              OS
                <input type="text" id="accommodation_test_pra_os" name="accommodation_test_pra_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>


        <div class="space-x-4">
            <div class="flex items-center">
                <button type="button" class="w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="prevStep()">Previous</button>
                <button type="button" class="w-1/2 stepper-button h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="nextStep()">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 7 -->
    <div class="step">
        <p class="font-medium  my-4">VII. Additional Visual Tests</p>

        <p class="font-medium mb-2">Prism Cover Test</p>
        <div class="w-full mb-4">
            <label for="prism_cover_test_hirschberg">Hirschberg:</label>
            <input type="text" id="prism_cover_test_hirschberg" name="prism_cover_test_hirschberg" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <p class="font-medium mb-2">Hirshberg Test</p>
        <div class="w-full mb-4">
            <label for="hirshberg_test">Result:</label>
            <input type="text" id="hirshberg_test" name="hirshberg_test" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <p class="font-medium mb-2">Worth's Four Dots Test</p>
        <div class="flex space-x-4 mb-4">
            <div class="w-1/2">
                <label for="worths_four_dots_far">Far:</label>
                <input type="text" id="worths_four_dots_far" name="worths_four_dots_far" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="worths_four_dots_near">Near:</label>
                <input type="text" id="worths_four_dots_near" name="worths_four_dots_near" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <p class="font-medium mb-2">Krimsky Test</p>
        <div class="w-full mb-4">
            <label for="krimsky_test">Result:</label>
            <input type="text" id="krimsky_test" name="krimsky_test" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <p class="font-medium mb-2">Maddox Rod Test</p>
        <div class="w-full mb-4">
            <label for="maddox_rod">Result:</label>
            <input type="text" id="maddox_rod" name="maddox_rod" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <p class="font-medium mb-2">Color Vision Tests</p>
        <div class="flex space-x-4 mb-4">
            <div class="w-1/2">
                <label for="color_vision_ishihara_test">Ishihara Test:</label>
                <input type="text" id="color_vision_ishihara_test" name="color_vision_ishihara_test" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="color_vision_d15_test">D15 Test:</label>
                <input type="text" id="color_vision_d15_test" name="color_vision_d15_test" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <p class="font-medium mb-2">Visual Field Tests</p>
        <div class="flex space-x-4 mb-4">
            <div class="w-1/2">
                <label for="visual_field_test_confrontation_od">Confrontation OD:</label>
                <input type="text" id="visual_field_test_confrontation_od" name="visual_field_test_confrontation_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="visual_field_test_confrontation_os">Confrontation OS:</label>
                <input type="text" id="visual_field_test_confrontation_os" name="visual_field_test_confrontation_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        <div class="flex space-x-4 mb-4">
            <div class="w-1/2">
                <label for="visual_field_test_ats_od">Amsler Test OD:</label>
                <input type="text" id="visual_field_test_ats_od" name="visual_field_test_ats_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="visual_field_test_ats_os">Amsler Test OS:</label>
                <input type="text" id="visual_field_test_ats_os" name="visual_field_test_ats_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="space-x-4">
            <div class="flex items-center">
                <button type="button" class="w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="prevStep()">Previous</button>
                <button type="button" class="w-1/2 stepper-button h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="nextStep()">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 8 -->
    <div class="step">
        <p class="font-medium  my-4">VIII. Trial Framing</p>
        <p class="font-medium">Distance</p> 
        <div class="flex space-x-4 mb-2">
            <div class="w-1/2">
                <label for="trial_framing_distance_od">OD:</label>
                <input type="text" id="trial_framing_distance_od" name="trial_framing_distance_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="trial_framing_distance_od_over">20/</label>
                <input type="text" id="trial_framing_distance_od_over" name="trial_framing_distance_od_over" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>

        </div>

        <div class="flex space-x-4 mb-2">
        <div class="w-1/2">
                <label for="trial_framing_distance_os">OS:</label>
                <input type="text" id="trial_framing_distance_os" name="trial_framing_distance_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="trial_framing_distance_os_over">20/</label>
                <input type="text" id="trial_framing_distance_os_over" name="trial_framing_distance_os_over" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        <p class="font-medium">Add</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-1/2">
                <label for="trial_framing_add_od">OD:</label>
                <input type="text" id="trial_framing_add_od" name="trial_framing_add_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="trial_framing_add_od_over">20/</label>
                <input type="text" id="trial_framing_add_od_over" name="trial_framing_add_od_over" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="flex space-x-4 mb-2">
        <div class="w-1/2">
                <label for="trial_framing_add_os">OS:</label>
                <input type="text" id="trial_framing_add_os" name="trial_framing_add_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/2">
                <label for="trial_framing_add_os_over">20/</label>
                <input type="text" id="trial_framing_add_os_over" name="trial_framing_add_os_over" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="space-x-4">
            <div class="flex items-center">
                <button type="button" class="w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="prevStep()">Previous</button>
                <button type="button" class="w-1/2 stepper-button h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="nextStep()">Next</button>
            </div>
        </div> 
    </div>

    <!-- Step 9 -->
    <div class="step">
        <p class="font-medium  my-4">IX. Biomicroscopy</p>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p class="text-sm">Eyelids:</p>
            </div>
            <div class="w-1/4">
                <label for="biomicroscopy_eyelids_od">OD:</label>
                <input type="text" id="biomicroscopy_eyelids_od" name="biomicroscopy_eyelids_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/4">
                <label for="biomicroscopy_eyelids_os">OS:</label>
                <input type="text" id="biomicroscopy_eyelids_os" name="biomicroscopy_eyelids_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p class="text-sm">Eyelashes:</p>
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_eyelashes_od">OD:</label>
                <input type="text" id="biomicroscopy_eyelashes_od" name="biomicroscopy_eyelashes_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_eyelashes_os">OS:</label>
                <input type="text" id="biomicroscopy_eyelashes_os" name="biomicroscopy_eyelashes_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p>Lid Margin:</p>
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_lid_margin_od">OD:</label>
                <input type="text" id="biomicroscopy_lid_margin_od" name="biomicroscopy_lid_margin_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_lid_margin_os">OS:</label>
                <input type="text" id="biomicroscopy_lid_margin_os" name="biomicroscopy_lid_margin_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p>Ducts:</p>
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_ducts_od">OD:</label>
                <input type="text" id="biomicroscopy_ducts_od" name="biomicroscopy_ducts_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_ducts_os">OS:</label>
                <input type="text" id="biomicroscopy_ducts_os" name="biomicroscopy_ducts_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p>Conjunctiva:</p>
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_conjunctiva_od">OD:</label>
                <input type="text" id="biomicroscopy_conjunctiva_od" name="biomicroscopy_conjunctiva_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_conjunctiva_os">OS:</label>
                <input type="text" id="biomicroscopy_conjunctiva_os" name="biomicroscopy_conjunctiva_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p>Sclera:</p>
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_sclera_od">OD:</label>
                <input type="text" id="biomicroscopy_sclera_od" name="biomicroscopy_sclera_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_sclera_os">OS:</label>
                <input type="text" id="biomicroscopy_sclera_os" name="biomicroscopy_sclera_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p>Pupil:</p>
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_pupil_od">OD:</label>
                <input type="text" id="biomicroscopy_pupil_od" name="biomicroscopy_pupil_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_pupil_os">OS:</label>
                <input type="text" id="biomicroscopy_pupil_os" name="biomicroscopy_pupil_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p>Iris:</p>
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_iris_od">OD:</label>
                <input type="text" id="biomicroscopy_iris_od" name="biomicroscopy_iris_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_iris_os">OS:</label>
                <input type="text" id="biomicroscopy_iris_os" name="biomicroscopy_iris_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="flex space-x-4 mb-2">
            <div class="w-2/4">
                <p>Lens:</p>
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_lens_od">OD:</label>
                <input type="text" id="biomicroscopy_lens_od" name="biomicroscopy_lens_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
            <div class="w-1/3">
                <label for="biomicroscopy_lens_os">OS:</label>
                <input type="text" id="biomicroscopy_lens_os" name="biomicroscopy_lens_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <!-- <div class="w-full mb-2">
            <label for="biomicroscopy_other_tests">Other Tests:</label>
            <input type="text" id="biomicroscopy_other_tests" name="biomicroscopy_other_tests" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div> -->
        <p>Von Herrick:</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-full">
                <input type="text" id="biomicroscopy_von_herrick" name="biomicroscopy_von_herrick" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        <p>TBUT:</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-full">
                <input type="text" id="biomicroscopy_tbut" name="biomicroscopy_tbut" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        <p>Schirmer's Test:</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-full">
                <input type="text" id="biomicroscopy_schirmers_test" name="biomicroscopy_schirmers_test" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>
        <p>Tear Meniscus:</p>
        <div class="flex space-x-4 mb-2">
            <div class="w-full">
                <input type="text" id="biomicroscopy_tear_meniscus" name="biomicroscopy_tear_meniscus" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
            </div>
        </div>

        <div class="w-full mb-2">
      <div id="canvasContainer">
          <canvas id="drawingCanvas" width="450" class="border"></canvas>
      </div>
      <div>
      <button type="button" id="undoButton" class="hidden w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Undo</button>
      <button type="button" id="redoButton" class="hidden w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Redo</button>
      <button type="button" id="clear" class="w-1/3 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Clear</button>
      </div>
      <!-- <script src="https://cdn.jsdelivr.net/npm/fabric"></script> -->
    
    </div>

      <div class="space-x-4">
            <div class="flex items-center">
                <button type="button" class="w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="prevStep()">Previous</button>
                <button type="button" class="w-1/2 stepper-button h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="nextStep()">Next</button>
            </div>
        </div>
    </div>
    
   <!-- Step 10 -->
   <div class="step">
    <p class="font-medium my-4">X. Intra Ocular Pressure</p>

    Tactile
    <div class="flex space-x-4 mb-2">
        <div class="w-1/2">
        <label for="intra_ocular_pressure_tactile_od">OD:</label>
            <input type="text" id="intra_ocular_pressure_tactile_od" name="intra_ocular_pressure_tactile_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
         </div>
        <div class="w-1/2">
            <label for="intra_ocular_pressure_tactile_os">OS:</label>
            <input type="text" id="intra_ocular_pressure_tactile_os" name="intra_ocular_pressure_tactile_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>
    <div class="flex space-x-4 mb-2">
        <div class="w-1/2">
            <label for="intra_ocular_pressure_tactile_time_taken">Time Taken:</label>
            <input type="text" id="intra_ocular_pressure_tactile_time_taken" name="intra_ocular_pressure_tactile_time_taken" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/2">
            <label for="intra_ocular_pressure_tactile_time_tested">Time Tested:</label>
            <input type="text" id="intra_ocular_pressure_tactile_time_tested" name="intra_ocular_pressure_tactile_time_tested" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>
    <br>

    <p class="font-medium">Tonometry Applanation:</p>
    <div class="flex space-x-4 mb-2">

        <div class="w-1/2">
            <label for="intra_ocular_pressure_tonometry_applanation_od">OD:</label>
            <input type="text" id="intra_ocular_pressure_tonometry_applanation_od" name="intra_ocular_pressure_tonometry_applanation_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/2">
            <label for="intra_ocular_pressure_tonometry_applanation_os">OS:</label>
            <input type="text" id="intra_ocular_pressure_tonometry_applanation_os" name="intra_ocular_pressure_tonometry_applanation_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>
    <div class="flex space-x-4 mb-2">
        <div class="w-1/2">
            <label for="intra_ocular_pressure_tonometry_applanation_time_taken">Time Taken:</label>
            <input type="text" id="intra_ocular_pressure_tonometry_applanation_time_taken" name="intra_ocular_pressure_tonometry_applanation_time_taken" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/2">
            <label for="intra_ocular_pressure_tonometry_applanation_time_tested">Time Tested:</label>
            <input type="text" id="intra_ocular_pressure_tonometry_applanation_time_tested" name="intra_ocular_pressure_tonometry_applanation_time_tested" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>
    <br>
    <p class="font-medium">iCare:</p>
    <div class="flex space-x-4 mb-2">
        <div class="w-1/2">
            <label for="intra_ocular_pressure_icare_od">OD:</label>
            <input type="text" id="intra_ocular_pressure_icare_od" name="intra_ocular_pressure_icare_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/2">
            <label for="intra_ocular_pressure_icare_os">OS:</label>
            <input type="text" id="intra_ocular_pressure_icare_os" name="intra_ocular_pressure_icare_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>
    <div class="flex space-x-4 mb-2">
        <div class="w-1/2">
            <label for="intra_ocular_pressure_icare_time_taken">Time Taken:</label>
            <input type="text" id="intra_ocular_pressure_icare_time_taken" name="intra_ocular_pressure_icare_time_taken" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/2">
            <label for="intra_ocular_pressure_icare_os_time_tested">Time Tested:</label>
            <input type="text" id="intra_ocular_pressure_icare_os_time_tested" name="intra_ocular_pressure_icare_os_time_tested" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>
    

    <div class="space-x-4">
        <div class="flex items-center">
            <button type="button" class="w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="prevStep()">Previous</button>
            <button type="button" class="w-1/2 stepper-button h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="nextStep()">Next</button>
        </div>
    </div> 
    
</div>

<!-- Step 11 -->
<div class="step">
    <p class="font-medium mb-2">XI. Posterior Segment Examination</p>

    <div class="flex space-x-4 mb-2">
        <div class="w-2/4">
            <p class="text-sm">ROR:</p>
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_ror_od">OD:</label>
            <input type="text" id="posterior_segment_exam_ror_od" name="posterior_segment_exam_ror_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_ror_os">OS:</label>
            <input type="text" id="posterior_segment_exam_ror_os" name="posterior_segment_exam_ror_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>

    <div class="flex space-x-4 mb-2">
        <div class="w-2/4">
            <p class="text-sm">Media:</p>
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_media_od">OD:</label>
            <input type="text" id="posterior_segment_exam_media_od" name="posterior_segment_exam_media_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_media_os">OS:</label>
            <input type="text" id="posterior_segment_exam_media_os" name="posterior_segment_exam_media_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>

    <div class="flex space-x-4 mb-2">
        <div class="w-2/4">
            <p class="text-sm">Optic Disc:</p>
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_optic_disc_od">OD:</label>
            <input type="text" id="posterior_segment_exam_optic_disc_od" name="posterior_segment_exam_optic_disc_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_optic_disc_os">OS:</label>
            <input type="text" id="posterior_segment_exam_optic_disc_os" name="posterior_segment_exam_optic_disc_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>

    <div class="flex space-x-4 mb-2">
        <div class="w-2/4">
            <p class="text-sm">C/D:</p>
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_cd_od">OD:</label>
            <input type="text" id="posterior_segment_exam_cd_od" name="posterior_segment_exam_cd_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_cd_os">OS:</label>
            <input type="text" id="posterior_segment_exam_cd_os" name="posterior_segment_exam_cd_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>

    <div class="flex space-x-4 mb-2">
        <div class="w-2/4">
            <p class="text-sm">A/V:</p>
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_av_od">OD:</label>
            <input type="text" id="posterior_segment_exam_av_od" name="posterior_segment_exam_av_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_av_os">OS:</label>
            <input type="text" id="posterior_segment_exam_av_os" name="posterior_segment_exam_av_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>

    <div class="flex space-x-4 mb-2">
        <div class="w-2/4">
            <p class="text-sm">Edema:</p>
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_edema_od">OD:</label>
            <input type="text" id="posterior_segment_exam_edema_od" name="posterior_segment_exam_edema_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_edema_os">OS:</label>
            <input type="text" id="posterior_segment_exam_edema_os" name="posterior_segment_exam_edema_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>

    <div class="flex space-x-4 mb-2">
        <div class="w-2/4">
            <p class="text-sm">Hemorrhage:</p>
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_hemorrhage_od">OD:</label>
            <input type="text" id="posterior_segment_exam_hemorrhage_od" name="posterior_segment_exam_hemorrhage_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_hemorrhage_os">OS:</label>
            <input type="text" id="posterior_segment_exam_hemorrhage_os" name="posterior_segment_exam_hemorrhage_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>

    <div class="flex space-x-4 mb-2">
        <div class="w-2/4">
            <p class="text-sm">Exudates:</p>
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_exudates_od">OD:</label>
            <input type="text" id="posterior_segment_exam_exudates_od" name="posterior_segment_exam_exudates_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_exudates_os">OS</label>
            <input type="text" id="posterior_segment_exam_exudates_os" name="posterior_segment_exam_exudates_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>

    <div class="flex space-x-4 mb-2">
        <div class="w-2/4">
            <p class="text-sm">Cotton Wool Spots:</p>
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_cotton_wool_spots_od">OD:</label>
            <input type="text" id="posterior_segment_exam_cotton_wool_spots_od" name="posterior_segment_exam_cotton_wool_spots_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_cotton_wool_spots_os">OS</label>
            <input type="text" id="posterior_segment_exam_cotton_wool_spots_os" name="posterior_segment_exam_cotton_wool_spots_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>
    <div class="flex space-x-4 mb-2">
        <div class="w-2/4">
            <p class="text-sm">Foveal Reflex</p>
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_foveal_reflex_od">OD:</label>
            <input type="text" id="posterior_segment_exam_foveal_reflex_od" name="posterior_segment_exam_foveal_reflex_od" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
        <div class="w-1/4">
            <label for="posterior_segment_exam_foveal_reflex_os">OS</label>
            <input type="text" id="posterior_segment_exam_foveal_reflex_os" name="posterior_segment_exam_foveal_reflex_os" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>
    </div>

    <div class="mb-2">
      <div id="canvasContainer2">
          <canvas id="drawingCanvas2" width="450" class="border"></canvas>
      </div>
      <div>
        <button type="button" id="undoButton2" class="hidden w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Undo</button>
        <button type="button" id="redoButton2" class="hidden w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Redo</button>
        <button type="button" id="clear2" class="w-1/3 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Clear</button>
      </div>
    </div>

    <div class="space-x-4">
            <div class="flex items-center">
                <button type="button" class="w-1/2 stepper-button h-12 text-blue-700 bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="prevStep()">Previous</button>
                <button type="button" class="w-1/2 stepper-button h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2" onclick="nextStep()">Next</button>
            </div>
        </div>
  </div>

    <!-- Step 12 -->
    <div class="step">
        <p class="font-medium mb-2">XII. Evaluation</p>

        <div class="w-full mb-2">
            <label for="evaluation_impression">Impression:</label>
            <input type="text" id="evaluation_impression" name="evaluation_impression" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <div class="w-full mb-2">
            <label for="evaluation_finalrx">Final Rx:</label>
            <input type="text" id="evaluation_finalrx" name="evaluation_finalrx" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <div class="w-full mb-2">
            <label for="evaluation_referral">Referral:</label>
            <input type="text" id="evaluation_referral" name="evaluation_referral" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <div class="w-full mb-2">
            <label for="evaluation_follow_up">Follow-Up:</label>
            <input type="text" id="evaluation_follow_up" name="evaluation_follow_up" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <div class="w-full mb-2">
            <label for="evaluation_external">External:</label>
            <input type="text" id="evaluation_external" name="evaluation_external" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <div class="w-full mb-2">
            <label for="evaluation_refraction_obj">Refraction Objective:</label>
            <input type="text" id="evaluation_refraction_obj" name="evaluation_refraction_obj" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <div class="w-full mb-2">
            <label for="evaluation_refraction_subj">Refraction Subjective:</label>
            <input type="text" id="evaluation_refraction_subj" name="evaluation_refraction_subj" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <div class="w-full mb-2">
            <label for="evaluation_other_test">Other Test:</label>
            <input type="text" id="evaluation_other_test" name="evaluation_other_test" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <div class="w-full mb-2">
            <label for="evaluation_ass_management">Assessment & Management:</label>
            <input type="text" id="evaluation_ass_management" name="evaluation_ass_management" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <div class="w-full mb-2">
            <label for="evaluation_dispensing">Dispensing:</label>
            <input type="text" id="evaluation_dispensing" name="evaluation_dispensing" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <div class="w-full mb-2">
            <label for="evaluation_supervisor">Supervisor:</label>
            <input type="text" id="evaluation_supervisor" name="evaluation_supervisor" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5">
        </div>

        <div class="space-x-4">
            <a id="submit" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-not-allowed" disabled>
            <svg aria-hidden="true" role="status" class="spinner-icon inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                            </svg>
                            Submit
            </a>
        </div>
        <div class="p-4 mb-4 text-sm text-gray-600 rounded-lg dark:bg-gray-800 dark:text-blue-400" role="alert">
                        <span class="font-medium">Note: </span> Fields that have asterisks (*) are required in order to submit the form. 
                      </div>
    </div>


    </form>
  </div>
</section>

<script>
    const steps = document.querySelectorAll('.step');
    const totalSteps = steps.length;
    let currentStep = 0;

    document.getElementById('total-steps').textContent = totalSteps;

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
        });
        document.getElementById('current-step').textContent = stepIndex + 1;
    }

    function nextStep() {
        if (currentStep < totalSteps - 1) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevStep() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    }

    function goToStep(stepIndex) {
        if (stepIndex >= 0 && stepIndex < totalSteps) {
            currentStep = stepIndex;
            showStep(currentStep);
        }
    }

    showStep(currentStep);
</script>

<script>
        $(document).ready(function() {
            var canvas = new fabric.Canvas('drawingCanvas', {
                isDrawingMode: true,
                cancelable: true
            });
            var canvas2 = new fabric.Canvas('drawingCanvas2', {
                isDrawingMode: true,
                cancelable: true
            });

            canvas.freeDrawingBrush.color = "red";
            canvas.freeDrawingBrush.width = 4;
            canvas2.freeDrawingBrush.color = "red";
            canvas2.freeDrawingBrush.width = 4;

            // Function to load fixed images
            function loadFixedImages() {
                const imageUrl1 = 'assets/step9.jpg';
                const imageUrl2 = 'assets/step11.jpg';
                fabric.Image.fromURL(imageUrl1, function(img) {
                    img.scaleToWidth(canvas.width);
                    img.scaleToHeight(canvas.height);
                    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
                });
                fabric.Image.fromURL(imageUrl2, function(img) {
                    img.scaleToWidth(canvas2.width);
                    img.scaleToHeight(canvas2.height);
                    canvas2.setBackgroundImage(img, canvas2.renderAll.bind(canvas2));
                });
            }
            loadFixedImages();

            // Undo/Redo functionality
            var undoStack = [];
            var redoStack = [];
            var undoStack2 = [];
            var redoStack2 = [];

            function saveState(canvas, stack) {
                var json = JSON.stringify(canvas.toDatalessJSON());
                stack.push(json);
            }

            function undo(canvas, undoStack, redoStack) {
                if (undoStack.length > 0) {
                    var json = undoStack.pop();
                    redoStack.push(json);
                    canvas.loadFromJSON(JSON.parse(json), function() {
                        canvas.renderAll();
                    });
                }
            }

            function redo(canvas, undoStack, redoStack) {
                if (redoStack.length > 0) {
                    var json = redoStack.pop();
                    undoStack.push(json);
                    canvas.loadFromJSON(JSON.parse(json), function() {
                        canvas.renderAll();
                    });
                }
            }

            function clearCanvas(canvas, undoStack, redoStack, loadImage) {
                canvas.clear();
                undoStack.length = 0;
                redoStack.length = 0;
                loadImage();
            }

            // Event listeners for canvas buttons
            $('#undoButton').click(() => undo(canvas, undoStack, redoStack));
            $('#redoButton').click(() => redo(canvas, undoStack, redoStack));
            $('#clear').click(() => clearCanvas(canvas, undoStack, redoStack, loadFixedImages));
            $('#undoButton2').click(() => undo(canvas2, undoStack2, redoStack2));
            $('#redoButton2').click(() => redo(canvas2, undoStack2, redoStack2));
            $('#clear2').click(() => clearCanvas(canvas2, undoStack2, redoStack2, loadFixedImages));
        });
    </script>


<script>
    $(document).ready(function() {
        $('.spinner-icon').hide();
    function checkFields() {
        var caseNo = $('#case_no').val().trim();
        var coNo = $('#co_no').val().trim();
        var firstName = $('#FirstName').val().trim();
        var lastName = $('#LastName').val().trim();

        if (caseNo && coNo && firstName && lastName) {
            $('#submit').prop('disabled', false).removeClass('cursor-not-allowed');
            $("#submit").prop("disabled", false).addClass("bg-blue-700");
        } else {
            $('#submit').prop('disabled', true).addClass('cursor-not-allowed');
            $("#submit").prop("disabled", true).addClass("bg-blue-200");
        }
    }

    // Check fields initially in case they are pre-filled
    checkFields();

    // Add event listeners to input fields
    $('#case_no, #co_no, #FirstName, #LastName').on('input', checkFields);

    var caseNoValid = false;

    function toggleSubmitButton() {
        if (caseNoValid) {
            $('#submit').prop('disabled', false).removeClass('cursor-not-allowed');
            $("#submit").prop("disabled", false).addClass("bg-blue-700");
        } else {
            $('#submit').prop('disabled', true).addClass('cursor-not-allowed');
            $("#submit").prop("disabled", true).addClass("bg-blue-200");
        }
    }
    
    $("#case_no").on('blur', function() {
        var case_no = $(this).val();

        $.ajax({
            url: "php/validate.php",
            method: "POST",
            data: { case_no: case_no },
            success: function(response) {
                if (response.trim() === "case_no_exist") {
                    $("#case_no").addClass('border-red-700');
                    $("#case_no-error").text("Case No. already exist. Try different one.").show();
                    caseNoValid = false;
                } else {
                    $("#case_no").removeClass('border-red-700');
                    $("#case_no-error").text("").hide();
                    caseNoValid = true;
                }
                toggleSubmitButton();
                checkFields();
            }
        });
    });

    $('#submit').click(function(event) {
        if ($(this).prop('disabled')) {
            event.preventDefault();
            return;
        }

        // Serialize form data
        var formData = $('#form').serialize();

        var canvas = document.getElementById('drawingCanvas');
        var canvas2 = document.getElementById('drawingCanvas2');
        var canvasData = canvas.toDataURL('image/png'); // Defaults to PNG format
        var canvasData2 = canvas2.toDataURL('image/png'); // Defaults to PNG format

        // Remove the "data:image/png;base64," prefix
        var base64Image = canvasData.replace(/^data:image\/(png|jpeg|jpg);base64,/, "");
        var base64Image2 = canvasData2.replace(/^data:image\/(png|jpeg|jpg);base64,/, "");

        // Add canvas data to formData (as an additional parameter or separate AJAX call)
        formData += '&biomicroscopy_image=' + encodeURIComponent(base64Image) + '&posterior_segment_exam=' + encodeURIComponent(base64Image2);

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'php/test_process.php',
            data: formData,
            success: function(response) {
                $('.spinner-icon').show();
                Swal.fire({
                    icon: 'success',
                    title: 'Form Submitted Successfully',
                    text: 'Your form has been submitted successfully.',
                }).then(function() {
                    $('.spinner-icon').hide();
                    window.history.back();
                });
            },
            error: function(xhr, status, error) {
                // Handle error response
                Swal.fire({
                    icon: 'error',
                    title: 'Form Submission Failed',
                    text: 'There was an error submitting your form. Please try again later.'
                });
            }
        });
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();

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
            echo "No record found with PatientID = $patientId";
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
<body>

<section class="overflow-y-auto">
  <div class="mt-1 mx-auto max-w-md flex-col items-center justify-center mx-auto md:h-screen lg:py-0">
    <!-- appbar -->
    <div class="flex items-center justify-between border-b border-gray-200 pb-2 pl-2">
      <button onclick="window.history.back();" class="text-gray-600 hover:text-blue-500 ml-2">
        <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
        </svg>
      </button>
      <div class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Edit Profile</div>
      <div class="w-10 h-10"></div>
    </div>
  </div>
</section>

<section>
  <div class="mx-auto max-w-md flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <h1>Comprehensive Eye Examination Form</h1>
    <form id="form" action="php/test_process.php" method="post">
    <div class="step-count">
        Step <span id="current-step">1</span> of <span id="total-steps">5</span>
      </div>
      <!-- Step 1 -->
      <div class="step active">
        <!-- <label for="PatientID" class="hidden block mb-2 text-sm font-medium text-gray-900">Patient ID:</label> -->
        <input type="text" id="PatientID" name="PatientID" class="hidden" required value="<?php echo $patientId; ?>">

        <!-- <label for="DoctorID">Doctor ID:</label> -->
        <input type="text" id="DoctorID" name="DoctorID" class="hidden" required value="<?php echo $doctorId; ?>">

        <!-- <label for="DoctorID">Walk-In</label> -->
        <input type="text" id="walkIn" name="walkIn" class="hidden" required value="<?php echo $walkin; ?>">

        <label for="FirstName">First Name:</label>
        <input type="text" id="FirstName" name="FirstName" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $firstName; ?>"><br><br>

        <label for="LastName">Last Name:</label>
        <input type="text" id="LastName" name="LastName" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5" value="<?php echo $lastName; ?>"><br><br>

        <label for="DateOfBirth">Patient's Birthday:</label>
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

        <button type="button" class="stepper-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="nextStep()">Next</button>
      </div>

      <!-- Step 2 -->
      <div class="step">
        <label for="case_no">Case Number:</label>
        <input type="text" id="case_no" name="case_no" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg w-full p-2.5"><br><br>

        <label for="co_no">CO Number:</label>
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

        <button type="button" class="stepper-button bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="prevStep()">Previous</button>
        <input type="submit" value="Submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">

        <button type="button" class="stepper-button bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="prevStep()">Previous</button>
        <button type="button" class="stepper-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="nextStep()">Next</button>
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

  showStep(currentStep);
</script>


<script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

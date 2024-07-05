<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();
if (!isset($_SESSION['doctorId'])) { 
    header('location: index.php');
  }

$firstName = $_SESSION['firstName'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet"></head>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/script.js"></script>
<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>
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
            <div class="text-center p-2 flex font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Profile</div>
            <div class="w-10 h-10"></div> 
      </div>
    </div>
  </div>
</nav>


<?php require_once 'php/aside_doctor.php'; ?>

<section class="mb-8 pb-8 max-w-4xl mx-auto">
<div class="p-4 py-8 mt-8 sm:ml-64  ">
        <?php

// Fetch and sanitize PatientID from URL parameter
if (isset($_GET['id'])) {
    $patientID = $_GET['id'];
    // Perform database query to fetch profile information for $patientID
    $sql = "SELECT * FROM patients WHERE PatientID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $profileData = $result->fetch_assoc();
        // Display profile information
        ?>
        <div class="w-full bg-white-50 rounded-lg dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="">
                <div>
                    <!-- User Image -->
                    <div class="bg-blue-100 rounded-full bg-gray-50 border rounded-full w-16 h-16 flex items-center justify-center mx-auto overflow-hidden">
                            <img src="assets/profile.png" class="w-full object-cover" alt="Profile Icon">
                          </div>
                    <p class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center my-2">
                        <?= htmlspecialchars($profileData['FirstName']) . " " . htmlspecialchars($profileData['LastName']); ?>
                    </p>
                    <p class="text-gray-600 text-center">
                        <?= htmlspecialchars($profileData['Email']); ?>
                    </p>
                </div>
            </div>
        </div>
                <!-- appointment -->
   
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="w-full focus-within:z-10" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
                </li>
                <li class="w-full focus-within:z-10" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="medical-records-tab" data-tabs-target="#medical-records" type="button" role="tab" aria-controls="medical-records" aria-selected="false">Medical Records</button>
                </li>
            </ul>
        </div>

        <div id="default-tab-content">
            <div class="rounded-lg dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="max-w-4xl mx-auto  rounded-lg p-6">
                    <!-- Profile Details -->
                    <table class="w-full text-gray-600 dark:text-gray-400">
                        <tr>
                            <td class="px-4 py-4">Email:</td>   
                            <td class="font-medium px-4 py-2"><?= htmlspecialchars($profileData['Email']); ?></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-4">Contact:</td>
                            <td class="font-medium px-4 py-2"><?= htmlspecialchars($profileData['ContactNumber']); ?></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-4">Gender:</td>
                            <td class="font-medium px-4 py-2"><?= htmlspecialchars($profileData['Gender']); ?></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-4">Birthday:</td>
                            <td class="font-medium px-4 py-2"><?= htmlspecialchars(date('F j, Y', strtotime($profileData['DateOfBirth']))); ?></td>

                        </tr>

                        
                        <!-- Add more rows for additional profile details -->
                    </table>
                    <button id="buttonTest" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Take Test</button>

                </div>
            </div>

            <div class="hidden rounded-lg dark:bg-gray-800" id="medical-records" role="tabpanel" aria-labelledby="medical-records-tab">
                <div class="max-w-4xl mx-auto rounded-lg p-6">
                    <!-- Medical Records -->
                   <h2 class="text-lg font-semibold mb-4">Medical Records</h2>
                    <table class="w-full text-gray-600 dark:text-gray-400">
                        <?php
                        // Query to fetch tests associated with the patient
                        $sql_tests = "SELECT testID, case_no, date FROM test WHERE patientID = ?";
                        $stmt_tests = $conn->prepare($sql_tests);
                        $stmt_tests->bind_param('i', $patientID);
                        $stmt_tests->execute();
                        $result_tests = $stmt_tests->get_result();

                        if ($result_tests->num_rows > 0) {
                            while ($row = $result_tests->fetch_assoc()) {
                                ?>
                                <div class="border rounded-lg mb-4 p-4 text-gray-600 dark:text-gray-400 flex justify-between items-center">
                                    <div>
                                        <div class="font-medium">Case No: <?= htmlspecialchars($row['case_no']); ?></div>
                                        <div class="text-sm">Date: <?= htmlspecialchars(date('F j, Y', strtotime($row['date']))); ?></div>
                                    </div>
                                    <div>
                                        <a href="view_test.php?id=<?= $row['testID']; ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md">View</a>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No medical records found.";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "Patient not found.";
    }
} else {
    echo "PatientID not specified.";
}
?>

</section>

<?php require_once 'php/bottombar_doctor.php';?>
<script>
  $(document).ready(function() {
    $('#buttonTest').click(function() {
      // Replace with your PHP variable as needed
      var patientID = <?php echo json_encode($patientID); ?>;
      window.location.href = 'doctor_test.php?id=' + patientID;
    });
  });
</script>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

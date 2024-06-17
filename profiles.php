<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();

$firstName = $_SESSION['firstName'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet"></head>
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
<section>
<div class="mx-auto max-w-md flex-col items-center justify-center px-2 py-2 mx-auto md:h-screen lg:py-0">
        
        <!-- appbar -->
        <div class="bg-white flex items-center justify-between mb-4 border-b border-gray-200 pb-2">
            <button onclick="window.history.back();" class="text-gray-600 hover:text-blue-500 ml-2">
                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
            </button>
            <div class="text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Profile</div>
            <div class="w-10 h-10"></div> <!-- Placeholder for equal spacing, adjust as needed -->
        </div>
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
                    <div class="flex items-center justify-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/5212/5212004.png" class="w-24 p-2 bg-gray-50 border rounded-full" alt="user icon">
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
                    <a href="doctor_test.php?id=<?php echo $patientID ?>" class="w-full h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Take Examination</a>

                </div>
            </div>

            <div class="hidden rounded-lg dark:bg-gray-800" id="medical-records" role="tabpanel" aria-labelledby="medical-records-tab">
                <div class="max-w-4xl mx-auto rounded-lg p-6">
                    <!-- Medical Records -->
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


      <!-- bottombar  -->
      <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
            <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
                <a href="index.php" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Home</span>
                </a>
                <a href="book.php" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Book</span>
                </a>
                <a href="notification.php" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z"/>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Notification</span>
                </a>
                <a href="profile.php" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Profile</span>
                </a>
            </div>
        </div>
        <!-- bottombar  -->

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

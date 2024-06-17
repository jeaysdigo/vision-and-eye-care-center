<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();

// Fetch and sanitize testID from URL parameter
if (isset($_GET['id'])) {
    $testID = $_GET['id'];
    
    // Perform database query to fetch test information for $testID
    $sql = "SELECT *
            FROM test t 
            WHERE t.testID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $testID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $testData = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Test Results</title>
          <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body class="bg-gray-100">
        <div class="container mx-auto p-4">
            <div class="bg-white rounded shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <button onclick="window.history.back();" class="text-gray-600 hover:text-blue-500">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900">Test Results</h1>
                    <div class="w-6 h-6"></div> <!-- Placeholder for equal spacing -->
                </div>
                
                <!-- Personal Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-700"><strong>Case No:</strong> <?= htmlspecialchars($testData['case_no']); ?></p>
                        <p class="text-gray-700"><strong>CO No:</strong> <?= htmlspecialchars($testData['co_no']); ?></p>
                        <p class="text-gray-700"><strong>Date:</strong> <?= htmlspecialchars(date('F j, Y', strtotime($testData['date']))); ?></p>
                        <p class="text-gray-700"><strong>Doctor:</strong> <?= htmlspecialchars($testData['FirstName']) . " " . htmlspecialchars($testData['LastName']); ?></p>
                        <p class="text-gray-700"><strong>Patient ID:</strong> <?= htmlspecialchars($testData['PatientID']); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-700"><strong>Date of Birth:</strong> <?= htmlspecialchars(date('F j, Y', strtotime($testData['DateOfBirth']))); ?></p>
                        <p class="text-gray-700"><strong>Gender:</strong> <?= htmlspecialchars($testData['Gender']); ?></p>
                        <p class="text-gray-700"><strong>Contact Number:</strong> <?= htmlspecialchars($testData['ContactNumber']); ?></p>
                        <p class="text-gray-700"><strong>Occupation:</strong> <?= htmlspecialchars($testData['Occupation']); ?></p>
                        <p class="text-gray-700"><strong>Email:</strong> <?= htmlspecialchars($testData['Email']); ?></p>
                    </div>
                </div>

                <!-- Address Details -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-700"><strong>Address:</strong> <?= htmlspecialchars($testData['Address']); ?></p>
                        <p class="text-gray-700"><strong>Municipality:</strong> <?= htmlspecialchars($testData['Municipality']); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-700"><strong>City:</strong> <?= htmlspecialchars($testData['City']); ?></p>
                        <p class="text-gray-700"><strong>Zip Code:</strong> <?= htmlspecialchars($testData['ZipCode']); ?></p>
                    </div>
                </div>

                <!-- Medical Details -->
                <div class="mt-6">
                    <h3 class="font-bold text-xl text-gray-900">Medical Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-700"><strong>BP:</strong> <?= htmlspecialchars($testData['bp_sys']) . "/" . htmlspecialchars($testData['bp_dia']) ?></p>
                            <p class="text-gray-700"><strong>Respiratory Rate:</strong> <?= htmlspecialchars($testData['resp_rate']); ?></p>
                            <p class="text-gray-700"><strong>Pulse Rate:</strong> <?= htmlspecialchars($testData['pulse_rate']); ?></p>
                            <p class="text-gray-700"><strong>Glasses OD:</strong> <?= htmlspecialchars($testData['glasses_od']); ?></p>
                            <p class="text-gray-700"><strong>Glasses OS:</strong> <?= htmlspecialchars($testData['glasses_os']); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-700"><strong>Contact Lens OD:</strong> <?= htmlspecialchars($testData['contact_lens_od']); ?></p>
                            <p class="text-gray-700"><strong>Contact Lens OS:</strong> <?= htmlspecialchars($testData['contact_lens_os']); ?></p>
                            <p class="text-gray-700"><strong>Type SCL:</strong> <?= $testData['type_scl'] ? 'Yes' : 'No'; ?></p>
                            <p class="text-gray-700"><strong>Type GP:</strong> <?= $testData['type_gp'] ? 'Yes' : 'No'; ?></p>
                            <p class="text-gray-700"><strong>Type Toric:</strong> <?= $testData['type_toric'] ? 'Yes' : 'No'; ?></p>
                            <p class="text-gray-700"><strong>Add Value:</strong> <?= htmlspecialchars($testData['add_value']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
        </html>
        <?php
    } else {
        echo "Test details not found.";
    }
} else {
    echo "Invalid test ID.";
}
?>

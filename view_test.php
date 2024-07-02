<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();

if (!isset($_SESSION['doctorId'])) { 
    header('location: index.php');
    exit();
}

// Fetch and sanitize testID from URL parameter
if (isset($_GET['id'])) {
    $testID = intval($_GET['id']);
    
    // Perform database query to fetch test information for $testID
    $sql = "SELECT * FROM test WHERE testID = ?";
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
        <body class="bg-gray-50">
        <div class="container mx-auto p-4">
            <div class="bg-white rounded-lg p-4">
                <div class="flex justify-between items-center mb-8">
                    <button onclick="window.history.back();" class="text-gray-600 hover:text-blue-500">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900">Test Results</h1>
                    <div class="w-6 h-6"></div> <!-- Placeholder for equal spacing -->
                </div>

                <div class="grid grid-cols-2 md:grid-cols-2 gap-4 p-2 rounded-md">
                    <div class="flex flex-col space-y-2 md:space-y-0 md:flex-row md:gap-x-2">
                        <p class="text-gray-700">
                            <span class="font-medium">Case No:</span> <?= htmlspecialchars($testData['case_no']); ?>
                        </p>
                        <p class="text-gray-700">
                            <span class="font-medium">CO No:</span> <?= htmlspecialchars($testData['co_no']); ?>
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-700">
                            <span class="font-medium">Date:</span> <?= htmlspecialchars(date('F j, Y', strtotime($testData['date']))); ?>
                        </p>
                    </div>
                </div>


                <!-- Step 1 -->
                <h4 class="p-2 text-gray-700 font-medium">1. Patient's Profile</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-2 rounded-md">
                    
                    <div class="flex flex-col space-y-2 border rounded p-4">
                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="full_name" class="text-gray-700 font-medium">Full Name:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars($testData['FirstName']) . " " . htmlspecialchars($testData['LastName']); ?></p>
                            </div>
                        </div>

                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="date_of_birth" class="text-gray-700 font-medium">Date of Birth:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars(date('F j, Y', strtotime($testData['DateOfBirth']))); ?></p>
                            </div>
                        </div>

                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="gender" class="text-gray-700 font-medium">Gender:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars($testData['Gender']); ?></p>
                            </div>
                        </div>

                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="contact_no" class="text-gray-700 font-medium">Contact No.:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars($testData['ContactNumber']); ?></p>
                            </div>
                        </div>

                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="occupation" class="text-gray-700 font-medium">Occupation:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars($testData['Occupation']); ?></p>
                            </div>
                        </div>

                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="email" class="text-gray-700 font-medium">Email:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars($testData['Email']); ?></p>
                            </div>
                        </div>

                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="address" class="text-gray-700 font-medium">Address:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars($testData['Address']) . ", " 
                                . htmlspecialchars($testData['Municipality']). ", " . htmlspecialchars($testData['City']) . " " . htmlspecialchars($testData['ZipCode']) ; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Vital Signs & Current RX Section -->
                    <div class="flex flex-col space-y-2">
                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Vital Signs</h4>

                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <label for="bp" class="text-gray-700">Blood Pressure:</label>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm">120/80</p>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <label for="resp_rate" class="text-gray-700">Respiratory Rate:</label>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['resp_rate']); ?></p>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <label for="pulse_rate" class="text-gray-700">Pulse Rate:</label>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['pulse_rate']); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Current RX</h4>

                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">Glasses</p>
                                </div>
                                <div class="w-1/2">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="glasses_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['glasses_od_sph']) . " / " . htmlspecialchars($testData['glasses_od_cyl']) . " / " . htmlspecialchars($testData['glasses_od_add']); ?></p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="glasses_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['glasses_os_sph']) . " / " . htmlspecialchars($testData['glasses_os_cyl']) . " / " . htmlspecialchars($testData['glasses_os_add']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="mt-4">Contact Lens</p>
                                </div>
                                <div class="w-1/2">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <label for="contact_lens_od" class="text-gray-700">OD:</label>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['contact_lens_od']); ?></p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-1/3">
                                            <label for="contact_lens_os" class="text-gray-700">OS:</label>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['contact_lens_os']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Patient's History -->
                <h4 class="p-2 text-gray-700 font-medium">2. Patient's History</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4  border rounded-md">
                    <!-- Visual Ocular -->
                    <div class="flex flex-col space-y-2 p-2 ">
                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="visual_ocular" class="text-gray-700 font-medium">Visual Ocular:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars($testData['visual_ocular']); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Medical History -->
                    <div class="flex flex-col space-y-2">
                        <label for="medical_history_present" class="text-gray-700 font-medium">Medical History</label>
                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="medical_history_present" class="text-gray-700">Present Illness:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars($testData['medical_history_present']); ?></p>
                            </div>
                        </div>

                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="medical_history_past" class="text-gray-700">Past History:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars($testData['medical_history_past']); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Family History -->
                    <div class="flex flex-col space-y-2">
                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="family_history" class="text-gray-700 font-medium">Family History:</label>
                            </div>
                        </div>

                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="family_history_ocular" class="text-gray-700">Ocular:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars($testData['family_history_ocular']); ?></p>
                            </div>
                        </div>

                        <div class="flex mb-2 md:flex-col">
                            <div class="w-full md:w-1/2">
                                <label for="family_history_medical" class="text-gray-700">Medical:</label>
                            </div>
                            <div class="w-full md:w-1/2">
                                <p class="text-gray-700"><?= htmlspecialchars($testData['family_history_medical']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
               <!-- Step 3: PRELIMINARY EXAMINATION AND GENERAL OBSERVATION -->
                <h4 class="p-2 text-gray-700 font-medium">3. Preliminary Examination And General Observation</h4>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 p-2 rounded-md">
                    <!-- Unaided Distance -->
                    <div class=" border p-4 rounded-md">
                        <h5 class="text-gray-700 font-medium mb-2">Unaided Distance</h5>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OD:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_unaided_distance_od']) ?></p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OS:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_unaided_distance_os']) ?></p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OU:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_unaided_distance_ou']) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Unaided Near -->
                    <div class=" border p-4 rounded-md">
                        <h5 class="text-gray-700 font-medium mb-2">Unaided Near</h5>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OD:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_unaided_near_od']) ?></p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OS:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_unaided_near_os']) ?></p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OU:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_unaided_near_ou']) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Pinhole Vision -->
                    <div class=" border p-4 rounded-md">
                        <h5 class="text-gray-700 font-medium mb-2">Pinhole Vision</h5>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OD:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_pinhole_od']) ?></p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OS:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_pinhole_os']) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- V.A with current Rx (Far) -->
                    <div class=" border p-4 rounded-md">
                        <h5 class="text-gray-700 font-medium mb-2">V.A with current Rx (Far)</h5>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OD:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_far_od']) ?></p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OS:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_far_os']) ?></p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OU:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_far_ou']) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- V.A with current Rx (Near) -->
                    <div class=" border p-4 rounded-md">
                        <h5 class="text-gray-700 font-medium mb-2">V.A with current Rx (Near)</h5>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OD:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_near_od']) ?></p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OS:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_near_os']) ?></p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p class="text-gray-700">OU:</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_acuity_near_ou']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 p-2 rounded-md">
                    <!-- visual_acuity_unaided_distance_od -->
                    <div class="grid grid-rows-1  border p-4 rounded-md">
                        <div class="w-full">
                            <p class="sm:mt-0">Pupil Shape</p>
                        </div>
                        <div class="w-full">
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OD:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['pupil_shape_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OS:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['pupil_shape_os']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="sm:mt-0">Pupil Diameter</p>
                        </div>
                        <div class="w-full">
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OD:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['pupil_diameter_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OS:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['pupil_diameter_os']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">PD:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['pd']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">DE:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['de']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-rows-1  border p-4 rounded-md">
                        <div class="">
                            <div class="w-full">
                                <p for="glasses_od" class="text-gray-700">Eyes not aligned:</p>
                            </div>
                            <div class="w-full">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['eyes_not_aligned']) ?></p>
                            </div>
                        </div>
                        <div class="">
                            <div class="w-full">
                                <p for="glasses_od" class="text-gray-700">Abnormal Head Posture:</p>
                            </div>
                            <div class="w-full">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['abnormal_head_posture']) ?></p>
                            </div>
                        </div>
                        <div class="">
                            <div class="w-full">
                                <p for="glasses_od" class="text-gray-700">Face Tilt Direction</p>
                            </div>
                            <div class="w-full">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['face_tilt_direction']) ?></p>
                            </div>
                        </div>
                        <div class="">
                            <div class="w-full">
                                <p for="glasses_od" class="text-gray-700">Head Tilt Direction</p>
                            </div>
                            <div class="w-full">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['head_tilt_direction']) ?></p>
                            </div>
                        </div>
                        <div class="">
                            <div class="w-full">
                                <p for="glasses_od" class="text-gray-700">Other Pertinent Observations</p>
                            </div>
                            <div class="w-full">
                                <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['other_pertinent_observations']) ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-rows-1  border p-4 rounded-md">
                        <div class="w-full">
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">Push Up</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_push_up_amp']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">NPC</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_npc']) ?></p>
                                </div>
                            </div>
                            Corneal Reflex Test
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OD</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_corneal_reflex_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OS</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_corneal_reflex_os']) ?></p>
                                </div>
                            </div>
                            <p class="text-sm">Alternate Cover (SC / CC)</p>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">Far</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_alternate_cover_test_far_sc']) . " / " . htmlspecialchars($testData['motor_sensory_alternate_cover_test_far_cc'])?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">Near</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_alternate_cover_test_near_sc']) . " / " . htmlspecialchars($testData['motor_sensory_alternate_cover_test_near_cc'])?></p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">Smooth Pursuit</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_motility_test_smooth_pursuit']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">Saccadic</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_motility_test_saccadic']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-rows-1  border p-4 rounded-md">
                        <div class="w-full">
                            <p class="sm:mt-0">Puppillary Reflexr DLR</p>
                        </div>
                        <div class="w-full">
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OD:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_pupillary_reflex_dlr_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OS:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_pupillary_reflex_dlr_os']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="sm:mt-0">Indirect</p>
                        </div>
                        <div class="w-full">
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OD:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_pupillary_reflex_indirect_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OS:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_pupillary_reflex_indirect_os']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="sm:mt-0">Accom</p>
                        </div>
                        <div class="w-full">
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OD:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_pupillary_reflex_accommodation_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OS:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_pupillary_reflex_accommodation_os']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-rows-1 p-4 rounded-md">
                        <div class="w-full">
                            <p class="sm:mt-0">Swinging Flashlight </p>
                        </div>
                        <div class="w-full">
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OD:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_pupillary_reflex_swinging_flashlight_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OS:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_pupillary_reflex_swinging_flashlight_os']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="sm:mt-0">Amsler Test </p>
                        </div>
                        <div class="w-full">
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OD:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_amsler_test_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OS:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_amsler_test_os']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="sm:mt-0">Proj. Test </p>
                        </div>
                        <div class="w-full">
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OD:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_proj_test_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-full">
                                    <p for="glasses_od" class="text-gray-700">OS:</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['motor_sensory_proj_test_os']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                

                <!-- Step 4: OBJECTIVE REFRACTION -->
                <h4 class="p-2 text-gray-700 font-medium">4. OBJECTIVE REFRACTION</h4>
                <div class="flex flex-col space-y-2">
                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Current RX</h4>

                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">Static Retinoscopy</p>
                                </div>
                                <div class="w-1/2">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="glasses_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['objective_refraction_static_retinoscopy_od']); ?></p>
                                        </div>
                                        <div class="w-1/3">
                                            <p for="glasses_od" class="text-gray-700">20/</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['objective_refraction_static_retinoscopy_od_over']); ?></p>
                                        </div>
                                    </div>
                                  

                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="glasses_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['objective_refraction_static_retinoscopy_os']) ?></p>
                                        </div>
                                        <div class="w-1/3">
                                            <p for="glasses_od" class="text-gray-700">20/</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['objective_refraction_static_retinoscopy_os_over']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="mt-4">Dynamic Retinoscopy at 20”</p>
                                </div>
                                <div class="w-1/2">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <label for="contact_lens_od" class="text-gray-700">OD:</label>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['objective_refraction_dynamic_retinoscopy_od']); ?></p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-1/3">
                                            <label for="contact_lens_os" class="text-gray-700">OS:</label>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['objective_refraction_dynamic_retinoscopy_os']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Step 5: SUBJECTIVE REFRACTION -->
                <h4 class="p-2 text-gray-700 font-medium">5. Subjective Refraction</h4>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-4 p-2 rounded-md">

                    <div class="flex flex-col space-y-2">

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Manifest</h4>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Mono</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-full">
                                            <p for="glasses_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['subjective_refraction_manifest_mono_od']) ?></p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-full">
                                            <p for="glasses_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['subjective_refraction_manifest_mono_os']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="mt-4">Bino</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-full">
                                            <p for="glasses_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['subjective_refraction_manifest_bino_od']) ?></p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-full">
                                            <p for="glasses_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['subjective_refraction_manifest_bino_os']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="mt-4">Visual Acuity</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-full">
                                            <p for="glasses_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['subjective_refraction_visual_acuity_od']) ?></p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-full">
                                            <p for="glasses_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['subjective_refraction_visual_acuity_os']) ?></p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-full">
                                            <p for="glasses_ou" class="text-gray-700">OU:</p>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['subjective_refraction_visual_acuity_ou']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="mt-4">Cycloplegic</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-full">
                                            <p for="glasses_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['subjective_refraction_cycloplegic_od']) ?></p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-full">
                                            <p for="glasses_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['subjective_refraction_cycloplegic_os']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="mt-4">Cycloplegic Visual Acuity</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-full">
                                            <p for="glasses_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['subjective_refraction_cycloplegic_visual_acuity_od']) ?></p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-full">
                                            <p for="glasses_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['subjective_refraction_cycloplegic_visual_acuity_os']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Step 6: PHOROMETRIC AND ACCOMMODATION TEST -->
                <h4 class="p-2 text-gray-700 font-medium">6. Phorometric and Accommodation Test</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-2 rounded-md">

                    <div class="flex flex-col space-y-2">

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Phorometric Test</h4>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Lateral Phoria (20 ft)</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="habitual" class="text-gray-700">Habitual:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['phorometric_test_lateral_phoria_20ft_habitual']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="induced" class="text-gray-700">Induced:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['phorometric_test_lateral_phoria_20ft_induced']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Lateral Phoria (16 in)</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="habitual" class="text-gray-700">Habitual:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['phorometric_test_lateral_phoria_16in_habitual']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="induced" class="text-gray-700">Induced:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['phorometric_test_lateral_phoria_16in_induced']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="induced_13bg" class="text-gray-700">Induced 13BG:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['phorometric_test_lateral_phoria_16in_induced_13bg']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Vertical Phoria</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="20ft" class="text-gray-700">20 ft:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['phorometric_test_vertical_phoria_20ft']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="16in" class="text-gray-700">16 in:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['phorometric_test_vertical_phoria_16in']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Duction</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="20ft" class="text-gray-700">20 ft:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['phorometric_test_duction_20ft']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="16in" class="text-gray-700">16 in:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['phorometric_test_duction_16in']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Vergence Test</h4>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">20 ft</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="bi" class="text-gray-700">BI:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['vergence_test_bi_20ft']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="bo" class="text-gray-700">BO:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['vergence_test_bo_20ft']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">16 in</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="bi" class="text-gray-700">BI:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['vergence_test_bi_16in']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="bo" class="text-gray-700">BO:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['vergence_test_bo_16in']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2">

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Accommodation Test</h4>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Amp of Accom</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="amp_of_accom" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['accommodation_test_amp_of_accom']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Unfused Crossed Cyl</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="unfussed_crossed_cyl_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['accommodation_test_unfussed_crossed_cyl_od']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="unfussed_crossed_cyl_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['accommodation_test_unfussed_crossed_cyl_os']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="unfussed_crossed_cyl_other" class="text-gray-700">Other:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['accommodation_test_unfussed_crossed_cyl_other']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Fused Crossed Cyl</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="fused_crossed_cyl_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['accommodation_test_fused_crossed_cyl_od']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="fused_crossed_cyl_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['accommodation_test_fused_crossed_cyl_os']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="fused_crossed_cyl_other" class="text-gray-700">Other:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['accommodation_test_fused_crossed_cyl_other']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">NRA</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="nra_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['accommodation_test_nra_od']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="nra_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['accommodation_test_nra_os']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">PRA</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="pra_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['accommodation_test_pra_od']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <p for="pra_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-2/3">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['accommodation_test_pra_os']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 7: PRISM COVER TEST AND OTHER TESTS -->
                <h4 class="p-2 text-gray-700 font-medium">7. Prism Cover Test and Other Tests</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-2 rounded-md">

                    <div class="flex flex-col space-y-2">

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Prism Cover Test</h4>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Hirschberg</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['prism_cover_test_hirschberg']) ?></p>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Hirshberg Test</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['hirshberg_test']) ?></p>
                                </div>
                            </div>
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Worth's Four Dots</h4>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Far</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['worths_four_dots_far']) ?></p>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Near</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['worths_four_dots_near']) ?></p>
                                </div>
                            </div>
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Krimsky Test</h4>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['krimsky_test']) ?></p>
                                </div>
                            </div>
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Maddox Rod</h4>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['maddox_rod']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2">

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Color Vision</h4>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Ishihara Test</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['color_vision_ishihara_test']) ?></p>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">D15 Test</p>
                                </div>
                                <div class="w-full">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['color_vision_d15_test']) ?></p>
                                </div>
                            </div>
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Visual Field Test</h4>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">Confrontation</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="confrontation_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_field_test_confrontation_od']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="confrontation_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_field_test_confrontation_os']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-full">
                                    <p class="sm:mt-0">ATS</p>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="ats_od" class="text-gray-700">OD:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_field_test_ats_od']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <p for="ats_os" class="text-gray-700">OS:</p>
                                        </div>
                                        <div class="w-1/2">
                                            <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['visual_field_test_ats_os']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 8: TRIAL FRAMING -->
                <h4 class="p-2 text-gray-700 font-medium">8. Trial Framing</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-2 rounded-md">

                    <div class="flex flex-col space-y-2">

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Distance</h4>

                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OD</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['trial_framing_distance_od']) ?></p>
                                </div>
                                <div class="w-1/2">
                                    <p class="sm:mt-0">20/</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['trial_framing_distance_od_over']) ?></p>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OS</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['trial_framing_distance_os']) ?></p>
                                </div>
                                <div class="w-1/2">
                                    <p class="sm:mt-0">20/</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['trial_framing_distance_os_over']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2">

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Addition</h4>

                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OD</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['trial_framing_add_od']) ?></p>
                                </div>
                                <div class="w-1/2">
                                    <p class="sm:mt-0">20/</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['trial_framing_add_od_over']) ?></p>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OS</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['trial_framing_add_os']) ?></p>
                                </div>
                                <div class="w-1/2">
                                    <p class="sm:mt-0">20/</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['trial_framing_add_os_over']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="p-2 text-gray-700 font-medium">9. Biomicroscopy</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-2 rounded-md">

                    <div class="flex flex-col space-y-2">
                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Eyelids</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OD</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_eyelids_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OS</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_eyelids_os']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Eyelids here if needed -->
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Eyelashes</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OD</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_eyelashes_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OS</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_eyelashes_os']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Eyelashes here if needed -->
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Lid Margin</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OD</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_lid_margin_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OS</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_lid_margin_os']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Lid Margin here if needed -->
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Ducts</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OD</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_ducts_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OS</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_ducts_os']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Ducts here if needed -->
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Conjunctiva</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OD</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_conjunctiva_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OS</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_conjunctiva_os']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Conjunctiva here if needed -->
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Sclera</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OD</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_sclera_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OS</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_sclera_os']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Sclera here if needed -->
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Pupil</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OD</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_pupil_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OS</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_pupil_os']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Pupil here if needed -->
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Iris</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OD</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_iris_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OS</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_iris_os']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Iris here if needed -->
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Lens</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OD</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_lens_od']) ?></p>
                                </div>
                            </div>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">OS</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_lens_os']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Lens here if needed -->
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Other Tests</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">Other Tests</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_other_tests']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Other Tests here if needed -->
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Von Herrick</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">Von Herrick</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_von_herrick']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Von Herrick here if needed -->
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">TBUT (Tear Break-Up Time)</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">TBUT</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_tbut']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to TBUT here if needed -->
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Schirmer's Test</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">Schirmer's Test</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_schirmers_test']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Schirmer's Test here if needed -->
                        </div>

                        <div class=" border p-4 rounded-md">
                            <h4 class="text-gray-700 font-medium mb-2">Tear Meniscus</h4>
                            <div class="flex mb-2">
                                <div class="w-1/2">
                                    <p class="sm:mt-0">Tear Meniscus</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['biomicroscopy_tear_meniscus']) ?></p>
                                </div>
                            </div>
                            <!-- Add other fields related to Tear Meniscus here if needed -->
                        </div>

                        <div class=" border p-4 rounded-md">
                        <div class="">
                                    <!-- Empty img tag for displaying the converted image -->
                                    <img id="converted-image" class="text-gray-900 sm:text-sm" src="" alt="Biomicroscopy Image">
                                </div>
                        </div>

                    </div>

                </div>

                <!-- step 10  -->
                 <!-- Step 10: INTRAOCULAR PRESSURE -->
<h4 class="p-2 text-gray-700 font-medium">10. Intraocular Pressure</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-2 rounded-md">
    <div class=" border p-4 rounded-md">
        <h4 class="text-gray-700 font-medium mb-2">Tactile</h4>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">OD:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_tactile_od']) ?></p>
        </div>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">OS:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_tactile_os']) ?></p>
        </div>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">Time Taken:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_tactile_time_taken']) ?></p>
        </div>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">Time Tested:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_tactile_time_tested']) ?></p>
        </div>
    </div>

    <div class=" border p-4 rounded-md">
        <h4 class="text-gray-700 font-medium mb-2">Applanation Tonometry</h4>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">OD:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_tonometry_applanation_od']) ?></p>
        </div>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">OS:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_tonometry_applanation_os']) ?></p>
        </div>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">Time Taken:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_tonometry_applanation_time_taken']) ?></p>
        </div>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">Time Tested:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_tonometry_applanation_time_tested']) ?></p>
        </div>
    </div>

    <div class=" border p-4 rounded-md">
        <h4 class="text-gray-700 font-medium mb-2">ICare</h4>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">OD:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_icare_od']) ?></p>
        </div>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">OS:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_icare_os']) ?></p>
        </div>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">Time Taken:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_icare_time_taken']) ?></p>
        </div>
        <div class="flex mb-2">
            <p class="w-1/2 sm:mt-0">Time Tested:</p>
            <p class="w-1/2 text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['intra_ocular_pressure_icare_os_time_tested']) ?></p>
        </div>
    </div>
</div>


<!-- Step 11: POSTERIOR SEGMENT EXAMINATION -->
<h4 class="p-2 text-gray-700 font-medium">11. Posterior Segment Examination</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-2 rounded-md">
    <div class=" border p-4 rounded-md">
        <?php
        $posteriorSegmentLabels = [
            'ROR' => 'ROR',
            'Media' => 'Media',
            'Optic Disc' => 'Optic Disc',
            'C/D' => 'CD',
            'AV' => 'AV',
            'Edema' => 'Edema',
            'Hemorrhage' => 'Hemorrhage',
            'Exudates' => 'Exudates',
            'Cotton Wool Spots' => 'Cotton Wool Spots',
            'Foveal Reflex' => 'Foveal Reflex',
        ];

        foreach ($posteriorSegmentLabels as $key => $label) {
            ?>
            <div class="flex mb-2">
                <h4 class="text-gray-700 font-medium mb-2 w-1/2"><?= $label ?>:</h4>
                <p class="w-1/2 text-gray-900 sm:text-sm">
                    <?= htmlspecialchars($testData['posterior_segment_exam_' . strtolower(str_replace(' ', '_', $label)) . '_od']) ?>
                </p>
                <p class="w-1/2 text-gray-900 sm:text-sm">
                    <?= htmlspecialchars($testData['posterior_segment_exam_' . strtolower(str_replace(' ', '_', $label)) . '_os']) ?>
                </p>
            </div>
    
            <?php
        }
        
        ?>

    </div>
    <img id="converted-image2" class="text-gray-900 sm:text-sm" src="" alt="Biomicroscopy Image">
            
</div>


<!-- Step 12: EVALUATION -->
<h4 class="p-2 text-gray-700 font-medium">12. Evaluation</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-2 rounded-md">
    <div class=" border p-4 rounded-md">
        <h4 class="text-gray-700 font-medium mb-2">Impression</h4>
        <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['evaluation_impression']) ?></p>

        <h4 class="text-gray-700 font-medium mt-4 mb-2">Final Rx</h4>
        <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['evaluation_finalrx']) ?></p>

        <h4 class="text-gray-700 font-medium mt-4 mb-2">Referral</h4>
        <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['evaluation_referral']) ?></p>

        <h4 class="text-gray-700 font-medium mt-4 mb-2">Follow-up</h4>
        <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['evaluation_follow_up']) ?></p>
    </div>

    <div class=" border p-4 rounded-md">
        <h4 class="text-gray-700 font-medium mb-2">External</h4>
        <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['evaluation_external']) ?></p>

        <h4 class="text-gray-700 font-medium mt-4 mb-2">Refraction Objective</h4>
        <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['evaluation_refraction_obj']) ?></p>

        <h4 class="text-gray-700 font-medium mt-4 mb-2">Refraction Subjective</h4>
        <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['evaluation_refraction_subj']) ?></p>

        <h4 class="text-gray-700 font-medium mt-4 mb-2">Other Test</h4>
        <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['evaluation_other_test']) ?></p>

        <h4 class="text-gray-700 font-medium mt-4 mb-2">Assessment & Management</h4>
        <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['evaluation_ass_management']) ?></p>

        <h4 class="text-gray-700 font-medium mt-4 mb-2">Dispensing</h4>
        <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['evaluation_dispensing']) ?></p>

        <h4 class="text-gray-700 font-medium mt-4 mb-2">Supervisor</h4>
        <p class="text-gray-900 sm:text-sm"><?= htmlspecialchars($testData['evaluation_supervisor']) ?></p>
    </div>
</div>








                 





   

            </div>
        </div>
        </body>
        </html>
        <?php
    } else {
        header('location: error.php');
    }
} else {
    header('location: error.php');
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    // Example blob data (replace with your actual base64 encoded blob data)
    var base64Data1 = '<?= htmlspecialchars($testData['biomicroscopy_image']) ?>';
    var base64Data2 = '<?= htmlspecialchars($testData['posterior_segment_exam']) ?>';

    // Function to convert base64 to blob
    function base64ToBlob(base64Data, contentType) {
        var byteCharacters = atob(base64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += 512) {
            var slice = byteCharacters.slice(offset, offset + 512);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);
            byteArrays.push(byteArray);
        }

        return new Blob(byteArrays, { type: contentType });
    }

    // Convert base64 strings to blobs
    var contentType1 = 'image/jpeg'; // Adjust image type as needed
    var blob1 = base64ToBlob(base64Data1, contentType1);
    var imageUrl1 = URL.createObjectURL(blob1);
    $('#converted-image').attr('src', imageUrl1);

    var contentType2 = 'image/jpeg'; // Adjust image type as needed
    var blob2 = base64ToBlob(base64Data2, contentType2);
    var imageUrl2 = URL.createObjectURL(blob2);
    $('#converted-image2').attr('src', imageUrl2);
});

</script>


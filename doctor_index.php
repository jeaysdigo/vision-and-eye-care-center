<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();

$firstName = $_SESSION['firstName'];
$doctorId = $_SESSION['doctorId'];
$sql = "SELECT patients.PatientID, doctors.FirstName, doctors.LastName, services.ServiceName, appointments.AppointmentDate,
appointments.AppointmentID, appointments.Notes, patients.FirstName, patients.LastName
        FROM appointments 
        INNER JOIN doctors ON appointments.DoctorID = doctors.DoctorID
        INNER JOIN patients ON appointments.PatientID = patients.PatientID
        INNER JOIN services ON appointments.ServiceID = services.ServiceID 
        WHERE appointments.DoctorID = $doctorId AND appointments.Status = 'InReview'";
        
$sql2 = "SELECT patients.PatientID, doctors.FirstName, doctors.LastName, services.ServiceName, appointments.AppointmentDate,
        appointments.AppointmentID, patients.FirstName, patients.LastName
                FROM appointments 
                INNER JOIN doctors ON appointments.DoctorID = doctors.DoctorID
                INNER JOIN patients ON appointments.PatientID = patients.PatientID
                INNER JOIN services ON appointments.ServiceID = services.ServiceID 
                WHERE appointments.DoctorID = $doctorId AND appointments.Status = 'Approved'";

$sql3 = "SELECT patients.PatientID, doctors.FirstName, doctors.LastName, services.ServiceName, appointments.AppointmentDate,
        appointments.AppointmentID, patients.FirstName, patients.LastName
                FROM appointments 
                INNER JOIN doctors ON appointments.DoctorID = doctors.DoctorID
                INNER JOIN patients ON appointments.PatientID = patients.PatientID
                INNER JOIN services ON appointments.ServiceID = services.ServiceID 
                WHERE appointments.DoctorID = $doctorId AND appointments.Status = 'Completed'";

$sql4 = "SELECT patients.PatientID, doctors.FirstName, doctors.LastName, services.ServiceName, appointments.AppointmentDate,
appointments.AppointmentID, patients.FirstName, patients.LastName
        FROM appointments 
        INNER JOIN doctors ON appointments.DoctorID = doctors.DoctorID
        INNER JOIN patients ON appointments.PatientID = patients.PatientID
        INNER JOIN services ON appointments.ServiceID = services.ServiceID 
        WHERE appointments.DoctorID = $doctorId AND appointments.Status = 'Cancelled'";
$result = $conn->query($sql); 
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
$result4 = $conn->query($sql4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet"></head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <div class="text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Home</div>
            <div class="w-10 h-10"></div> <!-- Placeholder for equal spacing, adjust as needed -->
        </div>

        <div class="mb-4 border-b border-gray-200 dark:border-gray-700 ">
        <ul class="flex -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="w-full focus-within:z-10" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="in-review-tab" data-tabs-target="#in-review" type="button" role="tab" aria-controls="in-review" aria-selected="false">In-Review</button>
            </li>
            <li class="w-full focus-within:z-10" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="approved-tab" data-tabs-target="#approved" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Approved</button>
            </li>
            <li class="w-full focus-within:z-10" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="completed-tab" data-tabs-target="#completed" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Completed</button>
            </li>
            <li class="w-full focus-within:z-10" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="cancelled-tab" data-tabs-target="#cancelled" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Cancelled</button>
            </li>
         
        </ul>
    </div>

        <div id="default-tab-content">
        <div class="hidden rounded-lg dark:bg-gray-800" id="in-review" role="tabpanel" aria-labelledby="in-review-tab">

        <!-- list of in-review -->
        <div class="max-w-4xl mx-auto bg-white rounded-lg">
            <ul class="divide-y divide-gray-200">
                <!-- Appointment Item -->
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    echo '<div class="max-w-4xl mx-auto bg-white rounded-lg">
                            <ul class="divide-y divide-gray-200">';
                    // Inside the PHP loop
                    while ($row = $result->fetch_assoc()) {
                        $approveButtonId = 'approveButton_' . $row["AppointmentID"];
                        $cancelButtonId = 'cancelButton_' . $row["AppointmentID"];
                        $appointmentDate = date("g:i A - F j, Y", strtotime($row["AppointmentDate"]));
                        echo '<li class="p-4 flex flex-col md:flex-row justify-between items-center bg-gray-25 hover:bg-gray-25 rounded-lg mb-4 shadow-sm transition">
                        <div class="flex items-center">
                          <div class="p-4 bg-blue-100 rounded-full">
                            <i class="bi bi-person-fill text-blue-500"></i>
                          </div>
                          <div class="p-2 ml-2">
                            <p class="text-lg p-1 font-medium text-gray-900">'. $row["FirstName"] . ' ' . $row["LastName"] .'</p>
                            <p class="text-sm p-1 text-gray-500"><i class="bi bi-eye-fill text-gray-400"></i> '  . $row["ServiceName"] .  '</p>
                            <p class="text-sm  p-1 text-gray-500"><i class="bi bi-calendar-fill text-gray-400"></i> ' . $appointmentDate . '</p>
                            <p class="text-sm  p-1 text-gray-500"><i class="bi bi-sticky-fill text-gray-400"></i> ' . $row["Notes"] . '</p>
                          </div>
                        </div>
                        <button id="' . $approveButtonId . '" class="mt-4 md:mt-0 approveButton text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                          <i class="bi bi-x-lg"></i> Accept
                        </button>
                        <button id="' . $cancelButtonId . '" class="mt-4 md:mt-0 cancelButton text-blue-500 bg-blue-100 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                          <i class="bi bi-x-lg"></i> Cancel
                        </button>
                      </li>';
                    }
                    

                    echo '</ul>
                        </div>';
                } else {
                    echo "<p class='text-center p-4 text-sm text-gray-500 dark:text-gray-400'>No results found.</p>";
                }
                ?>
                
            </ul>
        </div>
        
        </div>
        <div class="hidden rounded-lg dark:bg-gray-800" id="approved" role="tabpanel" aria-labelledby="approved-tab">
               <!-- list of approved -->
               <div class="max-w-4xl mx-auto bg-white rounded-lg">
            <ul class="divide-y divide-gray-200">
                <!-- Appointment Item -->
                <?php
                if ($result2->num_rows > 0) {
                    // Output data of each row
                    echo '<div class="max-w-4xl mx-auto bg-white rounded-lg">
                            <ul class="divide-y divide-gray-200">';
                    // Inside the PHP loop
                    while ($row = $result2->fetch_assoc()) {
                        $cancelButtonId = 'cancelButton_' . $row["AppointmentID"];
                        $appointmentDate = date("g:i A - F j, Y", strtotime($row["AppointmentDate"]));
                        echo '<li class="p-4 flex flex-row md:flex-row justify-between items-center bg-gray-25 hover:bg-gray-25 rounded-lg mb-4 shadow-sm transition">
                        <div class="flex items-center">
                          <div class="p-4 bg-blue-100 rounded-full">
                            <i class="bi bi-person-fill text-blue-500"></i>
                          </div>
                          <div class="p-2 ml-2">
                            <p class="text-lg p-1 font-medium text-gray-900">'. $row["FirstName"] . ' ' . $row["LastName"] .'</p>
                            <p class="text-sm p-1 text-gray-500"><i class="bi bi-eye-fill text-gray-400"></i> '  . $row["ServiceName"] .  '</p>
                            <p class="text-sm  p-1 text-gray-500"><i class="bi bi-calendar-fill text-gray-400"></i> ' . $appointmentDate . '</p>
                          </div>
                        </div>
                        <button id="' . $cancelButtonId . '" class="mt-4 md:mt-0 cancelButton text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                          <i class="bi bi-x-lg"></i> Take test
                        </button>
                      </li>';
                    }

                    echo '</ul>
                        </div>';
                } else {
                    echo "<p class='text-center p-4 text-sm text-gray-500 dark:text-gray-400'>No results found.</p>";
                }
                ?>
                
            </ul>
        </div>
        </div>
        <div class="hidden rounded-lg dark:bg-gray-800" id="completed" role="tabpanel" aria-labelledby="completed-tab">
              <!-- list of completed -->
        <div class="max-w-4xl mx-auto bg-white rounded-lg">
            <ul class="divide-y divide-gray-200">
                <!-- Appointment Item -->
                <?php
                if ($result3->num_rows > 0) {
                    // Output data of each row
                    echo '<div class="max-w-4xl mx-auto bg-white rounded-lg">
                            <ul class="divide-y divide-gray-200">';
                   // Inside the PHP loop
                   while ($row = $result3->fetch_assoc()) {
                    $cancelButtonId = 'cancelButton_' . $row["AppointmentID"];
                    $appointmentDate = date("g:i A - F j, Y", strtotime($row["AppointmentDate"]));
                    echo '<li class="p-4 flex flex-row md:flex-row justify-between items-center bg-gray-25 hover:bg-gray-25 rounded-lg mb-4 shadow-sm transition">
                    <div class="flex items-center">
                      <div class="p-4 bg-blue-100 rounded-full">
                        <i class="bi bi-person-fill text-blue-500"></i>
                      </div>
                      <div class="p-2 ml-2">
                        <p class="text-lg p-1 font-medium text-gray-900">'. $row["FirstName"] . ' ' . $row["LastName"] .'</p>
                        <p class="text-sm p-1 text-gray-500"><i class="bi bi-eye-fill text-gray-400"></i> '  . $row["ServiceName"] .  '</p>
                        <p class="text-sm  p-1 text-gray-500"><i class="bi bi-calendar-fill text-gray-400"></i> ' . $appointmentDate . '</p>
                      </div>
                    </div>
                    <button id="' . $cancelButtonId . '" class="mt-4 md:mt-0 cancelButton text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                      <i class="bi bi-x-lg"></i> Cancel
                    </button>
                  </li>';
                }

                    echo '</ul>
                        </div>';
                } else {
                    echo "<p class='text-center p-4 text-sm text-gray-500 dark:text-gray-400'>No results found.</p>";
                }
                ?>
                
            </ul>
        </div>
        </div>
        <div class="hidden dark:bg-gray-800" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
        <!-- list of cancelled -->
        <div class="max-w-4xl mx-auto bg-white rounded-lg">
            <ul class="divide-y divide-gray-200">
                <!-- Appointment Item -->
                <?php
                if ($result4->num_rows > 0) {
                    // Output data of each row
                    echo '<div class="max-w-4xl mx-auto bg-white rounded-lg">
                            <ul class="divide-y divide-gray-200">';
                   // Inside the PHP loop
                   while ($row = $result4->fetch_assoc()) {
                    $cancelButtonId = 'cancelButton_' . $row["AppointmentID"];
                    $appointmentDate = date("g:i A - F j, Y", strtotime($row["AppointmentDate"]));
                    echo '<li class="p-4 flex flex-row md:flex-row justify-between items-center bg-gray-25 hover:bg-gray-25 rounded-lg mb-4 shadow-sm transition">
                    <div class="flex items-center">
                      <div class="p-4 bg-blue-100 rounded-full">
                        <i class="bi bi-person-fill text-blue-500"></i>
                      </div>
                      <div class="p-2 ml-2">
                        <p class="text-lg p-1 font-medium text-gray-900">'. $row["FirstName"] . ' ' . $row["LastName"] .'</p>
                        <p class="text-sm p-1 text-gray-500"><i class="bi bi-eye-fill text-gray-400"></i> '  . $row["ServiceName"] .  '</p>
                        <p class="text-sm  p-1 text-gray-500"><i class="bi bi-calendar-fill text-gray-400"></i> ' . $appointmentDate . '</p>
                      </div>
                    </div>
                 
                  </li>';
                }

                    echo '</ul>
                        </div>';
                } else {
                    echo "<p class='text-center p-4 text-sm text-gray-500 dark:text-gray-400'>No results found.</p>";
                }
                ?>
                
            </ul>
        </div>
        </div>
    </div>


      
</section>


        <!-- bottombar  -->
        <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
            <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
                <a href="doctor_index.php" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Home</span>
                </a>
                <a href="doctor_patients.php" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Patients</span>
                </a>
                <a href="doctor_test.php" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-6 8a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Add test</span>
                </a>
                <a href="doctor_profile.php" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Profile</span>
                </a>
            </div>
        </div>
        <!-- bottombar  -->

        <script>
    $(document).ready(function() {
        // Attach click event listener to each cancel button
        $('.cancelButton').on('click', function() {
            var appointmentId = $(this).attr('id').replace('cancelButton_', '');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('cancellinng', appointmentId);
                    // Make an AJAX request to cancel the appointment
                    $.ajax({
                        type: 'POST',
                        url: 'php/cancel_book.php', // Replace with the URL of your cancel appointment PHP script
                        data: { appointmentId: appointmentId },
                        success: function(response) {
                            console.log('cancelled', appointmentId);
                            Swal.fire(
                                'Cancelled!',
                                'Your appointment has been cancelled.',
                                'success'
                            ).then((result) => {
                                // Reload the page after successful cancellation
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire(
                                'Error!',
                                'Failed to cancel the appointment. Please try again.',
                                'error'
                            );
                        }
                    });
                }
            });
        });


        //accept 
         $('.approveButton').on('click', function() {
            var appointmentId = $(this).attr('id').replace('approveButton_', '');

            $.ajax({
                        type: 'POST',
                        url: 'php/approve_book.php', 
                        data: { appointmentId: appointmentId },
                        success: function(response) {
                            console.log('APPROVED', appointmentId);
                            Swal.fire(
                                'Approved!',
                                'The appointment has been approved',
                                'success'
                            ).then((result) => {
                                console.log('APPROVED success', appointmentId);
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire(
                                'Error!',
                                'Failed to approve the appointment. Please try again.',
                                'error'
                            );
                        }
                    });

  
        });
    });
</script>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

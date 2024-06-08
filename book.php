<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();

$firstName = $_SESSION['firstName'];

// Query to fetch services
$sql = "SELECT * FROM services";
$result = $conn->query($sql);

// Query to fetch doctors
$sql2 = "SELECT * FROM doctors WHERE isAdmin = 0";
$result2 = $conn->query($sql2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/datepicker.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/book.js"></script>

<script>
$(document).ready(function(){
    // Get the current date
    var currentDate = new Date();
    
    // Format the date as MM/DD/YYYY
    var formattedDate = (currentDate.getMonth() + 1) + '/' + currentDate.getDate() + '/' + currentDate.getFullYear();
    
    // Update the data-date attribute of the div with the current date
    $('div[inline-datepicker]').attr('data-date', formattedDate);
});
 


        </script>
</head>
<body>


    
  <section>
  <div class="mx-auto max-w-md flex-col items-center justify-center px-2 py-2 mx-auto md:h-screen lg:py-0">
        
        <!-- appbar -->
        <div class="flex items-center justify-between mb-4 border-b border-gray-200 pb-2">
            <button onclick="window.history.back();" class="text-gray-600 hover:text-blue-500 ml-2">
                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
            </button>
            <div class="text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Book Appointment</div>
            <div class="w-10 h-10"></div> <!-- Placeholder for equal spacing, adjust as needed -->
        </div>
        
        <!-- appointment -->
     <!-- Modal body -->
     <div class="p-4 pt-0">
     <label class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Select date</label>
    <div class="relative max-w-sm mb-2 block">
    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
        </svg>
    </div>
    <input inputmode="none" datepicker datepicker-buttons datepicker-autohide datepicker-autoselect-today type="text" id="datePicker" required="required" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
    </div>
</div>


<div class="p-4 pt-0">
    <label class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Pick your time</label>
    <div id="timetable" class="grid w-full grid-cols-3 gap-2 mb-5">
        <!-- popuplate using the time button using js -->
    </div>

    <div class="mb-4">
        <label for="service" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select service</label>
        <select name="service" id="service" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="required">
            <option value="">Select service</option>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["ServiceID"] . '">' . $row["ServiceName"] . '</option>';
                }
            } else {
                echo '<option value="">No services available</option>';
            }
            
            ?>
        </select>
    </div>

    <div class="mb-4">
        <label for="doctorId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select doctor:</label>
        <select name="doctorId" id="doctorId" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="required">
            <option value="">Select doctor</option>
            <?php
            if ($result2->num_rows > 0) {
                // Output data of each row
                while($row = $result2->fetch_assoc()) {
                    echo '<option value="' . $row["DoctorID"] . '">' . $row["FirstName"] . ' '. $row["LastName"] . '</option>';
                }
            } else {
                echo '<option value="">No services available</option>';
            }
            $conn->close();
            ?>
        </select>
    </div>

    <div class="mb-4">
         <label for="note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes <span class="text-sm text-gray-400">(optional)</span></label>
         <input type="text" name="note" id="note" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write a note">
    </div>

    <div class="mb-4 hidden">
         <label for="patientId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">patientId</label>
         <input type="text" name="patientId" id="patientId" value="<?php echo $_SESSION['patientId'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    </div>
    
    
    <button id="bookBtn" type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Book Now</button>
</div>


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

        </div>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
    var timetable = document.getElementById('timetable');
    var times = [
        '10:00:00', '10:30:00', '11:00:00', 
        // Add more times as needed
    ];

    // Function to convert time from 24-hour format to 12-hour format for display
    function convertTo12Hour(time24h) {
        var [hours, minutes, seconds] = time24h.split(':');
        var period = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12;
        return hours + ':' + minutes + ' ' + period;
    }

    // Function to convert time from 12-hour format to 24-hour format
function convertTo24Hour(time12h) {
    var [time, period] = time12h.split(' ');
    var [hours, minutes] = time.split(':');
    if (period === 'PM' && hours !== '12') {
        hours = String(Number(hours) + 12);
    } else if (period === 'AM' && hours === '12') {
        hours = '00';
    }
    return hours.padStart(2, '0') + ':' + minutes + ':00';
}


    times.forEach(function(time24h) {
        var time12h = convertTo12Hour(time24h); // Convert time to 12-hour format
        var button = document.createElement('button');
        button.type = 'button';
        button.className = 'time-button inline-flex items-center justify-center w-full px-2 py-1 text-sm peer-checked:border-blue-600 peer-checked:text-blue-600 font-medium text-center hover:text-gray-900 dark:hover:text-white bg-white dark:bg-gray-800 border rounded-lg cursor-pointer text-gray-500 border-gray-200 dark:border-gray-700 dark:peer-checked:border-blue-500 peer-checked:border-blue-700 dark:hover:border-gray-600 dark:peer-checked:text-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-600 dark:peer-checked:bg-blue-900';
        button.textContent = time12h; // Display time in 12-hour format
        
        button.addEventListener('click', function() {
            // Remove 'selected' class from all buttons
            var allButtons = document.querySelectorAll('.time-button');
            allButtons.forEach(function(btn) {
                btn.classList.remove('selected');
            });
            
            // Add 'selected' class to the clicked button
            button.classList.add('selected');
        });
        
        timetable.appendChild(button);
    });

    $('#bookBtn').on('click', function() {
        
        if ($('#datePicker').val() === '') {
            alert('Please select a date.');
            return;
        }
    
        if ($('#service').val() === '') {
            alert('Please select a service.');
            return;
        } 

        if ($('#note').val() === '') {
            var note = "-";
        } 
        // Gather form data
        var formData = {
            patientId: $('#patientId').val(),
            doctorId: $('#doctorId').val(),
            selectedDate: $('#datePicker').val(),
            selectedTime12h: document.querySelector('.selected').textContent,
            service: $('#service').val(),
            note: note,
        };
    
        // Convert selected time to 24-hour format
        formData.selectedTime24h = convertTo24Hour(formData.selectedTime12h);
    
        // AJAX request
        $.ajax({
            type: 'POST',
            url: 'php/book_process.php',
            data: formData,
            success: function(response) {
                console.log(formData);
                // Show SweetAlert2 success notification
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    html: 'Successfully scheduled on <b>'+ formData.selectedDate + '</b> at <b>' + formData.selectedTime12h + '</b>. Kindly wait for the notification for the confirmation.',
                    
                    confirmButtonColor: 'blue',
                    
                    confirmButtonText: 'Okay'
                });
            },
            error: function(xhr, status, error) {
                // Show SweetAlert2 error notification
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while submitting the form. Please try again later.',
                });
            }
        });
    });
});

  </script>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

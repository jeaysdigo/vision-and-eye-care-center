<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();

if (!isset($_SESSION['patientId'])) {
    header('Location: login.php');
    exit;
  }

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
<link rel="stylesheet" href="css/style.css">
<script src="js/script.js"></script>

<style>
    .selected {
        border-color: rgb(26 86 219);
        
    }
  </style>

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
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
      <button onclick="window.history.back();" class="text-gray-600 hover:text-blue-500 ml-2">
                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
            </button>
            <div class="text-center p-2 flex font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Book an Appointment</div>
            <div class="w-10 h-10"></div> 
      </div>
    </div>
  </div>
</nav>


<?php require_once 'php/aside.php'; ?>

    
  <section class="mb-8 pb-8 max-w-2xl mx-auto">
  <div class="p-4 py-8 mt-8 sm:ml-64 ">
        
        <!-- appbar -->
        <!-- <div class="flex items-center justify-between mb-4 border-b border-gray-200 pb-2">
            <button onclick="window.history.back();" class="text-gray-600 hover:text-blue-500 ml-2">
                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
            </button>
            <div class="text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Book Appointment</div>
            <div class="w-10 h-10"></div> 
        </div> -->
        
        <!-- appointment -->
     <!-- Modal body -->
     <div class="p-4 pt-4">
     <label class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Appointment Date:</label>
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
    
    
    <button id="bookBtn" type="button" class="w-full h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Book Appointment</button>
</div>

<?php require_once 'php/bottombar.php'; ?>

        </div>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        var timetable = document.getElementById('timetable');
        var times = [
            '09:00:00', '09:30:00', '10:00:00', '10:30:00', 
            '11:00:00', '11:30:00', '12:00:00', '12:30:00', 
            '13:00:00', '13:30:00', '14:00:00', '14:30:00', 
            '15:00:00', '15:30:00', '16:00:00', '16:30:00', 
            '17:00:00', '17:30:00', '18:00:00'
        ];

        function convertTo12Hour(time24h) {
            var [hours, minutes, seconds] = time24h.split(':');
            var period = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12;
            return hours + ':' + minutes + ' ' + period;
        }

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

        function formatDate(dateString) {
            var date = new Date(dateString);
            var options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }

        times.forEach(function(time24h) {
            var time12h = convertTo12Hour(time24h);
            var button = document.createElement('button');
            button.type = 'button';
            button.className = 'time-button inline-flex items-center justify-center w-full px-2 py-1 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg hover:text-gray-900 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-600';
            button.textContent = time12h;

            button.addEventListener('click', function() {
                console.log('clicked', button.textContent);
                var allButtons = document.querySelectorAll('.time-button');
                allButtons.forEach(function(btn) {
                    btn.classList.remove('selected');
                });
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
            if ($('#doctorId').val() === '') {
                alert('Please select doctor.');
                return;
            }

            var note = $('#note').val() === '' ? '-' : $('#note').val();

            var formData = {
                patientId: $('#patientId').val(),
                doctorId: $('#doctorId').val(),
                selectedDate: $('#datePicker').val(),
                selectedTime12h: document.querySelector('.selected') ? document.querySelector('.selected').textContent : '',
                service: $('#service').val(),
                note: note,
            };

            if (formData.selectedTime12h === '') {
                alert('Please select a time.');
                return;
            }

            formData.selectedTime24h = convertTo24Hour(formData.selectedTime12h);

            // Custom HTML template for the confirmation dialog
            var htmlContent = `
                <div class="flowbite-confirm-dialog bg-white p-4 rounded-md">
                    <p class="mb-4 text-gray-600">Please check the details before confirming.</p>
                    <div class="flowbite-confirmation-details space-y-4 bg-blue-50 rounded-md p-4">
                        <div class="flex items-center">
                            <span class="w-20 text-gray-600 text-sm">Date:</span>
                            <span class="text-gray-600 font-medium text-sm ">${formatDate(formData.selectedDate)}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-20 text-gray-600 text-sm">Time:</span>
                            <span class="text-gray-600 font-medium text-sm ">${formData.selectedTime12h}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-20 text-gray-600 text-sm">Note:</span>
                            <span class="text-gray-600 font-medium text-sm">${formData.note}</span>
                        </div>
                    </div>
                </div>
            `;


            // Show confirmation dialog before submitting the form
            Swal.fire({
                title: 'Confirm Booking',
                html: htmlContent,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#1A56DA',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with AJAX request
                    $.ajax({
                        type: 'POST',
                        url: 'php/book_process.php',
                        data: formData,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                html: 'Successfully scheduled on <b>' + formatDate(formData.selectedDate) + '</b> at <b>' + formData.selectedTime12h + '</b>. Kindly wait for the notification for the confirmation.',
                                confirmButtonColor: 'blue',
                                confirmButtonText: 'Okay'
                            }).then(() => {
                        // Redirect to history.php after success message confirmation
                        window.location.href = 'history.php';
                    });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An error occurred while submitting the form. Please try again later.',
                            });
                        }
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

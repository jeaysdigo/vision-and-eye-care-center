<?php
session_start();
require_once 'php/connect.php';


if (!isset($_SESSION['firstName']) || !isset($_SESSION['patientId'])) {
    header("Location: login.php");
    exit();
}

$firstName = $_SESSION['firstName'];
$patientId = $_SESSION['patientId'];

$sql = "SELECT patients.PatientID, doctors.FirstName, doctors.LastName, services.ServiceName, appointments.AppointmentDate,
        appointments.AppointmentID
                FROM appointments 
                INNER JOIN doctors ON appointments.DoctorID = doctors.DoctorID
                INNER JOIN patients ON appointments.PatientID = patients.PatientID
                INNER JOIN services ON appointments.ServiceID = services.ServiceID 
                WHERE appointments.PatientID = $patientId AND appointments.Status = 'InReview' AND appointments.Status = 'Approved'" ;
                $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet"></head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="manifest" href="manifest.json">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/x-icon" href="./assets/icon.png">
<script src="js/script.js"></script>
   <script src="/app.js"></script>

<style>


        /* Media query for phones and tablets */
        @media (max-width: 768px) {
            .flex {
                overflow-x: auto;
            }
            /* Hide scrollbar for Chrome, Safari and Opera */
 .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        }
</style>
<body>
<script>  AOS.init();</script>

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
     
            <div class="text-center p-2 flex font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Home</div>
            <div class="w-10 h-10"></div> 
      </div>
    </div>
  </div>
</nav>


<?php require_once 'php/aside.php'; ?>

    
  <section class="mb-8 pb-8 max-w-4xl mx-auto">
  <div class="p-4 py-8 mt-8 sm:ml-64 ">

    <div class="flex-1" data-aos="fade-up">
    <div id="controls-carousel" class="relative w-full p-4" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="relative h-48 overflow-hidden rounded-lg md:h-48">
            <!-- Item 1 -->
            <div class=" duration-700 ease-in-out bg-blue-600" data-carousel-item>
                <img src="assets/index_bg.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                <div class=" mt-4 ">
                   
                    <a href="book.php" class="absolute inset-0 flex flex-col justify-center text-base sm:text-lg text-blue-500">
                    <span class="ms-4 text-white font-bold">Have your eyes <br>tested today!</span>
                    <span class="ms-4 w-24 px-3 py-3 text-white items-center justify-center bordered border border-white-100 
                    hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm 
                    dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Book Now</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Slider controls -->
        <!-- <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button> -->
    </div>


    <div class="mb-2 rounded-lg dark:border-gray-700" >
        <div class="flex justify-between items-center px-4 font-bold text-gray-900 sm:text-2xl dark:text-white mb-2">
            <span>Our Services</span>
            <a href="services.php" class="text-base sm:text-lg text-blue-500 hover:underline">See all</a>
        </div>


        <div class="pb-2 flex overflow-x-auto space-x-4 px-4 no-scrollbar">
            <?php
            $sql2 = "SELECT * FROM services";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
                while($row = $result2->fetch_assoc()) {
                    echo '
                    <a href="service.php?id='. htmlspecialchars($row["ServiceID"]) .'" class="block max-w-sm p-2 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex-shrink-0">
                        <img src="data:image/png;base64,'. htmlspecialchars($row["Icon"]) .'" class="w-24 md:w-32 max-w-full max-h-full p-4" alt="Service Icon">
                        <h1 class="w-24 md:w-32 max-w-full text-sm max-h-full text-center tracking-tight text-gray-900 dark:text-white">'. htmlspecialchars($row["ServiceName"]) .'</h1>
                    </a>';
                }
            } else {
                echo "<p class='text-center flex flex-col w-full p-4 text-sm text-gray-500 dark:text-gray-400'>No approved appointment.</p>";
            }
            ?>
        </div>
        
    </div>
    </div>

    <div class="flex-1" data-aos="fade-up">
        <!-- my bookings -->
        <div class="mb-2 rounded-lg dark:border-gray-700">
        <div class="flex justify-between items-center px-4 font-bold text-gray-900 sm:text-2xl dark:text-white mb-2">
            <span>My Appointments</span>
            <a href="history.php" class="text-base sm:text-lg text-blue-500 hover:underline">See all</a>
        </div>

        <div class="">
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
                    $cancelButtonId = 'cancelButton_' . $row["AppointmentID"];
                    $appointmentDate = date("g:i A - F j, Y", strtotime($row["AppointmentDate"]));
                    echo '<li class="p-4 flex flex-row md:flex-row justify-between items-center bg-gray-25 hover:bg-gray-25 rounded-lg mb-4 shadow-sm transition">
                    <div class="flex items-center">
                    <div class="bg-blue-100 rounded-full bg-gray-50 border rounded-full w-16 h-16 flex items-center justify-center mx-auto overflow-hidden">
                    <img src="assets/profile.png" class="w-full object-cover" alt="Profile Icon">
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
                    echo "<p class='text-center p-4 text-sm text-gray-500 dark:text-gray-400'>No approved appointment.</p>";
                }
                ?>
                
            </ul>
        </div>
        </div>
    </div>
    



    </div>



    
    


        
    </div>
</section>

<?php require_once 'php/bottombar.php'; ?>

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
    });
</script>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();

$firstName = $_SESSION['firstName'];
$patientId = $_SESSION['patientId'];

$sql = "SELECT patients.PatientID, doctors.FirstName, doctors.LastName, services.ServiceName, appointments.AppointmentDate,
        appointments.AppointmentID
                FROM appointments 
                INNER JOIN doctors ON appointments.DoctorID = doctors.DoctorID
                INNER JOIN patients ON appointments.PatientID = patients.PatientID
                INNER JOIN services ON appointments.ServiceID = services.ServiceID 
                WHERE appointments.PatientID = $patientId AND appointments.Status = 'InReview'";
                $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet"></head>
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
<section class="overflow-y-auto ">
  <div class="mt-1 mx-auto max-w-md flex-col items-center justify-center mx-auto md:h-screen lg:py-0">
        
        <!-- appbar -->
        <div class="flex items-center justify-between border-b border-gray-200 pb-2 pl-2">
            <!-- <button onclick="window.history.back();" class="text-gray-600 hover:text-blue-500 ml-2">
                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
            </button> -->
            <div class="text-xl ml-2 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Hello, <?php echo $firstName ?> </div>
            <div class="w-10 h-10"></div>
        </div>

        

<div id="controls-carousel" class="relative w-full p-4" data-carousel="static">
    <!-- Carousel wrapper -->
    <div class="relative h-48 overflow-hidden rounded-lg md:h-48">
         <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIsAjtNuTdZSpbWiq_5jZWC9IFZ4gph80Bvg&s" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIsAjtNuTdZSpbWiq_5jZWC9IFZ4gph80Bvg&s" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIsAjtNuTdZSpbWiq_5jZWC9IFZ4gph80Bvg&s" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 4 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIsAjtNuTdZSpbWiq_5jZWC9IFZ4gph80Bvg&s" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 5 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIsAjtNuTdZSpbWiq_5jZWC9IFZ4gph80Bvg&s" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
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
    </button>
</div>


    <div class="mb-2 rounded-lg dark:border-gray-700">
        <div class="flex justify-between items-center px-4 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-2">
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
                echo "No services found.";
            }
            ?>
        </div>
        
    </div>


    <!-- my bookings -->
    <div class="mb-2 rounded-lg dark:border-gray-700">
        <div class="px-4 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-2">My Appointments</div>

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
                        echo '<li class="p-4 flex justify-between items-center">
                                <div>
                                    <p class="text-lg font-medium text-gray-900">' . $row["ServiceName"] . '</p>
                                    <p class="text-sm text-gray-500">'  . $row["FirstName"] . ' ' . $row["LastName"] .  '</p>
                                    <p class="text-sm text-gray-500">' . $appointmentDate . '</p>
                                </div>
                                <button id="' . $cancelButtonId . '" class="cancelButton text-blue-700 bg-blue-100 hover:bg-blue-400 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-red-800">View</button>
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

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();
if (!isset($_SESSION['doctorId'])) {
    header('Location: login.php');
    exit;
  }
// Initialize counts
$totalPatients = 0;
$totalDoctors = 0;
$totalServices = 0;

// Fetch total patients count
$sql = "SELECT COUNT(*) AS total FROM patients";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $totalPatients = $row['total'];
}

// Fetch total doctors count
$sql = "SELECT COUNT(*) AS total FROM doctors";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $totalDoctors = $row['total'];
}

// Fetch total services count
$sql = "SELECT COUNT(*) AS total FROM services";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $totalServices = $row['total'];
}

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
<body>
    

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <!-- <a href="https://flowbite.com" class="flex ms-2 md:me-24"> -->
          <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Vision and Eyecare Center</span>
          <!-- <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Admin</span> -->
        </a>
      </div>
    </div>
  </div>
</nav>


<?php include_once 'php/aside_admin.php'; ?>

<div class="p-4 sm:ml-64">
    
        <div class="p-4  rounded-lg dark:border-gray-700 mt-14">
            <div class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-4">Dashboard</div>
            <div class="grid grid-cols-3 gap-4 mb-4">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h1 class="text-4xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white"><?php echo $totalPatients; ?></h1>
            <p class="text-lg text-gray-500 dark:text-gray-100">Total Patients</p>  
        </div>
        <div class="flex flex-col p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h1 class="text-4xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white"><?php echo $totalDoctors; ?></h1>
            <p class="text-lg text-gray-500 dark:text-gray-100">Total Doctors</p>
        </div>
        <div class="flex flex-col p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h1 class="text-4xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white"><?php echo $totalServices; ?></h1>
            <p class="text-lg text-gray-500 dark:text-gray-100">Clinic Services</p>
        </div>
    </div>
        </div>
        
        <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
    <div class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-4">Clinic Services</div>

    <div class="flex overflow-x-auto space-x-4 p-2">
        <?php
   
        $sql2 = "SELECT * FROM services";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            while($row = $result2->fetch_assoc()) {
                echo '
                <a href="#" class="block max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex-shrink-0">
                    <img src="data:image/png;base64,'. htmlspecialchars($row["Icon"]) .'" class="w-24 md:w-32 max-w-full max-h-full p-4" alt="Service Icon">
                    <h1 class="w-24 md:w-32 max-w-full text-sm max-h-full text-center tracking-tight text-gray-900 dark:text-white">'. htmlspecialchars($row["ServiceName"]) .'</h1>
                </a>';
            }
        } else {
            echo "No services found.";
        }

        // Close connection
        $conn->close();
        ?>
    </div>
</div>

</div>




<script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

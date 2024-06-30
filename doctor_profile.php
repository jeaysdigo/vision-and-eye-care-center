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
  <link rel="stylesheet" href="./css/style.css">
  <script src="js/script.js"></script>
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
  <div class="p-4 py-8 mt-8 sm:ml-64 ">
        
        
    

        <div class="w-full bg-white-50 rounded-lg dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <div>
                    <!-- User Image -->
                    <div class="flex items-center justify-center">
                    <div class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <span class="text-lg font-medium text-gray-600 dark:text-gray-300"><?php echo strtoupper(substr($_SESSION['firstName'], 0, 1)) . strtoupper(substr($_SESSION['lastName'], 0, 1))?></span>
                    </div>
                    </div>
                    <p class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center my-2">
                        <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?>
                    </p>
                    <p class="text-gray-600 text-center">
                        <?php echo $_SESSION['email']; ?>
                    </p>
                </div>
            </div>
            <!-- <div class="p-4 space-y-2 md:space-y-4 sm:p-4">
                <a href="account.php" class="text-blue-500 hover:underline">My Account</a>
            </div>
            <div class="p-4 space-y-2 md:space-y-4 sm:p-4">
                <a href="about.php" class="text-blue-500 hover:underline">About Us</a>
            </div>
            <div class="p-4 space-y-2 md:space-y-4 sm:p-4">
                <a href="logout.php" class="text-red-500 hover:underline">Logout</a>
            </div> -->
            <span class="px-2 text-gray-500 ">General</span>
            <div class="h-full overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="doctor_account.php" class="flex items-center p-4 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="ms-3">My Account</span>
                        </a>
                    </li>
                </ul>
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="about.php" class="flex items-center p-4 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="ms-3">About us</span>
                        </a>
                    </li>
                </ul>
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="logout.php" class="flex items-center p-4 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="ms-3">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>


<?php require_once 'php/bottombar_doctor.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

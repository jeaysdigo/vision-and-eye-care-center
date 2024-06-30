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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/script.js"></script>
</head>
  
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
    
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
      <button onclick="window.history.back();" class="text-gray-600 hover:text-blue-500 ml-2">
                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
            </button>
            <div class="text-center p-2 flex font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">All services</div>
            <div class="w-10 h-10"></div> 
      </div>
    </div>
  </div>
</nav>


<?php require_once 'php/aside.php'; ?>

    
  <section class="mb-8 pb-8 max-w-4xl mx-auto overflow-y-auto">
  <div class="p-4 py-8 mt-8 sm:ml-64 ">
    
    
    
        <div class="container mx-auto py-10 px-4">
    <div class="mb-2 rounded-lg dark:border-gray-700">
        <div class="flex justify-between items-center px-4 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-2">
            
        </div>
        <div class="grid gap-2 grid-cols-2  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 px-4">
            <?php
        
            $sql2 = "SELECT * FROM services";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
                while($row = $result2->fetch_assoc()) {
                    echo '
                    <a href="service.php?id='. htmlspecialchars($row["ServiceID"]) .'" class="block p-2 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <img src="data:image/png;base64,'. htmlspecialchars($row["Icon"]) .'" class="w-24 md:w-32 max-w-full max-h-full p-4 mx-auto" alt="Service Icon">
                        <h1 class="text-center text-sm tracking-tight text-gray-900 dark:text-white">'. htmlspecialchars($row["ServiceName"]) .'</h1>
                    </a>';
                }
            } else {
                echo "<div class='text-center text-gray-700 dark:text-white'>No services found.</div>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</div>


    </div>
</section>
<?php require_once 'php/bottombar.php'; ?>
  
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

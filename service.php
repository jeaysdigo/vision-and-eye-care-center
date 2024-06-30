<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();
if (!isset($_SESSION['patientId'])) { 
  header('location: index.php');
}

$firstName = $_SESSION['firstName'];
$firstName = $_SESSION['firstName'];

if (isset($_GET['id'])) {
    $serviceID = intval($_GET['id']);
    $sql = "SELECT * FROM services WHERE ServiceID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $serviceID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Service not found.";
        header('location: error.php');
        exit;
    }
} else {
    echo "Invalid Service ID.";
    header('location: error.php');
    exit;
}
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

<body class="">

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
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg ">
        <div class="flex flex-col ">
        <img src="data:image/png;base64,<?php echo htmlspecialchars($row["Icon"]); ?>" class="w-24 md:w-32 max-w-full max-h-full p-4 mx-auto" alt="Service Icon">

            <h1 class="text-2xl font-medium text-gray-900 mb-2"><?php echo htmlspecialchars($row["ServiceName"]); ?></h1>
            <p class="text-gray-700 mb-4"><?php echo nl2br(htmlspecialchars($row["Description"])); ?></p>
           
        </div>
    </div>
    <button id="bookBtn" type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Book Now</button>
</div>

    </div>
</section>


<?php require_once 'php/bottombar.php'; ?>
        
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

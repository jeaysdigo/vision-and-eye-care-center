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
            <div class="text-center p-2 flex font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">List of Patients</div>
            <div class="w-10 h-10"></div> 
      </div>
    </div>
  </div>
</nav>



<?php require_once 'php/aside_doctor.php'; ?>

    
  <section class="mb-8 pb-8 max-w-4xl mx-auto">
  <div class="p-4 py-8 mt-8 sm:ml-64 ">
        
        
<?php 
// Fetch services data
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);

// Initialize an empty array to store services
$services = [];

// Check if we have results and fetch them into the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}?>

<div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <!-- <th scope="col" class="px-6 py-3"><span class="sr-only">Image</span></th> -->
                        <th scope="col" class="px-6 py-3">Patient's Name</th>
         
                        <th scope="col" class="px-6 py-3"><span class="sr-only">Edit</span></th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $service): ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= htmlspecialchars($service['FirstName']) . " " .  htmlspecialchars($service['LastName'])  ?>
                            </th>
                           
                            <td class="px-6 py-4 text-right">
                                <!-- <button type="button"data-modal-target="edit-modal" data-modal-toggle="edit-modal" data-service-id="<?php echo $service['ServiceID'] ?>" class="edit-service-button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    Edit
                                </button> -->
                                <a href="profiles.php?id=<?php echo $service['PatientID']; ?>"type="button"  class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        
                                    View Profile
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No patients available.
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>



        
    </div>
</section>


<?php require_once 'php/bottombar_doctor.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

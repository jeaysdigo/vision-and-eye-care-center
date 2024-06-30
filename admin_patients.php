<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();
if (!isset($_SESSION['doctorId'])) {
    header('Location: login.php');
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
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <link rel="stylesheet" href="css/styles.css"> -->
</head>
<body>

<style>
    .swal2-button-blue {
    background-color: blue !important;
    color: white !important;
}

</style>
    

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
        </a>
      </div>
    </div>
  </div>
</nav>

<?php include_once 'php/aside_admin.php'; ?>

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

<div class="p-4 sm:ml-64">
<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm rounded-lg dark:border-gray-700 mt-14">
        <div class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-4">Patients</div>

        
        <div class="mb-4 flex items-center">
            <div class="relative mt-1 lg:w-64 xl:w-96">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" name="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg pl-10 p-2  focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">
            </div>
        </div>
        
        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <!-- <th scope="col" class="px-6 py-3"><span class="sr-only">Image</span></th> -->
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Contact Number</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Address</th>
                        <th scope="col" class="px-6 py-3">Registered on</th>
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
                            <td class="px-6 py-4">
                                <?= htmlspecialchars($service['ContactNumber']) ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= htmlspecialchars($service['Email']) ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= htmlspecialchars($service['Address']) ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $service['DateCreated'] ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <!-- <button type="button"data-modal-target="edit-modal" data-modal-toggle="edit-modal" data-service-id="<?php echo $service['ServiceID'] ?>" class="edit-service-button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    Edit
                                </button> -->
                                <button type="button" data-modal-toggle="delete-user-modal" data-service-id="<?php echo $service['PatientID'] ?>"  class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Delete
                                </button>
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
            <div id="noRecordsMessage" class="hidden text-center text-gray-500 dark:text-gray-400">No records found.</div>
        </div>
    </div>
</div>


<!-- create service modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create Service
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="POST" id="add-service-form" action="php/add_service.php"enctype="multipart/form-data">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type service name" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Description</label>
                        <textarea id="description" name="description"  rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write clinic service description"></textarea>                    
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="icon">Upload Image</label>
                        <input class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 
                        focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                        aria-describedby="icon" id="icon" name="icon" type="file">
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="icon">Upload the icon of the service.</div>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new service
                </button>
            </form>
        </div>
    </div>
</div>

<!-- edit  service modal -->
<div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Service
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" id="edit-service-form" enctype="multipart/form-data">
                <div class="grid gap-4 mb-4 grid-cols-2">
                <input type="text" name="serviceId" id="serviceId" class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="serviceId" required="">
                    
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type service name" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Description</label>
                        <textarea id="description" name="description"  rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write clinic service description"></textarea>                    
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="icon">Upload Image</label>
                        <input class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 
                        focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                        aria-describedby="icon" id="icon" name="icon" type="file">
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="icon">Upload the icon of the service.</div>
                    </div>
                </div>
                <button id="save-changes" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                   Save changes
                </button>
            </form>
        </div>
    </div>
</div> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        
        $('.edit-service-button').click(function () {
            const serviceId = $(this).data('service-id');
            const modal = $('#edit-modal');
            const serviceIdInput = modal.find('#serviceId');
            const serviceNameInput = modal.find('#name');
            const descriptionInput = modal.find('#description');

            // AJAX request to fetch service details
            $.ajax({
                url: 'php/fetch_service_details.php', // Replace with your endpoint to fetch service details
                method: 'GET',
                dataType: 'json',
                data: { service_id: serviceId },
                success: function (response) {
                    serviceIdInput.val(serviceId);
                    serviceNameInput.val(response.name);
                    descriptionInput.val(response.description);
                },
                error: function () {
                    // Handle error
                    console.error('Failed to fetch service details');
                }
            });
        });

        // edit service function
        $('#save-changes').click(function () {
            // Serialize form data
            var formData = new FormData($('#edit-service-form')[0]);

            // AJAX request to submit form data
            $.ajax({
                url: 'php/edit_service.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Handle success response
                    console.log(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Service details updated successfully'
                    });
                },
                error: function () {
                    // Handle error
                    console.error('Failed to submit form data');
                }
            });
        });

    });

    //delete service function
    $('[data-modal-toggle="delete-user-modal"]').click(function () {
        // Store a reference to the button that triggered the event
        var deleteButton = $(this);

        // Show SweetAlert2 confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this action',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'gray',
            confirmButtonText: 'Delete'
        }).then((result) => {
            // If user confirms deletion
            if (result.isConfirmed) {
                // Get the service ID from the data attribute
                var serviceId = deleteButton.data('service-id');

                // Make an AJAX request to delete the service
                $.ajax({
                    url: 'php/delete_patient.php', // Replace with your PHP script to handle deletion
                    method: 'POST',
                    data: { service_id: serviceId },
                    success: function (response) {
                        // Display success message
                        Swal.fire({
                            title: 'Deleted successfully',
                            text: 'Patient has been deleted.',
                            icon: 'success',
            
                            confirmButtonColor: 'blue',
                    
                            confirmButtonText: 'Okay'
                        }),
                                        
                        // You can also remove the corresponding row from the table if needed
                        deleteButton.closest('tr').remove();
                    },
                    error: function () {
                        // Handle error
                        Swal.fire(
                            'Error!',
                            'Failed to delete the patient.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>


<script src="js/search.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

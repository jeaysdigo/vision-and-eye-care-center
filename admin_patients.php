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
          <img src="./assets/logo.png" class="h-8 me-3" alt="logo" />
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

        
        <div class="mb-4 flex items-center justify-between">
            <div class="relative mt-1 lg:w-64 xl:w-96">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" name="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg pl-10 p-2  focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">
            </div>
            <a href="signup.php" class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Add patient
            </a>
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
                            <?= date("F j, Y g:i A ", strtotime($service['DateCreated'] )); ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button type="button"data-modal-target="edit-patient-modal" data-modal-toggle="edit-patient-modal" data-patient-id="<?php echo $service['PatientID'] ?>" class="edit-patient-button mx-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        Edit
                                    </button>
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

<!-- Edit Patient Modal -->
<div id="edit-patient-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Patient
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-patient-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" id="edit-patient-form">
                <input type="hidden" name="patientId" id="patientId" value="">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                </div>
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500" id="email-error"></p>
                </div>
                <div>
                    <label for="bday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                    <input type="date" name="bday" id="bday" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                </div>
                <div>
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                    <select name="gender" id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        <option value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div>
                    <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                    <input type="tel" name="contact" id="contact" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500" id="contact-error"></p>
                </div>
                <div>
                    <label for="occupation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Occupation</label>
                    <input type="text" name="occupation" id="occupation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                </div>
                <div>
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street Address</label>
                    <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                </div>
                <div>
                    <label for="municipality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Municipality</label>
                    <input type="text" name="municipality" id="municipality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                </div>
                <div>
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                    <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                </div>
                <div>
                    <label for="zipcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip Code</label>
                    <input type="text" name="zipcode" id="zipcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
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
   // Edit patient modal toggle
$('.edit-patient-button').click(function () {
    const patientId = $(this).data('patient-id');
    const modal = $('#edit-patient-modal');

    // AJAX request to fetch patient details
    $.ajax({
        url: 'php/fetch_patient.php', // Replace with your endpoint to fetch patient details
        method: 'GET',
        dataType: 'json',
        data: { patient_id: patientId },
        success: function (response) {
            modal.find('#patientId').val(patientId);
            modal.find('#first_name').val(response.first_name);
            modal.find('#last_name').val(response.last_name);
            modal.find('#email').val(response.email);
            modal.find('#bday').val(response.bday);
            modal.find('#gender').val(response.gender);
            modal.find('#contact').val(response.contact);
            modal.find('#occupation').val(response.occupation);
            modal.find('#address').val(response.address);
            modal.find('#municipality').val(response.municipality);
            modal.find('#city').val(response.city);
            modal.find('#zipcode').val(response.zipcode);

            // modal.removeClass('hidden');
            // $('body').addClass('modal-open');

            var emailValid = true;
            var contactValid = true;

            // Capture the original values
            var originalEmail = $("#email").val().trim();
            var originalContact = $("#contact").val().trim();

            function toggleSaveButton() {
                if (emailValid && contactValid) {
                    $("#save-changes").prop("disabled", false).removeClass("bg-gray-300 cursor-not-allowed");
                } else {
                    $("#save-changes").prop("disabled", true).addClass("bg-gray-300 cursor-not-allowed");
                }
            }

            function validateEmail() {
                var email = $("#email").val().trim();

                // Skip validation if the email hasn't changed
                if (email === originalEmail) {
                    emailValid = true;
                    $("#email").removeClass('border-red-700');
                    $("#email-error").text("").hide();
                    toggleSaveButton();
                    return;
                }

                $.ajax({
                    url: "php/validate.php",
                    method: "POST",
                    data: { email: email },
                    success: function(response) {
                        if (response.trim() === "Email already exists") {
                            $("#email").addClass('border-red-700');
                            $("#email-error").text("Email already exists").show();
                            emailValid = false;
                        } else {
                            $("#email").removeClass('border-red-700');
                            $("#email-error").text("").hide();
                            emailValid = true;
                        }
                        toggleSaveButton(); // Check button state after email validation
                    }
                });
            }

            function validateContact() {
                var contact = $("#contact").val().trim();

                // Skip validation if the contact hasn't changed
                if (contact === originalContact) {
                    contactValid = true;
                    $("#contact").removeClass('border-red-700');
                    $("#contact-error").text("").hide();
                    toggleSaveButton();
                    return;
                }

                // Validate contact number length
                if (contact.length !== 11 || !/^\d{11}$/.test(contact)) {
                    $("#contact").addClass('border-red-700');
                    $("#contact-error").text("Contact number must be exactly 11 digits").show();
                    contactValid = false;
                    toggleSaveButton(); // Check button state after contact validation
                    return; // Exit function early if length or format is incorrect
                } else {
                    $("#contact").removeClass('border-red-700');
                }

                // Perform AJAX validation
                $.ajax({
                    url: "php/validate.php",
                    method: "POST",
                    data: { contact: contact },
                    success: function(response) {
                        if (response.trim() === "Contact number already exists") {
                            $("#contact").addClass('border-red-700');
                            $("#contact-error").text("Contact number already exists").show();
                            contactValid = false;
                        } else {
                            $("#contact").removeClass('border-red-700');
                            $("#contact-error").text("").hide();
                            contactValid = true;
                        }
                        toggleSaveButton(); // Check button state after contact validation
                    },
                    error: function(xhr, status, error) {
                        $("#contact-error").text("Error validating contact number").show();
                        contactValid = false;
                        toggleSaveButton(); // Check button state after contact validation
                    }
                });
            }
            $("#email").on('blur', validateEmail);
            $("#contact").on('blur', validateContact);

        },
        error: function () {
            // Handle error
            console.error('Failed to fetch patient details');
        }
    });
});

// Save changes button click handler
$('#save-changes').click(function (e) {
    e.preventDefault();

    // Gather updated data
    const patientId = $('#patientId').val();
    const firstName = $('#first_name').val();
    const lastName = $('#last_name').val();
    const email = $('#email').val();
    const bday = $('#bday').val();
    const gender = $('#gender').val();
    const contact = $('#contact').val();
    const occupation = $('#occupation').val();
    const address = $('#address').val();
    const municipality = $('#municipality').val();
    const city = $('#city').val();
    const zipcode = $('#zipcode').val();

    // Validate if all fields are filled
    if (!firstName || !lastName || !email || !bday || !gender || !occupation || !address || !municipality || !city || !zipcode) {
        Swal.fire({
            icon: 'error',
            title: 'All fields are required',
            text: 'Please fill in all the required fields.',
        });
        return;
    }

    // AJAX request to update patient details
    $.ajax({
        url: 'php/edit_patient.php', // Replace with your endpoint to update patient details
        method: 'POST',
        dataType: 'json',
        data: {
            patient_id: patientId,
            first_name: firstName,
            last_name: lastName,
            email: email,
            bday: bday,
            gender: gender,
            contact: contact,
            occupation: occupation,
            address: address,
            municipality: municipality,
            city: city,
            zipcode: zipcode
        },
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Patient details updated successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload(); // Reload the page or update the UI as needed
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to update patient details',
                    text: 'Please try again.',
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Failed to update patient details',
                text: 'Please try again.',
            });
        }
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

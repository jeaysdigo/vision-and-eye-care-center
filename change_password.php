<?php
session_start();
require_once 'php/connect.php'; // Include your database connection file

// Check if user is logged in
if (!isset($_SESSION['patientId']) && !isset($_SESSION['doctorId'])) {
    // Redirect to login page or handle unauthorized access
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body>

    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button onclick="window.history.back();" class="text-gray-600 hover:text-blue-500 ml-2">
                        <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                        </svg>
                    </button>
                    <div class="text-center p-2 flex font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Change Password</div>
                    <div class="w-10 h-10"></div>
                </div>
            </div>
        </div>
    </nav>

    <?php 
    // require_once 'php/aside.php'; ?>

    <section class="mb-8 pb-8 mx-auto">
        <div class="p-4 py-8 mt-8 mx-auto justify-center max-w-lg">
            <div
                class="p-4 mb-4 mt-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">Change password</h3>
                <form id="formPass">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-2">
                            <label for="current-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current
                                password</label>
                            <input type="password" name="current-password" id="current-password"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="••••••••" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="new-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                                password</label>
                            <input type="password" name="new-password" id="new-password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="••••••••" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="confirm-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                password</label>
                            <input type="password" name="confirm-password" id="confirm-password"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="••••••••" required="">
                        </div>
                        <div class="col-span-6 sm:col-full">
                            <button id="submit-button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Update
                                Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php 
    // require_once 'php/bottombar.php'; ?>

<script>
$(document).ready(function() {
    $("#submit-button").click(function(event) {
        event.preventDefault(); // Prevent default form submission
        
        // Gather form data
        let currentPassword = $("#current-password").val();
        let newPassword = $("#new-password").val();
        let confirmPassword = $("#confirm-password").val();

        if (currentPassword == '') {    
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please input current password.'
            });
            return;
        }

        if (newPassword == '' || confirmPassword == '') {    
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please input new password.'
            });
            return;
        }
        
        // Validate passwords
        if (newPassword !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Passwords do not match!'
            });
            return;
        }
        
        // Prepare data for Ajax request
        let formData = {
            "current-password": currentPassword,
            "new-password": newPassword,
            "confirm-password": confirmPassword
        };
        
        // Ajax request
        $.ajax({
            type: "POST",
            url: "php/change_pass_process.php", // Replace with your actual endpoint URL
            data: formData,
            success: function(response) {
                // Parse the response
                let result = JSON.parse(response);
                
                if (result.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Password updated successfully!'
                    }).then(() => {
                        window.history.back();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update password. Please try again later.'
                });
                console.error("Error updating password: " + error);
            }
        });
    });
});
</script>



    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
    

</body>

</html>

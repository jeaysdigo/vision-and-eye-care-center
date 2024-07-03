<?php
session_start();
require_once 'php/connect.php';
// Check if the session is already set and redirect accordingly
if (isset($_SESSION['patientId'])) {
    header("Location: index.php");
    exit();
} elseif (isset($_SESSION['doctorId'])) {
    header("Location: doctor_index.php");
    exit();
} elseif (isset($_SESSION['isAdmin'])) {
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
<script>
  AOS.init();
</script>
<style>
    /* Style for loading spinner */
    .loading-spinner {
      border: 4px solid rgba(0, 0, 0, 0.1);
      border-top: 4px solid #3b82f6;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      animation: spin 1s linear infinite;
      margin-left: 10px;
      display: none; /* Initially hidden */
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .spinner-icon {
      display: none;
    }
  </style>
  <section>
    <div class="mt-6 mx-auto max-w-md flex flex-col items-center justify-center mx-auto md:h-screen lg:py-0">
        <div class="w-full mt-6 bg-white rounded-lg dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8"  data-aos="fade-up">
                <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Login</h1>
                <span class="text-sm font-light text-gray-500 dark:text-gray-400">Login to continue</span>
                <form id="loginForm" class="space-y-4 md:space-y-6">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                        <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input 11-digit number" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <!-- <div class="flex items-start">
                        <div class="text-sm">
                          <label for="forgot" class="font-light text-gray-500 dark:text-gray-300"><a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="forgot_password.php">Forgot Password?</a></label>
                        </div>
                    </div> -->
                    <p class="mt-2 text-sm text-red-600 hidden" id="error">Incorrect credentials. Please try again.</p>
                    <div class="flex items-center">
                        <button type="submit" id="loginButton" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-24 px-5 py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg aria-hidden="true" role="status" class="spinner-icon inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                            </svg>
                            <span>Login</span>
                        </button>
                    </div>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Not registered yet? <a href="signup.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Create account</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault();

            // Show spinner icon
            $('#loginButton span').hide();
            $('#loginButton .spinner-icon').show();

            var formData = $(this).serialize();

            $.ajax({
                url: 'php/login_process.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Hide spinner icon
                    $('#loginButton .spinner-icon').hide();
                    $('#loginButton span').show();
                    $('#loginButton span').addClass('disabled');

                    if (response.trim() === 'SuccessPatient') {
                        window.location.href = 'index.php';
                    } else if (response.trim() === 'SuccessDoctor') {
                        window.location.href = 'doctor_index.php';
                    } else if (response.trim() === 'Admin') {
                        window.location.href = 'admin.php';
                    } else {
                        $('#error').text(response).removeClass('hidden');
                    }
                },
                error: function() {
                    // Hide spinner icon
                    $('#loginButton .spinner-icon').hide();
                    $('#loginButton span').show();

                    $('#error').text('An error occurred. Please try again.').removeClass('hidden');
                }
            });
        });
    });
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
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
  </style>
  <section>
    <div class="mt-6 mx-auto max-w-md flex flex-col items-center justify-center mx-auto md:h-screen lg:py-0">
        <div class="w-full mt-6 bg-white rounded-lg dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
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
                    <div class="flex items-start">
                        <div class="text-sm">
                          <label for="forgot" class="font-light text-gray-500 dark:text-gray-300"><a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="forgot_password.php">Forgot Password?</a></label>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-red-600 hidden" id="error">Incorrect credentials. Please try again.</p>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-24 px-5 py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button> 
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

            var formData = $(this).serialize();

            $.ajax({
                url: 'php/login_process.php',
                method: 'POST',
                data: formData,
                success: function(response) {
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
                    $('#error').text('An error occurred. Please try again.').removeClass('hidden');
                }
            });
        });
    });
  </script>
</body>
</html>

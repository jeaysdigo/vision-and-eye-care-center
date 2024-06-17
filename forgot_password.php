<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet">
</head>
<body>
    <form id="forgot-password-form" method="POST">
        <section>
            <div class="mt-6 mx-auto max-w-md flex flex-col items-center justify-center md:h-screen lg:py-0">
                <div class="w-full mt-6 bg-white rounded-lg dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Forgot Password
                        </h1>
                        <span class="text-sm font-light text-gray-500 dark:text-gray-400">Just type in your email and we will send you a code to reset your password!</span>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email address" required="">
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-24 px-5 py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send an Email</button>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('#forgot-password-form').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: 'php/send_reset_link.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Success', 'A password reset link has been sent to your email.', 'success');
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

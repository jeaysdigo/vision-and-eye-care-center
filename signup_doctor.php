<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <!-- <link href="../dist/styles.css" rel="stylesheet"> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet">
  <!-- <script src="js/auth.js"></script> -->
</head>

<body>
  <section>
    <div class="mt-6 mx-auto max-w-md flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <!-- <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
            Vision and Eye Care Center    
        </a> -->
        
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Sign Up as Doctor
        </h1>
        <form class="space-y-4 md:space-y-60" id="signup-form" method="POST">
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
            </div>
            <div>
                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500" id="email-error"></p>
              </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
            </div>
            <div>
                <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                <p class="mt-2 text-sm text-red-600" id="confirm_password-error"></p>
            </div>
            <div>
                <label for="bday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                <input type="date" name="bday" id="bday" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
            </div>
            <div>
                <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                <select name="gender" id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    <option value="">Select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div>
                <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                <input type="tel" name="contact" id="contact"  maxlength="11" class="bg-gray-50  border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                <p class="mt-2 text-sm text-red-600" id="contact-error"></p>
            </div>
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street Address</label>
                <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
            </div>
            <div>
                <label for="municipality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Municipality</label>
                <input type="text" name="municipality" id="municipality" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
            </div>
            <div>
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
            </div>
            <div>
                <label for="zipcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip Code</label>
                <input type="text" name="zipcode" id="zipcode" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
            </div>
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                </div>
                <div class="ml-3 text-sm">
                    <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                </div>
            </div>
            <button id="signup-button" disabled class="text-white bg-blue-700 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 bg-gray-300 cursor-not-allowed">Sign Up</button>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                Already have an account? <a href="login.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
            </p>
        </form>
        
    </div>
</div>

    </div>
  </section>
<script>
  $(document).ready(function() {
    var emailValid = false;
    var contactValid = false;
    var passwordMatch = false;

    function toggleSignupButton() {
        if (emailValid && contactValid && passwordMatch) {
            $("#signup-button").prop("disabled", false);
            $("#signup-button").removeClass("bg-gray-300 cursor-not-allowed");
        } else {
            $("#signup-button").prop("disabled", true);
            $("#signup-button").addClass("bg-gray-300 cursor-not-allowed");
        }
    }

    $("#confirm_password").on('blur', function() {
        var password = $("#password").val();
        var confirmPassword = $(this).val();

        if (password !== confirmPassword) {
            $("#confirm_password-error").text("Passwords do not match").show();
            passwordMatch = false;
        } else {
            $("#confirm_password-error").text("").hide();
            passwordMatch = true;
        }

        toggleSignupButton(); // Check button state after password confirmation
    });
    
    $("#email").on('blur', function() {
      var email = $(this).val();
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
          toggleSignupButton(); // Check button state after email validation
        }
      });
    });

    $("#contact").on('blur', function() {
    var contact = $(this).val().trim();

    // Validate contact number length
    if (contact.length !== 11 || !/^\d{11}$/.test(contact)) {
        $("#contact-error").text("Contact number must be exactly 11 digits").show();
        contactValid = false;
        toggleSignupButton(); // Check button state after contact validation
        return; // Exit function early if length or format is incorrect
    }

    // Perform AJAX validation
    $.ajax({
        url: "php/validate.php",
        method: "POST",
        data: { contact: contact },
        success: function(response) {
            if (response.trim() === "Contact number already exists") {
          
                $("#contact-error").text("Contact number already exists").show();
                contactValid = false;
            } else {
           
                $("#contact-error").text("").hide();
                contactValid = true;
            }
            toggleSignupButton(); // Check button state after contact validation
        },
        error: function(xhr, status, error) {
            $("#contact-error").text("Error validating contact number").show();
            contactValid = false;
            toggleSignupButton(); // Check button state after contact validation
        }
    });
});


    $("#signup-form").submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: "php/signup_doctors_process.php",
        method: "POST",
        data: $(this).serialize(),
        success: function(data) {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Successfully registered.',
            timer: 4000,
            showConfirmButton: false
          }).then((result) => {
            window.location.href = "login.php";
          });
        }
      });
    });
  });
</script>



  <!-- <script src="../node_modules/flowbite/dist/flowbite.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

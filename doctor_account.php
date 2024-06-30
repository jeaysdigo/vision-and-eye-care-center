
<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();

if (!isset($_SESSION['doctorId'])) {
    header('Location: login.php');
    exit;
  }

$firstName = $_SESSION['firstName'];
$patientId = $_SESSION['doctorId'];

// $sql = "SELECT patients.PatientID, doctors.FirstName, doctors.LastName, services.ServiceName, appointments.AppointmentDate,
//         appointments.AppointmentID
//                 FROM appointments 
//                 INNER JOIN doctors ON appointments.DoctorID = doctors.DoctorID
//                 INNER JOIN patients ON appointments.PatientID = patients.PatientID
//                 INNER JOIN services ON appointments.ServiceID = services.ServiceID 
//                 WHERE appointments.PatientID = $patientId AND appointments.Status = 'InReview'";
//                 $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet"></head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- <link rel="manifest" href="manifest.json"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
   <!-- <script src="/app.js"></script> -->
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
            <div class="text-center p-2 flex font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Edit Profile</div>
            <div class="w-10 h-10"></div> 
      </div>
    </div>
  </div>
</nav>


<?php require_once 'php/aside_doctor.php'; ?>
<section class="mb-8 pb-8 max-w-4xl mx-auto">
  <div class="p-4 py-8 mt-8 sm:ml-64 ">
        

        <?php

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


 
// Initialize variables to hold user data
$first_name = $last_name = $email = $password = $bday = $gender = $contact  = $address = $municipality = $city = $zipcode = "";

// Fetch user data if ID is provided in query string
if (isset($patientId)) {
    $user_id = $patientId;
    
    // Prepare SQL statement to fetch user data
    $stmt = $conn->prepare("SELECT FirstName, LastName, Email, DateOfBirth, Gender, ContactNumber, Address, Municipality, City,Zipcode FROM doctors WHERE doctorID = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $email, $bday, $gender, $contact, $address, $municipality, $city, $zipcode);
    
    // Fetch the result
    $stmt->fetch();
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>


    <form class="space-y-4 md:space-y-6" id="edit-profile-form" method="POST" action="php/update_profile_doctor.php">
    <input type="hidden" name="patient_id" value="<?php echo $patientId ?>">
        <div>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($first_name); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required>
        </div>
        <div>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500" id="email-error"></p>
        </div>
        <div>
            <label for="bday">Birthday</label>
            <input type="date" name="bday" id="bday" value="<?php echo htmlspecialchars($bday); ?>" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div>
            <label for="gender">Gender</label>
            <select name="gender" id="gender" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Select gender</option>
                <option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>Male</option>
                <option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>Female</option>
                <option value="Other" <?php if ($gender == "Other") echo "selected"; ?>>Other</option>
            </select>
        </div>
        <div>
            <label for="contact">Contact Number</label>
            <input type="tel" name="contact" id="contact" value="<?php echo htmlspecialchars($contact); ?>" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <p class="mt-2 text-sm text-red-600" id="contact-error"></p>
        </div>
        <div>
            <label for="address">Street Address</label>
            <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($address); ?>" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div>
            <label for="municipality">Municipality</label>
            <input type="text" name="municipality" id="municipality" value="<?php echo htmlspecialchars($municipality); ?>" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div>
            <label for="city">City</label>
            <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($city); ?>" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div>
            <label for="zipcode">Zip Code</label>
            <input type="text" name="zipcode" id="zipcode" value="<?php echo htmlspecialchars($zipcode); ?>" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="py-8">
            <button type="button" onclick="updateProfile()" id="edit-profile-button"class="mb-8  text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save Changes</button>
        </div>
       
    </form>




</section>
<?php require_once 'php/bottombar_doctor.php'; ?>


        <script>
    function updateProfile() {
    // Serialize form data
    var formData = $('#edit-profile-form').serialize();

    // AJAX request
    $.ajax({
        type: "POST",
        url: "php/update_profile_doctor.php",
        data: formData,
        success: function(response) {
            // Parse response
            var data = JSON.parse(response);

            
            // Check if update was successful
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Profile Updated',
                    text: 'Your profile has been updated successfully. Please login again to show changes. ',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect or handle as needed
                        window.location.href = 'doctor_account.php';
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to update profile. Please try again!'
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Failed to connect to server. Please try again later!'
            });
        }
    });
}
</script>

<script>
    $(document).ready(function() {
        var emailValid = true;
        var contactValid = true;

        // Capture the original values
        var originalEmail = $("#email").val().trim();
        var originalContact = $("#contact").val().trim();

        function toggleSaveButton() {
            if (emailValid && contactValid) {
                $("#edit-profile-button").prop("disabled", false).removeClass("bg-gray-300 cursor-not-allowed");
            } else {
                $("#edit-profile-button").prop("disabled", true).addClass("bg-gray-300 cursor-not-allowed");
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
    });
</script>


        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

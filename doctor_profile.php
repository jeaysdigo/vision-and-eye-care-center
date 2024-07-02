<?php
session_start();
require_once 'php/connect.php';
if (!isset($_SESSION['doctorId'])) { 
    header('location: index.php');
  }

  $firstName = $_SESSION['firstName'];
  $doctorId = $_SESSION['doctorId'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $last_name = $email = $password = $bday = $gender = $contact  = $address = $municipality = $city = $zipcode = "";

if (isset($doctorId)) {
    $user_id = $doctorId;
    
    $stmt = $conn->prepare("SELECT FirstName, LastName, Email, DateOfBirth, Gender, ContactNumber, Address, Municipality, City,Zipcode FROM doctors WHERE DoctorID = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $email, $bday, $gender, $contact, $address, $municipality, $city, $zipcode);
    
    $stmt->fetch();
    $stmt->close();
}


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
            <div class="text-center p-2 flex font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Profile</div>
            <div class="w-10 h-10"></div> 
      </div>
    </div>
  </div>
</nav>



<?php require_once 'php/aside_doctor.php'; ?>

    
<section>
    <div class="my-8 py-8 p-4 py-8 mt-8 sm:ml-64 ">
    <div class="col-span-full xl:col-auto mt-4">
        <div class="p-4 mb-4 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="bg-gray-50 border rounded-full w-24 h-24 flex items-center justify-center mx-auto overflow-hidden">
                <img src="assets/profile.png" class="w-full object-cover" alt="Profile Icon">
            </div>

            <p class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center my-2">
                <?php echo htmlspecialchars($first_name) . " " . htmlspecialchars($last_name); ?>
            </p>
            <p class="text-gray-600 text-center">
                <?php echo htmlspecialchars($email) ?>
            </p>
        </div>
    </div>
    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="text-xl font-semibold dark:text-white">General information</h3>
            <p class="mb-4 text-gray-400 text-sm font-normal ">All information of your profile</p>
            <form action="#">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                        <p class="p-2.5 bg-gray-50 rounded-md  text-gray-900 sm:text-sm dark:text-white"><?php echo htmlspecialchars($first_name); ?></p>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                        <p class="p-2.5 bg-gray-50 rounded-md   text-gray-900 sm:text-sm dark:text-white"><?php echo htmlspecialchars($last_name); ?></p>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <p class="p-2.5 bg-gray-50 rounded-md   text-gray-900 sm:text-sm dark:text-white"><?php echo htmlspecialchars($email); ?></p>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                        <p class="p-2.5 bg-gray-50 rounded-md   text-gray-900 sm:text-sm dark:text-white"><?php echo htmlspecialchars($bday); ?></p>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                        <p class="p-2.5 bg-gray-50 rounded-md text-gray-900 sm:text-sm dark:text-white"><?php echo htmlspecialchars($gender); ?></p>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="contact-number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                        <p class="p-2.5 bg-gray-50 rounded-md  text-gray-900 sm:text-sm dark:text-white"><?php echo htmlspecialchars($contact); ?></p>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="home-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Home Address</label>
                        <p class="p-2.5 bg-gray-50 rounded-md  text-gray-900 sm:text-sm dark:text-white"><?php echo htmlspecialchars($address); ?></p>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="municipality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Municipality</label>
                        <p class="p-2.5 bg-gray-50 rounded-md  text-gray-900 sm:text-sm dark:text-white"><?php echo htmlspecialchars($municipality); ?></p>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                        <p class="p-2.5 bg-gray-50 rounded-md  text-gray-900 sm:text-sm dark:text-white"><?php echo htmlspecialchars($city); ?></p>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="zip-code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip/Postal Code</label>
                        <p class="p-2.5 bg-gray-50 rounded-md  p-2.5 bg-gray-100 rounded-md  text-gray-900 sm:text-sm dark:text-white"><?php echo htmlspecialchars($zipcode); ?></p>
                    </div>
                    <div class="py-2 col-span-6 sm:col-full">
                        <a href="doctor_account.php" class="md:px-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="p-4 mb-4  bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="text-xl font-semibold dark:text-white">Security & Login </h3>
            <p class="mb-4 text-gray-400 text-sm font-normal ">Update password and log out session</p>
            <form action="#">
                <div class="grid grid-cols-6 gap-6">
                <div class="py-2 col-span-6 sm:col-full">
                        <a href="change_password.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Change Password
                        </a>
                    </div>
                    <div class="py-2 col-span-6 sm:col-full">
                        <a href="logout.php" class="w-full px-3 py-2.5 text-sm font-medium text-center text-red-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300">
                            Logout Session
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">Password information</h3>
            <form action="#">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="current-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current password</label>
                        <input type="text" name="current-password" id="current-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="••••••••" required="">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New password</label>
                        <input data-popover-target="popover-password" data-popover-placement="bottom" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="••••••••" required="">
                        <div data-popover="" id="popover-password" role="tooltip" class="absolute z-10 invisible inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(1080.5px, -1380px, 0px);" data-popper-placement="top" data-popper-reference-hidden="">
                            <div class="p-3 space-y-2">
                                <h3 class="font-semibold text-gray-900 dark:text-white">Must have at least 6 characters</h3>
                                <div class="grid grid-cols-4 gap-2">
                                    <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                                    <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                                    <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                                    <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                                </div>
                                <p>It’s better to have:</p>
                                <ul>
                                    <li class="flex items-center mb-1">
                                        <svg class="w-4 h-4 mr-2 text-green-400 dark:text-green-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        Upper &amp; lower case letters
                                    </li>
                                    <li class="flex items-center mb-1">
                                        <svg class="w-4 h-4 mr-2 text-gray-300 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        A symbol (#$&amp;)
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-300 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        A longer password (min. 12 chars.)
                                    </li>
                                </ul>
                        </div>
                        <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(139px, 0px, 0px);"></div>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                        <input type="text" name="confirm-password" id="confirm-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="••••••••" required="">
                    </div>
                    <div class="col-span-6 sm:col-full">
                        <button class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="submit">Save all</button>
                    </div>
                </div>
            </form>
        </div> -->

        
   
    </div>

    </div>
</section>


<?php require_once 'php/bottombar_doctor.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

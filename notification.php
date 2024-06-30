<?php
// Include the connect.php file
require_once 'php/connect.php';

// Start the session
session_start();
if (!isset($_SESSION['patientId'])) { 
  header('location: index.php');
}

$firstName = $_SESSION['firstName'];
$patientId = $_SESSION['patientId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vision and Eye Care Center</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/script.js"></script>
</head>
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
        <div class="text-center p-2 flex font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Notification</div>
        <div class="w-10 h-10"></div> 
      </div>
    </div>
  </div>
</nav>

<?php require_once 'php/aside.php'; ?>
<section class="mb-8 pb-8">
  <div class="p-4 py-8 mt-8 sm:ml-64 ">
    
    <!-- Notification Container -->
    <div class="">
     
      <?php
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // SQL query to fetch notifications for approved appointments only
      $sql = "SELECT notifications.*, appointments.AppointmentDate, appointments.Status, doctors.FirstName, doctors.LastName
              FROM notifications
              JOIN appointments ON notifications.user_id = appointments.PatientID AND notifications.type = 'Appointment'
              JOIN doctors ON appointments.DoctorID = doctors.DoctorID
              WHERE appointments.Status = 'Approved'
                AND notifications.user_id = '$patientId'
                AND notifications.is_read = '0'
              ORDER BY notifications.created_at DESC";

      $result = $conn->query($sql);

      // Output notification cards
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          // Notification icon class for approved appointments
          $iconClass = "text-green-500";
      ?>

      <!-- Notification Card -->
      <div class="bg-white border rounded-lg p-4 max-w-sm mx-auto mt-2">
        <div class="flex items-start">
          <div class="flex-shrink-0">
       
            <!-- Notification Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 <?php echo $iconClass; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
          <div class="ml-3">
            <!-- Notification Content -->
            <p class="text-sm font-medium text-gray-900 p-1"><?php echo htmlspecialchars($row['title']); ?></p>
            <p class="text-sm text-gray-500 p-1">Your appointment on <span class="font-medium"><?php echo date('F j, Y \a\t g:i A', strtotime($row['AppointmentDate'])); ?></span> has been approved.</p>
            <p class="text-sm text-gray-400 p-1"><?php echo date('F j, Y \a\t g:i A', strtotime($row['created_at'])); ?></p>
          </div>
        </div>
      </div>

      <?php
        }
      } else {
        echo "<center><p class='mt-4'>No notifications found.</p></center>";
      }
      $conn->close();
      ?>
    </div>
  </div>
</section>

<?php require_once 'php/bottombar.php'; ?>

<script>
$(document).ready(function() {
  $("#mark-all-as-read").click(function() {
    $.ajax({
      url: "", // Pointing to the same page
      method: "POST",
      data: { update_all_notifications: true },
      success: function(response) {
        location.reload(); // Reload the page to reflect changes
      },
      error: function(xhr, status, error) {
        alert("An error occurred: " + error);
      }
    });
  });
});
</script>

<?php
if (isset($_POST['update_all_notifications'])) {
  // Reconnect to the database since the connection was closed earlier
  include 'php/connect.php';

  // Update all notifications' is_read status to 1 for the current user
  $updateSql = "UPDATE notifications SET is_read = '1' WHERE user_id = ? AND is_read = '0'";
  
  // Prepare and bind
  $updateStmt = $conn->prepare($updateSql);
  $updateStmt->bind_param("i", $patientId);
  $updateStmt->execute();

  if ($updateStmt->affected_rows > 0) {
    echo "All notifications marked as read.";
  } else {
    echo "No notifications to update.";
  }

  // Close the statement and database connection
  $updateStmt->close();
  $conn->close();
}
?>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>
</html>

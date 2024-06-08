<?php
// Check if the request method is POST and service_id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['service_id'])) {
    // Include your database connection code
    require_once "connect.php";

    // Sanitize input
    $serviceId = mysqli_real_escape_string($conn, $_POST['service_id']);

    // SQL query to delete the service
    $sql = "DELETE FROM patients WHERE PatientID = '$serviceId'";

    if ($conn->query($sql) === TRUE) {
        // If deletion was successful
        echo json_encode(array("success" => true));
    } else {
        // If an error occurred
        echo json_encode(array("success" => false, "message" => "Error deleting patient: " . $conn->error));
    }

    // Close connection
    $conn->close();
} else {
    // If service_id is not set or request method is not POST
    echo json_encode(array("success" => false, "message" => "Invalid request"));
}
?>

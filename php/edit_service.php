<?php
require_once "connect.php";


    // Sanitize input
    $id = mysqli_real_escape_string($conn, $_POST['serviceId']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Execute update statement
    $sql = "UPDATE services SET ServiceName = '$name', Description = '$description' WHERE ServiceID = '$id'";
    if ($conn->query($sql) === TRUE) {
        // Check if any rows were affected
        if ($conn->affected_rows > 0) {
            // Return success response
            echo json_encode(array("success" => true, "message" => "Service details updated successfully"));
        } else {
            // Return failure response
            echo json_encode(array("success" => false, "message" => "Service not found or details not updated"));
        }
    } else {
        // Return error response
        echo json_encode(array("success" => false, "message" => "Error updating service details: " . $conn->error));
    }

    // Close connection
    $conn->close();

?>

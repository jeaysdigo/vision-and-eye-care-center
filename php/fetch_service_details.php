<?php
require_once "connect.php";
// Check if the service_id parameter is set in the GET request
if (isset($_GET['service_id'])) {
    // Sanitize the input to prevent SQL injection
    $service_id = $conn->real_escape_string($_GET['service_id']);

    // Query to fetch service details based on service ID
    $sql = "SELECT * FROM services WHERE ServiceID = $service_id";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Send the service details as JSON response
        echo json_encode([
            'name' => $row['ServiceName'],
            'description' => $row['Description'],
            // Add other fields if needed
        ]);
    } else {
        // Service not found
        echo json_encode(['error' => 'Service not found']);
    }
} else {
    // Service ID parameter not provided
    echo json_encode(['error' => 'Service ID parameter not provided']);
}

// Close connection
$conn->close();
?>

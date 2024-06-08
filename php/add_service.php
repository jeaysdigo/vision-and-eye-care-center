<?php

require_once "connect.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (isset($_POST["name"]) && isset($_POST["description"]) && isset($_FILES["icon"])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        
        // File upload handling
        $fileName = $_FILES["icon"]["name"];
        $fileTempName = $_FILES["icon"]["tmp_name"];
        $fileType = $_FILES["icon"]["type"];
        
        // Check if file is uploaded successfully
        if ($fileTempName !== "" && is_uploaded_file($fileTempName)) {
            // Read file data and encode it as base64
            $fileData = file_get_contents($fileTempName);
            $base64Image = base64_encode($fileData);
            
            // Prepare SQL statement
            $sql = "INSERT INTO services (ServiceName, Description, Icon) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $description, $base64Image);
            
            // Execute SQL statement
            if ($stmt->execute() === TRUE) {
                echo "New record inserted successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            // Close statement
            $stmt->close();
        } else {
            echo "Failed to upload file.";
        }
        
        // Close connection
        $conn->close();
    } else {
        echo "Please fill all the required fields.";
    }
} else {
    echo "Form submission method not allowed.";
}
?>

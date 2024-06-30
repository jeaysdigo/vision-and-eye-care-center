<?php
require_once 'connect.php';

// Handle form submission via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords
    if ($new_password !== $confirm_password) {
        echo json_encode(["success" => false, "message" => "Passwords do not match."]);
        exit();
    }

    // Get the email associated with the token
    $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token=? AND expires >= ?");
    $stmt->bind_param("si", $token, time());
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    if ($email) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt_update = $conn->prepare("UPDATE doctors SET Password=? WHERE Email=?");
        $stmt_update->bind_param("ss", $confirm_password, $email);

        if ($stmt_update->execute()) {
            // Delete the token from password_resets table
            $stmt_delete = $conn->prepare("DELETE FROM password_resets WHERE token=?");
            $stmt_delete->bind_param("s", $token);
            $stmt_delete->execute();
            $stmt_delete->close();

            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update password: " . $conn->error]);
        }

        $stmt_update->close();
    } else {
        echo json_encode(["success" => false, "message" => "Invalid or expired token."]);
    }
}

// Close connection
$conn->close();
?>

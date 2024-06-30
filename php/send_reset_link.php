<?php
require_once 'connect.php';
require '../vendor/autoload.php'; // Autoload PHPMailer classes

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT DoctorID FROM doctors WHERE Email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if ($user_id) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        $expires = date("U") + 1800; // 30 minutes from now

        // Store the token in the database
        $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $email, $token, $expires);
        $stmt->execute();
        $stmt->close();

        // Send the password reset link via email
        $reset_link = "localhost/reset_password.php?token=" . $token;

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.office365.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jeaysdigo@outlook.com'; // Your Outlook address
            $mail->Password   = 'Leavemealonebaby01';      // Your Outlook App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('jeaysdigo@outlook.com', 'Password Reset');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset';
            $mail->Body    = 'Click <a href="' . $reset_link . '">here</a> to reset your password.';

            $mail->send();
            echo json_encode(["success" => true]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => 'Mailer Error: ' . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "No account found with that email."]);
    }
}
?>

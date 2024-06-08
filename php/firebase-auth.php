<?php
require_once 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Initialize Firebase
$serviceAccount = ServiceAccount::fromJson('serviceAccount.json');
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

// Get Firebase Authentication instance
$auth = $firebase->getAuth();

// Function to send verification code
function sendVerificationCode($phoneNumber) {
    global $auth;

    try {
        $auth->startPhoneVerification($phoneNumber);
        echo "Verification code sent!";
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Function to verify code
function verifyCode($phoneNumber, $code) {
    global $auth;

    try {
        $auth->verifyPhoneNumber($phoneNumber, $code);
        echo "Verification successful!";
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Example usage
$phoneNumber = '+1234567890'; // User's phone number
sendVerificationCode($phoneNumber); // Send verification code

// After user enters the code, verify it
$verificationCode = '123456'; // Code entered by the user
verifyCode($phoneNumber, $verificationCode);
?>

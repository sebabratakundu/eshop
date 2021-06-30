<?php
require('textlocal.class.php');
session_start();
$textlocal = new Textlocal(false,false,'/e9DkcuwXPM-GTX3cChGYLCqOTX7tCv3Y7LPMvP4iN');

$numbers = array($mobile);
$sender = 'TXTLCL';
$otp = rand(129485,995231);
$message = 'Your OTP for activating your account is : '.$otp;
$_SESSION["otp"] = $otp;
try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    echo "success";
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
?>
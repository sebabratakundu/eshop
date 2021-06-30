<?php
require('textlocal.class.php');
require_once("../../common_files/php/database.php");
session_start();
$textlocal = new Textlocal(false,false,'/e9DkcuwXPM-GTX3cChGYLCqOTX7tCv3Y7LPMvP4iN');
$mobile = $_POST["mobile"];
$email = strrchr($mobile, "@");
if($email){
	$get_mobile_no = "SELECT mobile FROM users WHERE email = '$email'";
	$mobile_response = $db -> query($get_mobile_no);
	if($mobile_response){
		$data = $mobile_response -> fetch_assoc();
		$mobile = $data["mobile"];
	}
}
$numbers = array($mobile);
$sender = 'TXTLCL';
$otp = rand(129485,995231);
$message = 'Your OTP for changing mobile number is : '.$otp;
$_SESSION["otp"] = md5($otp);
try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    echo "success";
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
?>
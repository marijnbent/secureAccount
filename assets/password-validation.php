<?php

function generateSalt()
{
	$salt = base64_encode(mcrypt_create_iv(24, MCRYPT_DEV_URANDOM));
	return $salt;
}

function hashPassword($salt, $password)
{
	$hash = hash_pbkdf2("sha256", $password, $salt, 10000, 48);
	return $hash;
}

function twoFactorAuthentication()
{
	$authenticationCode = rand(0, 999999);
	$expireDate = time() + 3600;
	$_SESSION["authenticationCode"] = ["code" => $authenticationCode, "expireDate" => $expireDate];

	//As SMS is not a viable option for experimenting, I've used an email api.
	sendEmail();
}

function sendEmail()
{
	$to = $_SESSION['email'];
	$subject = 'Two-factor Login';
//	echo "Code:  " . $_SESSION["authenticationCode"]['code'];
	$message = 'Hi there. Thank you for using the two-factor authentication, it is much safer. Your code is ' . $_SESSION["authenticationCode"]['code'] . ' and valid for the next hour.';
	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	mail($to, $subject, $message, $headers);
}

function checkPasswordOnLogin () {

}
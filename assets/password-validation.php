<?php

function generateSalt () {
	$salt = base64_encode(mcrypt_create_iv(24, MCRYPT_DEV_URANDOM));
	return $salt;
}

function hashPassword($salt, $password) {
	$iterations = 1000;
	$hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 48);
	return $hash;
}
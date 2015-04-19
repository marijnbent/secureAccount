<?php
//Starts session to destroy it and redirect the user to the login.php page.
session_start();
session_destroy();
header("Location: login.php");


<?php

require_once 'assets/phpheader.php';

if (!isset($_SESSION['loggedIn'])) {
	header("Location: login.php");
	exit;
}

?>

<?php require_once 'assets/header.php'; ?>
	<div class="row">
		<section class="col-md-12">

			<h1>You are logged in, in a secure way.</h1> <small>Made by Marijn Bent</small>

		</section>
	</div>

<?php require_once 'assets/footer.php'; ?>
<?php

require_once 'assets/phpheader.php';

//Checking if you're already logged in. If you are, sends you back to the secured page.
if (!isset($_SESSION['authentication'])) {
	header("Location: login.php");
	exit;
}

if (isset($_SESSION['loggedIn'])) {
	header("Location: secure.php");
	exit;
}

//If you've submitted the login form, this function will start to check your data.
if (isset($_POST['submit'])) {
	$code = $_POST['code'];
	if ($code == $_SESSION['authenticationCode']['code'] ) {
		$_SESSION["loggedIn"] = true;
		header("Location: secure.php");
	} else {
		$warning = "De code is niet juist. Check je email.";
	}
}

//Only echo when testing.
//echo $_SESSION['authenticationCode']['code'];

?>

<?php require_once 'assets/header.php'; ?>
	<div class="row">
		<section class="col-md-12">

			<p>De code wordt gestuurd via de email. Bekijk de zojuist ontvangen email en vul deze in.</p>
			<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="form-group">
					<label for="code">Code:</label>
					<input name="code" type="text" id="code" class="form-control" required>
				</div>

				<input type="submit" name="submit" id="submit" class="btn btn-default" value="Inloggen">

			</form>
		</section>
	</div>

<?php require_once 'assets/footer.php'; ?>
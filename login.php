<?php

require_once 'assets/phpheader.php';

//Checking if you're already logged in. If you are, sends you back to the secured page.
if (isset($_SESSION['loggedIn'])) {
	header("Location: secure.php");
	exit;
}

if (isset($_GET['registered'])) {
	$message = "U kunt nu inloggen met uw zojuist ingevulde gegevens.";
}

//If you've submitted the login form, this function will start to check your data.
if (isset($_POST['submit'])) {
	//Anti sql injection via the input field and put the values of the form to variables.

	$email = dataFilter($_POST['email'], $dbLink);
//	$password = dataFilter($_POST['password'], $dbLink);

	//Create query to collect the email and password from database.
	$select = "SELECT * FROM users
			   WHERE `email` = '" . $email . "'";

	//Send query to the function mySqlConnection with the query, config settings and dbconnection.
	$result = queryToDatabase($dbLink, $select);
	$user = queryToArray($result);

	$correctPassword = $user[0]['password'];
	$salt = $user[0]['salt'];

	$inputPassword = hashPassword($salt, $_POST['password']);

	//Checks if the returned array is empty and if the email and password match the input value's.
	if ($correctPassword == $inputPassword) {
		$_SESSION["userId"] = $user[0]['id'];
		$_SESSION['email'] = $user[0]['email'];
		$_SESSION['name'] = $user[0]['name'];
		//Create session variable which we can check on other pages if the user is logged in
		$_SESSION["loggedIn"] = true;

		header("Location: teams.php");
		exit;
	} else {
		//If there is no match, show message with the result.
		$danger = "Inloggen is niet gelukt. Probeer het opnieuw.";
	}
}

?>

<?php require_once 'assets/header.php'; ?>
	<div class="row">
		<section class="col-md-12">

			<p>Heeft u nog geen account? <a href="register.php">Ga naar de registreer pagina.</a></p>

			<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="form-group">
					<label for="email">Email:</label>
					<input name="email" type="email" id="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">Wachtwoord:</label>
					<input name="password" type="password" id="password" class="form-control" required>
				</div>

				<input type="submit" name="submit" id="submit" class="btn btn-default" value="Inloggen">

			</form>
		</section>
	</div>

<?php require_once 'assets/footer.php'; ?>
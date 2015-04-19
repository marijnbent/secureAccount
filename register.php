<?php

require_once 'assets/phpheader.php';

//Checks if the session variable 'loggedIn' exists, which only is granted to users who've validated their logindata.
if (isset($_SESSION["loggedIn"])) {
	header("Location: index.php");
	exit;
}
if (isset($_POST['submitRegister'])) {

	if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
		$name = dataFilter($_POST['name'], $dbLink);
		$email = dataFilter($_POST['email'], $dbLink);

		//Check if email is already in use
		$select = "SELECT email FROM Users WHERE email = '" . $email . "'";
		$emailVertification = queryToDatabase($dbLink, $select);
		//If the email isn't registerd, insert new row in Users table.
		if (mysqli_num_rows($emailVertification) == 0) {
			$salt = generateSalt();
			$hash = hashPassword($salt, $_POST['password']);
			$insert = "INSERT INTO `users` (`name`, `email`, `password`, `salt`) VALUES ('" . $name . "', '" . $email . "', '" . $hash . "', '" . $salt . "')";
			queryToDatabase($dbLink, $insert);
			header("Location: login.php?registered");
			exit;
		} else {
			$danger = 'Emailadres is al in gebruik.';
		}
	} else {
		$danger = "Vul alle velden in.";
	}
}


?>

<?php require_once 'assets/header.php'; ?>

	<span>Heeft u al een account? </span><a href="login.php">Ga naar de login pagina.</a>

	<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
		<div class="form-group">
			<label for="name">Naam:</label>
			<input name="name" type="text" id="name" <?php if (isset($_POST['submitRegister'])) { ?>
			       value="<?php echo $_POST['name'];
			       } ?>" class="form-control">
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input name="email" type="email" id="email" <?php if (isset($_POST['submitRegister'])) { ?>
			       value="<?php echo $_POST['email'];
			       } ?>" class="form-control">
		</div>
		<div class="form-group">
			<label for="password">Wachtwoord:</label>
			<input name="password" type="password" id="password" <?php if (isset($_POST['submitRegister'])) { ?>
			       value="<?php echo $_POST['password'];
			       } ?>" class="form-control">
		</div>
		<input type="submit" name="submitRegister" id="submit" class="btn btn-info" value="Registreer">

	</form>

<?php require_once 'assets/footer.php'; ?>
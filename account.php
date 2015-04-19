<?php

require_once 'assets/phpheader.php';

//Checks if the session variable 'loggedIn' exists, which only is granted to users who've validated their logindata.
if (!isset($_SESSION["loggedIn"])) {
	header("Location: login.php");
	exit;
}

if (isset($_POST['submitEdit'])) {
	if (!empty($_POST['name']) && !empty($_POST['email'])) {
		$select = "SELECT email FROM Users WHERE email = '" . $_POST['email'] . "'";
		$emailVertification = queryToDatabase($dbLink, $select);
		//If the email isn't registerd before, insert new row in Users table.
		if (mysqli_num_rows($emailVertification) == 0 || $_POST['email'] == $_SESSION['email']) {
			$update = "UPDATE `users` SET `email` = '" . $_POST['email'] . "', `name` = '" . $_POST['name'] . "' WHERE `id` = '" . $_SESSION['userId'] . "'";
			queryToDatabase($dbLink, $update);
			header("Location: account.php?success");
			exit;
		} else {
			$danger = 'Emailadres is al in gebruik.';
		}
	} else {
		$danger = "Vul alle velden in.";
	}
}

//Select drinks and put them in array.
$select = "SELECT * FROM users WHERE users.id =" . $_SESSION['userId'] . "";
$userSettings = queryToDatabase($dbLink, $select);
$userSettings = queryToArray($userSettings);

?>


<?php require_once 'assets/header.php'; ?>

	<h1>Mijn account
		<small> - Pas eenvoudig uw gegevens aan</small>
	</h1>

	<dl class="dl-horizontal">
		<?php foreach ($userSettings as $userSetting) { ?>
			<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" class="">
				<div class="form-group">
					<dt><label for="name">Name: </label></dt>
					<dd>
						<input name="name" type="text" id="name" class="form-control"
						       value="<?= $userSetting['name']; ?>">
					</dd>
				</div>
				<div class="form-group">
					<dt><label for="name">Email: </label></dt>
					<dd>
						<input name="email" type="email" id="email" class="form-control"
						       value="<?= $userSetting['email']; ?>">
					</dd>
				</div>
				<input type="submit" name="submitEdit" id="submitEdit" class="btn btn-default"
				       value="Bewerken">

			</form>

		<?php
		} ?>
	</dl>

<?php require_once 'assets/footer.php'; ?>
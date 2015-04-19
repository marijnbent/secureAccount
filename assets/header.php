<?php

?>
	<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>Secure login system</title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/style.css"/>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400' rel='stylesheet' type='text/css'>
	</head>
<body>

	<div class="container container-menu">
		<?php require_once 'navbar.php'; ?>
	</div>
<div class="container">

<?php if (isset($message)) { ?>
	<div class="alert alert-info" role="alert"><?= $message; ?></div>
<?php }
if (isset($warning)) { ?>
	<div class="alert alert-warning" role="alert"><?= $warning; ?></div>
<?php }
if (isset($danger)) { ?>
		<div class="alert alert-danger" role="alert"><?= $danger; ?></div>
	<?php }

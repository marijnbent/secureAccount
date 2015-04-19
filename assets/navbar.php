<nav class="navbar navbar-default">
	<div class="container-fluid">

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Index</a></li>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['email'])) { ?>
					<p class="navbar-text">U bent ingelogd met het emailadres <?= $_SESSION['email']; ?></p>
					<li><a href="account.php">Mijn account</a></li>
					<li><a href="logout.php">Uitloggen</a></li>
				<?php } ?>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>
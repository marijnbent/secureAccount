<?php
// Closing the msqli connection after usage.
if (isset($dbLink)) {
	mysqli_close($dbLink);
}
?>

</div> <!-- Closing the container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
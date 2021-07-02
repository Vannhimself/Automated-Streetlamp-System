
<!-- KHUSUS UP PADA WEBSITE -->
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
	$server = "localhost";
	$name = "root";
	$password = "";
	$db = "lampu";

	$conn = mysqli_connect($server, $name, $password, $db);

	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
  ?>
</body>
</html>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'timesheeet';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
	die('Could not connect: ');
}

$username = $_POST['username'];
$password = $_POST['password'];
$remaining_hours = 2000; // set natin ang remaining_hours sa 2000 sa umpisa

$sql = "INSERT INTO user (username, password, remaining_hours) VALUES ('$username', '$password', '$remaining_hours')";
$query_result = mysqli_query($conn, $sql);

if ($query_result) {
	echo "New user created successfully!";
} else {
	echo "Error creating new user: " . mysqli_error($conn);
}

mysqli_close($conn);
?>



<!DOCTYPE html>
<html>
<head>
	<title>New User Registration</title>
</head>
<body>
	<h1>New User Registration</h1>
	<form method="post" action="insert.php">
		<label for="username">Username:</label>
		<input type="text" name="username" required>
		<br>
		<label for="password">Password:</label>
		<input type="password" name="password" required>
		<br>
		<input type="submit" value="Create User">
	</form>
</body>
</html>
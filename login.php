
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

	$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);

	if ($count == 1) {
		$_SESSION['username'] = $username;
		header('Location: timesheet.php');
	} else {
		$error = "Invalid username or password";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<form method="post">
		<p>Username: <input type="text" name="username"></p>
		<p>Password: <input type="password" name="password"></p>
		<button type="submit">Log In</button>
	</form>
	<?php if(isset($error)): ?>
		<p><?php echo $error; ?></p>
	<?php endif; ?>
</body>
</html>
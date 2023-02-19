
You sent
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

$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$remaining_hours = $row['remaining_hours'];
$last_logout = $row['last_logout'];

$action = $_POST['action'];

if ($action == 'clock_in') {
	$remaining_hours -= 500;
} else if ($action == 'clock_out') {
	$current_time = time();
	$last_logout_time = strtotime($last_logout);
	$time_difference = $current_time - $last_logout_time;
	$remaining_hours += floor($time_difference / 3600);
	$last_logout = date('Y-m-d H:i:s');
}

$sql = "UPDATE user SET remaining_hours = '$remaining_hours', last_logout = '$last_logout' WHERE username = '$username' AND password = '$password'";
$query_result = mysqli_query($conn, $sql);

if ($query_result) {
	echo $remaining_hours;
} else {
	echo "Error updating remaining hours: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
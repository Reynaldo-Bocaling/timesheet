<?php
session_start();

if (!isset($_SESSION['username'])) {
	header('Location: login.php');
}

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'timesheeet';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
	die('Could not connect: ');
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$remaining_hours = $row['remaining_hours'];
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Time Tracker</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>

        $(Document)
		function updateRemainingHours(action) {
			var username = '<?php echo $username; ?>';
			var password = '<?php echo $row['password']; ?>';
			$.ajax({
				type: 'POST',
				url: 'update_hours.php',
                data: {
                action: action,
                username: username,
                password: password
                },
                success: function(data) {
                $('#remaining_hours').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                alert('Error updating remaining hours: ' + textStatus);
                }
            });
            }


            $(document).ready(function() {
		$('#clock_in').click(function() {
			updateRemainingHours('clock_in');
		});

		$('#clock_out').click(function() {
			updateRemainingHours('clock_out');
		});
	});
</script>
       
</head>
<body>
	<h1>Time Tracker</h1>
	<p>Remaining hours: <span id="remaining_hours"><?php echo $remaining_hours; ?></span></p>
	<button id="clock_in"> In</button>
	<button id="clock_out"> Out</button>
	<a href="logout.php">Log Out</a>
</body>
</html>
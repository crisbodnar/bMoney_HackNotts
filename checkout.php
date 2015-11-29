<?php
session_start();
if ($_SESSION['user'] == "") {
	header ("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	include_once 'dbconnect.php';
	//Transaction stuff here (not now)

	echo $_SESSION['id'];

	$id = $_SESSION['id'];
	$username = $_SESSION['user'];
	$query = "UPDATE offers SET lendfrom='$username' WHERE id='$id'";
	$result = $conn->query($query);
	if($result)
		?>
		<script type="text/javascript">alert("Merge!!!")</script>
	<?php
	unset($_SESSION['id']);
	header('Location: main.php');	
	?>
		<script type="text/javascript">alert("You have the money")</script>
	<?php
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
  </head>
  <body>
    <!-- page content -->
  </body>
</html>
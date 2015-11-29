<?php
session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {
	header ("Location: index.php");
}

include_once 'dbconnect.php';

?>

<?php
if(isset($_SESSION['id'])){
	$id = $_SESSION['id'];
	$query = "SELECT * FROM offers WHERE id='$id'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();

	$value = $row['amount'];
	$owner = $row['owner'];
}
?>
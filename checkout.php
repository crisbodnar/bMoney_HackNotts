<?php
session_start();

if(isset($_POST['lend-btn'])){
	//Transaction stuff here (not now)

	include_once 'dbconnect.php';

	$id = $_SESSION('id');
	$username = $_SESSION('username');
	$conn = "UPDATE offers SET lendto='$username' WHERE id='$id'";
	$result = $conn->query($query);
	unset($_SESSION['id']);
	header(' Location: main.php');	
}
?>
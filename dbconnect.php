<?php
$conn = new mysqli("localhost", "root", "", "bmoney");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>
<?php
session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {
	header ("Location: index.php");
}

?>

<?php
// Connect to the database
include_once 'dbconnect.php';

$username = $password = "";

if(isset($_POST['btn-search'])){
  $amount = $_POST["amount"];
  $interestr = $_POST["interestr"];

  $query = "SELECT * FROM offers WHERE amount>='" .$amount."'"
		          ."AND interestr<='".$interestr."'";
		$result = $conn->query($query);
		while($row = $result->fetch_assoc()){
			echo '<div class="offer-result">';
			echo $row["amount"] . ", " . $row["interestr"]; 
			echo "</div>";
		}
}

if(isset($_POST['btn-insert'])){
  $amount = $_POST["amount"];
  $interestr = $_POST["interestr"];
  $days = $_POST["days"];
  $owner = $_SESSION['user'];

  $query = "INSERT INTO offers(amount,interestr,days,owner) 
            VALUES('$amount','$interestr','$days','$owner')";
  $result = $conn->query($query);
}
?>




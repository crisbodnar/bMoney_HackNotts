<?php
session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {
	header ("Location: index.php");
}

?>

<?php
// Connect to the database
// Create connection
$conn = new mysqli("localhost", "buser", "buser", "bmoney");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
//End connection

$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET["type"]) {
  $username = test_input($_POST["usernamel"]);
  $password = sha1(test_input($_POST["passwordl"]));
  $query = "SELECT * FROM users WHERE username='" .$username."' 
           AND password='".$password."'";
  $result = $conn->query($query);
  if($result->num_rows > 0){
    $conn->close();
    $_SESSION['login'] = 1;
    header ("Location: main.php");
  }
}
/*
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if($_GET["search"]){
		$amount = $_POST["amount"];
		$interestr = $_POST["interestr"];

		$conn = new mysqli("localhost", "buser", "buser", "bmoney");
		$query = "SELECT * FROM offers WHERE amount>='" .$amount."'"
		          ."AND interestr<='".$interestr."'";
		$result = $conn->query($query);
		while($row = $result->fetch_assoc()){
			echo "<div>";
			echo $row["amount"] . ", " . $row["interestr"]; ;
			echo "</div>";
		}
		$conn->close(); 
	}
	else{
		$amount = $_POST["amount"];
		$interestr = $_POST["interestr"];
		$days = $_POST["days"];
		$owner = $_POST["owner"];
		$lendto = $_POST["lendto"];

		$conn = new mysqli("localhost", "buser", "buser", "bmoney");
		$query = "INSERT INTO offers(amount,interestr,days,owner)
			      VALUES('".$amount."','".$interestr."','".$days."',
			      '".$owner."')";
		$result = $conn->query($query);
		$conn->close(); 
	}
}
*/


?>




<?php
session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {
	header ("Location: index.php");
}

include_once 'dbconnect.php';
include_once './braintree-php-3.7.0/lib/autoload.php';

?>

<?php

if(isset($_SESSION['id'])){

	$username = $_SESSION['user'];
	//$query = "SELECT * FROM keys WHERE username='$username'";
	//$result = $conn->query($query);
	//$row = $result->fetch_assoc();
	//get data from db -> then hard coded


	Braintree_Configuration::environment('sandbox');
	Braintree_Configuration::merchantId("h47f3rqb3m4xr9q5");
	Braintree_Configuration::publicKey("5q45x7f9p4rvv5cn");
	Braintree_Configuration::privateKey("27f09e561c1f154120fa64bb5d884102");


	$id = $_SESSION['id'];
	$query = "SELECT * FROM offers WHERE id='$id'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();

	$amount = $row['amount'];
	$owner = $row['owner'];

	$nonce = "fake-valid-visa-nonce";
	$sale = Braintree_Transaction::sale([
  		'amount' => (float)$amount,
  		'paymentMethodNonce' => $nonce
	]);

	$conn->close();

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
	<form id="checkout" method="post" action="./checkout.php">
  		<div id="payment-form"></div>
  		<?php echo '<input type="submit" name="lend-btn" value="Lend '. $amount . '$">' ?>
	</form>

<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<script>
// We generated a client token for you so you can test out this code
// immediately. In a production-ready integration, you will need to
// generate a client token on your server (see section below).
var clientToken = "<?php echo($clientToken = Braintree_ClientToken::generate()); ?>";

braintree.setup(clientToken, "dropin", {
  container: "payment-form"
});
</script>
  </body>
</html>
<?php
}
?>
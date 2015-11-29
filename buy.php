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
	$query = "SELECT * FROM keys WHERE username='$username'";
	$result = $conn->query($query)
	$row = $result->fetch_assoc();

	Braintree_Configuration::environment('sandbox');
	Braintree_Configuration::merchantId($row['merchantid']);
	Braintree_Configuration::publicKey($row['publickey']);
	Braintree_Configuration::privateKey($row['privatekey']);


	$id = $_SESSION['id'];
	$query = "SELECT * FROM offers WHERE id='$id'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();

	$amount = $row['amount'];
	$owner = $row['owner'];

	$nonce = "fake-valid-visa-nonce";
	$result = Braintree_Transaction::sale([
  		'amount' => (float)$amount,
  		'paymentMethodNonce' => $nonce
	]);

?>
	<form id="checkout" method="post" action="checkout.php">
  <div id="payment-form"></div>
  <input type="submit" name="lend-btn" value="Lend ". $amount . "$">
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
<?php
}
?>
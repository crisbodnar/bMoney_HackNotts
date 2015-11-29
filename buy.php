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

	Braintree_Configuration::environment('sandbox');
	Braintree_Configuration::merchantId('h47f3rqb3m4xr9q5');
	Braintree_Configuration::publicKey('5q45x7f9p4rvv5cn');
	Braintree_Configuration::privateKey('27f09e561c1f154120fa64bb5d884102');


	$id = $_SESSION['id'];
	$query = "SELECT * FROM offers WHERE id='$id'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();

	$value = $row['amount'];
	$owner = $row['owner'];

	$nonce = "fake-valid-visa-nonce";
	$result = Braintree_Transaction::sale([
  		'amount' => '100.00',
  		'paymentMethodNonce' => $nonce
	]);

?>
	<form id="checkout" method="post" action="/checkout">
  <div id="payment-form"></div>
  <input type="submit" value="Pay $10">
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
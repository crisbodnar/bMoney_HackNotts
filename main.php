<?php
session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {
	header ("Location: index.php");
}

?>

<?php
// Connect to the database
include_once 'dbconnect.php';
global $search_data;

if(isset($_POST['btn-search'])){
  $amount = $_POST["amount"];
  $interestr = $_POST["interestr"];

  $query = "SELECT * FROM offers WHERE amount>='" .$amount."'"
		          ."AND interestr<='".$interestr."'";
  $result = $conn->query($query);
  if (!$result) {
  ?>
  <script>alert('Query problem ');</script>
  <?php
  }
  $search_data = $result;
}

if(isset($_POST['btn-insert'])){
  $amount = $_POST["amount"];
  $interestr = $_POST["interestr"];
  $days = $_POST["days"];
  $owner = $_SESSION['user'];

  $query = "INSERT INTO offers(amount,interestr,days,owner) 
            VALUES('$amount','$interestr','$days','$owner')";
  $result = $conn->query($query);
  if (!$result) {
  	?>
    <script>alert('Query problem ');</script>
  	<?php
  }
  ?>
    <script>alert('Announce posted');</script>
  	<?php
}

if(isset($_POST['logout'])){
	unset($_SESSION["user"]);
	session_destroy();
	header("Location: index.php");
}

if(isset($_POST['submit_table'])){
    $selected_radio = $_POST['id'];
    $_SESSION['id'] = $selected_radio;
    header('Location: buy.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>iNeedMoney</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">


</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">iNeedMoney</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll text-faded" href="#page-top"><span class="glyphicon glyphicon-home"></span></a>
                    </li>
                    <li>
                        <a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-search"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="#borrow">Borrow</a></li>
                          <li><a href="#lend">Lend</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="page-scroll text-faded" href="#services"><span class="glyphicon glyphicon-envelope"></span></a>
                    </li>
                    <li>
                        <a class="page-scroll text-faded" href="#contact"><span class="glyphicon glyphicon-phone-alt"></span></a>
                    </li>
                    <li>
                        <a class="page-scroll text-faded" href="#services"><span class="glyphicon glyphicon-wrench"></span></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Welcome back!</h1> 
                <hr>
                <form method="post"><button type="submit" class="btn btn-primary btn-xl wow tada page-scroll" name="logout" href="#logout">LOG OUT</button></form> 
            </div>
        </div>
    </header>


    <section id="borrow">
        <div class="container">
            <div class="row">
                
                <form method="post" class="centeral">
                    <p>Borrow</p>
                    <input name="amount" type="text" placeholder="Amount..." required>
                    <input name="interestr" type="text" placeholder="Interest rate..." required>
                    <button name="btn-search" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>
        </div>
    </section>

    <section>
    	  <?php
    		if($search_data){
                echo '<form method="post">';
    			echo '<table>';
    			echo '<tr><th>Select</th><th>Amount in pounds</th><th>Interest rate</th><th>Number of days</th></tr>' ;
    			while($row = $search_data->fetch_assoc()){
                echo '<tr>';
    			echo '<td><input type="radio" name="id" value="'. $row['id']. '"></td>';
				echo '<td>' . $row["amount"] . '</td>'; 
				echo '<td>' . $row["interestr"] . '</td>';
				echo '<td>' . $row['days'] . '</td>';  
				echo "</tr>";
				}
				echo '<table>';
                echo '<input type="submit" name="submit_table">';
                echo '</form>';
			}

	?>
    </section>

    <section id="lend">
        <div class="container">
            <div class="row">
                <form method="post" class="centeral">
                    <p>Lend</p>
                    <input name="amount" type="text" placeholder="Amount..." required>
                    <input name="interestr" type="text" placeholder="Interest rate..." required>
                    <input name="days" type="text" placeholder="Payback time..." required>
                    <button name="btn-insert" type="submit">Create</button>
                </form>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>

</body>
</html>
<?php
session_start();
if(isset($_SESSION['user']))
{
 header("Location: main.php");
}
include_once 'dbconnect.php';
?>


<?php
//Log in manage
if(isset($_POST['btn-signin']))
{
 $uname = $_POST['uname'];
 $upass = sha1($_POST['pass']);
 
 $query = "SELECT * FROM users WHERE username='$uname' AND password='$upass'";
 $result = $conn->query($query);
 if($result->num_rows > 0)
 {
        $_SESSION['user'] = $uname;
        header("Location: main.php");
  ?>
        <script>alert('successfully logged in ');</script>
      
        <?php
 }
 else
 {
  ?>
        <script>alert('error while logging you in...');</script>
        <?php
 }
} 
?>


<?php
//Register manage

if(isset($_POST['btn-signup']))
{
 $mid = $pubk = $prik = "";

 $uname = $_POST['uname'];
 $email = $_POST['email'];
 $upass = sha1($_POST['pass']);
 $mid = $_POST['mid'];
 $pubk = $_POST['pubk'];
 $prik = $_POST['prik'];
 
 $query = "INSERT INTO users(username,email,password) VALUES('$uname','$email','$upass')";
 $result = $conn->query($query);
 if($result)
 {
  ?>
        <script>alert('successfully registered ');</script>
        <?php
 }
 else
 {
  ?>
        <script>alert('error while registering you...');</script>
        <?php
 }
$conn->close();
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
                        <a class="page-scroll text-faded" href="#login">LogIn</a>
                    </li>
                    <li>
                        <a class="page-scroll text-faded" href="#services">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll text-faded" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll text-faded" href="#contact">Contact</a>
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
                <h1>iNeedMoney</h1>
                <hr>
                <p>Do you need money? Do you hate banks? Then you are in the right place!</p>
                <a href="#login" class="btn btn-primary btn-xl wow tada page-scroll">Log-in / Register</a>
            </div>
        </div>
    </header>

    <section class="bg-primary center" id="login" >
        <table>
            <td>
            <div class="container chestia1" style="float: left; width: 100%;; color: #FFFFFF;">   
                <h2 class="centeral">LOG-IN</h2>
                <form method="post" role="form" class="centeral">
                    <div class="form-group" style = "width: 100%;">
                        <label for="usr">Username:</label>
                        <input name="uname" type="text" style = "width: 100%;" class="form-control block" id="usr">
                    </div>
                    <div class="form-group" style = "width: 100%;">
                        <label class="centeral" for="pwd">Password:</label>
                        <input name="pass" type="password" style = "width: 100%;" class="form-control block" id="pwd">
                    </div>
                    <div class="form-group">
                        <button name="btn-signin" type="submit" class="btn btn-default wow tada">Log-in/</button>
                    </div>
                </form>
            </div>
            </td>
            <td>
            <div class="container chestia2" style="float: right; width: 100%; color: #FFFFFF;">
                <h2 class="centeral" >Register</h2>
                <form method="post" role="form" class="centeral">
                    <div class="form-group">
                        <label class="centeral" for="usr">Username:</label>
                        <input type="text" name="uname" style = "width: 100%;" class="form-control block" id="usr">
                    </div>
                    <div class="form-group">
                        <label class="centeral" for="email">Email:</label>
                        <input type="email" name="email" style = "width: 100%;" class="form-control block" id="email">
                    </div>
                    <div class="form-group">
                        <label class="centeral" for="pwd">Password:</label>
                        <input type="password" name="pass" style = "width: 100%;" class="form-control block" id="pwd">
                    </div>
                    <div class="form-group">
                        <label class="centeral" for="mertiant-id">Mertiant ID:</label>
                        <input type="text" name="mid" style = "width: 100%;" class="form-control block" id="mertiant-id">
                    </div>
                    <div class="form-group">
                        <label class="centeral" for="public-key">Public key:</label>
                        <input type="text" name="pubk" style = "width: 100%;" class="form-control block" id="public-key">
                    </div>
                    <div class="form-group">
                        <label class="centeral" for="private-key">Private key:</label>
                        <input type="text" name="prik" style = "width: 100%;" class="form-control block" id="private-key">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="btn-signup" class="btn btn-default wow tada">Register</button>
                    </div>
                </form>
            </div>
            </td>
        </table>
    </section>
    </div>



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
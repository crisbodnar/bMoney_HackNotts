<?php
session_start();
if(isset($_SESSION['user'])!="")
{
 header("Location: main.php");
}
include_once 'dbconnect.php';

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="uname" placeholder="User Name" required /></td>
</tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signin">Sign In</button></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
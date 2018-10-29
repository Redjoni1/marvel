<?php 
session_start();
if(isset($_SESSION['login_user'])){
  header("location:welcome.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="icon" href="marvel.png">
</head>
<body>
<div class="login-page">
  <div class="form">
    <h4 align="center" style="color:green;"><?php echo @$_GET["success"]; ?></h4>
    <h4 align="center" style="color:red;"><?php echo @$_GET["logout"]; ?></h4>
    <h4 align="center" style="color:red;"><?php echo @$_GET["notlogin"]; ?></h4>
    <h4 align="center" style="color:red;"><?php echo @$_GET["invalid"]; ?></h4>
    <form action="login.php" method="post" class="login-form">
      <input type="text" name="emer" placeholder="username"/>
      <input type="email" name="email" placeholder="email">
      <button name="login">login</button>
      <p class="message">Not registered? <a href="regjistrim.php">Create an account</a></p>
    </form>
  </div>
</div>
</body>
</html>


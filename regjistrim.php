<html>
<head>
    <title>Registration</title>
    <style>
        .error{
            color:red;
        }
        
    </style>
<link rel="stylesheet" type="text/css" href="style.css"> 
<link rel="icon" href="marvel.png">
</head>
    <body>
        
<?php
  
    function test_input($data){
       $data= trim($data);
       $data= stripslashes($data);
       $data= htmlspecialchars($data);
       return $data;
    } 

    $servername="localhost";
    $username="root";
    $password="";
    $database = "motors";

    $conn = new mysqli($servername, $username, $password, $database);
    
    $emer=$mbiemer=$mosha=$email="";
    $emerErr=$mbiemerErr=$moshaErr=$emailErr="";
    $message = "";
    $allow = true;


    if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(empty($_POST["emer"])){
       $emerErr = "Emri duhet te plotesohet.";
       $allow = false;
      } else{
       $emer=test_input($_POST["emer"]);
      }
      
      if(empty($_POST["mbiemer"])){
          $mbiemerErr = "Mbiemri duhet te plotesohet.";
          $allow = false;
      } else{
          $mbiemer=test_input($_POST["mbiemer"]);
      }

      if(empty($_POST["mosha"])){
          $moshaErr = "Mosha duhet te plotesohet.";
          $allow = false;
      } else{
          $mosha=test_input($_POST["mosha"]);
      }
      
      if(empty($_POST["email"])){
          $emailErr = "Emaili duhet te plotesohet.";
          $allow = false;
      } else{
          $email=test_input($_POST["email"]);
      }
    
    if($allow == true){        
      $sql="SELECT Id FROM Users WHERE email='$email'";
      $result = $conn->query($sql);

      if($result->num_rows > 0){
          $message = "Exists";
      }
      else{
          $sql="INSERT INTO users (emer, mbiemer, mosha, email) VALUES ('$emer', '$mbiemer', '$mosha', '$email')";
          if($conn->query($sql)==TRUE){
              header("location:index.php?success=You registered successfully");
          }else{
              echo mysqli_error($conn);
              $message = "Problem occurred";
          }
      }
    }
  }
?> 

<div class="login-page">
  <div class="form">
    <h5 align="center" style="color:red;"><?php echo $message ; ?></h5>
    <form method="post" action="regjistrim.php" class="register-form">
      <input type="text" name="emer" placeholder="name"/><span class="error">* <?php echo $emerErr;?> </span>
      <input type="text" name="mbiemer" placeholder="surname"/><span class="error">* <?php echo $mbiemerErr;?> </span>
      <input type="number" name="mosha" placeholder="age"/><span class="error">* <?php echo $moshaErr;?> </span>
      <input type="email" name="email" placeholder="email address"/><span class="error">* <?php echo $emailErr;?> </span>
      <button name="submit">create</button>
      <p class="message">Already registered? <a href="index.php">Sign In</a></p>
    </form>
  </div>
</div>
</body>
</html>
<?php
session_start();
session_destroy();
header("location:index.php?logout=You are succesfully logged out!");
?>

<?php
include './db.php';

session_start();
if(isset($_POST["login"])){
	$emer = $_POST["emer"];
	$email = $_POST["email"]; 
    
    $query = "SELECT * FROM Users WHERE emer = '$emer' AND email = '$email'";
    $exe_query = mysqli_query($conn, $query);
    $found_num_rows = mysqli_num_rows($exe_query);
    
    if($found_num_rows==1){
       $row = mysqli_fetch_array($exe_query);
       $_SESSION['user_id'] = $row['Id'];
	     $_SESSION["login_user"] = $emer;
       $_SESSION["admin"] = $row['roli'];
       if($_SESSION["admin"]==1) header("location:admin.php");
	   else header("location:welcome.php");
    }
    else{
       header("location:index.php?invalid=Your username or email are incorrect! Please Try Again");
    }
}


?>

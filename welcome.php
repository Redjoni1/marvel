<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>	
	<link rel="stylesheet" href="stili.css" type="text/css">
	<link rel="icon" href="marvel.png">
</head>
<body>
	<div id="content">

<?php
include './db.php';

session_start();
$msg = "";

if(!$_SESSION["login_user"]){
	header("location:index.php?notlogin=You are not logged in");
}
else {
	echo "<div class='navbar'>";
	echo "<h3>Welcome " .$_SESSION["login_user"]. "!&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<a href='login.php'><button class='btn-logout'>Logout</button></a></h3>";
    echo "</div>";
   }

   if(isset($_POST['upload'])){
	   	$target = "C:\wamp64\www\phptestredjon\images\\" .basename($_FILES['image']['name']);
	   	$image = $_FILES['image']['name'];
	   	$tema = $_POST['tema'];
	   	$koment = $_POST['koment'];


	   	$query = " INSERT INTO postim (Id_u, image, tema, komenti) VALUES (".$_SESSION['user_id'].", '$image', '$tema', '$koment')";
	   	
 		if(!mysqli_query($conn,$query)) { 
   				$msg = "Something went wrong! :("; 
            }
            else{
		      if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
   		        $msg = "Image uploaded succesfully";
		   	}  else
       			{
          		$msg = "Image not uploaded";
        		}
		}    
	}
mysqli_close($conn);

?>

	<div class="div-upload">
	<form class="upload" method="post" action="welcome.php" enctype="multipart/form-data">
			<input type="hidden" name="size" value="1000000">
			<div>
				<input class="upl1" type="file" name="image" required="required">
			</div>
			<div class="upl2">
				<input type="text" name="tema" placeholder="Tema" required="required">
			</div>
			<div class="upl3">
				<textarea name="koment" cols="40" rows="4" placeholder="Komento rreth kesaj..." required="required"></textarea>
			</div>
			<div class="upl4">
				<input class="btn-upload" type="submit" name="upload" value="Upload">
			</div>
			<?php echo $msg ;?>
        </form>
    </div>

    <?php

	include './db.php';

  	if(isset($_POST['submitdelete'])){
		 	$idPost = $_POST['del'];
			$query = "DELETE FROM postim WHERE Id=$idPost";
			mysqli_query($conn, $query);
	}

	$sql = "SELECT *, postim.Id AS idP FROM postim WHERE Id_u = " .$_SESSION['user_id'];
	$result = mysqli_query($conn, $sql);


	while($row = mysqli_fetch_array($result))
	{
		$query = "SELECT COUNT(*) FROM likes WHERE Id_p =".$row['idP']."";
		$result1 = mysqli_query($conn, $query);
		$row1 = mysqli_fetch_array($result1);
		echo "<div id='img_div' class='card'>";
	 	echo "<img class='img' src='images\\".$row['image']."'>";
	 	echo "<div class='container'>";
	 	echo "<h3>".$row['tema']."</h3>";
	 	echo "<p>".$row['komenti']."</p>";
	 	$id = $row['Id'];
	 	echo '<form method="post" action="welcome.php">';
	 	echo '<input type="hidden" id="del" name="del" value="'.$id.'">';
	 	echo '<input class="btn" type="submit" name="submitdelete" value="Delete">';
	 	echo '<span>&nbsp;&nbsp;'.$row1[0].' likes</span>';
	 	echo '</form>';
	 	echo "</div>";
	 	echo "</div>";
	}

?>

  </div>
</body>
</html>
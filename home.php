<!DOCTYPE html>
<html>
<head>
	<title>Homepage</title>
	<link rel="stylesheet" href="stili.css" type="text/css">
<link rel="icon" href="marvel.png">
</head>
<body>
<div class="home-content">
 <div class="header" style="max-width:100%">
    <img class="mySlides" src="marvel1.png" style="width:100%">
    <img class="mySlides" src="marvel2.png" style="width:100%">
    <img class="mySlides" src="marvel3.png" style="width:100%">
    <img class="mySlides" src="marvel4.png" style="width:100%">
 </div>

<script>
	var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); 
}
</script>

<div class="menu">
<ul>
  <li><a class="name" href="home.php">MARVEL</a></li>
  <li><a href="home.php">Home</a></li>
  <li><a href="admin.php">Admin</a></li>
  <li><a href="welcome.php">Profile</a></li>
  <li style="float:right;"><a href="login.php">Logout</a></li>
</ul>
</div>

<?php 
	include './db.php';
	session_start();

	if(!$_SESSION["login_user"]){
	header("location:index.php?notlogin=You are not logged in");
		}
	else{
	if(isset($_POST['submitlike'])){
		$idPost = $_POST['likep'];
		$query = "SELECT COUNT(*) FROM likes WHERE Id_p =".$idPost." AND Id_u = ".$_SESSION['user_id'];
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		if($row[0]==0){
			mysqli_query($conn, "INSERT INTO likes (Id_p, Id_u) VALUES (".$idPost.", ".$_SESSION['user_id'].")");
		}
		else{
			mysqli_query($conn, "DELETE FROM likes WHERE Id_p = ".$idPost." AND Id_u = ".$_SESSION['user_id']);
		}
	}

	$sql = "SELECT *, postim.Id AS idP FROM postim INNER JOIN users ON Id_u=users.Id";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_array($result))
	{
		$query = "SELECT COUNT(*) FROM likes WHERE Id_p =".$row['idP']." AND Id_u = ".$_SESSION['user_id'];
		$result1 = mysqli_query($conn, $query);
		$row1 = mysqli_fetch_array($result1);
		if($row1[0]==0){
			$text = "Like";
			$class = "btn-like";
		}
		else{
			$text = "Dislike";
			$class = "btn-logout";
		}
		$query = "SELECT COUNT(*) FROM likes WHERE Id_p =".$row['idP']."";
		$result1 = mysqli_query($conn, $query);
		$row1 = mysqli_fetch_array($result1);
		echo "<div id='img_div' class='card'>";
	 	echo "<img class='img' src='images\\".$row['image']."'>";
	 	echo "<div class='container'>";
	 	echo "<h3>".$row['tema']."</h3>";
	 	echo "<p>".$row['komenti']."</p>";
	 	echo "<p>Posted by ".$row['emer']."</p>";
	 	echo '<form method="post" action="home.php">';
	 	echo '<input type="hidden" id="likep" name="likep" value="'.$row['idP'].'">';
	 	echo '<input class="'.$class.'" type="submit" name="submitlike" value="'.$text.'">';
	 	echo '<span>&nbsp;&nbsp;'.$row1[0].' likes</span>';
	 	echo '</form>';
	 	echo "</div>";
	 	echo "</div>";
	}
}
?>
</div>
</body>
</html>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<link rel="stylesheet" href="stili.css" type="text/css">
	<link rel="icon" href="marvel.png">
</head>
<body>
	<div id="content">
<?php

include './db.php';

session_start();
	
	if($_SESSION["admin"]==0){
		header("location:welcome.php");
	}
	else {
		echo "<div class='navbar'>";
		echo "<h3>Welcome " .$_SESSION["login_user"]. "!&nbsp;&nbsp;&nbsp;&nbsp;";
    	echo "<a href='login.php'><button class='btn-logout'>Logout</button></a></h3>";
    	echo "</div>";
    	echo "<h1 class='post-title'> Users </h1>";
	   	 }

	if(isset($_POST['edit'])){
		$sql1 = "UPDATE users SET emer='".$_POST['emer']."', mbiemer='".$_POST['mbiemer']."', email='".$_POST['email']."', mosha=".$_POST['mosha']." WHERE Id=".$_POST['del'];
		mysqli_query($conn, $sql1);
	}

	if(isset($_POST['delete'])){
		$idUser = $_POST['del'];
		mysqli_query($conn, "DELETE FROM users WHERE Id=$idUser");
	}

	$query = "SELECT * FROM users";
	$rez = mysqli_query($conn, $query);

	echo "<div class='tabele'>";
	echo '<table align="center" class="users">
		  <tr>
		  <th style="border:none"></th>
		  <th>Emer</th>
		  <th>Mbiemer</th>
		  <th>Email</th>
		  <th>Mosha</th>
		  </tr>';

	while($row = mysqli_fetch_array($rez))
	{
		$id = $row['Id'];
		echo "<tr>";
		echo '<form method="post" action="admin.php">';
		echo '<td style="border:none">
				<input type="hidden" id="del" name="del" value="'.$id.'">
				<input class="btn-tbl" type="submit" id="edit" name="edit" value="Edit">
				<input class="btn-table" type="submit" name="delete" value="Delete">	
			  </td>';		
		echo '<td> <input type="text" name="emer" value="'.$row['emer'].'" </td>';
		echo '<td> <input type="text" name="mbiemer" value="'.$row['mbiemer'].'" </td>';
		echo '<td> <input type="text" name="email" value="'.$row['email'].'" </td>';
		echo '<td> <input type="text" name="mosha" value="'.$row['mosha'].'" </td>';
		echo "</form>";
		echo "</tr>";
	}
		echo '</table>';
		echo '</div>';

mysqli_close($conn);

?>


	     <h1 class="post-title"> Posted by users </h1>
<?php

	include './db.php';

  	if(isset($_POST['submitdelete'])){
		 	$idPost = $_POST['del'];
			$query = "DELETE FROM postim WHERE Id=$idPost";
			mysqli_query($conn, $query);
	}

	$sql = "SELECT *, postim.Id AS idP FROM postim INNER JOIN users ON Id_u=users.Id";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_array($result))
	{
		echo "<div id='img_div' class='card'>";
	 	echo "<img class='img' src='images\\".$row['image']."'>";
	 	echo "<div class='container'>";
	 	echo "<h3>".$row['tema']."</h3>";
	 	echo "<p>".$row['komenti']."</p>";
	 	echo "<p>Posted by ".$row['emer']."</p>";
	 	$id = $row['idP'];
	 	echo '<form method="post" action="admin.php">';
	 	echo '<input type="hidden" id="del" name="del" value="'.$id.'">';
	 	echo '<input class="btn" type="submit" name="submitdelete" value="Delete">';
	 	echo '</form>';
	 	echo "</div>";
	 	echo "</div>";
	}
?>

  </div>

</body>
</html>
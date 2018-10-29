<?php
include './db.php';

if (!isset($_POST['Submit'])) {
	die;
}
var_dump($_FILES['image']['name']);
// $target = "C:\wamp64\www\phptestredjon\images" . $_FILES['image']['name'];
// $image = $_FILES['image']['name'];
// $tema = $_POST['tema'];
// $koment = $_POST['koment'];

$sql = "INSERT INTO postim (tema, koment, image_location)
VALUES ('$tema', '$koment', '$image')";
 
mysqli_query($conn, $sql);


if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
echo "<script>alert('Successfully Added!!!'); window.location='welcome.php'</script>";
}else{
	echo "Image not uploaded!";
}
?>
<?php
	$prodId = $_GET['id'];
	
	$serverName = "localhost";
	$userName = "root";
	$passWord = "";
	$dbName = "restorant";

	$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

	$sql = "DELETE FROM `product` WHERE id=".$prodId;
	$conn->query($sql);
	
	echo "<script>location.href='../seller.php'</script>";
?>
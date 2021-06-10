<?php
		$orderId = $_GET['id'];
	
		$serverName = "localhost";
        $userName = "root";
        $passWord = "";
        $dbName = "restorant";
    
        $conn = mysqli_connect($serverName, $userName, $passWord, $dbName);
		
		if(isset($_GET['cart'])){
			$sql = "DELETE FROM `orders` WHERE id=".$orderId;
    
			$conn->query($sql);
		}
		else{
			$sql = "UPDATE `orders` SET `status`='Cancel' WHERE id=".$orderId;
    
			$conn->query($sql); 
		}
		
		echo "<script>window.location.href='../index.php';</script>";
?>
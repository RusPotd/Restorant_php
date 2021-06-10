<?php
	$index = $_GET['val'];
	$orderId = $_GET['id'];
	$status = "";
	
	if($index == 0){
		$status = "Accepted";
	}
	else{
		$status = "Cancel";
	}
		$serverName = "localhost";
        $userName = "root";
        $passWord = "";
        $dbName = "restorant";

        $conn = mysqli_connect($serverName, $userName, $passWord, $dbName);
    
        $sql = "UPDATE `orders` SET `status`='".$status."' WHERE id=".$orderId;
    
        $conn->query($sql); 
		
		echo "<script>window.location.href='../seller.php';</script>";
?>
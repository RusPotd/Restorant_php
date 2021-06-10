<?php
	session_start();

	$serverName = "localhost";
	$userName = "root";
	$passWord = "";
	$dbName = "restorant";

	$cId = $_GET["cId"];
	
	
	if(isset($_GET["add"])){

		$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);
		
		$sql= "UPDATE `orders` SET `status`='ordered',
				`action`='buy' WHERE cust_id=".$cId." AND action='cart'";
				
		$conn->query($sql);
	}
	else{
		$pId = $_GET["pId"];
		$quantity = $_GET["q"];
		$action = $_GET["a"];
		$price = $_GET["price"] * $quantity;
		$seller_id = 0;

		$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);
		
		$sql = "SELECT  `seller_id` FROM `product` WHERE id=".$pId;

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {        //seller
		// output data of each row
			while($row = $result->fetch_assoc()) {
				$seller_id = $row["seller_id"];
			}
		}
		
		$sql= "INSERT INTO `orders`(`cust_id`, `seller_id`, `product_id`, `action`, `quantity`, `amount`) VALUES (".$cId.", ".$seller_id.", ".$pId.", '".$action."', ".$quantity.", ".$price.")";

		$conn->query($sql);
		
	}

    echo "<script>location.href='../index.php'</script>";
?>
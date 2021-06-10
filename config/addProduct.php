
<?php
session_start();

		$image1 = $_FILES['image1']['name'];
		

        // image file directory
        $target = "../products/".basename($image1);
	

        if (move_uploaded_file($_FILES['image1']['tmp_name'], $target)) {
            //image uploaded success
            //echo "<script>alert('Image uploaded successfully');</script>";
        }else{
            //image upload failed
            //echo "<script>alert('Failed to upload');</script>"; 
        }
		
		$pname =  $_POST['pname'];
		$newPrice =  $_POST['newprice'];
	
		$description =  $_POST['description'];
		$brand =  $_POST['brand'];
		$pref = $_POST['pref'];
		$pref = strtolower($pref);
		
		$serverName = "localhost";
        $userName = "root";
        $passWord = "";
        $dbName = "restorant";
    
        $conn = mysqli_connect($serverName, $userName, $passWord, $dbName);
    
        $sql = "INSERT INTO `product`(`seller_id`, `pname`, `brand`, `pref`, `new price`, `descri`, `img1`) VALUES (".$_SESSION['id'].",'".$pname."','".$brand."', '".$pref."', ".$newPrice.",'".$description."','".$image1."')";
    
        $conn->query($sql); 
		
		echo "<script>window.location.href='../seller.php'</script>";

?>
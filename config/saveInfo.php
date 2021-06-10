<?php
session_start();
		$pname =  $_POST['pname'];
		$lname =  $_POST['lname'];
		$phone =  $_POST['phone'];
		$password =  $_POST['pass'];
		
		$serverName = "localhost";
        $userName = "root";
        $passWord = "";
        $dbName = "restorant";
    
        $conn = mysqli_connect($serverName, $userName, $passWord, $dbName);
    
        $sql = "UPDATE `seller` SET fname = '".$pname."',
		lname='".$lname."',	
		phone_no=".$phone.",
		pass='".$password."'
		WHERE Id=".$_SESSION['id'];
    
        $conn->query($sql); 
		
		$_SESSION['uname'] = $pname;

		echo "<script>window.location.href='../seller.php'</script>";

?>
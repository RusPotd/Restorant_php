<?php
session_start();

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "restorant";

$phone="";
$pass="";
$fname="";
$id = "";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);


$isLogin = $_GET['l'];

if($isLogin==1){
    $enteredPhone = $_POST['phone'];
	$enteredPass = $_POST['pass'];
	     
    $sql = "SELECT  `Id`, `fname`, `phone_no`, `pass` FROM `seller` WHERE phone_no=".$enteredPhone;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {        //seller
    // output data of each row
        while($row = $result->fetch_assoc()) {
			$fname = $row["fname"];
			$phone = $row["phone_no"];
			$pass = $row["pass"];   
			$id = $row["Id"];
        }
		
		if($enteredPhone==$phone && $enteredPass==$pass){
			$_SESSION['uname']= $fname;
			$_SESSION['isseller']= 1;
			$_SESSION['id']= $id;
	 
			echo "<script>location.href='seller.php'</script>";
		}
		else{
			echo "Not matched";
			echo "<script>alert('Incorrect password!! Try again');
				  window.location.href='index.php';</script>
			";  
		}
    }
	else{                //customer
		$sql = "SELECT  `Id`, `fname`, `phone_no`, `pass` FROM `customer` WHERE phone_no=".$enteredPhone;

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		// output data of each row
			while($row = $result->fetch_assoc()) {
			$fname = $row["fname"];
			$phone = $row["phone_no"];
			$pass = $row["pass"];   //$row["id"]
			$id = $row["Id"];
			}
		}
		else{
			//no such user
			echo "<script>alert('No Login Details found! Go Back and Register');
              window.location.href='index.php';</script>
			";
		}
		
		if($enteredPhone==$phone && $enteredPass==$pass){
			$_SESSION['uname']= $fname;
			$_SESSION['id']= $fname;
			$_SESSION['isseller']= 0;
			$_SESSION['id']= $id;
	 
			echo "<script>location.href='index.php'</script>";
		}
		else{
			echo "Not matched";
			echo "<script>alert('Incorrect password!!');
				  window.location.href='index.php';</script>
			";  
		}
	}

    
}
else if($isLogin==2){
	$fname = $_POST['fname'];
    $lname = $_POST['lname'];
	$phone = $_POST['phone'];
	$addr = $_POST['address'];
	$pass = $_POST['pass'];
	$pref = $_POST['pref'];
	$pref = strtolower($pref);

    $_SESSION['uname'] = $fname;
	$_SESSION['isseller']= 0;

    $sql= "INSERT INTO `customer`(`fname`, `lname`, `pref`, `address`, `phone_no`, `pass`) VALUES ('".$fname."','".$lname."','".$pref."', '".$addr."',".$phone.",'".$pass."')";

    $conn->query($sql);
	
	$sql = "SELECT `Id` FROM `customer` WHERE phone_no=".$phone;

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	
		while($row = $result->fetch_assoc()) {
			$_SESSION['id']= $row['Id'];
		}
	}

    echo "<script>location.href='index.php'</script>";
}
else{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
	
	$phone = $_POST['phone'];

	$pass = $_POST['pass'];

    $_SESSION['uname'] = $fname;
	$_SESSION['isseller']= 1;

    $sql= "INSERT INTO `seller`(`fname`, `lname`, `phone_no`, `pass`) VALUES ('".$fname."','".$lname."',".$phone.",'".$pass."')";

    $conn->query($sql);
	
	$sql = "SELECT `Id` FROM `seller` WHERE phone_no=".$phone;

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	
		while($row = $result->fetch_assoc()) {
			$_SESSION['id']= $row['Id'];
		}
	}

    echo "<script>location.href='seller.php'</script>";
}


?>
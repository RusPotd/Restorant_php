<!DOCTYPE html>
<?php 	session_start(); 

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "restorant";
$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

if(isset($_SESSION['isseller']) && $_SESSION['isseller']!=1){
	echo "<script>window.location.href='index.php';</script>";
}

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>shopping portal</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Team-Clean.css">
</head>

<body style="font-family: cursive;">
	<script>
		function deleteProd(prodId){
			//window.location.href="index.php";

				var myUrl ="config/deleteProd.php?id="+prodId;
				
				var xhr = new XMLHttpRequest();								//send request only to addtoevent.php, do not redirect i.e. database work needed to be done at background
				xhr.open("GET", myUrl, true);
				xhr.setRequestHeader('Content-Type', 'application/json');
				xhr.send(JSON.stringify({
				}));
				
				$('#all_product').load(document.URL +  ' #all_product');
				$('#all_product2').load(document.URL +  ' #all_product2');
				
		}
		
		function deleteProdDirect(prodId){
				var myUrl ="config/deleteProd.php?id="+prodId;
				window.location.href = myUrl;
		}
	</script>
	
	<button class="btn btn-success disabled" style="position: fixed; z-index:1; right:5%; top: 2%;"><i class="fa fa-user-o mx-2"></i>
		<?php echo $_SESSION['uname']; ?></button>
    <div class="row m-0">
        <div class="col-2 col-lg-1 p-2" id="seller_menu">
            <div class="text-center"><i class="fa fa-home seller_menu" id="home"></i></div>
            <div class="text-center"><i class="fa fa-dashboard seller_menu" id="dashboard"></i></div>
            <div class="text-center"><i class="fa fa-plus-square seller_menu" id="add_product"></i></div>
            <div class="text-center"><i class="fa fa-user seller_menu" id="account"></i></div>
            <div class="text-center"><i class="fa fa-power-off seller_menu" id="Logout" onclick=goback();></i></div>
        </div>
        <div class="col-10 col-lg-11 p-0" id="seller_right">
            <div id="home_page" class="s_page hide">
                <div class="row m-0 p-3">
					<?php
						$sql = "SELECT DISTINCT `brand` FROM `product` WHERE seller_id=".$_SESSION['id'];

						$result = $conn->query($sql);
						$allBrand = array();

						if ($result->num_rows > 0) {        //seller
							while($row = $result->fetch_assoc()) {
								array_push($allBrand, $row['brand']);
							}
						}
						else{
								echo "No products in shop!! Add some products..";
							}

						foreach ($allBrand as $Brand) {
							echo "
								<div class='col-12 col-sm-12 col-md-12 col-lg-12 my-3 p-3 shadow-lg' id='s_product_com_2' style='border-radius: 5px;'>
									<h4>".$Brand."</h4>
									<div style='white-space: nowrap;overflow-x: scroll;'>
								";
								$sql2 = "SELECT * FROM `product` WHERE seller_id=".$_SESSION['id']." AND brand='".$Brand."'";

								$result2 = $conn->query($sql2);

								if ($result2->num_rows > 0) {        //seller
									while($row = $result2->fetch_assoc()) {
										echo"
										<div class='col-6 col-sm-6 col-md-3 col-lg-2 col-xl-2 p-2 product' style='display: inline-block;'>
											<div class='row m-0 p-2 py-3'>
												<div class='col-12 col-sm-10 col-md-10 col-lg-8 offset-sm-1 offset-md-1 offset-lg-2 p-0'><img class='w-100 h-100 border' src='products/".$row['img1']."'></div>
												<div class='col-12 col-sm-12 col-md-12 col-lg-10 offset-lg-1 text-center p-1'>
													<h6>&nbsp;".$row['pname']."</h6>
												</div>
												<div class='col-12 col-sm-12 col-md-12 col-lg-10 offset-lg-1 text-center p-0'>
													<h6 class='text-success'>$ ".$row['new price']."</h6>
												</div>
												<div class='col-12 col-sm-12 col-md-12 col-lg-10 offset-lg-1 text-center p-0'>
													<button class='btn btn-danger w-50' type='button' onclick='deleteProdDirect(".$row['id'].")'>Delete</button>
												</div>
											</div>
										</div>
										";
									}
								}
								
							echo"
									</div>
								</div>
							";
						}
					?>
                  
                </div>
            </div>
            <div id="account_page" class="s_page hide">
                <form class="row m-0" action="config/saveInfo.php" method="post">
                    <div class="col-10 col-lg-12 p-3">
                        <h1 class="text-center">Seller Account Setting</h1>
                    </div>
                    <div class="col-12 col-lg-10 offset-lg-1 p-3 shadow-lg my-4" style="border-radius: 5px;">
                        <div class="row m-0">
                            <div class="col-12 col-lg-12 py-2">
                                <h3 class="text-left" style="font-family: serif;">Your Details</h3>
                            </div>
							<?php
								$sql = "SELECT * FROM `seller` WHERE Id=".$_SESSION['id'];

								$result = $conn->query($sql);

								if ($result->num_rows > 0) {        //seller
								// output data of each row
									while($row = $result->fetch_assoc()) {
										echo "
											<div class='col-12 col-sm-12 col-md-6 col-lg-4 py-3'>
												<p>First Name</p><input name='pname' value='".$row["fname"]."' type='text' class='w-100'></div>
											<div class='col-12 col-sm-12 col-md-6 col-lg-4 py-3'>
												<p>Last Name</p><input name='lname' value='".$row["lname"]."' type='text' class='w-100'></div>
											<div class='col-12 col-sm-12 col-md-6 col-lg-4 py-3'>
												<p>Mobile No.</p><input name='phone' value=".$row["phone_no"]." type='number' class='w-100'></div>
											<div class='col-12 col-sm-12 col-md-6 col-lg-4 py-3'>
												<p>Password</p><input name='pass' value='".$row["pass"]."' type='password'></div>
						
										";
									}
								}
							?>
                            <div class="col-12 col-lg-12 text-center py-2">
								<button class="btn btn-success w-75" type="submit" style="border-radius: 50px;">Save</button>
							</div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="add_product_page" class="s_page hide">
                <form class="row m-0" action="config/addProduct.php" method="post" enctype="multipart/form-data">
                    <div class="col-12 col-lg-12 p-3">
                        <h1 class="text-center">Add Item</h1>
                    </div>
                    <div class="col-12 col-lg-10 offset-lg-1 p-3 shadow-lg my-4" style="border-radius: 5px;">
                        <div class="row m-0">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 py-3">
                                <p>Item Name</p><input name="pname" type="text" class="w-100"></div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 py-3">
                                <p>Price</p><input name="newprice" type="number" class="w-100"></div>
							<div class="col-12 col-sm-12 col-md-6 col-lg-4 py-3">
                                <p>Type</p><input name="pref" type="text" placeholder="Veg / Non Veg" class="w-100"></div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-8 py-3">
                                <p>Description</p><input name="description" type="text" class="w-100"></div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 py-3">
                                <p>Category</p><input name="brand" type="text"></div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-12 py-3">
                                <p>Images</p><input name="image1" type="file" class="w-50 my-2 border-0">
                            </div>
                            <div class="col-12 col-lg-12 text-center py-2">
								<button class="btn btn-danger w-75" style="border-radius: 50px;" type="submit">Add Product&nbsp;</button>
							</div>
                        </div>
                    </div>
                </form>
                <div class="row m-0">
                    <div class="col-12 col-lg-12 p-3">
                        <h1 class="text-center">Recently added Items</h1>
                    </div>
                    <div class="col-12 col-lg-12 offset-lg-0 p-2 shadow-lg mb-4" style="border-radius: 5px;">
                        <div class="table-responsive">
                            <table class="table" id="all_product2">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>Item Id</th>
                                        <th>Item Name</th>
										<th>Category</th>
										<th>Type</th>
                                        <th>Price</th>
                                        <th class="text-center">DELETE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
											$sql = "SELECT * FROM `product` WHERE seller_id=".$_SESSION['id']." ORDER BY id DESC LIMIT 5";

											$result = $conn->query($sql);

											if ($result->num_rows > 0) {        //seller
											// output data of each row
												while($row = $result->fetch_assoc()) {
													$pname = $row["pname"];
													$brand = $row["brand"];
													$pref = $row["pref"];
													$price = $row["new price"];   
													$prodId = $row["id"];
													
													echo "
													<tr>
														<td>".$prodId."</td>
														<td>".$pname."</td>
														<td>".$brand."</td>
														<td>".$pref."</td>
														<td>".$price."</td>
														<td class='text-center'><i class='fa fa-trash pt-1' style='font-size: 25px;' onclick='deleteProd(".$prodId.")'></i></td>
													</tr>
													";
												}
											}
											
									?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="dashboard_page" class="s_page hide">
                <div class="row m-0">
                    <div class="col-lg-12">
                        <h1 class="text-center">Your Orders</h1>
                    </div>
					<?php
					
					$sql = "SELECT * FROM `orders` WHERE seller_id=".$_SESSION['id']." AND action='buy'";
					$customerName = "";

					$result = $conn->query($sql);

					if ($result->num_rows > 0) {       
											// output data of each row
						while($row = $result->fetch_assoc()) {
							
							$sql3 = "SELECT `fname`, `lname`, `phone_no`, `address` FROM `customer` WHERE Id=".$row['cust_id'];

							$result3 = $conn->query($sql3);

							if ($result3->num_rows > 0) {        
													
								while($row3 = $result3->fetch_assoc()) {
										$customerName = $row3['fname']." ".$row3['lname'];
										$customerContact = $row3['phone_no'];
										$customerAddr = $row3['address'];
								}
							}
							
							$sql2 = "SELECT `pname`, `brand`, `img1` FROM `product` WHERE id=".$row['product_id'];

							$result2 = $conn->query($sql2);

							if ($result2->num_rows > 0) {        //seller
													// output data of each row
								while($row2 = $result2->fetch_assoc()) {
									
									echo "
										 <div class='col-12 col-lg-10 offset-lg-1 py-2 shadow-0' style='border-radius: 5px;'>
											<div class='row m-0 shadow my-3' style='border-radius: 5px;'>
												<div class='col-10 col-lg-3 offset-1 offset-lg-0 text-center align-self-center p-2' id='product_img'><img class='w-75' src='products/".$row2['img1']."'></div>
												<div class='col-12 col-lg-9 text-center'>
													<div class='row'>
														<div class='col-lg-12 pt-2'>
															<h5 class='text-left' style='float:left;' id='item_name'>Order Id: ".$row['id']."</h5>
															<h5 class='text-dark' id='item_amt-2'><i class='fa fa-rupee mr-2'></i>".$row['amount']."</h5>
															<h6 class='text-left text-secondary'>".$row2['pname']." | Category : ".$row2['brand']."</h6><br>
															<h6 class='text-left text-secondary' id='item_amt-2'> Ordered by : ".$customerName.", $customerContact</h6>
															<h6 class='text-left text-secondary'>Delivery Address : $customerAddr</h6>
														</div>";
														
														if($row['status']=="Accepted"){
															echo "<div class='col-6 col-lg-3 text-left py-3'><button id='accepted_btn' class='btn btn-outline-secondary w-100 active' type='button'>Accepted</button></div>";
															
															echo "<div class='col-6 col-lg-3 text-left py-3'><button id='cancel_btn' class='btn btn-outline-danger w-100 disabled' type='button'>Cancel</button></div>";
														}
														else if($row['status']=="Cancel"){
															echo "<div class='col-6 col-lg-3 text-left py-3'><button id='accepted_btn' class='btn btn-outline-secondary w-100 disabled' type='button'>Accepted</button></div>";
															
															echo "<div class='col-6 col-lg-3 text-left py-3'><button id='cancel_btn' class='btn btn-outline-danger w-100 active' type='button'>Cancel</button></div>";
														}
														else{
															echo "<div class='col-6 col-lg-3 text-left py-3'><button id='accepted_btn' onclick='statusChange(0, ".$row['id'].")' class='btn btn-outline-secondary w-100' type='button'>Accepted</button></div>";
															
															echo "<div class='col-6 col-lg-3 text-left py-3'><button id='cancel_btn' onclick='statusChange(3, ".$row['id'].")' class='btn btn-outline-danger w-100' type='button'>Cancel</button></div>";
														}
													
													echo "
													</div>
												</div>
											</div>
										</div>
									";
								}
							}			
						}
					}
					else{
						echo "<p style='margin-left: 5%;'>No Orders Yet!!</p>";
					}
					
						
					?>
                   
					
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/navigation.js"></script>
    <script src="assets/js/seller.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
	<script>
		function statusChange(value, orderId){
				var myUrl ="config/changeStatus.php?val="+value+"&id="+orderId;
				
				window.location.href=myUrl;
		}
		function goback(){
			window.location.href="index.php";
		}
	</script>
</body>

</html>
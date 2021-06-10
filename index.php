
<!DOCTYPE html>
<?php 	

session_start(); 
$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "restorant";
$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

error_reporting(0);
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
	<script>
		my_function = null;
		showProductJQ = null;
	</script>
</head>

<body>
    <div id="header">
        <div class="row m-0 py-2">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <h4>FoodShala</h4>
            </div>
        </div>
        <div class="row m-0" style="background-color: #314152;">
            <div class="col-3 col-sm-5 col-md-7 col-lg-10 col-xl-9 p-0">
				<nav class="navbar navbar-light navbar-expand-md navigation-clean-search p-1" id="nav">
					<div class="container"><button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler">
					<span class="sr-only">Toggle navigation</span>
					<span class="navbar-toggler-icon"></span></button>
						<div class="collapse navbar-collapse" id="navcol-1">
							<ul class="nav navbar-nav">
								<li role="presentation" class="nav-item" id="home"><a class="nav-link active" href="#" style="font-size: 15px!important;">Home</a></li>
								<?php 
									$sql = "SELECT DISTINCT `brand` FROM `product`";

									$result = $conn->query($sql);
									
									if ($result->num_rows > 0) {        //seller
										$ct = 1;
										while($row = $result->fetch_assoc()) {
											echo "<li role='presentation' class='nav-item'><a class='nav-link' href='#product_com_".$ct."'>".$row['brand']."</a></li>";
											$ct = $ct + 1;
										}
									}
								?>
								
							</ul>
						</div>
					</div>
				</nav>
			</div>
			
            <div class="col-6 col-sm-4 col-md-3 col-lg-1 col-xl-2 align-self-center p-0" style="color: #fff!important;">
                <div class="dropdown"><button class="btn btn-primary btn-lg dropdown-toggle border-0" data-toggle="dropdown" aria-expanded="false" type="button" style="background-color: #314152;">
                 
						<?php
							if(isset($_SESSION['uname'])){
								$uname = $_SESSION['uname'];
								echo "
								".$_SESSION['uname']."<i class='fa fa-user-o mx-2'></i></button>
								<div class='dropdown-menu' role='menu'>
								
								";
								if(isset($_SESSION['isseller']) && $_SESSION['isseller']==1){
									echo "<a class='dropdown-item' role='presentation' onclick='manage()'>Manage Account</a>";
								}
								echo "<a class='dropdown-item' role='presentation' id='dd_logout' onclick='logout()'>Log Out</a>
								</div>
								";
							}
							else {
								echo "
								<i class='fa fa-user-o mx-2'></i></button>
								<div class='dropdown-menu' role='menu'>
								
								<a class='dropdown-item' role='presentation' id='dd_login'>Log In</a>
								<a class='dropdown-item' role='presentation' id='dd_register'>Customers Register</a>
								<a class='dropdown-item' role='presentation' id='dd_seller'>Restaurants Register</a>
								
								</div>
							"; }
						?>
					
                </div>
            </div>
			<?php
			if(isset($_SESSION['isseller']) && $_SESSION['isseller']!=1){ ?>
            <div class="col-3 col-sm-3 col-md-2 col-lg-1 align-self-center p-0" style="color: #fff!important;">
                <h4 id="btn_cart"><i class="fa fa-opencart mx-2"></i>&nbsp;<i id="cartCount">0</i></h4>
            </div>
			<?php } ?>
        </div>
    </div>
    <div id="slider" class="simple-slider header">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background-image: url(assets/img/header.jpg);"></div>
                <div class="swiper-slide" style="background-image: url(assets/img/header.jpg);"></div>
                <div class="swiper-slide" style="background-image: url(assets/img/header.jpg);"></div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
	
    <div id="product_list">
        <div class="row m-0 p-3">
					<?php
						$sql = "SELECT DISTINCT `brand` FROM `product`";

						$result = $conn->query($sql);
						$allBrand = array();

						if ($result->num_rows > 0) {        //seller
							while($row = $result->fetch_assoc()) {
								array_push($allBrand, $row['brand']);
							}
						}
						$ct = 1;
						foreach ($allBrand as $Brand) {
							echo "
								<div class='col-12 col-sm-12 col-md-12 col-lg-12 my-3 p-3 shadow-lg' id='product_com_".$ct."' style='border-radius: 5px;'>
									<h4>".$Brand."</h4>
									<div style='white-space: nowrap;overflow-x: scroll;'>
								";
								$sql2 = "SELECT * FROM `product` WHERE brand='".$Brand."'";

								$result2 = $conn->query($sql2);

								if ($result2->num_rows > 0) {        //seller
									while($row = $result2->fetch_assoc()) {
										echo"
										<div class='col-6 col-sm-6 col-md-3 col-lg-2 col-xl-2 p-2' style='display: inline-block;'>
											<div class='row m-0 p-2 py-3'>
												<div class='col-12 col-sm-10 col-md-10 col-lg-8 offset-sm-1 offset-md-1 offset-lg-2 p-0'>
													<img class='w-100 h-100 border' src='products/".$row['img1']."'>
												</div>
												<div class='col-12 col-sm-12 col-md-12 col-lg-10 offset-lg-1 text-center p-1'>
													<h6>&nbsp;".$row['pname']."</h6>
												</div>
												<div class='col-12 col-sm-12 col-md-12 col-lg-10 offset-lg-1 text-center p-0 text-success'  style='text-align: center;'>
													&nbsp;<i class='fa fa-rupee '></i>".$row['new price']."
												</div>
												<div class='col-12 col-sm-12 col-md-12 col-lg-10 offset-lg-1 text-center p-0'> " ;
												if($_SESSION['isseller']!=1){
												?>
													&nbsp;<button class='btn btn-secondary w-50' type='button' style='margin-top:2px;' onclick="showProduct(<?php if(isset($_SESSION['id'])) { echo "".$row['id'].", '".$row['pname']."', ".$row['new price'].", '".$row['img1']."', '".$row['descri']."' "; } else { echo "0,0,0,0,0"; } ?>);">Order</button>
												<?php }
											echo "
												</div>
											</div>
										
										";
										?>
										</div>
										<?php
									}
								}
								echo"
									</div>
								</div>
								";
							$ct = $ct + 1;
						}
					?>
        </div>
        
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-dark p-2" id="back_top">
            <h5 class="text-light m-0" id="back_top">Back To Top</h5>
        </div>
    </div>
    <div id="footer" class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    
                    <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
                </div>
                <p class="copyright">FoodShala © 2021</p>
            </div>
        </footer>
    </div>
    <div id="show_item" class="hide header">
        <div class="row m-0">
            <div class="col-12 col-lg-12">
                <div class="row m-0">
                    <div class="col-10 col-lg-3 p-3">
                        <h4></h4>
                    </div>
                    <div class="col-2 col-lg-9 py-2"><i class="fa fa-window-close" id="close_prod"></i></div>
                </div>
            </div>
            <div class="col-12 col-lg-8 offset-lg-2 py-2 shadow-lg" style="border-radius: 5px;">
                <div class="row m-0">
                    <div class="col-10 col-lg-4 offset-1 offset-lg-0 align-self-start p-2" id="product_img"><img id="prod_image_bg" class="w-100" src="assets/img/unnamed.jpg">
           
                    </div>
                    <div class="col-12 col-lg-8 text-center">
                        <h2 class="text-left" id="item_name">Product Name</h2>
                        <h4 class="text-primary text-left" id="item_amt"><i class="fa fa-rupee mr-2"></i>100.00</h4>
                        <div class="row">
                            <div class="col-5 col-lg-4 text-left align-self-center py-3"><span>Quantity</span></div>
                            <div class="col-7 col-lg-6 text-left align-self-center py-2">
                                <h4  id="counter"><i class="fa fa-minus-square mx-3" id="decri_count" onclick="count(0);"></i><i id="counterShow">1</i><i class="fa fa-plus-square mx-3" id="incri_count" onclick="count(1);"></i></h4>
                            </div>
                            <div class="col-lg-12 text-left py-3" id="item_size">
                                <h5>Description&nbsp;</h5>
                                <p id="description">Paragraph</p>
                            </div>
                            <div class="col-lg-10 py-3" ><button  id="btn_toadd_cart" class="btn btn-primary w-100" type="button" onclick="addToCart(<?php if(isset($_SESSION['id'])){ echo $_SESSION['id']; }?>);">Add to cart</button></div>
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div id="cart" class="header hide">
        <div class="row m-0">
            <div class="col-12 col-lg-12 offset-lg-0">
                <div class="row m-0">
                    <div class="col-10 col-lg-11 p-3" id="cart_menu">
                        <h5 id="cart1" class="pull-left selected">Cart</h5>
                        <h5 id="cart_history" class="pull-left ml-4">Order History</h5>
                    </div>
                    <div class="col-2 col-lg-1 py-2"><i class="fa fa-window-close close" id="close_cart"></i></div>
                </div>
                <div class="row m-0 hide page" id="page_cart1">
                    <div class="col-12 col-lg-7 offset-lg-0 py-2 shadow-0" style="border-radius: 5px;">
					<?php
						if(isset($_SESSION['id'])){
						
						$sql = "SELECT `id`, `product_id`, `quantity` FROM `orders` WHERE cust_id=".$_SESSION["id"]." AND action='cart'";
						
						$result = $conn->query($sql);
						$totalCost = 0;
						
						echo "<script>document.getElementById('cartCount').innerHTML = ".($result->num_rows).";</script>";  //cart value
						
						if ($result->num_rows > 0) { 						//seller
							
							while($row = $result->fetch_assoc()) {
								$sql2 = "SELECT * FROM `product` WHERE id=".$row["product_id"];

								$result2 = $conn->query($sql2);

								if ($result2->num_rows > 0) {        //seller
									while($row2 = $result2->fetch_assoc()) {
										$totalCost += $row2['new price'] * $row['quantity'];
										echo "
											<div class='row m-0 shadow my-3'>
												<div class='col-10 col-lg-3 offset-1 offset-lg-0 text-center align-self-center p-2' id='product_img'>
												<img class='w-75' src='products/".$row2['img1']."'></div>
												<div class='col-12 col-lg-8 text-center'>
													<div class='row'>
														<div class='col-lg-12 pt-2'>
															<h5 class='text-left' id='item_name'>".$row2['pname']."</h5>

															<h5 class='text-left text-dark pull-right' id='item_amt-1'><i class='fa fa-rupee mr-2'></i>".($row2['new price'] * $row['quantity'])."</h5>
														</div>
														<div class='col-6 col-lg-6 text-left py-3 disabled'>
															<h5>Qty. ".$row['quantity']."</h5>
														</div>
														<div class='col-6 col-lg-6 text-left py-3'><button class='btn btn-danger' type='button' onclick='removeOrder(".$row['id'].");'>Remove<i class='fa fa-trash mx-2'></i>&nbsp;</button></div>
													</div>
												</div>
											</div>
										";
									}
								}
							}
						}
						else{
							echo "Nothing in cart! Add some products...";
						}
						}
					?>
                        
						
                    </div>
                    <div class="col-12 col-lg-5 offset-lg-0 py-2 shadow-0" style="border-radius: 5px;">
                        <div class="row m-0 shadow my-3 p-2">
                            <div class="col-10 col-lg-12 offset-1 offset-lg-0 align-self-start p-2" id="product_img">
                                <h4>Order Summary</h4>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="row m-0 border-bottom">
                                    <div class="col-6 col-lg-8 offset-0 offset-lg-0 align-self-start p-2" id="product_img-1">
                                        <p>Order Subtotal</p>
                                    </div>
                                    <div class="col-6 col-lg-4 offset-0 offset-lg-0 align-self-start p-2" id="product_img-2">
                                        <h5 class="m-0"><i class="fa fa-rupee mr-2"></i><?php if(isset($_SESSION['id'])){ echo $totalCost; }?></h5>
                                    </div>
                                </div>
                                <div class="row m-0 border-bottom">
                                    <div class="col-6 col-lg-8 offset-0 offset-lg-0 align-self-start p-2" id="product_img-1">
                                        <p>Shipping and Handling<br></p>
                                    </div>
                                    <div class="col-6 col-lg-4 offset-0 offset-lg-0 align-self-start p-2" id="product_img-2">
                                        <h5 class="m-0"><i class="fa fa-rupee mr-2"></i>0</h5>
                                    </div>
                                </div>
                                <div class="row m-0 border-bottom">
                                    <div class="col-6 col-lg-8 offset-0 offset-lg-0 align-self-start p-2" id="product_img-1">
                                        <p>Tax</p>
                                    </div>
                                    <div class="col-6 col-lg-4 offset-0 offset-lg-0 align-self-start p-2" id="product_img-2">
                                        <h5 class="m-0"><i class="fa fa-rupee mr-2"></i>0</h5>
                                    </div>
                                </div>
                                <div class="row m-0 border-bottom">
                                    <div class="col-6 col-lg-8 offset-0 offset-lg-0 align-self-start p-2" id="product_img-1">
                                        <p>Total</p>
                                    </div>
                                    <div class="col-6 col-lg-4 offset-0 offset-lg-0 align-self-start p-2" id="product_img-2">
                                        <h5 class="m-0"><i class="fa fa-rupee mr-2"></i><?php if(isset($_SESSION['id'])){ echo $totalCost; }?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12 text-center">
							<button class="btn btn-dark w-75 m-2" type="button" style="border-radius: 50px;" onclick="placeOrder(<?php if(isset($_SESSION['id'])){ echo $_SESSION['id']; }?>);">Order Now&nbsp;&nbsp;
								<i class="fa fa-mail-forward"></i>
							</button></div>
                        </div>
                    </div>
                </div>
                <div class="row m-0 page hide" id="page_cart_history">
                    <div class="col-12 col-lg-8 offset-lg-2 py-2 shadow-0" style="border-radius: 5px;">
						<?php
						if(isset($_SESSION['id'])){
							
							$sql = "SELECT * FROM `orders` WHERE cust_id=".$_SESSION["id"]." AND action='buy'";

							$result = $conn->query($sql);

							if ($result->num_rows > 0) {        //seller
								while($row = $result->fetch_assoc()) {
									$sql2 = "SELECT * FROM `product` WHERE id=".$row["product_id"];

									$result2 = $conn->query($sql2);

									if ($result2->num_rows > 0) {        //seller
										while($row2 = $result2->fetch_assoc()) {
											echo "
												<div class='row m-0 shadow my-3'>
													<div class='col-10 col-lg-3 offset-1 offset-lg-0 text-center align-self-center p-2' id='product_img'>
													<img class='w-75' src='products/".$row2['img1']."'></div>
													<div class='col-12 col-lg-8 text-center'>
														<div class='row'>
															<div class='col-lg-12 pt-2'>
																<h5 class='text-left' id='item_name'>".$row2['pname']."</h5>
																<h6 class='text-left text-secondary pull-left' id='item_amt'>Qty.".$row['quantity']."</h6>
								
																<h5 class='text-left text-dark pull-right' id='item_amt-1'><i class='fa fa-rupee mr-2'></i>".$row['amount']."</h5>
															</div>
															<div class='col-lg-12'>
																<h6 class='text-left text-success pull-left' id='item_amt'>Status : ".$row['status']."</h6>
															</div>
															<div class='col-6 col-lg-6 text-left py-3'>";
															
															if($row["status"]=="Cancel" || $row["status"]=="Delivered"){
																echo "<button class='btn btn-danger disabled' type='button'>Cancel Order&nbsp;</button>";
															}
															else{
																echo "<button class='btn btn-danger' type='button' onclick='cancelOrder(".$row["id"].");'>Cancel Order&nbsp;</button>";
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
								echo "Cart History Empty! Purchase some stuff...";
							}
						}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="login" class="login-dark header hide">
        <form action="control.php?l=1" method="post">
            <!--User Login Form-->
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" name="phone" placeholder="Registered Mobile no."></div>
            <div class="form-group"><input class="form-control" type="password" name="pass" placeholder="Password">
			<button class="btn btn-primary btn-block" type="submit">Log In</button></div>
				<a class="forgot mt-2" href="#" style="clear: both;">Forgot your email or password?</a>
		</form>
    </div>
    <div id="seller" class="login-dark header hide">
        <form action="control.php?l=0" method="post">
            <!--Restorants Login Form-->
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" name="fname" type="text" placeholder="First Name"></div>
            <div class="form-group"><input class="form-control" name="lname" type="text" placeholder="Last Name"></div>
            <div class="form-group"><input class="form-control" name="phone" type="text" placeholder="Mobile Number"></div>
            <div class="form-group"><input class="form-control" name="pass" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><input class="form-control" name="pass2" type="password" name="password" placeholder="Confirm Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Sign Up</button></div>
        </form>
    </div>
    <div id="register" class="login-dark header hide">
        <form action="control.php?l=2" method="post">
            <!--Customer Registration Form-->
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" name="fname" type="text" placeholder="First Name"></div>
            <div class="form-group"><input class="form-control" name="lname" placeholder="Last  Name"></div>
            <div class="form-group"><input class="form-control" name="phone" placeholder="Mobile Number"></div>
			<div class="form-group"><input class="form-control" name="pref" placeholder="Preference : Veg / Non veg"></div>
			<div class="form-group"><input class="form-control" name="address" placeholder="Address"></div>
            <div class="form-group"><input class="form-control" name="pass" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><input class="form-control" name="pass2" type="password" name="password" placeholder="Confirm Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Sign In</button></div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/navigation.js"></script>
    <script src="assets/js/seller.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
	
	<script>
		$(document).ready(function(){
		  $("#btn_toadd_cart").click(function(){
			$("#show_item").fadeOut();
			$("#cart").fadeIn();
			$("#cart1").trigger("click");
		  });
		  
		  $("#btn_toadd_cart-1").click(function(){
			 $("#cart").fadeOut(); 
			$("#show_item").fadeOut();			 
			$("#checkout").fadeIn();
		 });
		 
		 $(function() { 
				function my_fun(){ 
					   $("#register").fadeOut();
						$("#seller").fadeOut();    
						$("#slider").fadeOut();
						$("#product_list").fadeOut();
						$("#footer").fadeOut();
						$("#login").fadeIn();
				}  
				my_function = my_fun;
		 })
		 
		 $(function() { 
				function product(){ 
					$("#slider").fadeOut();
					$("#product_list").fadeOut();
					$("#footer").fadeOut();
					$("#show_item").fadeIn();
				}  
				showProductJQ = product;
		 })
		 
		});
	</script>
	
	<script>
		var count_var=1;
		var oldP=0;
		var newP=0;
		var productId=0;
		var directOrder = false;
	

		function placeOrder(custId){
				if(custId==null){
					return
				}

				myUrl ="config/addtocart.php?cId="+custId+"&add=true";
				
				window.location.href=myUrl;
		}
		
		function addToCart(custId){
				
				if(custId != null){
					myUrl ="config/addtocart.php?cId="+custId+"&pId="+productId+"&q="+count_var+"&a=cart&price="+newP;
					
					window.location.href=myUrl;
				}
		}
		
		function count(value){
			if(value==1){
				count_var+=1
			}
			else{
				if(count_var>1){
					count_var-=1
				}
			}
			document.getElementById("counterShow").innerHTML = count_var;
			document.getElementById('item_amt').innerHTML = newP * count_var;
		}
		function logout(){	
			window.location.href="logout.php";
		}
		
		function manage(){
			window.location.href="seller.php";
		}
		function showProduct(Id, pname, newPrice, image, descri){
			
			if(Id==0){
				alert("Login First");
				my_function();
				return
			}
			
			showProductJQ();
			count_var=1; newP = newPrice; productId=Id;
			document.getElementById("counterShow").innerHTML = count_var;
			document.getElementById('item_name').innerHTML = pname;
			document.getElementById('item_amt').innerHTML = newPrice;
			document.getElementById('description').innerHTML = descri;
			document.getElementById('prod_image_bg').src = "products/"+image;
			
			document.getElementById('prod_image_bg').src = "products/"+image;
		}
		
		function cancelOrder(orderId){
		
			window.location.href="config/cancelOrder.php?id="+orderId;
		}
		
		function removeOrder(orderId){
			window.location.href="config/cancelOrder.php?id="+orderId+"&cart=1";
		}
	</script>
</body>

</html>
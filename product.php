<?php
session_start();
if (isset($_GET['addtocart']) && !empty($_GET['addtocart'])) {
	$pdtname = $_GET['productname'];
	$username = $_SESSION['username'];

	if ($_GET['addtocart']==1) {
		$con=mysqli_connect("localhost","root","","shopping") or die(mysqli_error());
		$sql = "INSERT INTO cart (username, productname) VALUES ('$username', '$pdtname')";
		mysqli_query($con, $sql);
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Shopping | The Best Place to Invest</title>
</head>
<body>






<?php //session_start(); 

if (isset($_POST['logout']) && !empty($_SESSION['username'])) {
	
	session_destroy();
	header("Location: index.php");
}



?>
<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="bootstrap-override.css">
		<link rel="stylesheet" type="text/css" href="css/index1.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


	<nav class="navbar navbar-static-top navbar-inverse">
	  <div class="container-fluid">
	  
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-control="navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar" ></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar" style="background-color:"></span>
	      </button>
	      <h4><a class="navbar-brand" align="center" style="color:white; font-size: 150%;" href="index.php">Shopping</a></h4>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      	<!-- <ul class="nav navbar-nav navbar-center">
	      			<li><a class="btn btn-lg navactive" href="index.php"></a></li>
	      	</ul> -->
	      	<ul class="nav navbar-nav navbar-right">
		        
		        
				
						<?php
						if (isset($_SESSION['username'])!="") 
						{
						?>
							<li><a class="btn btn-lg" type="button" href="cart.php"><i class="fa fa-shopping-cart fa-1x"></i>&nbsp;Cart
		        			<span class="badge">
		        				<?php 
		        					$username = $_SESSION['username'];
									$con=mysqli_connect("localhost","root","","shopping") or die(mysqli_error());
		        					$query = "SELECT * FROM cart WHERE username='$username'";
									$result = mysqli_query($con, $query);
									$count = mysqli_num_rows($result);
									echo $count;
								?>
		        			</span></a></li>
							<li><a class="btn btn-lg navactive" style="color:white;">Hello <?php echo $_SESSION['username']; ?></a></li>
							<li><form action="index.php" method="POST">
							<input type="submit" name="logout" class="btn btn-lg navactive" value="logout">
							</form></li>

						<?php
						}
						else
						{
						?>	<li><a class="btn btn-lg navactive" href="signup.php">Signup</a></li>
							<li><a class="btn btn-lg navactive" href="login.php">Login</a></li>
						<?php } ?>
			</ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	







<br><br>
<?php  

	$pdtname = $_GET['productname'];
	$con=mysqli_connect("localhost","root","","shopping") or die(mysqli_error());
    $sql = "SELECT * FROM product WHERE productname='$pdtname'";
    $res = mysqli_query($con, $sql);      
    $data=mysqli_fetch_array($res);

    $availability = $data['availability'];
    $shrtdesc = $data['shortdescription'];
    $longdesc = $data['longdescription'];
    $productinfo = $data['productinfo'];
    $price = $data['price'];
    $imgloc = $data['imagelocation'];

?>

<div class="container-fluid gap">
	<div class="row">
		<div class="col-sm-6 well">
			<!-- for catelog image-->
			<div class="row">
				<div id="cf7" class="col-sm-offset-1 col-sm-10 shadow">
					<img id=0 class="opaque img-responsive img-thumbnail" src=<?php echo $imgloc; ?>>
 				</div>
			</div>
		</div>

		<div align="left" class="side col-sm-offset-1 col-sm-5 pull-left" style="color:white;">
			<br><br><br>
			<?php
				echo "<h2>".$pdtname."</h2><hr>
					<h4>".$shrtdesc."</h4><hr>
					<h5>".$availability."</h5>"; ?>
					<ul class="list-group">
					<hr>
					
					<?php
						$username = $_SESSION['username'];
						$con=mysqli_connect("localhost","root","","shopping") or die(mysqli_error());
						//data from cart
						$query = "SELECT * FROM cart WHERE username='$username'";
						$result = mysqli_query($con, $query);
						$count=0;
						while($row=mysqli_fetch_array($result))
						{
							if ($row['productname']==$pdtname) {
								$count=1;
							}
						}
						if ($count==0) {
							$val=true;
							echo "<a class=\"btn btn-lg btn-primary\" href=\"product.php?productname=".$pdtname."&addtocart=".$val."\" name=\"addtocart\">Add to Cart!!</a>";
							
						}else{
							echo "<button class=\"btn btn-lg btn-primary\" href=\"#\" data-toggle=\"modal\" data-target=\"#login\">Already in Cart!!</button>";
						}	

					?>


				
		</div>
	</div>
</div>
<br>
<ul class="nav nav-tabs" style="margin:10px;">
  <li class="active"><a data-toggle="tab" href="#desc">Description</a></li>
  <li><a data-toggle="tab" href="#pdtinfo">Product Info</a></li>
</ul>

<div class="tab-content" style="color: white;margin:10px;">
  <div id="desc" class="tab-pane fade in active">
    <br>
    <p><?php echo $longdesc; ?></p>
  </div>
  <div id="pdtinfo" class="tab-pane fade">
    <br>
    <p><?php echo $productinfo; ?></p>
  </div>
</div>




<br><br><br>

<?php require 'footer.php';?>
</body>
</html>
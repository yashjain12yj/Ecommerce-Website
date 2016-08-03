<?php
	ob_start();
	session_start();
	if( isset($_SESSION['user'])!="" ){
	 header("Location: index.php");
	}

	if (isset($_POST['submit'])) 
	{	

		$username=trim($_POST['username']);
		$email=trim($_POST['email']);
		$address=trim($_POST['address']);
		$city=trim($_POST['city']);
		$pincode=trim($_POST['pincode']);
		$mobile=trim($_POST['mobile']);
		$password=trim($_POST['password']);

		$con=mysqli_connect("localhost","root","","shopping") or die(mysqli_error());
		
		$query = "SELECT username FROM login WHERE username='$username'";
		$result = mysqli_query($con,$query);
		$count = mysqli_num_rows($result); // if email not found then proceed
		
		if ($count==0) 
		{	
			$query = "INSERT INTO login (username, email, address, city, pincode, mobileno, password) VALUES ('$username', '$email', '$address', '$city', '$pincode', '$mobile', '$password')";
            
			$res = mysqli_query($con,$query);
			
			if ($res)
			{	
			 	header("Location: login.php");
		        ob_end_flush();
		        exit;
			} 
			else 
			{
			   $errTyp = "danger";
			   $errMSG = "Something went wrong, try again later..."; 
			} 
		}else{echo "Username already present.";}
		ob_end_flush();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
                        ?>  <li><a class="btn btn-lg navactive" href="signup.php">Signup</a></li>
                            <li><a class="btn btn-lg navactive" href="login.php">Login</a></li>
                        <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    






<hr><hr>
<br>
<div  class="row" >
    <div class="col-sm-offset-3 col-sm-6">
        <div class="well" >
        <h1 align="center" class="text-primary">Welcome to Shopping</h1>
        <h4 align="center" class="text-primary">Register Here | Its Free</h4>
            <form id="loginForm" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
                <div class="form-group">
                    <label for="Email" class="control-label">Email-id</label>
                    <div class="input-group">
                        <span class="input-group-addon " id="sizing-email"><i class="fa fa-envelope text-primary "></i></span>
                        <input type="email" class="form-control" id="email" name="email" 
                        required title="Please enter you email" placeholder="example@gmail.com" 
                        aria-describedby="sizing-email" />                             	
                    </div>
                    <div id="email_status"></div>
  				</div>
  				<div class="form-group ">
                    <label for="username" class="control-label">Username</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon" id="sizing-username"><i class="fa fa-user text-primary"></i></span>
                        <input type="text" class="form-control" id="username" name="username"
                        required title="Please enter you name" aria-describedby="sizing-username">                             	
                    </div>
  				</div>
  				<div class="form-group ">
                    <label for="username" class="control-label">Address</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-street"><i class="fa fa-map-marker text-primary"></i></span>
                        <input type="text" class="form-control" id="street" name="address"
                        required="" title="Please enter you street no." placeholder="house no., colony name" 
                        aria-describedby="sizing-street">                             	
                    </div>
                </div>
                <div class="form-inline">
                <div class="form-group">        
                    <label for="city" class="control-label">City</label>
                    <div class="input-group">
                    	<span class="input-group-addon" id="sizing-street"><i class="fa fa-map-marker text-primary"></i></span>
                        <input type="text" class="form-control" id="city" name="city"
                        required="" title="Please enter your city" placeholder="Indore" 
                        aria-describedby="sizing-city">
                    </div>
                </div>    
                <div class="form-group">
                    <label for="pincode" class="control-label">Pincode</label>
                    <div class="input-group">
                    	<span class="input-group-addon" id="sizing-street"><i class="fa fa-map-marker text-primary"></i></span>  
                        <input type="number" class="form-control" id="pincode" name="pincode"
                        required="" title="Please enter city pincode" maxlength="6" size="6" min=100000 max=999999  placeholder="452005" aria-describedby="sizing-pincode">                             	
                    </div>
  				</div>
  				</div>
  				<div class="form-group ">
                    <label for="mobile" class="control-label">Mobile No.</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-mobile"><i class="text-primary">+91</i></span>
                        <input type="number" class="form-control" id="mobile" name="mobile"
                        required="" title="Please enter your Mobile no." placeholder="9876543210" 
                        aria-describedby="sizing-mobile" size="10" maxlength="10" >                             	
                    </div>
  				</div>
  				<div class="form-group ">
                    <label for="password" class="control-label">Password</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon" id="sizing-password"><i class="fa fa-key text-primary"></i></span>
                        <input type="password" class="form-control" id="password" name="password"
                        required="" title="Please enter your password here" placeholder="******" 
                        minlength="6" maxlength="30" aria-describedby="sizing-password">                             	
                    </div>
  				</div>
                <div class="form-group ">
                    <label for="confirmpassword" class="control-label">Confirm Password</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon" id="sizing-confirmpassword"><i class="fa fa-key text-primary"></i></span>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                        required="" title="Please enter your confirm password here" placeholder="******" 
                        minlength="6" maxlength="30" aria-describedby="sizing-confirmpassword">                             	
                    </div>
  				</div>
                <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
                <button type="reset" class="btn btn-default ">Reset</button>
                </form>
            </div>
        </div>
</body>
</html>

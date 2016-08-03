<!DOCTYPE html>
<html>
<head>
	<title>Shopping | The Best Place to Invest</title>
	<link rel="icon" type="image/iconx" href="images/logos.png">
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/index1.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
</head>

<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>


<body>
	


<?php session_start(); 

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

	<div id="myCarousel" class="carousel slide" data-ride="carousel" style="width:80%;margin: 0% 10%;">
      

      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="images/1.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Product_name.</h1>
              <p>Short Discription about the product.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="images/2.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
            	<h1>Product_name.</h1>
              	<p>Short Discription about the product.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="images/3.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Product_name.</h1>
              <p>Short Discription about the product.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="fourth-slide" src="images/4.jpg" alt="Fourth slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Product_name.</h1>
              <p>Short Discription about the product.</p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    </nav>


<br>
<div style="font-size: 100px; text-align: center; "><u>Products</u></div>

<br><br>

<!-- Three columns of text below the carousel -->
      <div class="row" style="margin:10px;">
      <?php 
            $con=mysqli_connect("localhost","root","","shopping") or die(mysqli_error());
            $sql = "SELECT productname, imagelocation, shortdescription FROM product";
            $res = mysqli_query($con, $sql);
            
            while ($data=mysqli_fetch_array($res)) {
                $pdtname = $data['productname'];
                $shrtdesc = $data['shortdescription'];
                $imgloc = $data['imagelocation'];
                echo "<div class=\"col-lg-4\" style=\"text-align: center;padding: 20px 0px;\">
                        <img class=\"img-circle\" src=".$imgloc." width=\"170\" height=\"170\">
                        <h2>".$pdtname."</h2>
                        <p>".$shrtdesc."</p>
                        <p><a class=\"btn btn-default\" href=\"product.php?productname=".$pdtname."\" role=\"button\">View details &raquo;</a></p>
                     </div>";
            }
      ?>
      </div><!-- /.row -->

<?php require 'footer.php';?>

</body>
</html>
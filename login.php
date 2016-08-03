<?php
    ob_start();
    session_start();
    $con=mysqli_connect("localhost","root","","shopping") or die(mysqli_error());
    // it will never let you open index(login) page if session is set
    if ( isset($_SESSION['username'])!="" ) 
    {
     header("Location: index.php");
     exit;
    }


    if( isset($_POST['login']) && !empty($_POST['username']) ) { 
  
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      $username = strip_tags(trim($username));
      $password = strip_tags(trim($password));
      
      
      $res=mysqli_query($con,"SELECT username, password FROM login WHERE username='$username'");
      
      $row=mysqli_fetch_array($res);
      
      $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
      
      if( $count == 1 && $row['password']==$password ) {
       $_SESSION['username'] = $row['username'];
       header("Location: index.php");
      } elseif($count == 0) {
       echo "Username is invalid.. try again...";
      }
      else{
        echo "Password is wrong..";
      }
     }
?>



<!DOCTYPE html>
<html>
<head>
	<title>Shopping | The Best Place to Shop</title>
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
  





</nav>
<br><br><br>
<?php
   if( isset($_SESSION['username'])!="") 
   {
    header("Location: index.php");
    echo "Already Logged In";
   }
   else
   {
   ?>
   
<form class="form-horizontal" action="login.php" method="POST">
    <div class="form-group has-success">
        <label class="col-xs-2 control-label" for="inputSuccess">Username</label>
        <div class="col-xs-10">
            <input style="width:300px;" type="text" id="inputSuccess" name="username" class="form-control" required;>
        </div>
    </div><br>
    <div class="form-group has-warning">
        <label class="col-xs-2 control-label" for="inputWarning">Password</label>
        <div class="col-xs-10">
            <input style="width:300px;" type="password" name="password" id="inputWarning" class="form-control" required>
        </div>
    </div>
    <br><br>
    <button class="btn btn-lg btn-primary btn-block" style="width:100px;margin:0px 200px;" name="login" type="submit">Log in</button>
    <p style="margin: 0px 80px;">Don't have account<a href="signup.php">Click here</a><p>
</form>

<?php } ?>

</body>
</html>
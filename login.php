<?php 
//to show error ouput
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("connect.php");
?>
<?php
session_start();
$alert="none";
if(isset($_POST["btn-login"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    
     

    $qry = mysqli_query($con," SELECT * FROM table_admin WHERE admin_name='".$username."' AND admin_password='".$password."'");

    //count record number
    $count = mysqli_num_rows($qry);
     if($count>0){

        $_SESSION['username'] = $username;

        header("location:index_login.php");
        exit;
     }else {
        $alert="block";
     }
  
}

?>
<!DOCTYPE html>
<html>
<head>
<?php include "head.php";?>
</head>
<body>
<div class="container">
  <div class="navbar-header col-lg-3 col-md-3 col-sm-3 col-xs-12"><br/>
  <a class="navbar-brand" href="#"><img src="image/krumony.png"></a>
  </div>
  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
  	<p class="navbar-text navbar-right">Login to Dashboard</p>
  </div>
</div>

<nav class="navbar navbar-default">
	
</nav>

<div class="container">
	<div id="loginbox" style="margin-top: 50px;" class="mainbox col-lg-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<div class="alert alert-danger" role="alert" style="display: <?php echo $alert;?>">
			<span class="glyphicon glyphicon-remove-circle" arie-hidden="true"></span>
			Username or Password is incorrect,pless try agin!
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">Admin Login</div>
				<div style="float:right; font-size: 80%;position: relative; top: -10px;"><a href="?forget_password=request">Forget Password?</a></div>
			</div>

			<div style="padding-top: 30px;" class="panel-body">
				<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
				<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input name="username" class="form-control" type="text" placeholder="username" required oninvalid="this.setCustomValidity('Pleass Input Username')" oninput="setCustomValidity('')"/>
				</div>

				<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input type="password" id="login-password" class="form-control" name="password" value="" placeholder="username" required oninvalid="this.setCustomValidity('Pleass Input Password')" oninput="setCustomValidity('')"/>
				</div>

				<div class="input-group">
					<div style="margin-top: 10px;" class="form-group">
						
							<input type="submit" name="btn-login" id="btn-login" class="btn btn-success" value="login"/>
						
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

</body>
</html>
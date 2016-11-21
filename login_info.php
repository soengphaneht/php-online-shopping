<?php 
//to show error ouput
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<?php 
session_start();
include("connect.php");
$admin_id="";
$admin_email="";
$admin_password="";
$msg_password="";
$msg_email="";
if(!isset($_SESSION["username"])){
	header("location:login.php");
}
else{
	$qry_admin=mysqli_query($con,"select * from table_admin where admin_name='".$_SESSION["username"]."'");
	while ($row=mysqli_fetch_array($qry_admin,MYSQL_ASSOC)) {
		$admin_id=$row["admin_id"];
		$admin_email=$row["admin_email"];
		$admin_password=$row["admin_password"];
	}
}
if(isset($_SESSION["btn-save-password"])){
	$new_password= $_POST["new_password"];
	$confirm_password= $_POST["comfirm_password"];
	if($new_password==$confirm_password){
	$qry_password=mysql_query($con,"update table_admin set admin_password='".$new_password."' where admin_id='".$admin_id."'");
	$msg_password="Your: password update is successfully:";
}
else{
	$msg_password="sorry:Your Password dosen't mach";
}

}
else if(isset($_SESSION["btn-save-email"])){
	$new_password= $_POST["new_email"];
	$confirm_email= $_POST["comfirm_email"];
	if($new_email==$confirm_email){
	$qry_email=mysql_query($con,"update table_admin set admin_email='".$new_email."' where admin_id='".$admin_id."'");
	$msg_email="Your: email update is successfully:";
}
else{
	$msg_email="sorry:Your Email dosen't mach";
}
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include "head.php";?>
</head>
<body>
<?php include ("header_login.php");?>

<div class="container">
	<div class="row">
		
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<?php include ("left_menu_login.php");?>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<h3 class="panel-title">Change Password</h3>
				</div>
				<div class="panel-body">
					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
					<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">New Password</span>
					<input id="login-password" type="password" class="form-control" name="new_password" value="" placeholder="New Password" required>
				</div>

				<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Confirm Password</span>
					<input name="confirm_password" class="form-control"  type="password" placeholder="Confirm Password" required />
				</div>

				<div style="margin-top: 10px;" class="form-group">
						<div class="col-sm-12">
							<input type="submit" name="btn-save-password" id="btn-login" class="btn btn-success" value="save"/>
						<?php 
						if($msg_password!=""){

							echo $msg_password;
							}?>
					</div>
				</div>
				</form>
			</div>
		</div>

		<div class="panel panel-default">
				<div class="panel panel-heading">
					<h3 class="panel-title">Change Email</h3>
				</div>
				<div class="panel-body">
					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
					<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">New Email</span>
					<input id="login-password" type="text" class="form-control" name="new_email" value="" placeholder="New Email" required>
				</div>

				<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Confirm Email</span>
					<input name="confirm_email" class="form-control"  type="text" placeholder="Confirm Email" required />
				</div>

				<div style="margin-top: 10px;" class="form-group">
						<div class="col-sm-12">
							<input type="submit" name="btn-save-email" id="btn-login" class="btn btn-success" value="save"/>
						<?php 
						if($msg_email!=""){

							echo $msg_email;
							}?>
					</div>
				</div>
				</form>
			</div>
		</div>
		</div>
</body>
</html>
<?php
//to show error ouput
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<?php
session_start();
if(!isset($_SESSION["username"])){
	header("location:login.php");
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
				Hello
		</div>
</body>
</html>

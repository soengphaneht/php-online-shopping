<?php
session_start();
//to show error ouput
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connect.php";

if(!isset($_SESSION["username"])){
	header("location:login.php");
}
	function GetImageExtension($imagetype){
		if(empty($imagetype))
			return 'none';
		switch ($imagetype) {
			case 'image/jpeg':
				return'.jpg';break;
			default:
				return 'none';
		}
	}
if (isset($_POST["btn-save-language"])) {
	$ql=mysqli_query($con,"update table_homepage set language='".$_POST["language"]."'") or die("Can not update");
}
else if (isset($_POST["btn-save-title"])) {
	$ql=mysqli_query($con,"update table_homepage set title_en='".$_POST["title_en"]."',title_kh='".$_POST["title_kh"]."'") or die("Can not update");
}
else if (isset($_POST["btn-save-home-menu"])) {
	$ql=mysqli_query($con,"update table_homepage set home_menu_en='".$_POST["home_menu_en"]."',home_menu_kh='".$_POST["home_menu_kh"]."'") or die("Can not update");
}
else if (isset($_POST["btn-save-welcome-title"])) {
	$ql=mysqli_query($con,"update table_homepage set welcome_title_en='".$_POST["welcome_title_en"]."',welcome_title_kh='".$_POST["welcome_title_kh"]."'") or die("Can not update");
}
else if (isset($_POST["btn-save-welcome-content"])) {
	$welcome_content_en = mysql_real_escape_string($_POST["welcome_content_en"]);
	$welcome_content_kh = mysql_real_escape_string($_POST["welcome_content_kh"]);
	$sql = "update table_homepage set welcome_content_en='".$welcome_content_en."',welcome_content_kh='".$welcome_content_kh."'";


	$ql=mysqli_query($con,$sql) or die("Can not update");


}
else if (isset($_POST["btn-save-welcome-footer"])) {
	$ql=mysqli_query($con,"update table_homepage set footer_en='".$_POST["footer_en"]."',footer_kh='".$_POST["footer_kh"]."'") or die("Can not update");
}


else if (isset($_POST["btn-save-logo"])) {
	//var_dump($_FILES);
	if(!empty($_FILES["logo"]["name"])){
		$file_name=$_FILES["logo"]["name"];//test
		$temp_name=$_FILES["logo"]["tmp_name"];//test
		$imgtype=$_FILES["logo"]["type"];//image/jpeg
		$ext=GetImageExtension($imgtype);
		if($ext =='none'){
			$msg="<span class 'text-danger'>* This file is not JPEG or PNG.</span>";
		}
		else{
			$imagename = "logo_phaneth".$ext;
			$target='image/'.$imagename;
			move_uploaded_file($temp_name,$target);
		}
	}
}

else if (isset($_POST["btn-save-banner"])) {
	if(!empty($_FILES["banner"]["name"])){
		$file_name=$_FILES["banner"]["name"];//test
		$temp_name=$_FILES["banner"]["tmp_name"];//test
		$imgtype=$_FILES["banner"]["type"];//image/jpeg
		$ext=GetImageExtension($imgtype);
		if($ext =='none'){
			$msg="<span class 'text-danger'>* This file is not JPEG or PNG.</span>";
		}
		else{
			$imagename = "banner_logo".$ext;
			$target='image/'.$imagename;
			move_uploaded_file($temp_name,$target);
		}
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
					<div class="panel-heading">Change Language</div>
				<div class="panel-body">
					<div class="form-group">
					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
						<label for="sal1">Choose Language:</label>
						<select class="form-control" id="sel1" name="language">
						<?php
						$qs=mysqli_query($con,"select language from table_homepage");
						$row=mysqli_fetch_array($qs,MYSQLI_NUM);
						if ($row[0]=='en') {
							echo '<option value="en" selected>English</option>';
							echo '<option value="kh">Khmer</option>';
						}
						else if($row[0]=='kh'){
							echo '<option value="en">English</option>';
							echo '<option value="kh" selected>Khmer</option>';
						}

							?>
						</select>
						<div style="margin-top: 10px;" class="form-group">
								<div class="col-sm-12">
									<input type="submit" name="btn-save-language" id="btn-login" class="btn btn-success kh" value="Save Language" />
								</div>
							</div>
							</form>
					</div>
				</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Change Logo:</div>
				<div class="panel-body">
					<div class="form-group">
					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post" enctype="multipart/form-data">
						<div style="margin-bottom: 25px;" class="input-group">
						<span class="input-group-addon">Choose Logo:</span>
						<input id="login-password" type="file" class="form-control" name="logo" value="" required>
					</div>
						<div style="margin-top: 10px;" class="form-group">
								<div class="col-sm-12">
									<input type="submit" name="btn-save-logo" id="btn-login" class="btn btn-success kh" value="Save Logo" />
								</div>
							</div>
							</form>
					</div>
				</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Change Banner:</div>
				<div class="panel-body">
					<div class="form-group">
					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post" enctype="multipart/form-data">
						<div style="margin-bottom: 25px;" class="input-group">
						<span class="input-group-addon">Choose Banner:</span>
						<input id="login-password" type="file" class="form-control" name="banner" value="" required>
					</div>
						<div style="margin-top: 10px;" class="form-group">
								<div class="col-sm-12">
									<input type="submit" name="btn-save-banner" id="btn-login" class="btn btn-success kh" value="Save Banner" />
								</div>
							</div>
							</form>
					</div>
				</div>
				</div>


				<div class="panel panel-default">
				<div class="panel-heading">Change Title Bar:</div>
				<div class="panel-body">
				<div class="form-group">
					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
					<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Title English</span>
					<input id="login-password" type="text" class="form-control" name="title_en" value="" required>
				</div>

				<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Title Khmer</span>
					<input name="title_kh" class="form-control"  type="text" required />
				</div>

				<div style="margin-top: 10px;" class="form-group">
						<div class="col-sm-12">
							<input type="submit" name="btn-save-title" id="btn-login" class="btn btn-success" value="Save Title"/>

					</div>
				</div>
				</form>
			</div>
		</div>
		</div>
		<div class="panel panel-default">
				<div class="panel-heading">Change Home Menu:</div>
				<div class="panel-body">
				<div class="form-group">
					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
					<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Home Menu English</span>
					<input id="login-password" type="text" class="form-control" name="home_menu_en" value="" required>
				</div>

				<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Home Menu Khmer</span>
					<input name="home_menu_kh" class="form-control"  type="text" required />
				</div>

				<div style="margin-top: 10px;" class="form-group">
						<div class="col-sm-12">
							<input type="submit" name="btn-save-home-menu" id="btn-login" class="btn btn-success" value="Save Home Menu"/>

					</div>
				</div>
				</form>
			</div>
		</div>
		</div>

		<div class="panel panel-default">
				<div class="panel-heading">Change Welcome Title:</div>
				<div class="panel-body">
				<div class="form-group">
					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
					<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Welcome Title English</span>
					<input id="login-password" type="text" class="form-control" name="welcome_title_en" value="" required>
				</div>

				<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Welcome Title Khmer</span>
					<input name="welcome_title_kh" class="form-control"  type="text" required />
				</div>

				<div style="margin-top: 10px;" class="form-group">
						<div class="col-sm-12">
							<input type="submit" name="btn-save-welcome-title" id="btn-login" class="btn btn-success" value="Save Welcome Title"/>

					</div>
				</div>
				</form>
			</div>
		</div>
		</div>

		<div class="panel panel-default">
				<div class="panel-heading">Change Welcome Content</div>
				<div class="panel-body">
				<div class="form-group">
					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
					<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Welcome Content English</span>
					<textarea class="form-control" rows="5" id="login-password" name="welcome_content_en" value="" required></textarea>
				</div>

				<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Welcome Content Khmer</span>
					<textarea class="form-control" rows="5" id="login-password" name="welcome_content_kh" value="" required></textarea>

				</div>

				<div style="margin-top: 10px;" class="form-group">
						<div class="col-sm-12">
							<input type="submit" name="btn-save-welcome-content" id="btn-login" class="btn btn-success" value="Save Welcome Content"/>

					</div>
				</div>
				</form>
			</div>
		</div>
		</div>

		<div class="panel panel-default">
				<div class="panel-heading">Change Footer</div>
				<div class="panel-body">
				<div class="form-group">
					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
					<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Footer English</span>
					<input id="login-password" type="text" class="form-control" name="footer_en" value="" required>
				</div>

				<div style="margin-bottom: 25px;" class="input-group">
					<span class="input-group-addon">Footer Khmer</span>
					<input name="footer_kh" class="form-control"  type="text" required />
				</div>

				<div style="margin-top: 10px;" class="form-group">
						<div class="col-sm-12">
							<input type="submit" name="btn-save-welcome-footer" id="btn-login" class="btn btn-success" value="Save Welcome Footer"/>

					</div>
				</div>
				</form>
			</div>
		</div>
		</div>
	</div>
</div>
</body>
</html>

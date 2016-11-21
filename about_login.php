<?php
session_start();
//to show error ouput
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connect.php";
function GetImageExtension($imagetype){
	if(empty($imagetype))
		return 'none';
	switch ($imagetype) {
		case 'image/jpeg':
			return'.jpg';break;
		case 'image/png':
			return'.png';break;
		default:
			return 'none';
	}
}
function text_area($txt){
	$txt=n12br($txt);
	$txt=stripcslashes($txt);
	return $txt;
}
if(!isset($_SESSION["username"])){
	header("location:login.php");
}
else if (isset($_POST["btn-save-company-profile-title"])) {
	$ql=mysqli_query($con,"update table_about set company_profile_title_en='".$_POST["company_profile_title_en"]."',company_profile_title_kh='".$_POST["company_profile_title_kh"]."'") or die("Can not update");
}
else if (isset($_POST["btn-save-company-profile-content"])) {
	$ql=mysqli_query($con,"update table_about set company_profile_content_en='".$_POST["company_profile_content_en"]."',company_profile_content_kh='".$_POST["company_profile_content_kh"]."'") or die("Can not update");
}
else if (isset($_POST["btn-save-company-mission"])) {
	$ql=mysqli_query($con,"update table_about set company_mission_en='".$_POST["company_mission_en"]."',company_mission_kh='".$_POST["company_mission_kh"]."'") or die("Can not update");
}
else if (isset($_POST["btn-save-company-mission-content"])) {
	$ql=mysqli_query($con,"update table_about set company_mission_content_en='".$_POST["company_mission_content_en"]."',company_mission_content_kh='".$_POST["company_mission_content_kh"]."'") or die("Can not update");
}

else if(isset($_POST["btn-save-campany-image"])){
	if(!empty($_FILES["company_image"]["name"])){
		$file_name=$_FILES["company_image"]["name"];//test
		$temp_name=$_FILES["company_image"]["tmp_name"];//test
		$imgtype=$_FILES["company_image"]["type"];//image/jpeg
		$ext=GetImageExtension($imgtype);
		if($ext =='none'){
			$msg="<span class 'text-danger'>* This file is not JPEG or PNG.</span>";
		}
		else{
			$imagename = "company_image".$ext;
			$target='image/slideshow/'.$imagename;
			if(move_uploaded_file($temp_name,$target)){

			}
			else{
				$msg="<span class 'text-anger'>* Error uplaod.</span>";
			}
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
      				<div class="panel-heading">Change Company Profile Title:</div>
      				<div class="panel-body">
      				<div class="form-group">
      					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
      					<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Company Profile Title English</span>
      					<input id="login-password" type="text" class="form-control" name="company_profile_title_en" value="" required>
      				</div>

      				<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Company Profile Title Khmer</span>
      					<input name="company_profile_title_kh" class="form-control"  type="text" required />
      				</div>

      				<div style="margin-top: 10px;" class="form-group">
      						<div class="col-sm-12">
      							<input type="submit" name="btn-save-company-profile-title" id="btn-login" class="btn btn-success" value="Save Company Profile"/>

      					</div>
      				</div>
      				</form>
      			</div>
      		</div>
      		</div>

          <div class="panel panel-default">
      				<div class="panel-heading">Change Company Profile Content:</div>
      				<div class="panel-body">
      				<div class="form-group">
      					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
      					<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Company Profile Contact English</span>
      					<input id="login-password" type="text" class="form-control" name="company_profile_content_en" value="" required>
      				</div>

      				<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Company Profile Content Khmer</span>
      					<input name="company_profile_content_kh" class="form-control"  type="text" required />
      				</div>

      				<div style="margin-top: 10px;" class="form-group">
      						<div class="col-sm-12">
      							<input type="submit" name="btn-save-company-profile-content" id="btn-login" class="btn btn-success" value="Save Company Profile Content"/>

      					</div>
      				</div>
      				</form>
      			</div>
      		</div>
      		</div>

          <div class="panel panel-default">
      				<div class="panel-heading">Change Company Mission:</div>
      				<div class="panel-body">
      				<div class="form-group">
      					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
      					<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Company Mission English</span>
      					<input id="login-password" type="text" class="form-control" name="company_mission_en" value="" required>
      				</div>

      				<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Company Mission Khmer</span>
      					<input name="company_mission_kh" class="form-control"  type="text" required />
      				</div>

      				<div style="margin-top: 10px;" class="form-group">
      						<div class="col-sm-12">
      							<input type="submit" name="btn-save-company-mission" id="btn-login" class="btn btn-success" value="Save Company Mission"/>

      					</div>
      				</div>
      				</form>
      			</div>
      		</div>
      		</div>

					<div class="panel panel-default">
      				<div class="panel-heading">Change Company Mission Content:</div>
      				<div class="panel-body">
      				<div class="form-group">
      					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
      					<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Company Mission Content English</span>
      					<input id="login-password" type="text" class="form-control" name="company_mission_content_en" value="" required>
      				</div>

      				<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Company Mission Content Khmer</span>
      					<input name="company_mission_content_kh" class="form-control"  type="text" required />
      				</div>

      				<div style="margin-top: 10px;" class="form-group">
      						<div class="col-sm-12">
      							<input type="submit" name="btn-save-company-mission-content" id="btn-login" class="btn btn-success" value="Save Company Mission Content"/>

      					</div>
      				</div>
      				</form>
      			</div>
      		</div>
      		</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Company Image</h3>
						</div>
						<div class="panel-body">
							<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post" enctype="multipart/form-data">
								<div style="margin-bottom: 25px" class="input-group">
									<input id="login-password" type="file" class="form-control" name="company_image" value="" placeholder="select an image" required>

								</div>
								<div style="margin-top: 10px;" class="form-group">
									<div class="col-sm-12">
										<input type="submit" name="btn-save-company_image" id="btn-login" class="btn btn-success kh" value="Save Image" />
									</div>
								</div>
							</form>
						</div>

					</div>
		</div>
</body>
</html>

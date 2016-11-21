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
if(!isset($_SESSION["username"])){
	header("location:login.php");
}
else if (isset($_POST["btn-save-contact-title"])) {
	$ql=mysqli_query($con,"update table_contact set contact_title_en='".$_POST["contact_title_en"]."',contact_title_kh='".$_POST["contact_title_kh"]."'") or die("Can not update");
}
else if (isset($_POST["btn-save-contact-content"])) {
	$ql=mysqli_query($con,"update table_contact set contact_content_en='".$_POST["contact_content_en"]."',contact_content_kh='".$_POST["contact_content_kh"]."'") or die("Can not update");
}
else if (isset($_POST["btn-save-contact-map"])) {
	$ql=mysqli_query($con,"update table_contact set contact_map_en='".$_POST["contact_map_en"]."',contact_map_kh='".$_POST["contact_map_kh"]."'") or die("Can not update");
}

else if(isset($_POST["btn-save-campany-map"])){
	if(!empty($_FILES["company_map"]["name"])){
		$file_name=$_FILES["company_map"]["name"];//test
		$temp_name=$_FILES["company_map"]["tmp_name"];//test
		$imgtype=$_FILES["company_map"]["type"];//image/jpeg
		$ext=GetImageExtension($imgtype);
		if($ext =='none'){
			$msg="<span class 'text-danger'>* This file is not JPEG or PNG.</span>";
		}
		else{
			$imagename = "company_map".$ext;
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
      				<div class="panel-heading">Change Contact Title:</div>
      				<div class="panel-body">
      				<div class="form-group">
      					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
      					<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Contact Title English</span>
      					<input id="login-password" type="text" class="form-control" name="contact_title_en" value="" required>
      				</div>

      				<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Contact Title Khmer</span>
      					<input name="contact_title_kh" class="form-control"  type="text" required />
      				</div>

      				<div style="margin-top: 10px;" class="form-group">
      						<div class="col-sm-12">
      							<input type="submit" name="btn-save-contact-title" id="btn-login" class="btn btn-success" value="Save Contact Title"/>

      					</div>
      				</div>
      				</form>
      			</div>
      		</div>
      		</div>

          <div class="panel panel-default">
      				<div class="panel-heading">Change Contact Content:</div>
      				<div class="panel-body">
      				<div class="form-group">
      					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
      					<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Contact Content English</span>
      					<input id="login-password" type="text" class="form-control" name="contact_content_en" value="" required>
      				</div>

      				<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Contact Content Khmer</span>
      					<input name="contact_content_kh" class="form-control"  type="text" required />
      				</div>

      				<div style="margin-top: 10px;" class="form-group">
      						<div class="col-sm-12">
      							<input type="submit" name="btn-save-contact-content" id="btn-login" class="btn btn-success" value="Save Contact Content"/>

      					</div>
      				</div>
      				</form>
      			</div>
      		</div>
      		</div>

          <div class="panel panel-default">
      				<div class="panel-heading">Change Contact Map:</div>
      				<div class="panel-body">
      				<div class="form-group">
      					<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
      					<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Contact Map English</span>
      					<input id="login-password" type="text" class="form-control" name="contact_map_en" value="" required>
      				</div>

      				<div style="margin-bottom: 25px;" class="input-group">
      					<span class="input-group-addon">Contact Map Khmer</span>
      					<input name="contact_map_kh" class="form-control"  type="text" required />
      				</div>

      				<div style="margin-top: 10px;" class="form-group">
      						<div class="col-sm-12">
      							<input type="submit" name="btn-save-contact-map" id="btn-login" class="btn btn-success" value="Save Contact Map"/>

      					</div>
      				</div>
      				</form>
      			</div>
      		</div>
      		</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Company Map</h3>
						</div>
						<div class="panel-body">
							<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post" enctype="multipart/form-data">
								<div style="margin-bottom: 25px" class="input-group">
									<input id="login-password" type="file" class="form-control" name="company_map" value="" placeholder="select an image" required>

								</div>
								<div style="margin-top: 10px;" class="form-group">
									<div class="col-sm-12">
										<input type="submit" name="btn-save-company_map" id="btn-login" class="btn btn-success kh" value="Save Map" />
									</div>
								</div>
							</form>
						</div>

					</div>
		</div>
</body>
</html>

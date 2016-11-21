
<?php
session_start();
//to show error ouput
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("connect.php");

if(!isset($_SESSION["username"])){
	header("location:login.php");
}

$msg="<span class 'text-info'>* Pleass uplaod image with JPEG or PNG file type only.</span>";
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
	if(isset($_POST["btn-save"])){
		if(!empty($_FILES["image_slide"]["name"])){
			$file_name=$_FILES["image_slide"]["name"];//test
			$temp_name=$_FILES["image_slide"]["tmp_name"];//test
			$imgtype=$_FILES["image_slide"]["type"];//image/jpeg
			$ext=GetImageExtension($imgtype);
			if($ext =='none'){
				$msg="<span class 'text-danger'>* This file is not JPEG or PNG.</span>";
			}
			else{
				$imagename = date("Y-m-d_h-i-s").$ext;
				$target='image/slideshow/'.$imagename;
				if(move_uploaded_file($temp_name,$target)){
					$qr=mysqli_query($con,"insert into table_slideshow values('','".$imagename."')");
					$msg="<span class 'text-success'>* This file is uplaod successfully.</span>";
				}
				else{
					$msg="<span class 'text-anger'>* Error uplaod.</span>";
				}
			}
		}
	}
	if (isset($_GET["name"])) {
		$qd=mysqli_query($con,"delete from table_slideshow where slide_name='".$_GET["name"]."'");
		if ($qd) {
			unlink("image/slideshow/".$_GET["name"]);
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
					<div class="panel-heading">
						<h3 class="panel-title">Slide Show Manager</h3>
					</div>
					<div class="panel-body">
						<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post" enctype="multipart/form-data">
							<div style="margin-bottom: 25px" class="input-group">
								<input id="login-password" type="file" class="form-control" name="image_slide" value="" placeholder="select an image" required>
								<?php echo $msg;?>
							</div>
							<div style="margin-top: 10px;" class="form-group">
								<div class="col-sm-12">
									<input type="submit" name="btn-save" id="btn-login" class="btn btn-success kh" value="Add" />
								</div>
							</div>
						</form>
					</div>

				</div>
				<div class="panel panel-default">
						<!--default panel contentse-->
						<div class="panel-heading">All Slideshow Images</div>
						<!--Table-->
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Image Name</th>
									<th>Image View</th>
									<th>action</th>
								</tr>
							</thead>

						<tbody>
							<?php
							$q=mysqli_query($con,"select * from table_slideshow");
								while ($row=mysqli_fetch_array($q,MYSQLI_ASSOC)) {
									echo "<tr>";
									echo "<td>".$row["slide_id"]."</td>";
									echo "<td>".$row["slide_name"]."</td>";
									echo "<td><img src='image/slideshow/".$row["slide_name"]."' width='20px'; height='20px';/></td>";
									echo "<td> <a href='?name=".$row["slide_name"]."' onclick=\"return confirm('Are your sure you when to delete?');\">Delete</a></td>";
									echo "</tr>";
								}
							 ?>
						</tbody>
						</table>
					</div>
		</div>
	</body>
</html>

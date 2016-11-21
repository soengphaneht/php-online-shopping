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
$product_id="";
$product_name_en="";
$product_name_kh="";
$product_description_en="";
$product_description_kh="";
$product_category="";
$product_order="";
$product_image="";

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
if(isset($_POST["btn-save-product"])){

	if(!empty($_FILES["product_image"]["name"])){
		$file_name=$_FILES["product_image"]["name"];//test
		$temp_name=$_FILES["product_image"]["tmp_name"];//test
		$imgtype=$_FILES["product_image"]["type"];//image/jpeg
		$ext=GetImageExtension($imgtype);
		if($ext =='none'){
			$msg="<span class 'text-danger'>* This file is not JPEG or PNG.</span>";
		}
		else{
			$imagename = date('Y-m-d_h-i-s').$ext;
			$target_path='image/products/'.$imagename;
			if(move_uploaded_file($temp_name,$target_path)){
				$qr=mysqli_query($con,"insert into table_product values('','".$_POST["product_name_en"]."','".$_POST["product_name_kh"]."','".$_POST["product_description_en"]."','".$_POST["product_description_kh"]."','".$_POST["product_category"]."','".$_POST["product_order"]."','".$imagename."')");
				$msg="<span class 'text-success'>* This file is uplaod successfully.</span>";
			}
			else{
				$msg="<span class 'text-anger'>* Error uplaod.</span>";
			}
		}
	}
}

if(isset($_POST["btn-edit-product"])){
	if(!empty($_FILES["product_image"]["name"])){
		$file_name=$_FILES["product_image"]["name"];//test
		$temp_name=$_FILES["product_image"]["tmp_name"];//test
		$imgtype=$_FILES["product_image"]["type"];//image/jpeg
		$ext=GetImageExtension($imgtype);
		if($ext =='none'){
			$msg_profile="<span class 'text-danger'>* This file is not JPEG or PNG.</span>";
		}
		else{
			$imagename = date('Y-m-d_h-i-s').$ext;
			$target_path ='image/products/'.$imagename;
			if(move_uploaded_file($temp_name,$target_path)){
				unlink("image/products/".$_POST["product_pic"]);
				$qu=mysqli_query($con,"update table_product set product_image='".$imagename."' where product_id='".$_POST["product_id"]."'");
			}
			else{
				$msg_image="<span class 'text-anger'>* Error While uplaoding image .</span>";
			}
		}
	}
	$qry=mysqli_query($con,"update table_product set product_name_en='".$_POST["product_name_en"]."',product_name_kh='".$_POST["product_name_kh"]."',product_description_en='".$_POST["product_description_en"]."',
	product_description_kh='".$_POST["product_description_kh"]."',product_category='".$_POST["product_category"]."',product_order='".$_POST["product_order"]."'
	where product_id='".$_POST["product_id"]."'");
}

if (isset($_GET["delete_id"])) {
	$qd=mysqli_query($con,"delete from table_product where product_id='".$_GET["delete_id"]."'");
		unlink("image/products/".$_GET["image"]);
}
else if(isset($_GET["edit_id"])){
	$qu=mysqli_query($con,"select * from table_product where product_id='".$_GET["edit_id"]."'") or die("can not edit");
	$row=mysqli_fetch_array($qu,MYSQLI_NUM);
		$product_id=$row[0];
		$product_name_en=$row[1];
		$product_name_kh=$row[2];
		$product_description_en=$row[3];
		$product_description_kh=$row[4];
		$product_category=$row[5];
		$product_order=$row[6];
		$product_image=$row[7];

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
							<div class="panel-heading">Change Product Manager:</div>
							<div class="panel-body">
							<div class="form-group">
								<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post" enctype="multipart/form-data">
									<input type="hidden" name="product_id" value='<?php echo $product_id;?>'/>
								<div style="margin-bottom: 25px;" class="input-group">
								<span class="input-group-addon">Product Name En</span>
								<input id="login-password" type="text" class="form-control" name="product_name_en" value='<?php echo $product_name_en;?>' required>
							</div>

							<div style="margin-bottom: 25px;" class="input-group">
								<span class="input-group-addon">Product Name Kh</span>
								<input name="product_name_kh" class="form-control"  type="text" required value='<?php echo $product_name_kh;?>'/>
							</div>

							<div style="margin-bottom: 25px;" class="input-group">
							<span class="input-group-addon">Product Description En</span>
							<input name="product_description_en" class="form-control"  type="text" required value='<?php echo $product_description_kh;?>'/>
						</div>

						<div style="margin-bottom: 25px;" class="input-group">
							<span class="input-group-addon">Product Description Kh</span>
							<input name="product_description_kh" class="form-control"  type="text" required value='<?php echo $product_description_kh;?>'/>
						</div>

						<div style="margin-bottom: 25px;" class="input-group">
							<span class="input-group-addon">Product Category</span>
							<select class="form-control" id="sel1" name="product_category">
								<?php
								$qry=mysqli_query($con,"select * from table_category");
								while ($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)) {
									echo '<option value="'.$row["category_id"].'">'.$row["category_name_en"].' ('.$row["category_name_kh"].')'.'</option>';
								}
								?>
							</select>
						</div>

						<div style="margin-bottom: 25px;" class="input-group">
							<span class="input-group-addon">Product Order</span>
							<input name="product_order" class="form-control"  type="text" required value='<?php echo $product_order;?>'/>
						</div>

						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon">Product Image</span>
							<input id="login-password" type="file" class="form-control" name="product_image" value="" placeholder="select an image"<?php if(!isset($_GET["edit_id"])) echo "required";?>>
							<input type="hidden" name="product_pic" value='<?php echo $product_image;?>'/>
						</div>


							<div style="margin-top: 10px;" class="form-group">
									<div class="col-sm-12">
										<input type="submit" name="btn-save-product" id="btn-login" class="btn btn-success" value="Save Product"/>
										<input type="submit" name="btn-edit-product" id="btn-login" class="btn btn-success" value="Edit Product"/>

								</div>
							</div>
							</form>
						</div>
					</div>
					</div>

					<div class="panel panel-default">
							<!--default panel contentse-->
							<div class="panel-heading">All Product</div>
							<!--Table-->
							<table class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Product Name En</th>
										<th>Product Image</th>
										<th>Product Category</th>
										<th>action</th>
									</tr>
								</thead>

							<tbody>
								<?php
								$q=mysqli_query($con,"select * from table_product");
									while ($row=mysqli_fetch_array($q,MYSQLI_ASSOC)) {
										echo "<tr>";
										echo "<td>".$row["product_id"]."</td>";
										echo "<td>".$row["product_name_en"]."</td>";
										echo "<td><img src='image/products/".$row["product_image"]."' height =\"30px\"/></td>";
										echo "<td>".$row["product_category"]."</td>";
										echo "<td>
										<a href='?delete_id=".$row["product_id"]."&image=".$row["product_image"]."'
										onclick=\"return confirm('Are your sure you when to delete?');\">Delete
										</a>||
										<a href='?edit_id=".$row["product_id"]."'>Edit</a>
										</td>";
										echo "</tr>";
									}
								 ?>
							</tbody>
							</table>
						</div>
		</div>
</body>
</html>

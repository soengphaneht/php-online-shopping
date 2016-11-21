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
$category_id="";
$category_name_en="";
$category_name_kh="";
$category_order="";
if (isset($_POST["btn-save-category"])) {
	$category_name_en= $_POST["category_name_en"];
 	$category_name_kh=$_POST["category_name_kh"];
	$category_order= $_POST["category_order"];
	$qry=mysqli_query($con,"insert into table_category values('','".$category_name_en."','".$category_name_kh."','".$category_order."')") or die("can not insert into table category");
}
else if (isset($_GET["delete_id"])) {
	$qry=mysqli_query($con,"delete from table_category where category_id='".$_GET["delete_id"]."'") or die("can not delete category");
}
else if(isset($_GET["edit_id"])){
	$qry=mysqli_query($con,"select * from table_category where category_id='".$_GET["edit_id"]."'") or die("can not edit");
	while ($row=mysqli_fetch_array($qry,MYSQLI_NUM)) {
		$category_id=$row["0"];
		$category_name_en=$row["1"];
		$category_name_kh=$row["2"];
		$category_order=$row["3"];
	}
}
else if (isset($_POST["btn-edit-category"])) {
	$qry=mysqli_query($con,"update table_category set category_name_en='".$_POST["category_name_en"]."',category_name_kh='".$_POST["category_name_kh"]."',category_order='".$_POST["category_order"]."' where category_id='".$_POST["category_id"]."'");
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
							<div class="panel-heading">Change Category Manager:</div>
							<div class="panel-body">
							<div class="form-group">
								<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
									<input type="hidden" name="category_id" value='<?php echo $category_id;?>'/>
								<div style="margin-bottom: 25px;" class="input-group">
								<span class="input-group-addon">Category Name En</span>
								<input id="login-password" type="text" class="form-control" name="category_name_en" value='<?php echo $category_name_en;?>' required>
							</div>

							<div style="margin-bottom: 25px;" class="input-group">
								<span class="input-group-addon">Category Name Kh</span>
								<input name="category_name_kh" class="form-control"  type="text" required value='<?php echo $category_name_kh;?>'/>
							</div>
							<div style="margin-bottom: 25px;" class="input-group">
								<span class="input-group-addon">Category Order</span>
								<input name="category_order" class="form-control"  type="text" required value='<?php echo $category_order;?>'/>
							</div>

							<div style="margin-top: 10px;" class="form-group">
									<div class="col-sm-12">
										<input type="submit" name="btn-save-category" id="btn-login" class="btn btn-success" value="Save Category"/>
										<input type="submit" name="btn-edit-category" id="btn-login" class="btn btn-success" value="Edit Category"/>

								</div>
							</div>
							</form>
						</div>
					</div>
					</div>

					<div class="panel panel-default">
							<!--default panel contentse-->
							<div class="panel-heading">All Category</div>
							<!--Table-->
							<table class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Category Name En</th>
										<th>Category Name Kh</th>
										<th>Category Order</th>
										<th>action</th>
									</tr>
								</thead>

							<tbody>
								<?php
								$q=mysqli_query($con,"select * from table_category");
									while ($row=mysqli_fetch_array($q,MYSQLI_ASSOC)) {
										echo "<tr>";
										echo "<td>".$row["category_id"]."</td>";
										echo "<td>".$row["category_name_en"]."</td>";
										echo "<td>".$row["category_name_kh"]."</td>";
										echo "<td>".$row["category_order"]."</td>";
										echo "<td>
										<a href='?delete_id=".$row["category_id"]."' onclick=\"return confirm('Are your sure you when to delete?');\">Delete
										</a>||
										<a href='?edit_id=".$row["category_id"]."'>Edit</a>
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

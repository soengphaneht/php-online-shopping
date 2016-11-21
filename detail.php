<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include ("connect.php");
if (!isset($_SESSION["lang"])){
  $qt=mysqli_query($con,"select language from table_homepage");
        $row=mysqli_fetch_array($qt,MYSQLI_NUM);
        echo $_SESSION["lang"]=$row[0];
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include "head.php";?>
</head>
<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>
<body>
<div class="container">
  <?php
  include "head_index.php";
  ?>

  <div class="row">
  	<?php
    include "slideshow_index.php";
    ?>
    <?php
    if(isset($_GET["pro"])){
    $qt=mysqli_query($con,"select * from table_product where product_id='".$_GET["pro"]."'");
    $row=mysqli_fetch_array($qt,MYSQLI_ASSOC);
    echo '<h3>'.$row["product_name_".$_SESSION["lang"]]."</h3>";
    echo '<p>'.$row["product_description_".$_SESSION["lang"]]."</p>";
    echo '<div class="panel panel-default" style="padding:20px;">
    <img src="image/products/'.$row["product_image"].'" style="height:400px;" class="img-responsive" /></div>';
  }
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:0px; padding-right:0px; margin-bottom:20px;">

    </div>
  		<?php include "footer.php";?>
      </div>
  	</div>
  </div>
</body>
</html>

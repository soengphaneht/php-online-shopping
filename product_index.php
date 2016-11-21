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
      //protect date from user input
      if(isset($_GET["cate"])){
      $sql=mysqli_query ($con,"
              SELECT
                  category_name_".$_SESSION["lang"]."
              FROM
                  table_category
              WHERE
                  category_id = '".$_GET["cate"]."'
          ");
      //do something more
      $row=mysqli_fetch_array($sql,MYSQLI_NUM);
      echo '<h3>'.$row[0]."</h3>";
    }
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:0px; padding-right:0px; margin-bottom:20px;">
      <?php
      if(isset($_GET["cate"])){
        $qt = mysqli_query($con,"select * from table_product where product_category = '".$_GET["cate"]."' order by product_order desc");
      }
      while($row=mysqli_fetch_array($qt,MYSQLI_ASSOC)){

      echo '<a href="detail.php?cate='.$row["product_category"].'&pro='.$row["product_id"].'"><div class="panel panel-default col-lg-6 col-md-8 col-sm-6 col-xs-12"
      style="margin-bottom:20px;"><h4>'.$row["product_name_".$_SESSION["lang"]].'</h4>';
      echo '<img src="image/products/'.$row["product_image"].'" style="height:200px;margin-bottom:50px; width:105px;height:140px;" class="img-responsive" />';
      echo '</div></a>';
  }
      ?>
    </div>
  		<?php include "footer.php";?>
      </div>
  	</div>
  </div>
</body>
</html>

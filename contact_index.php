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

  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  	<h3 style="margin-top: 0px;">
      <?php
      $qt=mysqli_query($con,"select contact_title_".$_SESSION["lang"]." from table_contact");
      $row=mysqli_fetch_array($qt,MYSQLI_NUM);
      echo $row[0];
      ?>
    </h3>
  		<p>
        <?php
        $qt=mysqli_query($con,"select contact_content_".$_SESSION["lang"]." from table_contact");
        $row=mysqli_fetch_array($qt,MYSQLI_NUM);
        echo $row[0];
        ?>
      </p>
  	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  	<h3 style="margin-top: 0px;">
      <?php
      $qt=mysqli_query($con,"select contact_map_".$_SESSION["lang"]." from table_contact");
      $row=mysqli_fetch_array($qt,MYSQLI_NUM);
      echo $row[0];
      ?>
    </h3>
    <p><img src="image/logo_phaneth.jpg" class="img-responsive img-thumbneil"></p>
  		<?php include "footer.php";?>
      </div>
  	</div>
  </div>
</body>
</html>

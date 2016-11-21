<div class="row">
  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 border">
    <a href="http://localhost:8888/web_project/" border="0"><img class="img-responsive logo tcenter" src="image/logo_phaneth.jpg"></a>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 border">
    <img class="img-responsive" src="image/banner_logo.jpg" style="width:800px;">
  </div>
</div>
<div class="row">
  <nav class="navbar navbar-default bg-success">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="http://localhost:8888/web_project/">
      <?php
        $qt=mysqli_query($con,"select home_menu_".$_SESSION["lang"]." from table_homepage");
      $row=mysqli_fetch_array($qt,MYSQLI_NUM);
      echo $row[0];
      ?>
        </a></li>
        <?php
          $qry=mysqli_query($con,"select * from table_category order by category_order asc");
          while ($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
            echo '<li><a href="product_index.php?cate='.$row["category_id"].'">'.$row["category_name_".$_SESSION["lang"]].'</a></li>';
          }
        ?>
      </ul>

      <ul class="nav navbar-nav navbar-right" style="margin-right: 0px;">
        <li class="home"><a href="contact_index.php">Contact Us</a></li>
        <li class="home"><a href="about_index.php">About Us</a></li>

        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
          <?php
            if ($_SESSION["lang"]=="kh") echo "ខ្មែរ";
            else
              echo "English";
          ?>
        <span class="caret"></span></a>

        <ul class="dropdown-menu" id="custom">
          <li><a href="change_language.php?lang=kh">ខ្មែរ</a></li>
          <li><a href="change_language.php?lang=en">English</a></li>
        </ul>
      </li>
      </ul>
    </div>
  </nav>
</div>

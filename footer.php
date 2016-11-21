<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well well_footer" >
        <p><?php
        $qt=mysqli_query($con,"select footer_".$_SESSION["lang"]." from table_homepage");
        $row=mysqli_fetch_array($qt,MYSQLI_NUM);
        echo $row[0];
        ?></p>
      </div>

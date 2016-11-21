<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well">

<div id="myCarousel" class="carousel slide" data-ride="carousel">
<!-- Indicators -->
<ol class="carousel-indicators">

  <?php $qc=mysqli_query($con,"select * from table_slideshow");
    $count=mysqli_num_rows($qc);
    for($i=0;$i<$count;$i++){
      echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
    }
   ?>
</ol>

<!-- Wrapper for slides -->

<div class="carousel-inner" role="listbox">
<?php
  $qi=mysqli_query($con,"select slide_name from table_slideshow order by slide_id desc");

  $i=0;
  while ($row=mysqli_fetch_array($qi,MYSQL_ASSOC)) {
    if ($i==0) {
      echo '<div class="item active"><img src="image/slideshow/'.$row["slide_name"].'" style="width:1000px; height:345px;"></div>';
    }
    else{
      echo '<div class="item"><img src="image/slideshow/'.$row["slide_name"].'" style="width:1000px; height:345px;"></div>';
    }
    $i++;
  }
?>
</div>
<!-- Left and right controls -->
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
</div>

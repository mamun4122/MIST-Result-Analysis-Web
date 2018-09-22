<?php
	session_start();
	$cse13="['ID Number', 'Level 1 Term 1 2013', 'Level 1 Term 2 2013'],";
	$roll=array(201214018, 201214034, 201214047, 201314001, 201314002, 201314003, 201314004, 201314005, 201314006, 201314007, 201314008, 201314009, 201314010, 201314011, 201314012, 201314013, 201314014, 201314015, 201314016, 201314017, 201314018, 201314019, 201314020, 201314021, 201314022, 201314023, 201314024, 201314025, 201314026, 201314027, 201314028, 201314029, 201314030, 201314031, 201314032, 201314033, 201314034, 201314035, 201314036, 201314037, 201314038, 201314039, 201314040, 201314041, 201314042, 201314043, 201314044, 201314045, 201314046, 201314047, 201314048, 201314049, 201314050, 201314051, 201314052, 201314053, 201314054, 201314055, 201314056, 201314057, 201314058, 201314059, 201314060, 201314061, 201314062, 201314063, 201314064, 201314065, 201314066);
	$level11=array(2.93, 3.0, 3.18, 3.87, 3.96, 3.74, 3.36, 3.67, 3.64, 4.0, 2.59, 3.73, 2.86, 3.42, 3.15, 3.27, 3.43, 2.97, 3.91, 3.13, 3.6, 3.65, 3.93, 2.32, 3.1, 2.91, 3.91, 3.16, 3.73, 3.81, 3.78, 3.2, 3.86, 2.98, 3.55, 2.69, 2.75, 2.92, 3.31, 3.84, 3.11, 3.56, 3.55, 3.35, 3.15, 3.32, 3.85, 3.4, 2.86, 3.86, 3.17, 3.19, 3.84, 3.02, 3.05, 2.29, 3.08, 3.57, 3.95, 3.3, 3.39, 3.84, 2.87, 2.94, 2.65, 3.33, 3.02, 2.32, 3.87);
	$level12=array(2.0,2.64, 2.79, 3.64, 3.89, 3.15, 3.06, 3.2, 3.06, 3.82, 2.59, 3.39, 1.33, 3.39, 2.51, 3.02, 2.95, 2.39, 3.8, 2.41, 3.46, 3.57, 0.0, 1.69, 2.72, 2.05, 3.44, 2.57, 3.37, 3.48, 3.02, 3.2, 3.51, 2.81, 2.91, 2.65, 2.4, 2.56, 2.76, 3.53, 2.7, 3.15, 0.0, 2.88, 2.58, 2.54, 3.6, 3.22, 2.72, 3.58, 2.89, 3.0, 3.59, 2.61, 2.52, 1.22,2.46, 3.05, 3.62, 3.05, 2.9, 3.73, 2.4, 2.51, 2.54, 2.75, 2.67, 1.13, 3.51);
	$arrlength = count($roll);
	for($x = 0; $x < $arrlength; $x++) {
		$cse13.="['$roll[$x]',$level11[$x], $level12[$x]],";
	}
	//echo $cse13;

?>
<!DOCTYPE html>
<html class="no-js">
<head>
<title>GPA Graph Of DEPT</title>
<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
<link href="assets/styles.css" rel="stylesheet" media="screen">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>

<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid"><img src="MIST.gif" width="60" height="60" align="left"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">Student's Panel</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li class="dropdown"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>
            <?php
		 // session_start();
		   echo $_SESSION['name'] ?>
            <i class="caret"></i> </a>
            <ul class="dropdown-menu">
              <li> <a tabindex="-1" href="index.html">Logout</a> </li>
            </ul>
          </li>
        </ul>
        <ul class="nav">
          <li class="dropdown"> <a href="studentbasic.php" >Basic Information</a> </li>
          <li> <a href="studentsubjectgpapercentage.php">Subject Gpa Percentage of Student</a> </li>
          <li> <a href="studenttermwisegpa.php">Term Wise GPA</a> </li>
          <li> <a href="studentgpagraphdept.php">GPA Graph Of DEPT</a> </li>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
  </div>
</div>

<div class="container-fluid">
<!--/span-->
<div class="span9" id="content">
<!-- morris graph chart -->
<div class="row-fluid section">
<!-- block -->
<div class="block">
  <div class="navbar navbar-inner block-header">
    <div class="muted pull-left">
      <medium>GPA Graph of DEPT</medium>
    </div>
    <div class="pull-right"><span class="badge badge-warning"></span> </div>
  </div>
    <html>
  <head>
    <script type="text/javascript"
          src="assets/googleline.js"></script>

    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        /*var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);*/
		<?php
		 echo "var data=google.visualization.arrayToDataTable([$cse13]);"
?>
        var options = {
          title: 'GPA Graph Of CSE-13',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 1366px; height: 500px"></div>
  </body>
</html>

</div>


<hr>
<footer>
  <p>2015 &copy; Military Institute of Science & Technology (MIST) all rights reserved.</p>
</footer>
<!-- /block -->
</div>
</div>
</div>

<!--/.fluid-container--> 
<script src="vendors/jquery-1.9.1.min.js"></script> 
<script src="bootstrap/js/bootstrap.min.js"></script> 
<script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script> 
<script src="assets/scripts.js"></script> 
<script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
</body>
</html>
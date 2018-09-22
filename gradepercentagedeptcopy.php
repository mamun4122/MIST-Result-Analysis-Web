<?php
	$con=new mysqli("localhost", "root", "", "mist_result");
		$ans=array();
		
	$aplus=0;
	$a=0;
	$aminus=0;
	$bplus=0;
	$b=0;
	$bminus=0;
	$c=0;
	$d=0;
	$f=0;
	
	
		
		
		$query="select s.subjectid,sb.coursenumber,sb.subject,sb.creditunit,s.gradetitle,s.gradepoints from semestergrades s join subjects sb using (subjectid) join classes c using(classid) where studentid=22700 and c.semesterid in (select distinct semesterid from classes where classid in (select classid from semestergrades where studentid=22700))";
	$row = mysqli_query($con,$query);
	$totalsubject=0;
    while($rowvalue=mysqli_fetch_array($row,MYSQLI_ASSOC))
	{
		//echo $rowvalue['gradetitle'];
		switch($rowvalue['gradetitle']){
			case "A+":
				$aplus++;
				break;
			Case "A":
				$a++;
				break;
			Case "A-":
				$aminus++;
				break;
			Case "B+":
				$bplus++;
				break;
			Case "B":
				$b++;
				break;
			Case "B-":
				$bminus++;
				break;
			Case "C":
				$c++;
				break;
			Case "D":
				$d++;
				break;
			Case "F":
				$f++;
				break;
		}
	}
	
	$aplus*=68;
	$a*=68;
	$aminus*=68;
	$bplus*=68;
	$b*=68;
	$bminus*=68;
	$c*=68;
	$d*=68;
	$f+=68;
	$res="";
	$res.="['Grade', 'NO of Subject'],";
	$res.="['A+', $aplus],";
	$res.="['A', $a],";
	$res.="['A-', $aminus],";
	$res.="['B+', $bplus],";
	$res.="['B', $b],";
	$res.="['B-', $bminus],";
	$res.="['C', $c],";
	$res.="['D', $d],";
	$res.="['F', $f],";
	//echo $res;
	    
	
	
	
?>
<!DOCTYPE html>
<html class="no-js">
<head>
<title>GPA Percentage of DEPT</title>
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
    <div class="container-fluid"><img src="MIST.gif" width="60" height="60" align="left"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">Teacher's Panel</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li class="dropdown"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><?php
		  session_start(); 
		 echo $_SESSION['name'] 
		 ?> <i class="caret"></i> </a>
            <ul class="dropdown-menu">
              <li> <a tabindex="-1" href="index.html">Logout</a> </li>
            </ul>
          </li>
        </ul>
        <ul class="nav">
          <li class="dropdown"> <a href="basic.php" >Basic Information</a> </li>
          <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle">Mist Result <b class="caret"></b> </a>
            <ul class="dropdown-menu" id="menu1">
              <li> <a href="tabular.php">Tabular View </a> </li>
              <li> <a href="subjectgpapercentage.php">Subject Gpa Percentage of Student</a> </li>
              <li> <a href="termwisegpa.php">Term Wise GPA</a> </li>
              <li> <a href="gpagraphdept.php">GPA Graph Of DEPT</a> </li>
              <li> <a href="gparangesearch.php">GPA Range Search</a> </li>
              <li> <a href="subjectrangesearch.php">Subject Range Search</a> </li>
              <li> <a href="gradepercentagedept.php">Grade Percentage of DEPT</a> </li>
              <li> <a href="subjectpercentagedept.php">Subject GPA Percentage of DEPT</a> </li>
            </ul>
          </li>
          <li class="dropdown"> <a href="notification.php" >Notification</a> </li>
          <li class="dropdown"> <a href="generate.php" >Generate Transcript </a> </li>
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
    <medium>GPA Percentage of DEPT of CSE-13</medium>
  </div>
  <div class="pull-right"><span class="badge badge-warning"></span> </div>
</div>
<html>
<head>
<script type="text/javascript" src="assets/google.js"></script> 
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

		<?php
        echo "var data = google.visualization.arrayToDataTable([$res]);"
		?>

        var options = {
          title: 'Level 1 Term 1'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>

</div>
<div class="block">
<div class="navbar navbar-inner block-header">
  <div class="muted pull-left">
    <medium>GPA Percentage of DEPT of CSE-13</medium>
  </div>
  <div class="pull-right"><span class="badge badge-warning"></span> </div>
</div>
<html>
<head>
<script type="text/javascript" src="assets/google.js"></script> 
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

		<?php
        echo "var data = google.visualization.arrayToDataTable([$res]);"
		?>

        var options = {
          title: 'Level 1 Term 1'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>
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
<?php
	if(!empty($_GET['email'])||!empty($_POST['message'])||!empty($_POST['subject']))
	{
		
		//echo $_POST['message'];
		$var=mail($_GET['email'],$_POST['subject'],$_POST['message']);
		//$var=true;
		if($var == true)
		{
			$ok=true;
		}
		else
		{
			$ok=false;
		}
	}
	else
	{
		//echo $_POST['message'];
		$ok=false;			
	}
?>
<!DOCTYPE html>
<html class="no-js">
<head>
<title>Admin Home Page</title>
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
  <div class="row-fluid"> 
    
    <!--/span-->
    <div class="span9" id="content"> 
      <!-- morris stacked chart --> 
      
      <!-- validation -->
      <div class="row-fluid"> 
        <!-- block -->
        <div class="block">
          <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Email</div>
          </div>
          <div class="block-content collapse in">
            <div class="span12"> 
              <!-- BEGIN FORM-->
              
                    <label class="control-label">
                    	<?php
							if($ok == true)
								echo "Message Sending Successful";
							else
								echo "Error Occured";
						?>
                    <span class="required"></span></label>
              <!-- END FORM--> 
            </div>
          </div>
          <form action="notification.php" id="form_sample_1" class="form-horizontal" >
                   <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-inverse" type="submit">Back</button>
                    </div>
                  </div>
                  
                </form>
        <!-- /block --> 
      </div>
      <!-- /validation --> 
      
      
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
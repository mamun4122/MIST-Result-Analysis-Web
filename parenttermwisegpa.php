<?php
	$con=new mysqli("localhost", "root", "", "mist_result");
	session_start();
	if(!empty($_SESSION['roll'])){
		$ans=array();
	$idnumber=$_SESSION['roll'];
    $query = "select studentid from students where idnumber = '$idnumber' ";
   	$row = mysqli_query($con,$query);
	$id="";
    while($rowvalue=mysqli_fetch_array($row,MYSQLI_ASSOC))
	{
		$id=$rowvalue['studentid'];
	}
	$query="select * from students where studentid = $id ";
	$row=mysqli_query($con,$query);
	while($rowvalue=mysqli_fetch_array($row,MYSQLI_ASSOC))
	{
		$studentname=$rowvalue['firstName'] . " " . $rowvalue['middleName'] . " " . $rowvalue["lastName"];
		$batchnumber=$rowvalue['batchNumber'];
		$email=$rowvalue['email'];
		$cellphone=$rowvalue['cellPhone'];
	}
	$query = "SELECT Distinct L.levelName from Levels L , Registrations R where R.studentId= $id and R.levelId=L.levelId limit 0,1";
   	$row = mysqli_query($con,$query);
    while($rowvalue=mysqli_fetch_array($row,MYSQLI_NUM))
	{
		$dept=$rowvalue[0];
	}
	$query = "SELECT DISTINCT SUBSTRING(S.title,7,1) FROM ClassStudentReltn R, Classes C, Semesters S WHERE R.studentId= $id AND R.classId=C.classId AND C.semesterId=S.semesterId ORDER BY S.endDate desc LIMIT 1";
   	$row = mysqli_query($con,$query);
    while($rowvalue=mysqli_fetch_array($row,MYSQLI_NUM))
	{
		$level=$rowvalue[0];
	}
	$sql = "select distinct semesterid from classes where classid in (select classid from semestergrades where studentid= $id ) ";
	$cnt=0;
	$cgpa=0.0;
	//echo $sql;
	$row = mysqli_query($con,$sql);
	while($rowvalue=mysqli_fetch_array($row,MYSQLI_ASSOC))
	{
		$cnt++;
		$semesterid=$rowvalue['semesterid'];
		$sql = "select title from semesters where semesterid= $semesterid " ;
		//echo $sql;
		$result=mysqli_query($con,$sql);
		$name="'";
		while($rwval=mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$name=$name . $rwval['title'];
			//echo $name;
		}
		$name=$name . "'";
		//echo $name;
		$sql = "select sum(sb.creditunit),sum(s.gradepoints) from semestergrades s join subjects sb using (subjectid) join classes c using(classid) where studentid= $id
		and c.semesterid= $semesterid";
		$result=mysqli_query($con,$sql);
		$gpa=0.0;
		while($rwval=mysqli_fetch_array($result,MYSQLI_NUM))
		{
			$gpa=$rwval[1]/$rwval[0];
			$gpa=sprintf('%0.2f', $gpa);
		}
		$cgpa+=$gpa;
		array_push($ans,'{levels: ' . $name . ', GPA: ' . $gpa . '},');  
		}
		$res="";
		foreach($ans as &$val)
		{
			$res=$res . $val .PHP_EOL;
		}
	$cgpa=$cgpa/$cnt;
	$cgpa=sprintf('%0.2f', $cgpa);
	
	
	}
	else
	{
		$cgpa=0.0;
		$ans=array();
		$idnumber="";
		$id='Some value here';
		$idnumber='Some value here';
		$studentname='Some value here';
		$batchnumber='Some value here';
		$cellphone='Some value here';
		$dept='Some value here';
		$level='Some value here';
		$email='Some value here';
		
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<title>Term Wise GPA</title>
<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="assets/styles.css" rel="stylesheet" media="screen">
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid"><img src="MIST.gif" width="60" height="60" align="left"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">Parent's Panel</a>
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
          <li class="dropdown"> <a href="parentbasic.php" >Basic Information</a> </li>
              <li> <a href="parentsubjectgpapercentage.php">Subject Gpa Percentage of Student</a> </li>
              <li> <a href="parenttermwisegpa.php">Term Wise GPA</a> </li>
              <li> <a href="parentgpagraphdept.php">GPA Graph Of DEPT</a> </li>
          </li>
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
          <div class="muted pull-left">Basic Information</div>
        </div>
        <div class="block-content collapse in">
          <div class="span12"> 
            <!-- BEGIN FORM-->
            <form id="form_sample_1" class="form-horizontal" >
              <div class="control-group">
                <label class="control-label">Student Name</label>
                <div class="controls"> <span class="input-xlarge uneditable-input"> <?php echo $studentname; ?> </span> </div>
              </div>
              <div class="control-group">
                <label class="control-label">Student Id</label>
                <div class="controls"> <span class="input-xlarge uneditable-input"> <?php echo $idnumber; ?> </span> </div>
              </div>
              <div class="control-group">
                <label class="control-label">DEPT</label>
                <div class="controls"> <span class="input-xlarge uneditable-input"> <?php echo $dept; ?> </span> </div>
              </div>
              <div class="control-group">
                <label class="control-label">Batch</label>
                <div class="controls"> <span class="input-xlarge uneditable-input"> <?php echo $batchnumber; ?> </span> </div>
              </div>
              <div class="control-group">
                <label class="control-label">Level</label>
                <div class="controls"> <span class="input-xlarge uneditable-input"> <?php echo $level; ?> </span> </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls"> <span class="input-xlarge uneditable-input"> <?php echo $email; ?> </span> </div>
              </div>
              <div class="control-group">
                <label class="control-label">Contract</label>
                <div class="controls"> <span class="input-xlarge uneditable-input"> <?php echo $cellphone; ?> </span> </div>
              </div>
            </form>
            <!-- END FORM--> 
          </div>
        </div>
      </div>
      <!-- /block --> 
    </div>
    <!-- /validation --> 
    
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
            <medium>Term Wise GPA of <?php echo $idnumber . ' Current CGPA '. $cgpa ?></medium>
          </div>
          <div class="pull-right"><span class="badge badge-warning"></span> </div>
        </div>
        <div class="block-content collapse in">
          <div class="span12">
            <div id="hero-bar" style="height: 230px;"></div>
          </div>
        </div>
      </div>
  <hr>
  <footer>
    <p>2015 &copy; Military Institute of Science & Technology (MIST) all rights reserved. </p>
  </footer>
      <!-- /block -->
    </div>
  </div>
</div>
<!--/.fluid-container-->
<link rel="stylesheet" href="vendors/morris/morris.css">
<script src="vendors/jquery-1.9.1.min.js"></script>
<script src="vendors/jquery.knob.js"></script>
<script src="vendors/raphael-min.js"></script>
<script src="vendors/morris/morris.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="vendors/flot/jquery.flot.js"></script>
<script src="vendors/flot/jquery.flot.categories.js"></script>
<script src="vendors/flot/jquery.flot.pie.js"></script>
<script src="vendors/flot/jquery.flot.time.js"></script>
<script src="vendors/flot/jquery.flot.stack.js"></script>
<script src="vendors/flot/jquery.flot.resize.js"></script>
<script src="assets/scripts.js"></script>
<script>
        $(function() {
        doPlot("right");

        });
         //Morris Bar Chart
		 <?php
		 echo "Morris.Bar({
            element: 'hero-bar',
			data:[$res],
            xkey: 'levels',
            ykeys: ['GPA'],
            labels: ['GPA'],
            barRatio: 0.4,
            xLabelMargin: 10,
            hideHover: 'auto',
        });"
		?>
		//document.write(5+6);
        </script>
</body>
</html>

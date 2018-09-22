<?php
	$con=new mysqli("localhost", "root", "", "mist_result");
	if(!empty($_POST['roll'])){
		$ans=array();
	$idnumber=$_POST['roll'];
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
	$cgpa=$cgpa/$cnt;
	//echo $cgpa;
	//echo $cnt;
	$cgpa=sprintf('%0.2f', $cgpa);
		//echo $res;
		
		
		$query="select s.subjectid,sb.coursenumber,sb.subject,sb.creditunit,s.gradetitle,s.gradepoints from semestergrades s join subjects sb using (subjectid) join classes c using(classid) where studentid=$id and c.semesterid in (select distinct semesterid from classes where classid in (select classid from semestergrades where studentid=$id))";
	$row = mysqli_query($con,$query);
	$totalsubject=0;
	$aplus=0;
	$a=0;
	$aminus=0;
	$bplus=0;
	$b=0;
	$bminus=0;
	$c=0;
	$d=0;
	$f=0;
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
<title>Subject GPA Percentage</title>
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
    <div class="container-fluid"> <img src="MIST.gif" width="60" height="60" align="left"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">Teacher's Panel</a>
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
          <div class="muted pull-left"> <small>Enter ID Number</small></div>
          <div class="pull-right"><span class="badge badge-warning"></span> </div>
        </div>
        <div class="block-content collapse in">
          <div class="span12"> 
            <!-- BEGIN FORM-->
            <form method="post" action="subjectgpapercentage.php" id="form_sample_1" class="form-horizontal" >
              <div class="control-group">
                <label class="control-label">ID<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="roll" data-required="1" class="span6 m-wrap"/>
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                  <button class="btn btn-inverse" type="submit">Show</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /block --> 
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
      <medium>Subject GPA Percentage of <?php echo $idnumber . ' Current CGPA '. $cgpa ?></medium>
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
          title: 'Subject GPA Percentage of Student'
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
</body>
</html>
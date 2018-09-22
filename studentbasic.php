<?php
	session_start();
	$con=new mysqli("localhost", "root", "", "mist_result");
	if(!empty($_SESSION['roll'])){
	$idnumber=$_SESSION['roll'];
    $query = "select studentid from students where idnumber = $idnumber ";
   	$row = mysqli_query($con,$query);
    while($rowvalue=mysqli_fetch_array($row,MYSQLI_ASSOC))
	{
		$id=$rowvalue['studentid'];
	}
	$query="select * from students where studentid = $id ";
	$row=mysqli_query($con,$query);
	while($rowvalue=mysqli_fetch_array($row,MYSQLI_ASSOC))
	{
		$name=$rowvalue['firstName'] . " " . $rowvalue['middleName'] . " " . $rowvalue["lastName"];
		$batchnumber=$rowvalue['batchNumber'];
		$dateofbirth=$rowvalue['dateOfBirth'];
		$email=$rowvalue['email'];
		$cellphone=$rowvalue['cellPhone'];
		$nationality=$rowvalue['citizenship'];
		$adress=$rowvalue['address'] ;
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
	
	}
	else
	{
		$id='Some value here';
		$idnumber='Some value here';
		$name='Some value here';
		$batchnumber='Some value here';
		$dateofbirth='Some value here';
		$cellphone='Some value here';
		$nationality='Some value here';
		$adress='Some value here';
		$dept='Some value here';
		$level='Some value here';
		$email='Some value here';
		
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<title>Basic Information</title>
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
    <div class="container-fluid"><img src="MIST.gif" width="60" height="60" align="left"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">Student's Panel</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li class="dropdown"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><?php
		  //session_start();
		   echo $_SESSION['name'] ?> <i class="caret"></i> </a>
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
              <form method="post" action="basic.php" id="form_sample_1" class="form-horizontal" >
                   <div class="control-group">
                    <label class="control-label">Student Name</label>
                    <div class="controls"> <span class="input-xlarge uneditable-input">
                    		<?php echo $name; ?>
                        </span> 
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Student Id</label>
                    <div class="controls"> <span class="input-xlarge uneditable-input">
                    		<?php echo $idnumber; ?>
                        </span> 
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">DEPT</label>
                    <div class="controls"> <span class="input-xlarge uneditable-input">
                    		<?php echo $dept; ?>
                        </span> 
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Batch</label>
                    <div class="controls"> <span class="input-xlarge uneditable-input">
                    		<?php echo $batchnumber; ?>
                        </span> 
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Level</label>
                    <div class="controls"> <span class="input-xlarge uneditable-input">
                    		<?php echo $level; ?>
                        </span> 
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Date Of Birth</label>
                    <div class="controls"> <span class="input-xlarge uneditable-input">
                    		<?php echo $dateofbirth; ?>
                        </span> 
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Email</label>
                    <div class="controls"> <span class="input-xlarge uneditable-input">
                    		<?php echo $email; ?>
                        </span> 
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Contract</label>
                    <div class="controls"> <span class="input-xlarge uneditable-input">
                    		<?php echo $cellphone; ?>
                        </span> 
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Nationality</label>
                    <div class="controls"> <span class="input-xlarge uneditable-input">
                    		<?php echo $nationality; ?>
                            </span>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Address</label>
                    <div class="controls"> <span class="textarea">
                    		<?php echo $adress; ?>
                        </span> 
                    </div>
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
  <hr>
  <footer>
    <p>2015 &copy; Military Institute of Science & Technology (MIST) all rights reserved. </p>
  </footer>
</div>
<!--/.fluid-container-->
<link href="vendors/datepicker.css" rel="stylesheet" media="screen">
<link href="vendors/uniform.default.css" rel="stylesheet" media="screen">
<link href="vendors/chosen.min.css" rel="stylesheet" media="screen">
<link href="vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
<script src="vendors/jquery-1.9.1.js"></script> 
<script src="bootstrap/js/bootstrap.min.js"></script> 
<script src="vendors/jquery.uniform.min.js"></script> 
<script src="vendors/chosen.jquery.min.js"></script> 
<script src="vendors/bootstrap-datepicker.js"></script> 
<script src="vendors/wysiwyg/wysihtml5-0.3.0.js"></script> 
<script src="vendors/wysiwyg/bootstrap-wysihtml5.js"></script> 
<script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script> 
<script type="text/javascript" src="vendors/jquery-validation/dist/jquery.validate.min.js"></script> 
<script src="assets/form-validation.js"></script> 
<script src="assets/scripts.js"></script> 

</body>
</html>
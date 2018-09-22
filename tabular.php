<!DOCTYPE html>
<html class="no-js">
<head>
<title>Tabular View</title>
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
          <li class="dropdown"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>Gp Capt. Afzal Hossain <i class="caret"></i> </a>
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
<div class="row-fluid"> 
  <!-- block -->
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left">GPA of all student of CSE-13</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Student ID </th>
              <th>Student Name</th>
              <th>Level 1 Term 1 2013</th>
              <th>Level 1 Term 2 2013</th>
            </tr>
          </thead>
          <tbody>
            <?php
				$roll=array(201214018, 201214034, 201214047, 201314001, 201314002, 201314003, 201314004, 201314005, 201314006, 201314007, 201314008, 201314009, 201314010, 201314011, 201314012, 201314013, 201314014, 201314015, 201314016, 201314017, 201314018, 201314019, 201314020, 201314021, 201314022, 201314023, 201314024, 201314025, 201314026, 201314027, 201314028, 201314029, 201314030, 201314031, 201314032, 201314033, 201314034, 201314035, 201314036, 201314037, 201314038, 201314039, 201314040, 201314041, 201314042, 201314043, 201314044, 201314045, 201314046, 201314047, 201314048, 201314049, 201314050, 201314051, 201314052, 201314053, 201314054, 201314055, 201314056, 201314057, 201314058, 201314059, 201314060, 201314061, 201314062, 201314063, 201314064, 201314065, 201314066);
	$level11=array(2.93, 3.0, 3.18, 3.87, 3.96, 3.74, 3.36, 3.67, 3.64, 4.0, 2.59, 3.73, 2.86, 3.42, 3.15, 3.27, 3.43, 2.97, 3.91, 3.13, 3.6, 3.65, 3.93, 2.32, 3.1, 2.91, 3.91, 3.16, 3.73, 3.81, 3.78, 3.2, 3.86, 2.98, 3.55, 2.69, 2.75, 2.92, 3.31, 3.84, 3.11, 3.56, 3.55, 3.35, 3.15, 3.32, 3.85, 3.4, 2.86, 3.86, 3.17, 3.19, 3.84, 3.02, 3.05, 2.29, 3.08, 3.57, 3.95, 3.3, 3.39, 3.84, 2.87, 2.94, 2.65, 3.33, 3.02, 2.32, 3.87);
	$level12=array(2.0,2.64, 2.79, 3.64, 3.89, 3.15, 3.06, 3.2, 3.06, 3.82, 2.59, 3.39, 1.33, 3.39, 2.51, 3.02, 2.95, 2.39, 3.8, 2.41, 3.46, 3.57, 0.0, 1.69, 2.72, 2.05, 3.44, 2.57, 3.37, 3.48, 3.02, 3.2, 3.51, 2.81, 2.91, 2.65, 2.4, 2.56, 2.76, 3.53, 2.7, 3.15, 0.0, 2.88, 2.58, 2.54, 3.6, 3.22, 2.72, 3.58, 2.89, 3.0, 3.59, 2.61, 2.52, 1.22,2.46, 3.05, 3.62, 3.05, 2.9, 3.73, 2.4, 2.51, 2.54, 2.75, 2.67, 1.13, 3.51);
	$name=array('Umme  Hany', 'Sanjida Afrin Mitul', 'Md. Fazle  Rabby', 'Md Nazmul  Hossain', 'Shadman Sipar Ocean', 'Md Faruk Hussain Khan Khan', 'Md Shahriar  Rajib', 'Mohammad Ariful Haque Chowdhury', 'Jabber  Ahmed', 'Md Mahfuzur  Rahman', 'Mahmuda  Khatun', 'Humayara Binte Rashid', 'Pia Silvia Rozario', 'Shubhashis Roy Dipta', 'Maliha  Tabassum', 'Md Imtiaz  Abedin', 'Md. Mahmudur  Rahman', 'Sumaita  Khan Sanila', 'AFIA  ANJUM','Sadman Sakib Saumik', 'Mainul  Polash', 'Progga Laboni Pritu', 'Ashratuz Zavin Asha', 'Promit  Saha', 'Annita  Tahsin Priyoti', 'Mehnaz  maharin', 'Nusrat  Jahan', 'Arnab  Roy', 'Itisha  Nowrin', 'Fatima  Jannat', 'Majidur  Rahman', 'Asfaqur Rahman Sourav', 'Antara  Mahmud', 'Shakil  Ahmed', 'Maksuda Rahman Anti', 'Proma  Roy', 'Maroof Abdul Matin', 'Sadiya Sayara Chowdhury Puspo', 'S. M.  Kamaruzzaman', 'Zareen  Tasneem', 'Md.  Shamsuzzaman', 'Warda Ruheen Bristi', 'Fahim  Anzum', 'MAHEDI  HASAN', 'Qazi  Noor', 'Nawshin  Nazrul', 'Tarannum  Zaki', 'Tarikul Islam Shazan', 'Tanu  Dewan', 'Ayeasha  Akhter', 'Adnan  Kamal', 'Ismat  Tarik', 'Fahima  Khanam', 'K.M. Salman  Soumik', 'Masum Masum Billah Shakil', 'Tanzina Afroz Rimi','Niloy Roy ANTU', 'Farhana Afroz Shila', 'Fariha  Chowdhury', 'Jubair  Hossain', 'Nishat Nishat Sultana', 'Zinia  Sultana', 'Sami  Uddin', 'Zaki Tasnim Duti', 'Tarikul Islam Shazan', 'Mohaimen  Rahman', 'Aafra  Alam', 'Samina kamal Upama', 'Adeeba  Anis');
	$arrlength = count($roll);
	for($x = 0; $x < $arrlength; $x++) {
			
			echo "<tr>";
            echo "<td>$roll[$x]</td>";
            echo "  <td>$name[$x]</td>";
            echo "  <td>$level11[$x]</td>";
            echo "  <td>$level12[$x]</td>";
            echo "</tr>";
	}

									  		
			?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /block --> 
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
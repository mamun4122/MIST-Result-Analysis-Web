<?php

//load and connect to MySQL database stuff
require("config.inc.php");
session_start();

if (!empty($_POST)) {
    //gets user's info based off of a username.
    $query = " 
            SELECT 
                username, 
                password,
				fullname,
				role
            FROM users 
            WHERE 
                username = :username 
        ";
    
    $query_params = array(
        ':username' => $_POST['username']
    );
    $name="";
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
        // For testing, you could use a die and message. 
        //die("Failed to run query: " . $ex->getMessage());
        
        //or just use this use this one to product JSON data:
        $response["success"] = 0;
        $response["message"] = "Database Error1. Please Try Again!";
        die(json_encode($response));
        
    }
	//echo $_POST['username'];
    
    //This will be the variable to determine whether or not the user's information is correct.
    //we initialize it as false.
    $validated_info = false;
    $login_ok=-1;
    //fetching all the rows from the query
    $row = $stmt->fetch();
    if ($row) {
        //if we encrypted the password, we would unencrypt it here, but in our case we just
        //compare the two passwords
        if ($_POST['password'] === $row['password']) {
			if($_POST['role'] === $row['role'])
			{
				$login_ok=$row['role'];
				$_SESSION['name']=$row['fullname'];
				$_SESSION['roll']=$row['username'];
				//$_SESSION['name']="mamun";
			}
            //$login_ok = true;
        }
    }
    
    // If the user logged in successfully, then we send them to the private members-only page 
    // Otherwise, we display a login failed message and show the login form again 
    if ($login_ok==0) {
       header("Location:http://localhost/mist/basic.php"); 
    }else if($login_ok==1) {
        header("Location:http://localhost/mist/studentbasic.php"); 
    }else if($login_ok==2){
		$sql= " select accessid from parents where username = '" . $_SESSION['roll'] . "'" ;
		$con=new mysqli("localhost", "root", "", "mist_result");
		$row = mysqli_query($con,$sql);
		while($rowvalue=mysqli_fetch_array($row,MYSQLI_ASSOC))
	{
		$_SESSION['roll']=$rowvalue['accessid'];
	//	echo "mamun";
		//echo $_SESSION['roll'];
	}
        header("Location:http://localhost/mist/parentbasic.php"); 
    } else {
        header("Location:http://localhost/mist/index.html"); 
    }
} else {
	header("Location:http://localhost/mist/index.html"); 
}

?>

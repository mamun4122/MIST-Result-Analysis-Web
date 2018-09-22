<?php
include('conn.php');
session_start();

$check=$_SESSION['login_mail'];
$session=mysql_query("SELECT name,username,user_id,email,password,propic FROM `login` WHERE email='$check'");
$row=mysql_fetch_array($session);
$login_session=$row['username'];
$login_name=$row['name'];
$login_id=$row['user_id'];
$login_mail=$row['email'];
$login_password=$row['password'];
$login_propic=$row['propic'];
/*if(!isset($login_session))
header("location:index.php");*/
?>
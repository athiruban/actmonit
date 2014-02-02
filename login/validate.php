<?php

require('../lib/dbutils.php');

	$token = connectToDBServer();
	$result = connectToDB($token);
	
	if($result==true) {
	}
	else {
		//display error form 
		echo "Database is currently down";
	}
	
	$username=$_POST['loguname'];
	$password=$_POST['logpass'];
	
	echo $username;
	echo $password;

	$res = isValidUser($token,$username,$password);
	
	if($res==true){
		echo "Valid User";
	}
	else {
		echo "Not a valid user";
	}
	
/*
	$query = "select * from $table_name where username = '$username' and password = '$password'";
	
	$count = mysql_num_rows(mysql_query($query));	

	if($count == 1 )
	{
		session_start(); 
		$_SESSION['user'] = $username;
		// redirect to wall.............
		header("Location: http://localhost/amass/wall");		
	}
	else
	{
		echo "Login Failure";
		echo "\n\nTry Again";
	}
*/	
?>
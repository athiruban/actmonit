<?php
    require('../lib/dbutils.php');

    $token = connectToDBServer();
    $result = connectToDB($token);
	
    if($result==false) {
	echo "Database is currently down";
        exit(0); 
    }
    $username=$_POST['loguname'];
    $password=$_POST['logpass'];
    $res = isValidUser($token,$username,$password);

    if($res==true){
	$emp_design = getEmpDesignation($token,$username);
	session_start();
	$_SESSION['emp_id']=$username;
	$_SESSION['emp_design']=$emp_design;
	$_SESSION['emp_password']=$password;
	header("Location: ".FULLPATH."/home");
    }
    else {
        echo "Not a valid user";
	echo "<a href=".FULLPATH."> Go Back </a>";
    }	
?>

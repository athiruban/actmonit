<?php
    require('../lib/dbutils.php');

    $emp_fname = $_POST['fname'];
    $emp_sname = $_POST['lname'];
    $emp_designation = $_POST['design'];
    $emp_dob = $_POST['dob'];
    $emp_phno = $_POST['pno'];
    $emp_primary_skill = $_POST['pskill'];
    $emp_sec_skill = $_POST['sskill'];
    $emp_address = $_POST['resaddr'];

    $token=connectToDBServer();
    $return=connectToDB($token);
    
    if($return==true) {
        $return=addNewEmployee($token, $emp_fname, $emp_sname, $emp_designation, $emp_dob, 
		$emp_phno, $emp_primary_skill, $emp_sec_skill, $emp_address);
	if($return==100){
	    echo 'Emp ID not found';
	}
	else if($return==300){
            echo 'Emp Insertion failed!';
	}
	else if($return==400){
	    echo 'Login Insertin failed';
	}
	else echo 'Your Employee ID is : '.$return;
    }
    else {
	 echo 'DB Not started!';
    }	    

?> 


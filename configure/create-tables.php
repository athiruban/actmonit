
<?php

	require ('../lib/dbutils.php');

	$link=connectToDBServer();

	echo "Wamp Server is up!"."Token is".$link;
	echo "<br> Checking DB already exists!";

	if(checkDBExists($link)==true){
		die ("DB is already there! Can't reset tables. Remove the DB by logging into the server.");
	}
	else echo "DB is not created!";

	sleep(3);

	echo "<br> Creating DB!";

	$command1 = "CREATE DATABASE epmas";

	if(executeCommand($link, $command1)==true) echo "<BR>DB Created!";
	else echo "<BR>DB Creation failed";

	connectToDB($link);

	$command2 = "CREATE TABLE SKILLS (skill_cd CHAR(5), skill_desc CHAR(30)) ENGINE=INNODB";
	
	if(executeCommand($link, $command2)==true) echo "<BR>SKILLS table Created!";
	else echo "<BR>SKILLS table Creation failed";

	$command3 = "CREATE TABLE DESIGNATION(
	designation_cd CHAR(5), 
	designation_desc CHAR(40)
	) ENGINE=INNODB;";
	if(executeCommand($link, $command3)==true) echo "<BR>DESIGNATION table Created!";
	else echo "<BR>DESIGNATION table Creation failed";

	$command4 = "CREATE TABLE EMPLOYEE(
	emp_fname VARCHAR(20) NOT NULL, 
	emp_sname VARCHAR(20) NOT NULL, 
	emp_id INT(6) PRIMARY KEY auto_increment, 
	supervisor_id INT(6) references EMPLOYEE(emp_id),
	emp_designation CHAR(5) references DESIGNATION(designation_cd), 
	emp_dob CHAR(10) NOT NULL, 
	emp_phno CHAR(10), 	
	emp_primary_skill CHAR(5) references SKILLS(skill_cd), 
	emp_sec_skill CHAR(5) references SKILLS(skill_cd), 
	emp_address VARCHAR(70) NOT NULL, 
	validity CHAR(1) DEFAULT 'Y'
	) ENGINE=INNODB;";
	if(executeCommand($link, $command4)==true) echo "<BR>EMPLOYEE table Created!";
	else echo "<BR>EMPLOYEE table Creation failed";

	$command5 = "CREATE TABLE LOGIN(
	emp_id INT(6) references EMPLOYEE(emp_id), 
	password CHAR(8) NOT NULL
	) ENGINE=INNODB;";
	if(executeCommand($link, $command5)==true) echo "<BR>LOGIN table Created!";
	else echo "<BR>LOGIN table Creation failed";

	$command6 = "CREATE TABLE JOB(
	job_id INT(7) PRIMARY KEY auto_increment, 
	job_desc VARCHAR(1000) NOT NULL, 
	status CHAR(1), 
	updates VARCHAR(2000),
	assign_to INT(6) references EMPLOYEE(emp_id), 
	created_by  INT(6) references EMPLOYEE(emp_id),
	created_on DATETIME NOT NULL, 
	last_changed DATETIME NOT NULL,
	validity CHAR(1) DEFAULT 'Y'
	) ENGINE=INNODB;";
	if(executeCommand($link, $command6)==true) echo "<BR>JOB table Created!";
	else echo "<BR>JOB table Creation failed";

	$command7 = "CREATE TABLE JOB_H(
	job_id INT(7) references JOB(job_id),
	status CHAR(1) NOT NULL,
	updates VARCHAR(2000),
	assign_to INT(6) references EMPLOYEE(emp_id), 
	last_changed DATETIME NOT NULL
	) ENGINE=INNODB;";
	if(executeCommand($link, $command7)==true) echo "<BR>JOB_H table Created!";
	else echo "<BR>JOB_H table Creation failed";

	$command8 = "CREATE TABLE LEAVE_REQ(
	req_cd INT(7) PRIMARY KEY auto_increment,
	emp_id INT(6) references EMPLOYEE(emp_id), 
	applied_on DATETIME NOT NULL,
	status CHAR(1),
	reason VARCHAR(200) NOT NULL,
	pending_with INT(6) references EMPLOYEE(emp_id),
	validity CHAR(1) DEFAULT 'Y'
	) ENGINE=INNODB;";
	if(executeCommand($link, $command8)==true) echo "<BR>LEAVE_REQ table Created!";
	else echo "<BR>LEAVE_REQ table Creation failed";
?>





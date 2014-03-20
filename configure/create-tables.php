
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

	$command2a = "INSERT INTO SKILLS (skill_cd, skill_desc) VALUES ('JV','CORE JAVA')";
	$command2b = "INSERT INTO SKILLS (skill_cd, skill_desc) VALUES ('MF','MAINFRAME')";
	$command2c = "INSERT INTO SKILLS (skill_cd, skill_desc) VALUES ('DN','MS DOT NET')";
	$command2d = "INSERT INTO SKILLS (skill_cd, skill_desc) VALUES ('PH','PHP 5')";
	$command2e = "INSERT INTO SKILLS (skill_cd, skill_desc) VALUES ('TW','TECHNICAL WRITER')";
	$command2f = "INSERT INTO SKILLS (skill_cd, skill_desc) VALUES ('BL','BLOGGER')";
	$command2g = "INSERT INTO SKILLS (skill_cd, skill_desc) VALUES ('GD','GRAPHIC DESIGNER')";
	$command2h = "INSERT INTO SKILLS (skill_cd, skill_desc) VALUES ('AC','APPLICATION DEVELOPER')";
	if(executeCommand($link, $command2a)==true
		&& executeCommand($link, $command2b)==true
		&& executeCommand($link, $command2c)==true
		&& executeCommand($link, $command2d)==true
		&& executeCommand($link, $command2e)==true
		&& executeCommand($link, $command2f)==true
		&& executeCommand($link, $command2g)==true
		&& executeCommand($link, $command2h)==true)
		echo "<BR>DEFAULT SKILL ROWS ARE INSERTED";
	else echo "<BR>DEFAULT SKILL ROWS ARE NOT INSERTED";

	$command3 = "CREATE TABLE DESIGNATION(
	designation_cd CHAR(5), 
	designation_desc CHAR(40)
	) ENGINE=INNODB;";
	if(executeCommand($link, $command3)==true) echo "<BR>DESIGNATION table Created!";
	else echo "<BR>DESIGNATION table Creation failed";

	$command3a = "INSERT INTO DESIGNATION (designation_cd,designation_desc) VALUES ('M','PROJECT MANAGER')";
	$command3b = "INSERT INTO DESIGNATION (designation_cd,designation_desc) VALUES ('P','PROGRAMMER ANALYST')";
	$command3c = "INSERT INTO DESIGNATION (designation_cd,designation_desc) VALUES ('L','TEAM LEADER')";
	if(executeCommand($link, $command3a)==true
		&& executeCommand($link, $command3b)==true
		&& executeCommand($link, $command3c)==true)
		echo "<BR>DEFAULT DESIGNATION ROWS ARE INSERTED";
	else echo "<BR>DEFAULT DESIGNATION ROWS ARE NOT INSERTED";

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
    emp_photo VARCHAR(50), 
	validity CHAR(1) DEFAULT 'Y'
	) ENGINE=INNODB;";
	if(executeCommand($link, $command4)==true) echo "<BR>EMPLOYEE table Created!";
	else echo "<BR>EMPLOYEE table Creation failed";

	$command4a="ALTER TABLE EMPLOYEE AUTO_INCREMENT = 100000;";
	if(executeCommand($link, $command4a)==true) echo "<BR>EMPLOYEE table autoincrement Changed!";
	else echo "<BR>EMPLOYEE table autoincrement change failed";

        $command4b = "INSERT INTO EMPLOYEE(
	emp_fname, 
	emp_sname,  
	emp_designation, 
	emp_dob, 
	emp_phno, 	
	emp_primary_skill, 
	emp_sec_skill, 
	emp_address
        ) VALUES
        (
        'ADMIN',
        'EPMAS',
        'M',
        '01/01/0001',
        0000000000,
        'JV',
        'TW',
        'India'
	)";
	if(executeCommand($link, $command4b)==true) echo "<BR>Default Admin row Created!";
	else echo "<BR>Default Admin row failed";


	$command5 = "CREATE TABLE LOGIN(
	emp_id INT(6) references EMPLOYEE(emp_id), 
	password CHAR(8) NOT NULL
	) ENGINE=INNODB;";
	if(executeCommand($link, $command5)==true) echo "<BR>LOGIN table Created!";
	else echo "<BR>LOGIN table Creation failed";

        $command5a = "INSERT INTO LOGIN(
	emp_id, 
	password
        ) VALUES 
        (
            100000,
            '123'   
        );";
	if(executeCommand($link, $command5a)==true) echo "<BR> Default login row for Admin  Inserted!";
	else echo "<BR>Default login row for admin failed";

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

	$command6a="ALTER TABLE JOB AUTO_INCREMENT = 1000;";
	if(executeCommand($link, $command6a)==true) echo "<BR>JOB table autoincrement Changed!";
	else echo "<BR>JOB table autoincrement change failed";


	$command6b="INSERT INTO job (
	job_desc,status,updates,assign_to,created_by,created_on,last_changed) VALUES
        ('dummy description', 
         'W',
         'some updates should go here', 
	 100000, 
	 100000, 
	 CURRENT_TIMESTAMP, 
	 CURRENT_TIMESTAMP);";

	if(executeCommand($link, $command6b)==true) echo "<BR>Dummy JOB insertion succeeded!";
	else echo "<BR>Dummy JOB insertion failed";


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
    leave_type CHAR(1), 
    lfrom CHAR(10) NOT NULL,
    lto CHAR(10) NOT NULL,
	status CHAR(1),
	reason VARCHAR(200) NOT NULL,
	pending_with INT(6) references EMPLOYEE(emp_id),
	validity CHAR(1) DEFAULT 'Y'
	) ENGINE=INNODB;";
	if(executeCommand($link, $command8)==true) echo "<BR>LEAVE_REQ table Created!";
    else echo "<BR>LEAVE_REQ table Creation failed";

    $command8a="ALTER TABLE LEAVE_REQ AUTO_INCREMENT = 1000;";
	if(executeCommand($link, $command8a)==true) echo "<BR>LEAVE REQUEST table autoincrement Changed!";
	else echo "<BR>LEAVE REQUEST table autoincrement change failed";
?>





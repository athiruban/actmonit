
<?php 

define ("DBNAME", "epmas");
define ("APP_USER", "root");
define ("APP_USER_PASS", "");
define ("HOST", "localhost");
define ("FULLPATH", "http://localhost/epmas");

	function dummy(){
		return "Hello, World!!";
	}

	function connectToDBServer(){
		$link =mysql_connect(HOST,APP_USER,APP_USER_PASS) or die ("DB is not UP");
		return $link;
	}

	function connectToDB($link){
		//mysql_connect(HOST,APP_USER,APP_USER_PASS) or die ("DB is not UP");
		mysql_select_db(DBNAME,$link);	
		return true;
	}

	function checkDBExists($link){
		$query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '".DBNAME."'";
		$resultset = mysql_query($query,$link);
		$rec_count = mysql_num_rows($resultset);	
		
		if($rec_count == 1 )
			return true;
		else
			return false;
	}

	function executeCommand($link, $command){
		$result = mysql_query($command,$link);
		return $result;
	}

	function executeQuery($link, $query){
		$resultset = mysql_query($query,$link);
		return $resultset;
	}

	function countRows($resultset){
		$rec_count=mysql_num_rows($resultset);
		return $rec_count;
	}

	function retrieveElement($resultset, $row, $col){
		return mysql_result($resultset,$row,$col);
	}

	function isValidUser($link, $emp_id, $password){
		$query="SELECT * FROM LOGIN WHERE emp_id=$emp_id AND password='$password'";
		$result=executeQuery($link,$query);
		$nrows=countRows($result);

		if($nrows==1) return true;
		else return false;	
	}

	function applyLeave($link, $emp_id, $applied_on, $reason){
		//GET THE SUPERVISOR ID
		$query="SELECT supervisor_id FROM EMPLOYEE WHERE emp_id=$emp_id;";
		$resultset=executeQuery($link,$query);
		if($resultset==false) { 
			// need to update the supervisor otherwise leave will not be given.
			return false;
		}
		$supervisor_id=retrieveElement($resultset,0,0);
		//APPLY LEAVE
		$command="INSERT INTO LEAVE_REQ(emp_id, applied_on, reason, pending_with, status) VALUES (
		$emp_id,'$applied_on','$reason',$supervisor_id,'P');";
		$result=executeCommand($link,$command);
		if($result==true) {
			// return the emp-id
			return true;
		}
		else return false;	
	}

	function cancelLeave($link, $leave_req_cd){
		$command="UPDATE LEAVE_REQ SET status ='C' WHERE req_cd=$leave_req_cd";
		$result=executeCommand($link,$command);
		return $result;	
	}

	function approveLeave($link, $leave_req_cd){
		$command="UPDATE LEAVE_REQ SET status ='A' WHERE req_cd=$leave_req_cd";
		$result=executeCommand($link,$command);
		return $result;	
	}

	function rejectLeave($link, $leave_req_cd){
		$command="UPDATE LEAVE_REQ SET status ='R' WHERE req_cd=$leave_req_cd";
		$result=executeCommand($link,$command);
		return $result;	
	}

	function addNewEmployee($link, $emp_fname, $emp_sname, $emp_designation, $emp_dob, 
							$emp_phno, $emp_primary_skill, $emp_sec_skill, $emp_address){
		$commanda="INSERT INTO EMPLOYEE (
		emp_fname, emp_sname, emp_designation, emp_dob, emp_phno, emp_primary_skill, emp_sec_skill, emp_address
		) VALUES ('$emp_fname', '$emp_sname', '$emp_designation', '$emp_dob','$emp_phno', '$emp_primary_skill',
		'$emp_sec_skill', '$emp_address');";

		$resulta=executeCommand($link,$commanda);

		if($resulta==true) {
			$queryb="SELECT MAX(emp_id) FROM EMPLOYEE;";
			$resultsetb=executeQuery($link,$queryb);
			if($resultsetb==false) { 
				// need to update the supervisor otherwise leave will not be given.
			return 100; // '100-employee id not found.
			}
			$emp_id=retrieveElement($resultsetb,0,0);
		    	// insert a row in login table.
		    	$commandb="INSERT INTO LOGIN {
		    	emp_id, password) VALUES ($emp_id, '12345678');";	
		    	// return the emp-id
		    	return $emp_id;
		}
		else return 300; // '300-employee insertion failed.							
	}
?>

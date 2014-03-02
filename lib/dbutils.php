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

function updateSupervisor($link, $emp_id, $spr_id){
    $emp_name=getEmpName($link, $emp_id);
    if($emp_name == '') 
        return 100;
    
    $spr_name=getEmpName($link, $spr_id);
    if($spr_name == '') 
        return 300;

    $commanda="UPDATE EMPLOYEE SET supervisor_id=".$spr_id." WHERE emp_id=".$emp_id.";";
    $resulta=executeCommand($link,$commanda);
    if($resulta==true)
        return "Supervisor of ".$emp_name." is updated with ".$spr_name; // success	
    else 
        return 400;
}

function applyLeave($link, $emp_id, $from, $to, $type, $reason){
    //GET THE SUPERVISOR ID
    $query="SELECT supervisor_id FROM EMPLOYEE WHERE emp_id=$emp_id;";
    $resultset=executeQuery($link,$query);
    if($resultset==false || is_null(retrieveElement($resultset,0,0))) { 
        // need to update the supervisor otherwise leave will not be given.
        return 100;
    }
    $supervisor_id=retrieveElement($resultset,0,0);
    //APPLY LEAVE
    $command="INSERT INTO LEAVE_REQ(emp_id, lfrom, lto, leave_type, reason, pending_with, status) VALUES (
    $emp_id,'$from','$to','$type','$reason',$supervisor_id,'P');";
    $result=executeCommand($link,$command);
    if($result==true) {
        $queryb="SELECT MAX(req_cd) FROM LEAVE_REQ;";
        $resultsetb=executeQuery($link,$queryb);
        if($resultsetb==false) { 
            return 400; // '100-employee id not found.
        }
        $req_cd=retrieveElement($resultsetb,0,0);
        return $req_cd;
    }
    else return 300; // leave update failed	
}

function convertLeaveStatus($leave_cd){
    if($leave_cd=='P'){
        return "Pending";
    }
    else if($leave_cd=='A'){
        return "Approved";
    }
    else if($leave_cd=='C'){
        return "Cancelled";
    }
    else if($leave_cd=='R'){
        return "Rejected";
    }
}

function convertLeaveType($leave_ty){
    if($leave_ty=='V'){
        return "Vacation";
    }
    else if($leave_ty=='S'){
        return "Sick";
    }
    else if($leave_ty=='P'){
        return "Personal";
    }
    else if($leave_ty=='O'){
        return "Others";
    }
}


function populateLeave($link, $emp_id){ 
    $query="SELECT emp_id, leave_type, lfrom, lto, status, reason, req_cd FROM leave_req WHERE pending_with = $emp_id AND status='P' ;";
    $resultset=executeQuery($link,$query);
    if($resultset==false||countRows($resultset)==0){
        echo '
        <div class="row">
            <div class="large-2 columns">
                <input type="text" value="NA" />
            </div>
            <div class="large-2 columns">
                <input type="text" value="NA" />
            </div>
            <div class="large-2 columns">
                <input type="text" value="NA" />
            </div>
            <div class="large-2 columns">
                <input type="text" value="NA" />
            </div>
            <div class="large-2 columns">
                <input type="text" value="NA" />
            </div>    
            <div class="large-2 columns">
                <textarea rows="5"> NA </textarea>
            </div>
        </div>
        ';
        return;
    }
    $nRows=countRows($resultset);
    if($nRows>=1){
        for($index=0; $index<$nRows; $index++){
            $who        = retrieveElement($resultset,$index,0);
            $leavetype  = retrieveElement($resultset,$index,1);
            $from       = retrieveElement($resultset,$index,2);
            $to         = retrieveElement($resultset,$index,3);
            $status     = retrieveElement($resultset,$index,4);
            $reason     = retrieveElement($resultset,$index,5);
            $leaveid    = retrieveElement($resultset,$index,6);
            echo '
                <div class="row">
                    <div class="large-2 medium-2 columns">
                        <input type="text" readonly value="'.$who.' - '.getEmpName($link, $who).'" />
                    </div>
                    <div class="large-2 medium-2 columns">
                        <input type="text" readonly value="'.convertLeaveType($leavetype).'" />
                    </div>
                    <div class="large-2 medium-2 columns">
                        <input type="text" readonly value="'.$from.'" />
                    </div>
                    <div class="large-2 medium-2 columns">
                        <input type="text" readonly value="'.$to.'" />
                    </div>
                    <div class="large-2 medium-2 columns">
                        <input type="text" readonly value="'.convertLeaveStatus($status).'" />
                    </div>    
                    <div class="large-2 medium-2 columns">
                        <textarea rows="5" readonly> "'.$reason.'" </textarea>
                    </div>
                </div>        
                <div class="row">
                    <div class="large-3 medium-3 columns">
                        <a id="approveLeave" style="color:White" onClick="approveLeaveClick('.$leaveid.')">
                            <img src="../../img/Approve.png" alt="Approve Leave" width="40px" height="40px" />
                        </a>
                    </div>
                    <div class="large-3 medium-3 columns">
                        <a id="applyLeave" style="color:White" onClick="rejectLeaveClick('.$leaveid.')">
                            <img src="../../img/reject.png" alt="Reject Leave" width="36px" height="36px" />
                        </a>
                    </div>
                    <div class="large-6 medium-6 columns"> </div>
                </div>
            ';
        }
    }
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

function addNewJob($link,$assignto, $jobdesc, $jobupdates, $created_by){
    // select and see if assign to is existing in the server....
    $querya="SELECT * FROM EMPLOYEE WHERE emp_id=$assignto";
    $resultseta=executeQuery($link,$querya);

    if($resultseta==true && countRows($resultseta)==1)
        $commanda="INSERT INTO JOB (job_desc, status, updates,      assign_to, created_by,  created_on,        last_changed) 
                            VALUES('$jobdesc', 'O', '$jobupdates',  $assignto, $created_by, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
    else
        $commanda="INSERT INTO JOB (job_desc, status, updates, created_by,  created_on,        last_changed) 
                           VALUES('$jobdesc', 'O', '$jobupdates', $created_by, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";

    $resulta=executeCommand($link,$commanda);

    if($resulta==true) {
        $queryb="SELECT MAX(job_id) FROM JOB;";
        $resultsetb=executeQuery($link,$queryb);
        if($resultsetb==false) { 
            return 100; // '100-employee id not found.
        }
        $job_id=retrieveElement($resultsetb,0,0);
        return $job_id;
    }
    else return 300; // '300-Job Insertion failed.
}

function updateJob($link, $jobid, $jobstatus, $assignto, $jobupdates){
    $commanda="
        INSERT INTO JOB_H (status,updates,assign_to,last_changed,job_id)
        SELECT status,updates,assign_to,last_changed,job_id FROM JOB WHERE job_id=$jobid;
    ";

    $resulta=executeCommand($link,$commanda);
    if($resulta==true) {
        $commandb="UPDATE JOB SET status='".$jobstatus."', updates='".$jobupdates."', assign_to='".$assignto."', last_changed=CURRENT_TIMESTAMP 
            WHERE job_id=$jobid";
        $resultb=executeCommand($link,$commandb);
        if($resultb==true)
            return 0; // success	
        else 
            return 300;
    }
    else return 100;
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
            return 100; // '100-employee id not found.
        }
        $emp_id=retrieveElement($resultsetb,0,0);
            // insert a row in login table.
            $commandb="INSERT INTO LOGIN (
            emp_id, password) VALUES ($emp_id, '12345678');";	
        // return the emp-id
        $resultb=executeCommand($link,$commandb);
        if($resultb==true)
                return $emp_id;
        else return 400; //'400 Login insertion failed.
    }
    else return 300; // '300-employee insertion failed.							
}

function getEmpDesignation($link, $emp_id){
    $querya="SELECT emp_designation FROM EMPLOYEE WHERE emp_id = $emp_id;";
    $resultseta=executeQuery($link,$querya);
    if($resultseta==false){
        return 100;	
    }
    // Valid employee designation are 'P','L' or 'M' ; 100 - means not found.
    $emp_design=retrieveElement($resultseta,0,0);
    return $emp_design;
}

function getEmpName($link, $emp_id){
    $querya="SELECT emp_fname, emp_sname FROM EMPLOYEE WHERE emp_id = $emp_id;";
    $resultseta=executeQuery($link,$querya);
    if($resultseta==false||countRows($resultseta)!=1){
        return "";	
    }
    $emp_fname=retrieveElement($resultseta,0,0);
    $emp_sname=retrieveElement($resultseta,0,1);
    return $emp_fname.", ".$emp_sname;
}

function getJobStatus($link, $job_id){
    $querya="SELECT status FROM JOB WHERE JOB_ID=$job_id;";
    $resultseta=executeQuery($link,$querya);
    if($resultseta==false){
        return 'NA';
    }
    if(countRows($resultseta)!=1){
                return 'NA';
    }
    $job_status=retrieveElement($resultseta,0,0);
    return $job_status;
}

function getJobAssignTo($link, $job_id){
    $querya="SELECT assign_to FROM JOB WHERE JOB_ID=$job_id;";
    $resultseta=executeQuery($link,$querya);
    if($resultseta==false){
        return 'NA';
    }
    if(countRows($resultseta)!=1){
                return 'NA';
    }
    $assign_to=retrieveElement($resultseta,0,0);
    return $assign_to;
}

function getJobDesc($link, $job_id){
    $querya="SELECT job_desc FROM JOB WHERE JOB_ID=$job_id;";
    $resultseta=executeQuery($link,$querya);
    if($resultseta==false){
        return 'NA';
    }
    if(countRows($resultseta)!=1){
                return 'NA';
    }
    $job_desc=retrieveElement($resultseta,0,0);
    return $job_desc;
}

function getJobUpdates($link, $job_id){
    $querya="SELECT updates FROM JOB WHERE JOB_ID=$job_id;";
    $resultseta=executeQuery($link,$querya);
    if($resultseta==false){
        return 'NA';
    }
    if(countRows($resultseta)!=1){
                return 'NA';
    }
    $updates=retrieveElement($resultseta,0,0);
    return $updates;
}

function populateJob($link, $job_id){
    $querya="SELECT status, assign_to, created_by, created_on, last_changed, job_desc, updates FROM JOB WHERE job_id = $job_id;";
    $resultseta=executeQuery($link,$querya);

    if($resultseta==false){
        echo '<div class="callout panel">
                  <div class="row">
                      <div class="large-4 columns">
                      <label>No Jobs Found</label>
                      </div>
                  </div>
             </div>';
        return;  
    }      		
    if(countRows($resultseta)!=1){
        echo '<div class="callout panel">
                          <div class="row">
                              <div class="large-4 columns">
              <label>No Jobs Found</label>
              </div>
              </div>
          </div>    
          ';
        return;
    }
    $job_status=retrieveElement($resultseta,0,0);
    $assign_to=retrieveElement($resultseta,0,1);
    $created_by=retrieveElement($resultseta,0,2);
    $created_on=retrieveElement($resultseta,0,3);
    $last_changed=retrieveElement($resultseta,0,4);
    $job_desc=retrieveElement($resultseta,0,5);
    $updates=retrieveElement($resultseta,0,6);
    
    $job_status=statusMapper($job_status);

    $queryb="SELECT emp_fname FROM EMPLOYEE WHERE emp_id=$created_by;";
    $resultsetb=executeQuery($link,$queryb);
    if($resultsetb==false){
        echo "Created By Not found";
        return;	
    }
    $temp0=retrieveElement($resultsetb,0,0);
    $temp1=$created_by." - ".$temp0;

    $queryc="SELECT emp_fname FROM EMPLOYEE WHERE emp_id=$assign_to;";
    $resultsetc=executeQuery($link,$queryc);
    if($resultsetc==false){
        $temp3='NA';	
    }
    else {
        $temp2=retrieveElement($resultsetc,0,0);
        $temp3=$assign_to." - ".$temp2;
    }
    echo '
        <div class="callout panel">
            <div class="row">
                <div class="large-4 columns">
                    <label>Job ID:</label>
                    <div class="row">
                        <div class="large-6 columns">
                            <input type="text" name="jobName" size="7" value="'.$job_id.'" readonly>
                        </div>
                        <div class="large-6 columns">
                        </div>
                    </div>    
                </div>
                <div class="large-4 columns">
                    <label>Status:</label>
                    <div class="row">
                        <div class="large-8 columns">
                            <input type="text" name="jobStatus" size="20" value="'.$job_status.'" readonly> 
                        </div>
                        <div class="large-4 columns">
                        </div>
                    </div> 
                </div>
                <div class="large-4 columns">
                    <label>Assigned To:</label>
                    <input type="text" name="assignTo" size="20" value="'.$temp3.'" readonly>  
                </div>
            </div>
            <div class="row"> 
                <div class="large-4 columns">
                    <label>Created On:</label> 
                    <div class="row">
                        <div class="large-12 columns"> 
                            <input type="text" name="createdOn" size="10" value="'.$created_on.'" readonly>
                        </div>
                    </div> 
                </div>
                <div class="large-4 columns">
                    <label>Created By:</label>
                    <div class="row">
                        <div class="large-12 columns">
                            <input type="text" name="createdBy" size="10" value="'.$temp1.'" readonly> 
                        </div> 
                    </div>  
                </div>
                <div class="large-4 columns">
                    <label>Last Changed:</label>
                    <div class="row">
                        <div class="large-12 columns">
                            <input type="text" name="lastChanged" size="10" value="'.$last_changed.'" readonly> 
                        </div> 
                    </div>  
                </div>
            </div> 
            <div class="row">
                <div class="large-12 columns">
                    <label>Description:</label> 
                    <input type="text" name="lastChanged" size="40" value="'.$job_desc.'" readonly>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Updates:</label> 
                    <textarea readonly>'.$updates.'</textarea>
                </div>
            </div>
        </div>
    ';
    $queryb="SELECT status, updates, assign_to, last_changed FROM JOB_H WHERE job_id = $job_id;";
    $resultsetb=executeQuery($link,$queryb);
    if($resultsetb==false){
    }
    $nRows=countRows($resultsetb);
    if($nRows>=1){
        for($index=0; $index<$nRows; $index++){
            $job_status  =retrieveElement($resultsetb,$index,0);
            $updates     =retrieveElement($resultsetb,$index,1);
            $assign_to   =retrieveElement($resultsetb,$index,2);
            $last_changed=retrieveElement($resultsetb,$index,3);
            $job_status=statusMapper($job_status);
            $queryc="SELECT emp_fname FROM EMPLOYEE WHERE emp_id=$assign_to;";
                    $resultsetc=executeQuery($link,$queryc);
            if($resultsetc==false){
                $temp3='NA';
            }
            else {
                $temp2=retrieveElement($resultsetc,0,0);
                $temp3=$assign_to." - ".$temp2;
            }
            echo '
                <div class="callout panel">
                    <div class="row">
                        <div class="large-4 columns">
                            <label>Last Changed:</label>
                            <div class="row">
                                <div class="large-12 columns">
                                    <input type="text" name="lastChanged" size="10" value="'.$last_changed.'" readonly> 
                                </div> 
                            </div>  
                        </div>
                        <div class="large-4 columns">
                            <label>Status:</label>
                            <div class="row">
                                <div class="large-8 columns">
                                    <input type="text" name="jobStatus" size="20" value="'.$job_status.'" readonly> 
                                </div>
                                <div class="large-4 columns">
                                </div>
                            </div> 
                        </div>
                        <div class="large-4 columns">
                            <label>Assigned To:</label>
                            <input type="text" name="assignTo" size="20" value="'.$temp3.'" readonly>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>Updates:</label> 
                            <textarea readonly>'.$updates.'</textarea>
                        </div>
                    </div>
                </div>
    ';
        }
    }
}

function statusMapper($job_status){
    if($job_status=="O") 
        $job_status="Open";
    else if($job_status=="W") 
        $job_status="Work In Progress";
    else if($job_status=="P") 
        $job_status="Pending";
    else if($job_status=="C") 
        $job_status="Closed";
    else if($job_status=="R") 
        $job_status="Resolved";
    return $job_status;
}

function populateJobLst($link, $emp_id){
    echo '
                <div class="CSSTableGenerator" >
                    <table id="myTable" class="tablesorter" >
                        <tr>
                            <td> Job ID      </td>
                            <td> Status      </td>
                            <td> Job Desc    </td>
                            <td> Created On  </td>
                        </tr>
        ';
    $querya="SELECT job_id, status, job_desc, created_on FROM JOB WHERE assign_to = $emp_id;";
    $resultseta=executeQuery($link,$querya);
    if($resultseta==false){
        echo '</table>
            </div>';
        return;
    }
    $nRows=countRows($resultseta);
    if($nRows>=1){
        for($index=0; $index<$nRows; $index++){
            $job_id      = retrieveElement($resultseta,$index,0);
            $job_status  = retrieveElement($resultseta,$index,1);
            $job_desc    = retrieveElement($resultseta,$index,2);
            $tjob_desc = (strlen($job_desc) > 20) ? substr($job_desc, 0, 20) . '...' : $job_desc;
            $created_on  = retrieveElement($resultseta,$index,3);
           
            $job_status  = statusMapper($job_status);
            
            echo '
                <tr>
                    <td> <a href='.FULLPATH.'/jobs/search/index.php?job_id='.$job_id.'>'.$job_id.'</a> </td>
                    <td> '.$job_status.'    </td>
                    <td> '.$tjob_desc.'     </td>
                    <td> '.$created_on.'    </td>
                </tr>
            ';
        }

        echo '</table>
            </div>';
    }
}

function displaymenu(){
    echo '
        <p style="background:#0079A1; color:white; text-align:right">
            <a href="'.FULLPATH.'/home" style="color:white;">Home&nbsp;</a>
            <a href="'.FULLPATH.'/home/signout.php" style="color:white;">&nbsp;Log Off&nbsp;</a>
        </p>
    ';
}
?>

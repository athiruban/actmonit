<?php
session_start();
require('../../lib/dbutils.php');
//if no session go to login
if(!isset($_SESSION['emp_design'])){
    echo "Authorizatin required!";
    sleep(3);
    header("Location: ".FULLPATH.""); 
}
if(!$_GET['job_id']){
    echo 'Invalid Call';
    exit(0);
}
$USER_TYPE =$_SESSION['emp_design'];
$USER_ID   =$_SESSION['emp_id'];
$USER_PASS =$_SESSION['emp_password'];
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EPM and AS - Edit Job Landing page</title>
        <link rel="stylesheet" href="../../css/foundation.css" />
        <link rel="stylesheet" type="text/css" href="../../css/tcal.css" />
        <script src="../../js/tcal.js"></script>
        <script src="../../js/modernizr.js"></script>
    </head>
    <body>
        <?php
        require(FULLPATH.'/header.php');
        $token = connectToDBServer();
        $result = connectToDB($token);
        if($result==false) {
            echo "Database is currently down";
            exit(0); 
        }
        ?>
        <div class="row">
        <?php
        require(FULLPATH.'/menu-bar.php?emp_design='.$USER_TYPE);
        ?>
            <div class="large-9 medium-9 columns">
            <?php
            $job_id=$_GET['job_id'];
            $job_status=getJobStatus($token, $job_id); 	

            if($job_status=="O"){
                $job_status_txt='<option value="O" selected="selected">Open</option>
                                 <option value="P">Pending</option>
                                 <option value="W">Work In-progress</option>
                                 <option value="R">Resolved</option>
                                 <option value="C">Closed</option>';
            }
            else if($job_status=="P"){
                $job_status_txt='<option value="O">Open</option>
                                 <option value="P" selected="selected">Pending</option>
                                 <option value="W">Work In-progress</option>
                                 <option value="R">Resolved</option>
                                 <option value="C">Closed</option>';
            }
            else if($job_status=="W"){
                $job_status_txt='<option value="O">Open</option>
                                 <option value="P">Pending</option>
                                 <option value="W" selected="selected">Work In-progress</option>
                                 <option value="R">Resolved</option>
                                 <option value="C">Closed</option>';
            }
            else if($job_status=="R"){
                $job_status_txt='<option value="O">Open</option>
                                 <option value="P">Pending</option>
                                 <option value="W">Work In-progress</option>
                                 <option value="R" selected="selected">Resolved</option>
                                 <option value="C">Closed</option>';
            }
            else if($job_status=="C"){
                $job_status_txt='<option value="O">Open</option>
                                 <option value="P">Pending</option>
                                 <option value="W">Work In-progress</option>
                                 <option value="R">Resolved</option>
                                 <option value="C" selected="selected">Closed</option>';
            }
            else{
                $job_status_txt='<option value="NA">Not Available</option>';
            }

            echo '
                <div class="callout panel">
                    <form name="editJobForm" method="post">
                        <div class="row">
                            <div class="large-4 columns">
                                <label>Job ID:</label>
                                <div class="row">
                                    <div class="large-6 columns">
                                        <input type="text" name="jobId" size="7" value="'.$job_id.'" readonly>
                                    </div>
                                    <div class="large-6 columns">
                                    </div>
                                </div>    
                            </div>
                            <div class="large-4 columns">
                                <label>Status:</label>
                                <div class="row">
                                    <div class="large-10 columns">
                                        <select name="jobStatus">
                                        '.$job_status_txt.'
                                        </select>  
                                    </div>
                                    <div class="large-2 columns">
                                    </div>
                                </div> 
                            </div>
                            <div class="large-4 columns">
                                <label>Assigned To:</label>
                                <input type="text" name="assignTo" size="20" value="'.getJobAssignTo($token,$job_id).'">  
                            </div>
                        </div> 
                        <div class="row">
                            <div class="large-12 columns">
                                <label>Description:</label> 
                                <textarea name="jobDesc" readonly>'.getJobDesc($token,$job_id).'</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label>Updates:</label> 
                                <textarea name="jobUpdates">'.getJobUpdates($token,$job_id).'</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-3 medium-3 columns">
                                <a id="editjobSave" class="small radius button" style="color:White">Save</a>
                            </div>
                            <div class="large-3 medium-3 columns">
                                <a class="small radius button" style="color:White" onClick="buttonClicked(\'editJobCancel\')">Cancel</a>
                            </div>
                            <div class="large-6 medium-6 columns"> </div>
                        </div>
                    </form>  
                </div> <!-- End of Callout panel -->
            ';
            ?>
        </div>     
        </div> <!--End of row -->
        <div class="row">
            <div class="large-12 medium-12 columns">
                <center> <span style="font-size:9px">&copy; Copyrights 2014. Some rights reserved.</span></center>
            </div>
        </div>
        <script src="../../js/jquery.js"></script>
        <script src="../../js/foundation.min.js"></script>
        <script src="../../js/athi.js"> </script>
        <script>
                $(document).foundation();
        </script>
    </body>
</html>


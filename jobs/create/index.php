<?php
session_start();
require('../../lib/dbutils.php');
//if no session go to login
if(!isset($_SESSION['emp_design'])){
    echo "Authorizatin required!";
    sleep(3);
    header("Location: ".FULLPATH.""); 
}
if($_SESSION['emp_design']!='M'){
    echo 'Invalid Call. You dont have access to create new job.';
    header("Location: ".FULLPATH."/home");
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
        <title>EPM and AS - Create New Job Landing page</title>
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
                <form name="newJobForm" method="post">
                    <div class="callout panel">
                        <h6> <left> Open New Job </left> </h6>
                        <div class="row">
                            <div class="large-6 columns">
                                <label>Status:</label>
                                <div class="row">
                                    <div class="large-6 columns">
                                        <input type="text" name="jobStatus" size="20" value="Open" readonly>
                                    </div>
                                    <div class="large-6 columns">
                                    </div>
                                </div> 
                            </div>
                            <div class="large-6 columns">
                                <label>Assigned To:</label>
                                <div class="row">
                                    <div class="large-6 columns">
                                        <input type="text" name="assignTo" size="20" value="">  
                                    </div>
                                    <div class="large-6 columns">
                                    </div>	
                                </div> 	
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label>Description:</label> 
                                <input type="text" name="jobDesc" size="40" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label>More Details:</label> 
                                <textarea name="jobUpdates"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-3 medium-3 columns">
                                <a id="newjobSave" class="small radius button" style="color:White">Save</a>
                            </div>
                            <div class="large-3 medium-3 columns">
                                <a class="small radius button" style="color:White" href="../../home/">Cancel</a>
                            </div>
                            <div class="large-6 medium-6 columns"> </div>
                        </div>
                    </div> <!-- End of Panel -->
                </form>
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


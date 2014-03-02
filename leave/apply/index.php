<?php
session_start();
require('../../lib/dbutils.php');
//if no session go to login
if(!isset($_SESSION['emp_design'])){
    echo "Authorizatin required!";
    sleep(3);
    header("Location: ".FULLPATH.""); 
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
        <title>EPM and AS - Apply Leave Landing Page</title>
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
                <form name="leaveApplyForm" method="post">
                    <div class="callout panel">
                        <h6> <left> Apply Leave </left> </h6>
                        <div class="row">
                            <div class="large-6 columns">
                                <label>From:</label>
                                <div class="row">
                                    <div class="large-6 columns">
                                        <input name="from" type="text" placeholder="From Date" class="tcal" value="" />						
                                    </div>
                                    <div class="large-6 columns">
                                    </div>
                                </div> 
                            </div>
                            <div class="large-6 columns">
                                <label>To:</label>
                                <div class="row">
                                    <div class="large-6 columns">
                                        <input name="to" type="text" placeholder="To Date" class="tcal" value="" />  
                                    </div>
                                    <div class="large-6 columns">
                                    </div>	
                                </div> 	
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-3 columns">
                                <label>Leave Type:</label>
                                <select name="ltype">
                                    <option value="P">Personal</option>
                                    <option value="V">Vacation</option>
                                    <option value="S">Sick</option>
                                </select>
                            </div>
                            <div class="large-9 columns">
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label>Reason:</label>
                                <textarea name="reason" placeholder="Reason for your leave"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-3 medium-3 columns">
                                <a id="applyLeave" class="small radius button" style="color:White">Save</a>
                            </div>
                            <div class="large-3 medium-3 columns">
                                <a class="small radius button" style="color:White" onClick="buttonClicked('cancelApply')">Cancel</a>
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


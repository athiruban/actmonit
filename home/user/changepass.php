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
        <title>EPM and AS - User home page</title>
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
                <div class="callout panel">
                    <form name="changePassForm">
                        <p> <h6> <left> Change Password </left> </h6> </p>
                        <div class="row">
                            <div class="large-6 columns">
                                <label>Old Password</label>
                                <div class="row">
                                    <div class="large-6 columns">
                                        <input name="oldpass" type="password" placeholder="*****" value="" />						
                                    </div>
                                    <div class="large-6 columns">
                                    </div>
                                </div> 
                            </div>
                            <div class="large-6 columns">
                                <label>New Password</label>
                                <div class="row">
                                    <div class="large-6 columns">
                                        <input name="newpass" type="password" placeholder="*****" value="" />  
                                    </div>
                                    <div class="large-6 columns">
                                    </div>	
                                </div> 	
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-3 medium-3 columns">
                                <a id="changePass" class="small radius button" style="color:White">Change</a>
                            </div>
                            <div class="large-3 medium-3 columns">
                                <a class="small radius button" style="color:White" onClick="buttonClicked('cancelChangePass')">Cancel</a>
                            </div>
                            <div class="large-6 medium-6 columns"> </div>
                        </div>
                    </form>
                </div>      
            </div>     
        </div> <!--End of row -->
        <div class="row">
            <div class="large-12 medium-12 columns">
                <center> 
                    <span style="font-size:9px">&copy; Copyrights 2014. Some rights reserved.</span>
                </center>
            </div>
        </div>
        <script src="../../js/jquery.js"></script>
        <script src="../../js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>

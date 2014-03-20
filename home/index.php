<?php
session_start();
require('../lib/dbutils.php');
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
        <link rel="shortcut icon" href="../img/favicon.png" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EPM and AS - User home page</title>
        <link rel="stylesheet" href="../css/foundation.css" />
        <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
        <script src="../js/tcal.js"></script>
        <script src="../js/modernizr.js"></script>
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
                <?php
                if($USER_TYPE=="P"){
                ?>
                    <div class="callout panel" style="background-color:white;">
                        <h3> Welcome <?php 
                                echo getEmpName($token,$USER_ID); 
                                $photoname=getPhotoNm($token,$USER_ID); 
                                if($photoname==''){ ?> 
                            <img src="../photos/default.png" alt="To Do Items" width="40px" height="40px" /> 
                                <?php } else {
                                echo '<img src="../photos/'.$photoname.'" width="40px" height="40px" />';
                                } ?>
                        </h3>
                        <img src="../img/to-do.jpg" alt="To Do Items" width="40px" height="40px" />
                        <ul>
                            <li> Be Punctual in your office timings        </li>
                            <li> Submit your Leave Request when needed     </li>
                            <li> Post updates to your assigned job on time </li>
                        </ul>
                        <img src="../img/link.png" alt="Important Links" width="40px" height="40px" />
                        <ul>
                            <li> <a href="<?php echo FULLPATH.'/jobs/list'; ?>">Jobs assigned to you.</a>               </li>
                        </ul>
                    </div>	
                <?php    
                }
                else if($USER_TYPE=="L"){
                ?> 		
                    <div class="callout panel" style="background-color:white;">
                        <h3> Welcome <?php 
                                echo getEmpName($token,$USER_ID); 
                                $photoname=getPhotoNm($token,$USER_ID); 
                                if($photoname==''){ ?> 
                            <img src="../photos/default.png" alt="To Do Items" width="40px" height="40px" /> 
                                <?php } else {
                                echo '<img src="../photos/'.$photoname.'" width="40px" height="40px" />';
                                } ?>
                        </h3>
                        <img src="../img/to-do.jpg" alt="To Do Items" width="40px" height="40px" />
                        <ul>
                            <li> Track your team member's performance and report regurlarly to your Manager </li>
                            <li> Submit your Leave Request when needed                                      </li>
                            <li> Post updates to your assigned job on time                                  </li>
                        </ul>
                        <img src="../img/link.png" alt="Important Links" width="40px" height="40px" />
                        <ul>
                            <li> <a href="<?php echo FULLPATH.'/home/user/team.php'; ?>">List of Team Members.</a></li>
                            <li> <a href="<?php echo FULLPATH.'/leave/view/all.php'; ?>">Complete List of Leave applications.</a></li>
                            <li> <a href="<?php echo FULLPATH.'/jobs/list'; ?>">Jobs assigned to you.</a>               </li>
                        </ul>
                    </div>	
                <?php 	
                }
                else if($USER_TYPE=="M"){ 
                ?>
                    <div class="callout panel" style="background-color:white;">	
                        <h3> Welcome <?php 
                                echo getEmpName($token,$USER_ID); 
                                $photoname=getPhotoNm($token,$USER_ID); 
                                if($photoname==''){ ?> 
                            <img src="../photos/default.png" alt="To Do Items" width="40px" height="40px" /> 
                                <?php } else {
                                echo '<img src="../photos/'.$photoname.'" width="40px" height="40px" />';
                                } ?>
                        </h3>
                        <img src="../img/to-do.jpg" alt="To Do Items" width="40px" height="40px" />
                        <ul>
                            <li> Evaluate Project Schedule and Tasks and revise plan accordingly.           </li>
                            <li> Prepare report to be submitted to client every first week of month.        </li>
                            <li> Post updates to your assigned job on time                                  </li>
                        </ul>
                        <img src="../img/link.png" alt="Important Links" width="40px" height="40px" />
                        <ul>
                            <li> <a href="<?php echo FULLPATH.'/home/user/team.php'; ?>">List of All Employees.</a></li>
                            <li> <a href="<?php echo FULLPATH.'/leave/view/all.php'; ?>">Complete List of Leave applications.</a></li>
                            <li> <a href="<?php echo FULLPATH.'/register'; ?>">Register New Employee.</a>               </li>
                            <li> <a href="<?php echo FULLPATH.'/jobs/list'; ?>">Jobs assigned to you.</a>               </li>
                            <li> <a href="<?php echo FULLPATH.'/supervisor'; ?>">Supervisor Update.</a>                 </li>
                        </ul>
                    </div>
                <?php 	
                } 
                ?>
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
        <script src="../js/jquery.js"></script>
        <script src="../js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>

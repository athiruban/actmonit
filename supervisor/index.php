<?php
    session_start();
    require('../lib/dbutils.php');
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
<?php
    $token = connectToDBServer();
    $result = connectToDB($token);
    if($result==false) {
    echo "Database is currently down";
        exit(0); 
    }
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EPM and AS-Supervisor Update Page</title>
        
        <link rel="stylesheet" href="../css/foundation.css" />
        <link rel="stylesheet" type="text/css" href="../css/tcal.css" />

        <script src="../js/tcal.js"></script>
        <script src="../js/modernizr.js"></script>
    </head>
    <body>
        <?php require(FULLPATH.'/header.php'); ?>
        <div class="row">
            <?php
            require(FULLPATH.'/menu-bar.php?emp_design='.$USER_TYPE);
            ?>
            <div class="large-9 medium-9 columns">
                <form name="sprUpdateForm" method="post">
                    <div class="callout panel">
                        <div class="row">
                            <div class="large-6 columns"> <!-- EMPID -->
                                <label>Employee ID</label>
                                <input name="empid" type="text" placeholder="" />
                            </div>
                            <div class="large-6 columns"> <!-- SPRID -->
                                <label>Supervisor ID</label>
                                <input name="sprid" type="text" placeholder="" />
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="large-6 medium-6 columns">
                                <a id="sprSave" class="small radius button" style="color:White">Save</a>
                            </div>
                            <div class="large-6 medium-6 columns">
                                <a class="small radius button" style="color:White" onClick="buttonClicked('sprcanbutton')">Cancel</a>
                            </div>
                        </div>
                    </div>   
                </form>
            </div> <!-- End of left panel -->    
            
        </div> <!--End of Row-->
        <div class="row">
            <div class="large-12 medium-12 columns">
                <center> <span style="font-size:9px">&copy; Copyrights 2014. Some rights reserved.</span></center>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/foundation.min.js"></script>
        <script src="../js/athi.js"> </script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>

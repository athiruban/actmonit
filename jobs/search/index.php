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
        <title>EPM and AS - Search Job Landing page</title>
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
                 populateJob($token,$_GET['job_id']);
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
        <script>
            $(document).foundation();
        </script>
    </body>
</html>


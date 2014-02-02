<?php
   session_start();
   require('../lib/dbutils.php');
   $_SESSION['USER_TYPE']="PA";
   $USER_TYPE=$_SESSION['USER_TYPE'];
   //echo $USER_TYPE;
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EPM and AS - User home page</title>
    
    <link rel="stylesheet" href="../css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
	
	<script src="../js/tcal.js"></script>
    <script src="../js/modernizr.js"></script>
  </head>
  <!--<body style="background-image:url(img/Bg1.jpg);background-repeat:no-repeat; background-position:center; o">-->
  <body>
  
  <p style="background:#0079A1; color:#0079A1">
   hi
  </p>
  
  
    <?php
		//require(FULLPATH.'/header.php');
	?>
    <div class="row">
    <?php
		require(FULLPATH.'/menu-bar.php');
	?>
        <div class="large-9 medium-9 columns">
        	 <div class="callout panel">
             <?php
                  if($USER_TYPE=="PA"){
             ?>
                  <h1>About Your Company</h1>
                  <p>Here is a quote from Apple's CEO:</p>

                  <blockquote>
                       For 50 years, WWF has been protecting the future of nature. The world’s leading conservation organization, WWF works in 100                       countries and is supported by 1.2 million members in the United States and close to 5 million globally.
                  </blockquote>

				  <div class="callout panel" style="background-color:white;">	
	              <h3> Reminders for Employees </h3>
                  		<ul>
                        	<li> Be Punctual in your office timings </li>
                            <li> Submit your Leave Request when needed </li>
                            <li> Post updates to your assigned job on time </li>
                        </ul>
				  </div>	
             <?php    
				}
				else if($USER_TYPE=="TL"){
		     ?> 		
                  <div class="callout panel" style="background-color:white;">	
	              <h3> Reminders for Employees </h3>
                  		<ul>
                        	<li> Be Punctual in your office timings </li>
                            <li> Submit your Leave Request when needed </li>
                            <li> Post updates to your assigned job on time </li>
                        </ul>
				  </div>	
			 <?php 	
				}
			 ?>
             </div>      
        </div>     
    </div>
    <div class="row">
       <div class="large-12 medium-12 columns">
       <center> <span style="font-size:9px">&copy; Copyrights 2014. Some rights reserved.</span></center>
       </div>
    </div>
			
    <script src="../js/jquery.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>

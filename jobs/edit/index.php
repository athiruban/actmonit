
<?php 
   require('../../lib/dbutils.php');
?>


<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EPM and AS-Edit a Job</title>
    
    <link rel="stylesheet" href="../../css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="../../css/tcal.css" />
	
	<script src="../../js/tcal.js"></script>
    <script src="../../js/modernizr.js"></script>
  </head>
  <!--<body style="background-image:url(img/Bg1.jpg);background-repeat:no-repeat; background-position:center; o">-->
  <body>
    
    <div class="row">
      <div class="large-12 columns">
        <!-- Banner should come here -->
      </div>
    </div>
    
	<?php
		require(FULLPATH.'/header.php');
	?>
    
    <div class="row">
    
	<?php
		// edit is common to all........The below URL should change as per the usertype
		require(FULLPATH.'/jobs/menu-bar.php');
	?>

      <div class="large-9 medium-9 columns">
      <p>Edit a Job </p>
      	<div class="callout panel">
        <div class="row">
          <div class="large-4 columns">
            Job ID: <span style="background:white; outline: solid thin black;"> &nbsp; ZZZZZZZ &nbsp; </span>
          </div>
          <div class="large-4 columns">
            Status: <span style="background:white; outline: solid thin black;"> &nbsp; Not Available &nbsp; </span>
          </div>
          <div class="large-4 columns">
            Assigned To: <span style="background:white; outline: solid thin black;"> &nbsp; None &nbsp; </span>
          </div>
        </div>
        <div class="row">
          <br><br> <div class="large-6 columns">
            Created On: <span style="background:white; outline: solid thin black;"> &nbsp; DD/MM/YYYY &nbsp; </span>
          </div>
          <div class="large-5 columns">
            Last Changed: <span style="background:white; outline: solid thin black;"> &nbsp; DD/MM/YYYY &nbsp; </span>
          </div>
          <div class="large-1 columns"></div>
        </div> 
        <div class="row">
          <br><br> <div class="large-12 columns">
            Description:  <br><br>
            <textarea placeholder=" Not Available "></textarea>
          </div>
        </div>
        
        <div class="row">
          <div class="large-12 columns">
            Updates:  <br><br>
            <textarea> hijjaijfasdj sajdfj sidjf j </textarea>
          </div>
        </div>
       </div>      
       <!-- End of forms --> 
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

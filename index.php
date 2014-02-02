<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EPM and AS</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/modernizr.js"></script>
  </head>
  <!--<body style="background-image:url(img/Bg1.jpg);background-repeat:no-repeat; background-position:center; o">-->
  <body>
    
    <div class="row">
      <div class="large-12 columns">
        <!-- Banner should come here -->
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
      	<div class="panel">
	        <h3>
               <span style="color:#F86707">Welcome </span> 
               <span style="color:#F90">to </span> 
               <span style="color:#C0C">EPM </span> 
               <span style="color:#0060BF">and </span>
               <span style="color:#009B4E">AS tool </span>
            </h3>
	        <p></p>
	        <p></p>
	    </div>
      </div>
    </div>

    <div class="row">
      <div class="large-8 medium-8 columns">
        <div class="row">
          <div class="large-12 columns">
          <img src="img/Bg3.jpg" align="middle" />
          </div>
        </div>
       </div>     
       <div class="large-4 medium-4 columns">
      	 <div class="panel">
         <form name="loginForm" method="post" action="login/validate.php">
            <div class="row">
               <div class="large-12 medium-12 columns">
			      <label>User Name</label>
			      <input type="text" name="loguname" placeholder="techie" />
		       </div>
            </div>
            <div class="row">
               <div class="large-12 medium-12 columns">
			      <label>Password</label>
			      <input type="password" name="logpass" placeholder="********" />
		       </div>
            </div>
            <div class="row" align="right">
               <div class="large-12 medium-12 columns">
                 <a id="logbutton" class="small round button" onClick="buttonClicked('logbutton')">Log On</a> 
               </div>
            </div>
            <div class="row" align="left">
               <div class="large-12 medium-12 columns antialiased breadcrumbs ">
                   <label>Help Desk +0 000 000 0000</label>
               </div>
            </div>
        </form>    
        </div>           
	   </div>
    </div>
    <div class="row">
       <div class="large-12 medium-12 columns">
       <center> <span style="font-size:9px">&copy; Copyrights 2014. Some rights reserved.</span></center>
       </div>
    </div>
			
    <script src="js/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>

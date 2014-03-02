<!doctype html>
<html class="no-js" lang="en">
    <head>
        <link rel="shortcut icon" href="../img/favicon.png" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EPM and AS-New Employee Registration Page</title>
        <link rel="stylesheet" href="../css/foundation.css" />
        <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
        <script src="../js/tcal.js"></script>
        <script src="../js/modernizr.js"></script>
    </head>
    <body>
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
                <form name="registerForm" method="post">
                    <div class="callout panel">
                        <div class="row">
                            <div class="large-6 columns"> <!-- FNAME -->
                                <label>First Name</label>
                                <input name="fname" type="text" placeholder="Your First Name" />
                            </div>
                            <div class="large-6 columns"> <!-- LNAME -->
                                <label>Last Name</label>
                                <input name="lname" type="text" placeholder="Your Second Name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-6 columns"> <!-- DESIGN -->
                                <label>Designation</label>
                                <select name="design">
                                    <option value="M">Manager</option>
                                    <option value="P">Programmer</option>
                                    <option value="L">Project Leader</option>
                                </select>
                            </div>
                            <div class="large-6 columns"> <!-- DOB -->
                                <label>Date Of Birth</label>
                                <input name="dob" type="text" placeholder="When did you born?" class="tcal" value="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-6 columns"> <!-- PNO -->
                                <label>Phone Number</label>
                                <input name="pno" type="text" placeholder="How to reach you?" />
                            </div>
                            <div class="large-6 columns"> <!-- PSKILL -->
                                <label>Primary Skill</label>
                                <select name="pskill">
                                    <option value="JV">Java</option>
                                    <option value="MF">Mainframe</option>
                                    <option value="DN">dotNet</option>
                                    <option value="PH">PHP</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-6 columns"> <!-- SSKILL -->
                                <label>Secondary Skill</label>
                                <select name="sskill">
                                    <option value="TW">Technical Writer</option>
                                    <option value="BL">Blogger</option>
                                    <option value="GD">Graphic Designer</option>
                                    <option value="AC">Application Developer</option>
                                </select>
                            </div>
                            <div class="large-6 columns"> <!-- RESADDR -->
                                <label>Residence Address</label>
                                <textarea name="resaddr" placeholder="Where do you live?"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-6 medium-6 columns">
                                <a id="regSave" class="small radius button" style="color:White">Save</a>
                            </div>
                            <div class="large-6 medium-6 columns">
                                <a class="small radius button" style="color:White" href="../home/">Cancel</a>
                            </div>
                        </div>
                    </div>   
                </form>
            </div> <!-- End of left panel -->    
            <div class="large-4 medium-4 columns">
                <div class="panel">
                    <div class="row">
                        <div class="large-12 medium-12 columns">
                            <center> Please fill the details to  </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 medium-12 columns">
                            <center> <img src="../img/badge_join_us.png" /> </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 medium-12 columns">
                            <center> <img src="../img/join-team-icons.png" /> </center>
                        </div>
                    </div>
                </div>
            </div>
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

<head>
<title>SignOut Page</title>
<meta http-equiv="refresh" content="2;url=<?php require('../lib/dbutils.php'); echo FULLPATH; ?>">
</head>

<?php
	session_start();
	session_unset();
	session_destroy();
	echo "Successfully Signed out";	
?>

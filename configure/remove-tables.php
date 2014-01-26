<?php

	require ('../lib/dbutils.php');
	$link=connectToDBServer();

	echo "Wamp Server is up!"."Token is".$link;
	echo "<br> Checking DB already exists!";

	if(checkDBExists($link)==true){
		echo "Yes DB is already there!";
	}
	else 
		die ("DB is not created!");

	echo "<br> Removing DB!";
	$command1 = "DROP DATABASE epmas";

	if(executeCommand($link, $command1)==true) 
		echo "<BR>DB Removed!";
	else 
		echo "<BR>DB Removal failed";
?>
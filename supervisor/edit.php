<?php
session_start();
require('../lib/dbutils.php');

$empid  = $_POST['empid'];
$sprid  = $_POST['sprid'];
    
$token=connectToDBServer();
$return=connectToDB($token);

// Get current values of the job from db
// compare against the passed values

    $return=updateSupervisor($token, $empid, $sprid);
    
    if($return==100)
        echo ' Empid Not found ';
    else if($return==300)
        echo ' Supervisor ID Not found ';
    else if($return==400)
        echo ' Supervisor Update failed ';
    else 
        echo $return; 
	    
?>


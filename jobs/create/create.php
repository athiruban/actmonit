<?php
session_start();
require('../../lib/dbutils.php');

$assignto   = $_POST['assignto'];
$jobdesc    = $_POST['jobdesc'];
$jobupdates = $_POST['jobupdates'];
$created_by = $_SESSION['emp_id'];
    
$token=connectToDBServer();
$return=connectToDB($token);

if($return==true) {
    $return=addNewJob($token, $assignto, $jobdesc, $jobupdates, $created_by);
    if($return==100||$return==300){
        echo 'Job insertion failed';
    }
    else 
        echo 'Your New Job ID is : '.$return;
    }
else {
    echo 'DB Not started!';
}	    
?>

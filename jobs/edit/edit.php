<?php
session_start();
require('../../lib/dbutils.php');

$jobid      = $_POST['jobid'];
$jobstatus  = $_POST['jobstatus'];
$assignto   = $_POST['assignto'];
$jobupdates = $_POST['jobupdates'];
    
$token=connectToDBServer();
$return=connectToDB($token);

// Get current values of the job from db
// compare against the passed values

$temp=getJobDesc($token,$jobid);
if($temp=='NA') {echo 'Not a valid Job'; exit(0); }


$ojobstatus = getJobStatus($token, $jobid);
$oassignto  = getJobAssignTo($token, $jobid);
$ojobupdates= getJobUpdates($token, $jobid);
$flag=true;

if($ojobstatus==$jobstatus){
    if($oassignto==$assignto){
        if($ojobupdates==$jobupdates){
            $flag=false;
        }
    }
}

if($return==true) {
    if($flag==true)
        $return=updateJob($token, $jobid, $jobstatus, $assignto, $jobupdates);
    else
        echo 'Values are not changed';
    
    if($return==100)
        echo ' First copy failed ';
    else if($return==300)
        echo ' Job update failed ';
    else 
        echo ' Job Successfully Updated '; 
    }
else {
    echo ' DB Not started! ';
}	    
?>

<?php
session_start();
require('../../lib/dbutils.php');

$lfrom   = $_POST['lfrom'];
$lto     = $_POST['lto'];
$ltype   = $_POST['ltype'];
$lreason = $_POST['lreason'];
$emp_id  = $_SESSION['emp_id'];

$token=connectToDBServer();
$return=connectToDB($token);

$return=applyLeave($token, $emp_id, $lfrom, $lto, $ltype, $lreason);

if($return==100)
    echo ' Supervisor update needed ';
else if($return==300)
    echo ' Leave Update failed ';
else if($return==400)
    echo ' Leave code return failed ';
else 
    echo 'Your leave request # is '. $return;
?>


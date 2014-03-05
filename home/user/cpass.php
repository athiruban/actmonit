<?php
session_start();
require('../../lib/dbutils.php');

$newpass = $_POST['newpass'];
$emp_id  = $_SESSION['emp_id'];

$token=connectToDBServer();
$return=connectToDB($token);

if($return==true) {
    $return=changePassword($token, $emp_id, $newpass);
    if($return==100){
        echo 'Password Change Failed';
    }
    else {
        echo 'Password Updated!';
    }	    
}
else {
    echo 'DB Not Started';
}
?>


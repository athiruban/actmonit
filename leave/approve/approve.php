<?php
require('../../lib/dbutils.php');

$leavecd = $_POST['leavecd'];

$token=connectToDBServer();
$return=connectToDB($token);

if($return==true) {
    $return=approveLeave($token, $leavecd);
    if($return==100){
        echo 'Leave Cd update failed';
    }
    else {
        echo 'Leave approved!';
    }	    
}
else {
    echo 'DB Not Started';
}
?>

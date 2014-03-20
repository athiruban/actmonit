<?php
session_start();
require('../../lib/dbutils.php');

$emp_id  = $_SESSION['emp_id'];

$token=connectToDBServer();
$return=connectToDB($token);

if($return==true) {
   $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["photo"]["name"]);
    $extension = end($temp);
    if ((($_FILES["photo"]["type"] == "image/gif")
        || ($_FILES["photo"]["type"] == "image/jpeg")
        || ($_FILES["photo"]["type"] == "image/jpg")
        || ($_FILES["photo"]["type"] == "image/pjpeg")
        || ($_FILES["photo"]["type"] == "image/x-png")
        || ($_FILES["photo"]["type"] == "image/png"))
        && ($_FILES["photo"]["size"] < 20000)
        && in_array($extension, $allowedExts)){
        if ($_FILES["photo"]["error"] > 0){
            echo "Return Code: " . $_FILES["photo"]["error"] . "<br>";
        }
        else{
            $already_there=false;
            $photoname="../../photos/" . $_FILES["photo"]["name"];
            if (file_exists($photoname)){
                
                $already_there=true;
                $flag=isPhotoNmVal($token,$_FILES["photo"]["name"],$emp_id);
                if($flag==true) unlink($photoname);
                else echo "Please rename the file to your emp_id and try again";
            }
            else {
                move_uploaded_file($_FILES["photo"]["tmp_name"],
                    $photoname);
                updatePhotoNm($token,$_FILES["photo"]["name"],$emp_id);
                if($already_there==false){
                    echo "Photo Uploaded successfully ". $_FILES["photo"]["name"];
                }
                else{
                    echo "Photo Updated successfully ". $_FILES["photo"]["name"];
                }
            }
            echo "<head>
            <title>Photo Upload</title>
            <meta http-equiv='refresh' content='2;url=".FULLPATH."/home"."'>
            </head>";

        }
    }
    else{
        echo "Invalid file";
    }
}
?>

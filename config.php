<?php

$conn = new mysqli('localhost','root','','rent') or die('connection faild'); 
if($conn->connect_error){
    die("connection failed: ".$conn->connect_error);
}
echo "Connection successfull";

?>
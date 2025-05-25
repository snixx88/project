<?php 

$connect=mysqli_connect('localhost','root','','bmw');

//if($connect){
    // echo "connected";
 //}
 // Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


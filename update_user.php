<?php
require_once('db_setup.php');
$sql = "USE eMarket";
$conn->query($sql);

// Get user info
$id = $_COOKIE['userID'];
$password = $_POST['password'];
$sex = $_POST['sex'];
$phone = $_POST['phone'];
$email = $_POST['email'];

if($conn->query($sql)===TRUE){
//	echo "Connected!";


// Edit the info
if($password){
    $sql = "update User set password ='$password' where userID = '$id';";
    $conn->query($sql);
}

if($sex){
    $sql = "update Normal set sex ='$sex' where userID = '$id';";
    $conn->query($sql);
}

if($phone){
    $sql = "update Normal set phone ='$phone' where userID = '$id';";
    $conn->query($sql);
}

if($email){
    $sql = "update Normal set email ='$email' where userID = '$id';";
    $conn->query($sql);
}

// header("Location: Parents_Userinfo.php");
?>
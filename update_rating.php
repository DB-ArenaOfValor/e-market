<?php
require_once('db_setup.php');
$sql = "USE eMarket";
$conn->query($sql);

// Get rating info
$ratingID = $_COOKIE['ratingID'];
$buyerID = $_POST['buyerID'];
$sellerID = $_POST['sellerID'];
$PR_PID = $_POST['PR_PID'];
$rating_time = $_POST['rating_time'];

if($conn->query($sql)===TRUE){
//	echo "Connected!";


// Edit the info
if($buyerID){
    $sql = "update Rating set buyerID ='$buyerID' where ratingID = '$ratingID';";
    $conn->query($sql);
}
if($sellerID){
    $sql = "update Rating set sellerID ='$sellerID' where ratingID = '$ratingID';";
    $conn->query($sql);
}
if($PR_PID){
    $sql = "update Rating set PR_PID ='$PR_PID' where ratingID = '$ratingID';";
    $conn->query($sql);
}
if($rating_time){
    $sql = "update Rating set rating_time ='$rating_time' where ratingID = '$ratingID';";
    $conn->query($sql);
}

// header("Location: Parents_Userinfo.php");
?>
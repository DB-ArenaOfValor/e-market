<?php
require_once('db_setup.php');
$sql = "USE eMarket";
$conn->query($sql);

// Get input info
$orderID = $_COOKIE['orderID'];
$buyerID = $_POST['buyerID'];
$order_time = $_POST['order_time'];
$ship_address = $_POST['ship_address'];

if($conn->query($sql)===TRUE){
//	echo "Connected!";


// Edit the info
if($buyerID){
    $sql = "UPDATE Orders set buyerID ='$buyerID' where orderID = '$orderID';";
    $conn->query($sql);
}
if($order_time){
    $sql = "UPDATE Orders set order_time ='$order_time' where orderID = '$orderID';";
    $conn->query($sql);
}
if($ship_address){
    $sql = "UPDATE Orders set ship_address ='$ship_address' where orderID = '$orderID';";
    $conn->query($sql);
}

// header("Location: Parents_Userinfo.php");
?>
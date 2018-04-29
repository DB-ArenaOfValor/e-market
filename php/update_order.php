<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
    die("Connection failed:".mysql_error());
}
else{
    $sql = "use zli80_p1";
    if ($conn->query($sql) === TRUE){

// Get input info
$orderID = $_POST['orderID'];
$buyerID = $_POST['buyerID'];
$order_time = $_POST['order_time'];
$ship_address = $_POST['ship_address'];


// Edit the info
if($buyerID){
    $sql = "UPDATE Orders set buyerID ='$buyerID' where orderID = '$orderID'";
    $conn->query($sql);
}
if($order_time){
    $sql = "UPDATE Orders set order_time ='$order_time' where orderID = '$orderID'";
    $conn->query($sql);
}
if($ship_address){
    $sql = "UPDATE Orders set ship_address ='$ship_address' where orderID = '$orderID'";
    $conn->query($sql);
}
}
else{
        echo "Error using database:".mysql_error();
    }
}
$conn->close();
// header("Location: Parents_Userinfo.php");
?>
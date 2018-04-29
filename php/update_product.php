<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
    die("Connection failed:".mysql_error());
}
else{
    $sql = "use zli80_p1";
    if ($conn->query($sql) === TRUE){

// Get input info
$PID = $_POST['PID'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$year = $_POST['year'];
$color = $_POST['color'];
$use_time = $_POST['use_time'];
$price = $_POST['price'];
$state = $_POST['state'];
$image = $_POST['image'];
$sell_time = $_POST['sell_time'];
$sellerID = $_POST['sellerID'];



// Edit the info
if($brand){
    $sql = "update Product set brand ='$brand' where PID = '$PID'";
    $conn->query($sql);
}
if($model){
    $sql = "update Product set model ='$model' where PID = '$PID'";
    $conn->query($sql);
}
if($year){
    $sql = "update Product set year ='$year' where PID = '$PID'";
    $conn->query($sql);
}
if($color){
    $sql = "update Product set color ='$color' where PID = '$PID'";
    $conn->query($sql);
}
if($use_time){
    $sql = "update Product set use_time ='$use_time' where PID = '$PID'";
    $conn->query($sql);
}
if($price){
    $sql = "update Product set price ='$price' where PID = '$PID'";
    $conn->query($sql);
}
if($state){
    $sql = "update Product set state ='$state' where PID = '$PID'";
    $conn->query($sql);
}
if($image){
    $sql = "update Product set image ='$image' where PID = '$PID'";
    $conn->query($sql);
}
if($sell_time){
    $sql = "update Product set sell_time ='$sell_time' where PID = '$PID'";
    $conn->query($sql);
}
if($sellerID){
    $sql = "update Product set sellerID ='$sellerID' where PID = '$PID'";
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
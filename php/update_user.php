<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
    die("Connection failed:".mysql_error());
}
else{
    $sql = "use zli80_p1";
    if ($conn->query($sql) === TRUE){

// Get user info
$userID = $_POST['userID'];
$password = $_POST['password'];
$sex = $_POST['sex'];
$phone = $_POST['phone'];
$email = $_POST['email'];



// Edit the info
if($password){
    $sql = "update User set password ='$password' where userID = '$userID'";
    $conn->query($sql);
}

if($sex){
    $sql = "update Normal set sex ='$sex' where userID = '$userID'";
    $conn->query($sql);
}

if($phone){
    $sql = "update Normal set phone ='$phone' where userID = '$userID'";
    $conn->query($sql);
}

if($email){
    $sql = "update Normal set email ='$email' where userID = '$userID'";
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
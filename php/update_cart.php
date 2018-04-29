<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
    die("Connection failed:".mysql_error());
}
else{
    $sql = "use zli80_p1";
    if ($conn->query($sql) === TRUE){

// Get input info
$user_cartID = $_POST['user_cartID'];
$cart_PID = $_POST['cart_PID'];



}
else{
        echo "Error using database:".mysql_error();
    }
}
$conn->close();
// header("Location: Parents_Userinfo.php");
?>
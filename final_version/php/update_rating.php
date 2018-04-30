<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
    die("Connection failed:".mysql_error());
}
else{
    $sql = "use zli80_p1";
    if ($conn->query($sql) === TRUE){

// Get rating info
$ratingID = $_POST['ratingID'];
$buyerID = $_POST['buyerID'];
$rating = $_POST['rating'];
$PR_PID = $_POST['PR_PID'];
$rating_time = $_POST['rating_time'];



// Edit the info
if($buyerID){
    $sql = "update Rating set buyerID ='$buyerID' where ratingID = '$ratingID';";
    $conn->query($sql);
}
if($rating){
    $sql = "update Rating set rating ='$rating' where ratingID = '$ratingID';";
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
}
else{
        echo "Error using database:".mysql_error();
    }
}
$conn->close();
// header("Location: Parents_Userinfo.php");
?>

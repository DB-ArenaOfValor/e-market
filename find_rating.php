<?php
require_once('db_setup.php');
$sql = "USE eMarket";
$conn->query($sql);


// Get the input info to find
$ratingID = $_COOKIE['ratingID'];
$buyerID = $_POST['buyerID'];
$sellerID = $_POST['sellerID'];
$PR_PID = $_POST['PR_PID'];
$rating_time = $_POST['rating_time'];


if($conn->query($sql)===TRUE){

    $sql = "SELECT * FROM Rating, User where Rating.sellerID = User.userID  ";
    if($ratingID){$sql += "AND ratingID = $ratingID";}
    if($buyerID){$sql += "AND buyerID = $buyerID";}
    if($sellerID){$sql += "AND sellerID = $sellerID";}
    if($PR_PID){$sql += "AND PR_PID = $PR_PID";}
    if($rating_time){$sql += "AND rating_time = $rating_time";}

    $sql += ";"

    $result = $conn->query($sql);

}

// Split the info from result
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        // Convert into json
        $myobj->ratingID = $row["ratingID"];
        $myobj->buyerID = $row["buyerID"];
        $myobj->sellerID = $row["sellerID"];
        $myobj->PR_PID = $row["PR_PID"];
        $myobj->rating_time = $row["rating_time"];

        // Add into a json file
        $myJSON = json_encode($myobj);

    }
    echo myJSON;
}
else {
    echo "0 results";
}
$conn->close();
?>
<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
    die("Connection failed:".mysql_error());
}
else{
    $sql = "use zli80_p1";
    if ($conn->query($sql) === TRUE){


// Get the input info to find
$ratingID = $_POST['ratingID'];
$buyerID = $_POST['buyerID'];
$sellerID = $_POST['sellerID'];
$PR_PID = $_POST['PR_PID'];
$rating_time = $_POST['rating_time'];
$userName = $_POST['userName'];



    $sql = "SELECT * FROM Rating, User where Rating.sellerID = User.userID  ";
    if($userName){$sql .= " AND User.userName = $userName";}
    if($ratingID){$sql .= " AND Rating.ratingID = $ratingID";}
    if($buyerID){$sql .= " AND Rating.buyerID = $buyerID";}
    if($sellerID){$sql .= " AND RatingsellerID = $sellerID";}
    if($PR_PID){$sql .= " AND Rating.PR_PID = $PR_PID";}
    if($rating_time){$sql .= " AND Rating.rating_time = $rating_time";}

    $sql .= ";";

    $result = $conn->query($sql);



// Split the info from result
if ($result->num_rows > 0) {
    // output data of each row
    $arr = array();
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        // Convert into json
        $myobj = array(
            ratingID => $row["ratingID"],
            buyerID => $row["buyerID"],
            sellerID => $row["sellerID"],
            PR_PID => $row["PR_PID"],
            rating_time => $row["rating_time"]
        );

        $arr[] = $myobj;
    }
    // Add into a json file
    $myJSON = json_encode($arr);
    echo $myJSON;
}
else {
    $arr = array();
    $myobj = array(
            ratingID => NULL,
            buyerID => NULL,
            sellerID => NULL,
            PR_PID => NULL,
            rating_time => NULL
        );

        $arr[] = $myobj;
            $myJSON = json_encode($arr);
            echo $myJSON;
}
}
else{
        echo "Error using database:".mysql_error();
    }
}
$conn->close();
?>
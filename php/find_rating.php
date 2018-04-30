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
$rating = $_POST['rating'];
$buyerID = $_POST['buyerID'];
$PR_PID = $_POST['PR_PID'];
$rating_time = $_POST['rating_time'];
$userName = $_POST['userName'];



    $sql = "SELECT * FROM Rating, User where Rating.buyerID = User.userID  ";
    if($userName){$sql .= " AND User.userName = '$userName'";}
    if($ratingID){$sql .= " AND Rating.ratingID = $ratingID";}
    if($buyerID){$sql .= " AND Rating.buyerID = $buyerID";}
    if($rating){$sql .= " AND Rating.rating = $rating";}
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
	    rating => $row["rating"],
            buyerID => $row["buyerID"],
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
            ratingID => "not found",
	    rating => "not found",
            buyerID => "not found",
            PR_PID => "not found",
            rating_time => "not found"
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

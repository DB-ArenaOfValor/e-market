<?php
require_once('db_setup.php');
$sql = "USE eMarket";
$conn->query($sql);


// Get the input info to find
$userID = $_POST['userID'];
$userName = $_POST["userName"];
$sex = $_POST["sex"]
$phone = $_POST['phone'];
$email = $_POST['email'];


if($conn->query($sql)===TRUE){

    $sql = "SELECT * FROM User, Normal where User.userID = Normal.userID";
    if($userID){$sql += "AND userID = $userID";}
    if($userName){$sql += "AND userName = $userName";}
    if($sex){$sql += "AND sex = $sex";}
    if($phone){$sql += "AND phone = $phone";}
    if($email){$sql += "AND email = $email";}

    $sql += ";"

    $result = $conn->query($sql);

}

// Split the info from result
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        // Convert into json
        $myobj->userID = $row["userID"];
        $myobj->userName = $row["userName"];
        $myobj->password = $row["password"];

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
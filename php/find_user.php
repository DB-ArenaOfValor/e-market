<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
    die("Connection failed:".mysql_error());
}
else{
    $sql = "use zli80_p1";
    if ($conn->query($sql) === TRUE){



// Get the input info to find
$userID = $_POST['userID'];
$userName = $_POST["userName"];
$sex = $_POST["sex"]
$phone = $_POST['phone'];
$email = $_POST['email'];



    $sql = "SELECT * FROM User, Normal where User.userID = Normal.userID";
    if($userID){$sql .= " AND User.userID = $userID";}
    if($userName){$sql .= " AND User.userName = $userName";}
    if($sex){$sql .= " AND User.sex = $sex";}
    if($phone){$sql .= " AND User.phone = $phone";}
    if($email){$sql .= " AND User.email = $email";}

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
            userID => $row["userID"],
            userName => $row["userName"],
            password => $row["password"]
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
            userID => NULL,
            userName => NULL,
            password => NULL
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
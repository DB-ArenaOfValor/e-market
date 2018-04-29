<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
    die("Connection failed:".mysql_error());
}
else{
    $sql = "use zli80_p1";
    if ($conn->query($sql) === TRUE){

// Get the input info to find
$userName = $_POST['userName'];
$orderID = $_POST['orderID'];
$PID = $_POST['PID'];


if($conn->query($sql)===TRUE){

    $sql = "SELECT * FROM Order_detail, Orders where Order_detail.orderID = Orders.orderID AND Order.buyerID = User.userID";
    if($userName){$sql .= "AND User.userName = $userName";}
    if($orderID){$sql .= " AND Order_detailorderID = $orderID";}
    if($PID){$sql .= " AND Order_detailPID = $PID";}

    $sql .= ";";

    $result = $conn->query($sql);

}

// Split the info from result
if ($result->num_rows > 0) {
    // output data of each row
    $arr = array();
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        // Convert into json
        $myobj = array(
            orderID => $row["orderID"],
            PID => $row["PID"]
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
            orderID => NULL,
            PID => NULL
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
<?php
require_once('db_setup.php');
$sql = "USE eMarket";
$conn->query($sql);


// Get the input info to find
$orderID = $_COOKIE['orderID'];
$PID = $_COOKIE['PID'];


if($conn->query($sql)===TRUE){

    $sql = "SELECT * FROM Order_detail, Orders where Order_detail.orderID = Orders.orderID  ";
    if($orderID){$sql += "AND orderID = $orderID";}
    if($PID){$sql += "AND PID = $PID";}

    $sql += ";"

    $result = $conn->query($sql);

}

// Split the info from result
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        // Convert into json
        $myobj->orderID = $row["orderID"];
        $myobj->PID = $row["PID"];

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
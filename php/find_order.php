<?php
require_once('db_setup.php');
$sql = "USE eMarket";
$conn->query($sql);


// Get the input info to find
$orderID = $_POST['orderID'];
$buyerID = $_POST['buyerID'];
$order_time = $_POST['order_time'];
$ship_address = $_POST['ship_address'];


if($conn->query($sql)===TRUE){

    $sql = "SELECT * FROM Orders, User where Product.buyerID = User.userID ";
    if($orderID){$sql += "AND orderID = $orderID";}
    if($buyerID){$sql += "AND buyerID = $buyerID";}
    if($order_time){$sql += "AND order_time = $order_time";}
    if($ship_address){$sql += "AND ship_address = $ship_address";}

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
        $myobj->buyerID = $row["buyerID"];
        $myobj->order_time = $row["order_time"];
        $myobj->ship_address = $row["ship_address"];

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
<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
    die("Connection failed:".mysql_error());
}
else{
    $sql = "use zli80_p1";
    if ($conn->query($sql) === TRUE){
// Get the input info to find
$orderID = $_POST['orderID'];
$buyerID = $_POST['buyerID'];
$order_time = $_POST['order_time'];
$ship_address = $_POST['ship_address'];
$userName = $_POST['userName'];


if($conn->query($sql)===TRUE){

    $sql = "SELECT * FROM Orders, User where Orders.buyerID = User.userID ";
    if($userName){$sql .= " AND User.userName = $userName";}
    if($orderID){$sql .= " AND Orders.orderID = $orderID";}
    if($buyerID){$sql .= " AND Orders.buyerID = $buyerID";}
    if($order_time){$sql .= " AND Orders.order_time = $order_time";}
    if($ship_address){$sql .= " AND Orders.ship_address = $ship_address";}

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
            buyerID => $row["buyerID"],
            order_time => $row["order_time"],
            ship_address => $row["ship_address"]
        );
        $arr[] = $myobj;
        
    }
    // Add into a json file
    $myJSON = json_encode($myobj);

    echo myJSON;
}
else {
    echo "0 results";
}
}
else{
        echo "Error using database:".mysql_error();
    }
}
$conn->close();
?>
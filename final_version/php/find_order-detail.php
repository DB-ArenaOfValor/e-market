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

        $sql = "SELECT * FROM Order_detail, Orders, User where Order_detail.orderID = Orders.orderID AND Orders.buyerID = User.userID";
        if($userName){$sql .= " AND User.userName = '$userName'";}
        if($orderID){$sql .= " AND Order_detail.orderID = $orderID";}
        if($PID){$sql .= " AND Order_detail.PID = $PID";}
        $sql .= ";";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $arr = array();
            while($row = $result->fetch_assoc()) {
                $myobj = array(
                orderID => $row["orderID"],
                PID => $row["PID"]
            );
            $arr[] = $myobj;
            }
        $myJSON = json_encode($arr);
        echo $myJSON;
        }
        else {
            $arr = array();
            $myobj = array(
                orderID => "not found",
                PID => "not found"
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

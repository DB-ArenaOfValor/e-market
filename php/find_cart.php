<?php
require_once('db_setup.php');
$sql = "USE eMarket";
$conn->query($sql);


// Get the input info to find
$user_cartID = $_POST['user_cartID'];
$cart_PID = $_POST['cart_PID'];


if($conn->query($sql)===TRUE){

    $sql = "SELECT * FROM Cart, User where Cart.user_cartID = User.userID  ";
    if($user_cartID){$sql += "AND user_cartID = $user_cartID";}
    if($cart_PID){$sql += "AND cart_PID = $cart_PID";}

    $sql += ";"

    $result = $conn->query($sql);

}

// Split the info from result
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        // Convert into json
        $myobj->user_cartID = $row["user_cartID"];
        $myobj->cart_PID = $row["cart_PID"];

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
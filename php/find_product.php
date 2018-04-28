<?php
require_once('db_setup.php');
$sql = "USE eMarket";
$conn->query($sql);


// Get the input info to find
$PID = $_POST['PID'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$year = $_POST['year'];
$color = $_POST['color'];
$use_time = $_POST['use_time'];
$price = $_POST['price'];
$state = $_POST['state'];
$image = $_POST['image']
$sell_time = $_POST['sell_time'];
$sellerID = $_POST['sellerID'];


if($conn->query($sql)===TRUE){

    $sql = "SELECT * FROM Product, User where Product.sellerID = User.userID ";
    if($PID){$sql += "AND PID = $PID";}
    if($brand){$sql += "AND brand = $brand";}
    if($model){$sql += "AND model = $model";}
    if($year){$sql += "AND year = $year";}
    if($color){$sql += "AND color = $color";}
    if($use_time){$sql += "AND use_time = $use_time";}
    if($price){$sql += "AND price = $price";}
    if($image){$sql += "AND image = $image";}
    if($sell_time){$sql += "AND sell_time = $sell_time";}
    if($sellerID){$sql += "AND sellerID = $sellerID";}

    $sql += ";"

    $result = $conn->query($sql);

}

// Split the info from result
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        // Convert into json
        $myobj->PID = $row["PID"];
        $myobj->brand = $row["brand"];
        $myobj->model = $row["model"];
        $myobj->year = $row["year"];
        $myobj->color = $row["color"];
        $myobj->use_time = $row["use_time"];
        $myobj->price = $row["price"];
        $myobj->state = $row["state"];
        $myobj->image = $row["image"];
        $myobj->sell_time = $row["sell_time"];
        $myobj->sellerID = $row["sellerID"];

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
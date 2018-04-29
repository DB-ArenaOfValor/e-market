<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
    die("Connection failed:".mysql_error());
}
else{
    $sql = "use zli80_p1";
    if ($conn->query($sql) === TRUE){
        // Get the input info to find
        $PID = $_POST['PID'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $color = $_POST['color'];
        $use_time = $_POST['use_time'];
        $price = $_POST['price'];
        $state = $_POST['state'];
        $image = $_POST['image'];
        $sell_time = $_POST['sell_time'];
        $sellerID = $_POST['sellerID'];
        $userName = $_POST['userName'];

        $sql = "SELECT * FROM Product, User where Product.sellerID = User.userID"; 
        if($userName) {$sql .= " AND Product.userName = '$userName'";}
        if($PID) {$sql .= " AND Product.PID = '$PID'";}
        if($brand) {$sql .= " AND Product.brand = '$brand'";}
        if($model) {$sql .= " AND Product.model = '$model'";}
        if($year) {$sql .= " AND Product.year = '$year'";}
        if($color) {$sql .= " AND Product.color = '$color'";}
        if($use_time) {$sql .= " AND Product.use_time = '$use_time'";}
        if($price) {$sql .= " AND Product.price = '$price'";}
        if($image) {$sql .= " AND Product.image = '$image'";}
        if($sell_time) {$sql .= " AND Product.sell_time = '$sell_time'";}
        if($sellerID) {$sql .= " AND Product.sellerID = '$sellerID'";}
        $sql .= ";";
        $result = $conn->query($sql);
        // Split the info from result
        if ($result->num_rows > 0) {
            $arr = array();
            // output data of each row
            while($row = $result->fetch_assoc()) {
                // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                // Convert into json
                $myobj = array(
                    PID => $row["PID"],
                    brand => $row["brand"],
                    model => $row["model"],
                    year => $row["year"],
                    color => $row["color"],
                    use_time => $row["use_time"],
                    price => $row["price"],
                    state => $row["state"],
                    image => $row["image"],
                    sell_time => $row["sell_time"],
                    sellerID => $row["sellerID"]
                );
                
                // Add into a json file
                $arr[] = $myobj;
                
            }
            $myJSON = json_encode($arr);
            echo $myJSON;
        }
        else {
            $arr = array();
            $myobj = array(
                    PID => NULL,
                    brand => NULL,
                    model => NULL,
                    year => NULL,
                    color => NULL,
                    use_time => NULL,
                    price => NULL,
                    state => NULL,
                    image => NULL,
                    sell_time => NULL,
                    sellerID => NULL
                );
                
                // Add into a json file
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
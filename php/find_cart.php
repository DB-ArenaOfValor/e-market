<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
    die("Connection failed:".mysql_error());
}
else{
    $sql = "use zli80_p1";
    if ($conn->query($sql) === TRUE){
        // Get the input info to find
        $user_cartID = $_POST['user_cartID'];
        $cart_PID = $_POST['cart_PID'];


        if($conn->query($sql)===TRUE){

            $sql = "SELECT * FROM Cart, User where Cart.user_cartID = User.userID  ";
            if($user_cartID){$sql += "AND user_cartID = $user_cartID";}
            if($cart_PID){$sql += "AND cart_PID = $cart_PID";}

            $sql += ";";

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
    }
    else{
        echo "Error using database:".mysql_error();
    }
}
$conn->close();
?>
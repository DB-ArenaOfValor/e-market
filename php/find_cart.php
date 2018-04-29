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
        $userName = $_POST['userName'];


        if($conn->query($sql)===TRUE){

            $sql = "SELECT * FROM Cart, User where Cart.user_cartID = User.userID  ";
            if($userName){$sql .=" AND User.userName= $userName";}
            if($user_cartID){$sql .= " AND Cart.user_cartID = $user_cartID";}
            if($cart_PID){$sql .= " AND Cart.cart_PID = $cart_PID";}

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
                    user_cartID => $row["user_cartID"],
                    cart_PID => $row["cart_PID"]
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
                    user_cartID => NULL,
                    cart_PID => NULL
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
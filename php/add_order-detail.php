<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
	die("Connection failed:".mysql_error());
}
else{
	$sql = "use zli80_p1";
	if ($conn->query($sql) === TRUE){
		$orderID = $_POST['orderID'];
		$PID = $_POST['PID'];

		$userName = $_POST['userName'];
		if($userName){
			$query = "select * from User, Orders where User.userID = Orders.buyerID and userName = '$userName' order by orderID DESC limit 1;";
			$result = $conn->query($query);
			$row = $result->fetch_assoc();
			$real_orderID = $row['orderID'];
			$query1 = "select * from Product where PID = '$PID';";
			$result1 = $conn->query($query1);
			$row1 = $result1->fetch_assoc();
			$state = $row1['state'];
			if ($orderID === $real_orderID && $state == 0){
				$query2 = "insert into Order_detail values('$orderID', '$PID');";
				if($conn->query($query2) === TRUE){
					$query8 = "delete from Cart where cart_PID = '$PID';";
					if($conn->query($query8) === FALSE){
						$output->success = FALSE;
                                        	$myJSON = json_encode($output);
                                        	echo $myJSON;
					}
					$query3 = "update Product set state = 1 where PID = '$PID';";
					$conn->query($query3);
					$output->success = TRUE;
					$myObj = array(
						orderID => $orderID,
						PID => $PID
					);
					$output->data = $myObj;
					$myJSON = json_encode($output);
					echo $myJSON;
				}
				else{
					$output->success = FALSE;
					$myJSON = json_encode($output);
					echo $myJSON;
				}
			}
			else{
				$output->success = FALSE;
				$myJSON = json_encode($output);
				echo $myJSON;
			}
		}
		else{
			$query4 = "select * from Orders where orderID = '$orderID';";
			$result4 = $conn->query($query4);
			$query5 = "select * from Product where PID = '$PID';";
			$result5 = $conn->query($query5);
			$row5 = $result5->fetch_assoc();
			$state = $row5['state'];
			if($result4->num_rows > 0 && $state == 0){
				$query6 = "insert into Order_detail values('$orderID', '$PID');";
				if($conn->query($query6) === TRUE){
					$query9 = "delete from Cart where cart_PID = '$PID';";
                                        if($conn->query($query9) === FALSE){
                                                $output->success = FALSE;
                                                $myJSON = json_encode($output);
                                                echo $myJSON;
                                        }

					$query7 = "update Product set state = 1 where PID = '$PID';";
					$conn->query($query7);
					$output->success = TRUE;
					$myObj = array(
						orderID => $orderID,
						PID => $PID
					);
					$output->data = $myObj;
					$myJSON = json_encode($output);
					echo $myJSON;
				}
				else{
					$output->success = FALSE;
					$myJSON = json_encode($output);
					echo $myJSON;
				}
			}
			else{
				echo "ddd";
				$output->success = FALSE;
				$myJSON = json_encode($output);
				echo $myJSON;
			}
		}

	}
	else{
		echo "Error using database:".mysql_error();
	}
}
$conn->close();
?>

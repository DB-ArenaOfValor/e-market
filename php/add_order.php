<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
	die("Connection failed:".mysql_error());
}
else{
	$sql = "use zli80_p1";
	if ($conn->query($sql) === TRUE){
		// $orderID = $_POST['orderID'];
		$buyerID = $_POST['buyerID'];
		// $order_time = $_POST['order_time'];
		$ship_address = $_POST['ship_address'];
		$userName = $_POST['userName'];
		if($userName){
			$query = "select userID from User where userName = '$userName';";
			$result = $conn->query($query);
			$row = $result->fetch_assoc();
			$userID = $row['userID'];

			if($buyerID === $userID){
				if(!$ship_address){
					$output->success = FALSE;
					$myJSON = json_encode($output);
					echo $myJSON;
				}
				else{
					$query1 = "insert into Orders (buyerID, ship_address) values ('$buyerID', '$ship_address');";
					if($conn->query($query1) === TRUE){
						$query2 = "select * from Orders where buyerID = '$buyerID' and ship_address = '$ship_address' order by orderID DESC limit 1;";
						$result2 = $conn->query($query2);
						$row = $result2->fetch_assoc();
						$myObj = array(
							orderID => $row['orderID'],
							buyerID => $row['buyerID'],
							order_time => $row['order_time'],
							ship_address => $row['ship_address']
						);
						$output->success = TRUE;
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
			}
			else{
				$output->success = FALSE;
				$myJSON = json_encode($output);
				echo $myJSON;
			}
		}
		else{
			$query = "select * from User where userID = '$buyerID';";
			$result = $conn->query($query);
			if($result->num_rows > 0){
				if(!$ship_address){
					$output->success = FALSE;
					$myJSON = json_encode($output);
					echo $myJSON;
				}
				else{
					$query1 = "insert into Orders (buyerID, ship_address) values ('$buyerID', '$ship_address');";
					if($conn->query($query1) === TRUE){
						$query2 = "select * from Orders where buyerID = '$buyerID' and ship_address = '$ship_address' order by orderID DESC limit 1;";
						$result2 = $conn->query($query2);
						$row = $result2->fetch_assoc();
						$myObj = array(
							orderID => $row['orderID'],
							buyerID => $row['buyerID'],
							order_time => $row['order_time'],
							ship_address => $row['ship_address']
						);
						$output->success = TRUE;
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
			}
			else{
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

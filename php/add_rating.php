<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
	die("Connection failed:".mysql_error());
}
else{
	$sql = "use zli80_p1";
	if ($conn->query($sql) === TRUE){
		$rating = $_POST['rating'];
		$buyerID = $_POST['buyerID'];
		$PR_PID = $_POST['PR_PID'];
		$userName = $_POST['userName'];
		if($userName){
			$query = "select userID from User where userName = '$userName';";
			$result = $conn->query($query);
			$row = $result->fetch_assoc();
			$userID = $row['userID'];
			$query1 = "select * from Orders, Order_detail where Orders.orderID = Order_detail.orderID and buyerID = '$userID' and PID = '$PR_PID';";
			$result1 = $conn->query($query1);

			if($rating && $result1->num_rows > 0){
				$query2 = "insert into Rating (rating, buyerID, PR_PID) values ('$rating', '$buyerID', '$PR_PID');";
				if($conn->query($query2) === TRUE){
					$query3 = "select * from Rating order by ratingID DESC limit 1;";
					$result3 = $conn->query($query3);
					$row3 = $result3->fetch_assoc();
					$output->success = TRUE;
					$myObj = array(
						ratingID => $row3['ratingID'],
						rating => $row3['rating'],
						buyerID => $row3['buyerID'],
						PR_PID => $row3['PR_PID'],
						rating_time => $row3['rating_time']
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
			$query4 = "select * from Orders, Order_detail where Orders.orderID = Order_detail.orderID and buyerID = '$buyerID' and PID = '$PR_PID';";
			$result4 = $conn->query($query4);

			if($rating && $result4->num_rows > 0){
				$query5 = "insert into Rating (rating, buyerID, PR_PID) values ('$rating', '$buyerID', '$PR_PID');";
				if($conn->query($query5) === TRUE){
					$query6 = "select * from Rating order by ratingID DESC limit 1;";
					$result6 = $conn->query($query6);
					$row6 = $result6->fetch_assoc();
					$output->success = TRUE;
					$myObj = array(
						ratingID => $row6['ratingID'],
						rating => $row6['rating'],
						buyerID => $row6['buyerID'],
						PR_PID => $row6['PR_PID'],
						rating_time => $row6['rating_time']
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
	}
	else{
		echo "Error using database:".mysql_error();
	}
}
$conn->close();
?>

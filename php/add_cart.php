<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
	die("Connection failed:".mysql_error());
}
else{
	$sql = "use zli80_p1";
	if ($conn->query($sql) === TRUE){
		$user_cartID = $_POST['user_cartID'];
		$cart_PID = $_POST['cart_PID'];
		$userName = $_POST['userName'];

		if($userName){
			$query = "select userID from User where userName = '$userName';";
			$result = $conn->query($query);
			$row = $result->fetch_assoc();
			$userID = $row['userID'];
			$query1 = "select * from Product where PID = '$cart_PID';";
			$result1 = $conn->query($query1);
			$row1 = $result1->fetch_assoc();
			$state = $row1['state'];
			if($state == 0){
				$query2 = "insert into Cart values ('$userID', '$cart_PID');";
				if($conn->query($query2) === TRUE){
					$output->success = TRUE;
					$myObj = array(
						user_cartID => $userID,
						cart_PID => $cart_PID
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
			$query3 = "select * from Product where PID = '$cart_PID';";
			$result3 = $conn->query($query3);
			$row3 = $result3->fetch_assoc();
			$state = $row3['state'];
			if($state == 0){
				$query4 = "insert into Cart values ('$user_cartID', '$cart_PID');";
				if($conn->query($query4) === TRUE){
					$output->success = TRUE;
					$myObj = array(
						user_cartID => $user_cartID,
						cart_PID => $cart_PID
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

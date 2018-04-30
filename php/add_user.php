<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
	die("Connection failed:".mysql_error());
}
else{
	$sql = "use zli80_p1";
	if ($conn->query($sql) === TRUE){
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$sex = $_POST['sex'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];

		if(!$userName || !$password){
			$output->success = FALSE;
			$myJSON = json_encode($output);
			echo $myJSON;
		}
		else{	
		$query = "insert into User (userName, password) values ('$userName', '$password');";
		if($conn->query($query) === FALSE){
			echo "<script> alert('User Name Exists...'); </script>";
		}
		else{
			$query1 = "select userID from User where userName = '$userName';";
			$result = $conn->query($query1);
			if ($result->num_rows > 0){
				$row = $result->fetch_assoc();
				$userID = $row['userID'];
				$query2 = "insert into Normal values ('$userID', '$sex', '$phone', '$email');";
				if($conn->query($query2) === TRUE){
					$myObj = array(
						userID => $userID,
						userName => $userName,
						password => $password,
						sex => $sex,
						phone => $phone,
						email => $email
					);
					$output->success = TRUE;
					$output->data = $myObj;
					$myJSON = json_encode($output);
					echo $myJSON;
				}
				else{
					echo "failed to add normal:".mysql_error();
				}
			}
			else{
				echo "failed to add user:".mysql_error();
			}
		}
		}
	}
	else{
		echo "Error using database:".mysql_error();
	}
}
$conn->close();
?>

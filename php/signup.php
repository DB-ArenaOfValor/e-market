<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
	die("Connection failed:".mysql_error());
}
else{
	$sql = "use zli80_p1";
	if ($conn->query($sql) === TRUE){
		$userName = $_POST['user'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$query = "select * from User where userName = '$userName';";
		$result = $conn->query($query);
		if($result->num_rows > 0){
			echo "<script> alert('User Name Exists...'); </script>";
			header('Refresh:0.1; url=../index.html');
		}
		else{
			$query1 = "insert into User (userName, password) values ('$userName', '$password');";
			if($conn->query($query1) === TRUE){
				$query2 = "select userID from User where userName = '$userName';";
				$result2 = $conn->query($query2);
				$row = $result2->fetch_assoc();
				if($row){
					$userID = $row['userID'];
					$query3 = "insert into Normal (userID, email) values('$userID', '$email');";
					$conn->query($query3);
					setcookie("userName", $userName);
					setcookie("password", $password);
					header("location: ../user.html?userName=$userName?userID=$userID");
				}
				else{
					echo "Wrong user ID";
				}
			}
			else{
				echo "Insert error";
			}
		}
	}
	else{
		echo "Error using database:".mysql_error();
	}
}
$conn->close();
?>

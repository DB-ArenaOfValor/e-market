<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
	die("Connection failed:".mysql_error());
}
else{
	$sql = "use zli80_p1";
	if ($conn->query($sql) === TRUE){
		$userID = $_POST['userID'];
		$query = "delete from User where userID = '$userID';";
		if($conn->query($query) === TRUE){
			$query1 = "select * from Product where sellerID = '$userID' and state = 0;";
			$result1 = $conn->query($query1);
			if ($result1->num_rows > 0){
				$query2 = "delete from Product where sellerID = '$useID' and state = 0;";
				if($conn->query($query2) === TRUE){
                                	// success
                        	}
                        	else{
                                	echo "Failed to delete product:".mysql_error();
                        	}

			}
		}
		else{
			echo "Failed to delete:".mysql_error();
		}
	}
	else{
		echo "Error database:".mysql_error();
	}
}
$conn->close();
?>

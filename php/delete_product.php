<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
	die("Connection failed:".mysql_error());
}
else{
	$sql = "use zli80_p1";
	if ($conn->query($sql) === TRUE){
		$PID = $_POST['PID'];
		$query = "delete from Product where PID = '$PID';";
		if($conn->query($query) === TRUE){
			// return nothing
		}
		else{
			echo "Failed to delete:".mysql_error();
		}
	}
	else{
		echo "Error database:".mysql_error();
	}
}
?>
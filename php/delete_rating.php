<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
	die("Connection failed:".mysql_error());
}
else{
	$sql = "use zlin80_p1";
	if ($conn->query($sql) === TRUE){
		$ratingID = $_POST['ratingID'];
		$query = "delete from Rating where ratingID = '$ratingID';";
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
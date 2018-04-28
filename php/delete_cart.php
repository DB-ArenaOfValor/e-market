<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
	die("Connection failed:".mysql_error());
}
else{
	$sql = "use zlin80_p1";
	if ($conn->query($sql) === TRUE){
		$user_cartID = $_POST['user_cartID'];
		$cart_PID = $_POST['cart_PID'];
		$query = "delete from Cart where user_cartID = '$user_cartID' and cart_PID = '$cart_PID';";
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
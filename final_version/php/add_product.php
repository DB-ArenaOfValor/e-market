<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error) {
	die("Connection failed:".mysql_error());
}
else{
	$sql = "use zli80_p1";
	if ($conn->query($sql) === TRUE){
		// $PID = $_POST['PID'];
		$brand = $_POST['brand'];
		$model = $_POST['model'];
		$year = $_POST['year'];
		$color = $_POST['color'];
		$use_time = $_POST['use_time'];
		$price = $_POST['price'];
		// $state = $_POST['state'];
		$image = $_POST['image'];
		// $sell_time = $_POST['sell_time'];
		$sellerID = $_POST['sellerID'];

		if (!$brand||!$model||!$year||!$color||!$use_time||!$price||!$image||!$sellerID){
			$output->success = FALSE;
			$myJSON = json_encode($output);
			echo $myJSON;
		}
		else{
		$query = "insert into Product (brand, model, year, color, use_time, price, image, sellerID) values ('$brand', '$model', '$year', '$color', '$use_time', '$price', '$image', '$sellerID');";
		if ($conn->query($query) === TRUE){
			$query1 = "select * from Product where brand = '$brand' and model = '$model' and year = '$year' and color = '$color' and use_time = '$use_time' and price = '$price' and image = '$image' and sellerID = '$sellerID';";
			$result = $conn->query($query1);
			$row = $result->fetch_assoc();
			$myObj = array(
				PID => $row['PID'],
				brand => $row['brand'],
				model => $row['model'],
				year => $row['year'],
				color => $row['color'],
				use_time => $row['use_time'],
				price => $row['price'],
				state => $row['state'],
				image => $row['image'],
				sell_time => $row['sell_time'],
				sellerID =>$row['sellerID']
			);
			$output->success = TRUE;
			$output->data = $myObj;
			$myJSON = json_encode($output);
			echo $myJSON;
		}
		else{
			// echo "Failed to add product:".mysql_error();
			$myObj = array(
				PID => "error",
				brand => "error",
				model => "error",
				year => "error",
				color => "error",
				use_time => "error",
				price => "error",
				state => "error",
				image => "error",
				sell_time => "error",
				sellerID => "error"
			);
			$output->success = FALSE;
			$output->data = $myObj;
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

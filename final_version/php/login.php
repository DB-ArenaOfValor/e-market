<?php
$conn = new mysqli("localhost", "zli80", "950115");
if ($conn->connect_error){
        die("Connection failed:".mysql_error());
}
else{
        $sql = "use zli80_p1;";
        if ($conn->query($sql) === TRUE){
                $userName = $_POST['user'];
                $password = $_POST['password'];
                $query = "select * from User where userName = '$userName' and password = '$password';";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                if($row){
                        $userID = $row['userID'];
                        $query1 = "select userID from Normal where userID = '$userID';";
                        $result1 = $conn->query($query1);
                        $row1 = $result1->fetch_assoc();
                        if($row1){
                        	setcookie("userName", $row['userName']);
                                setcookie("password", $row['password']);
				$url = $row['userName'];
                                header("location: ../user.html?userName=$url&userID=$userID");
                        }
                        else{
                        	setcookie("userName", $row['userName']);
                                setcookie("password", $row['password']);
                                header("location: ../admin.html");
                        }
                }
                else{
			echo "<script> alert('Please make sure you enter the right information or you already have an account...'); </script>";
                        header('Refresh:0.1; url = ../index.html');
                }
        }
        else{
                echo "Error database:".mysql_error();
        }
}
$conn->close();
?>

<?php

	$card = $_GET["card"];
	$con = mysqli_connect('182.50.151.70', 'RFID', 'RFID47');
	if(!$con){
		echo "Fail";
		die("Connection failed: " .mysql_error());
	}
	
	mysqli_select_db($con, 'RFID');
	
	$query = "SELECT * FROM Customers WHERE Cust_ID='{$card}'";
	
	$result = mysqli_query($con, $query);
	
	$row = mysqli_fetch_assoc($result);
	
	if($card == $row["Cust_ID"]){
		$query = "SELECT * FROM Balance WHERE Cust_ID='{$card}'";
		$result2 = mysqli_query($con, $query);
		$row2 = mysqli_fetch_assoc($result2);
		echo $row2["Bal"];
		echo "\r\n";
		echo $row["Phone_No"]."\r\n";
	}
	else{
		echo "Invalid";
	}

?>
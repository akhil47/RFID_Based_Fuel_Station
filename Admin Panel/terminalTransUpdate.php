<?php
	$card = $_GET["card"];
	$amount = $_GET["amount"];
	$branch = $_GET["branch"];
	$tno = $_GET["tno"];
	$status = $_GET["status"];
	
	$con = mysqli_connect('182.50.151.70', 'RFID', 'RFID47');
	if(!$con){
		echo "Fail";
		die("Connection failed: " .mysql_error());
	}
	
	mysqli_select_db($con, 'RFID');
	
	$query = "SELECT * FROM Customers WHERE Cust_ID='{$card}'";
	
	if($result = mysqli_query($con, $query)){
		$row = mysqli_fetch_assoc($result);
		$licenseNo = $row["License_No"];
		$query = "SELECT * FROM Balance WHERE Cust_ID='{$card}'";
		if($result = mysqli_query($con, $query)){
			$row = mysqli_fetch_assoc($result);
			if($status == "Success"){
				$currBal = $row["Bal"];
				$currBal = $currBal - $amount;
				$query = "UPDATE Balance SET Bal={$currBal} WHERE Cust_ID='{$card}'";
			}
			if(mysqli_query($con, $query)){
				echo "Success";
				$query = "INSERT INTO Transactions (Cust_ID, License_No, Location, Terminal_No, Amount, Status) VALUES ('{$card}', '{$licenseNo}', '{$branch}', {$tno}, {$amount}, '{$status}')";
				mysqli_query($con, $query);
			}
			else{
				echo "Failed";
			}
		}
		else{
			echo "Failed";
		}
	}
	else{
		echo "Failed";
	}

?>
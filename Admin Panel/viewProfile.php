<?php

	session_start();
	if($_SESSION["loggedIn"] != true) {
		header("Location: http://www.rfid84.xyz/login.php?msg=Please 'Login' to access the WebPage!");
		exit();
	}
	
	$fullName = "";
	$dateOfBirth = "";
	$phoneNo = "";
	$address = "";
	$licenseNo = "";
	$custID = "";
	$joinDate = "";
	$balance = "Rs. ";
	$con = mysqli_connect('182.50.151.70', 'RFID', 'RFID47');
	if(!$con){
		die("Connection failed: " .mysql_error());
	}
	mysqli_select_db($con, "RFID");
	$query = "";
	
	if($_GET){
		$query = "SELECT * FROM Customers WHERE Cust_ID = '{$_GET["Cust_ID"]}'";
		$result = mysqli_query($con, $query);
		if($result){
			if (mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				$fullName = $row["Name"];
				$dateOfBirth = $row["DOB"];
				$phoneNo = $row["Phone_No"];
				$address = $row["Address"];
				$licenseNo = $row["License_No"];
				$custID = $row["Cust_ID"];
				$joinDate = $row["Joining_Date"];
			}
		}
		$query = "SELECT * FROM Balance WHERE Cust_ID = '{$_GET["Cust_ID"]}'";
		$result = mysqli_query($con, $query);
		if($result){
			if (mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				$balance .= $row["Bal"];
			}
		}
	}
?>
<html>
	<head>
		<title><?php echo $fullName;?></title>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/viewProfile.css"/>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/header.css"/>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/sideBar.css"/>
		<script>
			function display(image) {
				image.src = "http://www.rfid84.xyz/images/HomeButtonHover.png";
			}									
			function hide(image) {
				image.src = "http://www.rfid84.xyz/images/HomeButton.png";
			}
			function displaySubmit(image) {
				image.src = "http://www.rfid84.xyz/images/submitHover.png";
			}
			function hideSubmit(image) {
				image.src = "http://www.rfid84.xyz/images/submit.png";
			}
		</script>
	</head>
	<center>
		<body>
			<div id = "mainContainer">
				<div id ="Header">
					<a href="http://www.rfid84.xyz/home.php"><img id = "logo" src = "http://www.rfid84.xyz/images/Logo.png"/></a>
					<img id = "adminButton" src = "http://www.rfid84.xyz/images/adminButton.png"/>
					<a  class = "headerText" href="http://www.rfid84.xyz/logout.php"><text>Logout</text></a>
					<a  class = "headerText" href="http://www.rfid84.xyz/changePassword.php"><text>Change Password</text></a>
					<a  class = "headerText" href="http://www.rfid84.xyz/deposit.php"><text>Deposit</text></a>
					<a id = "homeButton" href="http://www.rfid84.xyz/home.php"><img src = "http://www.rfid84.xyz/images/HomeButton.png" onmouseenter =
						"display(this)" onmouseleave = "hide(this)"/></a>
				</div>
				<div id ="contentContainer">
					<div id = "sideBar">
						<div class = "Bar">
							<img class = "BarIcon"src = "http://www.rfid84.xyz/images/registration1.png"/>
							<a class = "sideBarText" href="http://www.rfid84.xyz/registration.php"><text class = "sideBar" id = "sideBarReg">
								Registration</text></a>
						</div>
						<div class = "Bar">
							<img class = "BarIcon"src = "http://www.rfid84.xyz/images/customerSearch1.png"/>
							<a class = "sideBarText" href="http://www.rfid84.xyz/customerSearch.php"><text class = "sideBar" id = "sideBarCS">
								Customer Search</text></a>
						</div>
						<div class = "Bar">
							<img class = "BarIcon"src = "http://www.rfid84.xyz/images/transactionSearch1.png"/>
							<a class = "sideBarText" href="http://www.rfid84.xyz/transactionSearch.php"><text class = "sideBar" id = "sideBarTS">
								Transaction Search</text></a>
						</div>
					</div>
					<div id = "contentDisplay">
						<div class = "contentSections">
							<div class = "contentSubSectionLeft">
								<label class = "textLabels">Full Name</label>
							</div>
							<div class = "contentSubSectionMiddle"><label class = "textSeperators">:</label></div>
							<div class = "contentSubSectionRight">
								<text class = "textContent"><?php echo $fullName;?></text>
							</div>
						</div>
						<div class = "contentSections">
							<div class = "contentSubSectionLeft">
								<label class = "textLabels">Date of birth</label>
							</div>
							<div class = "contentSubSectionMiddle"><label class = "textSeperators">:</label></div>
							<div class = "contentSubSectionRight">
								<text class = "textContent"><?php echo $dateOfBirth;?></text>
							</div>
						</div>
						<div class = "contentSections">
							<div class = "contentSubSectionLeft">
								<label class = "textLabels">Phone No</label>
							</div>
							<div class = "contentSubSectionMiddle"><label class = "textSeperators">:</label></div>
							<div class = "contentSubSectionRight">
								<text class = "textContent"><?php echo $phoneNo;?></text>
							</div>
						</div>
						<div class = "contentSections">
							<div class = "contentSubSectionLeft">
								<label class = "textLabels">Address</label>
							</div>
							<div class = "contentSubSectionMiddle"><label class = "textSeperators">:</label></div>
							<div class = "contentSubSectionRight">
								<text class = "textContent"><?php echo $address;?></text>
							</div>
						</div>
						<div class = "contentSections">
							<div class = "contentSubSectionLeft">
								<label class = "textLabels">License No</label>
							</div>
							<div class = "contentSubSectionMiddle"><label class = "textSeperators">:</label></div>
							<div class = "contentSubSectionRight">
								<text class = "textContent"><?php echo $licenseNo;?></text>
							</div>
						</div>
						<div class = "contentSections">
							<div class = "contentSubSectionLeft">
								<label class = "textLabels">Customer ID</label>
							</div>
							<div class = "contentSubSectionMiddle"><label class = "textSeperators">:</label></div>
							<div class = "contentSubSectionRight">
								<text class = "textContent"><?php echo $custID;?></text>
							</div>
						</div>
						<div class = "contentSections">
							<div class = "contentSubSectionLeft">
								<label class = "textLabels">Joining Date</label>
							</div>
							<div class = "contentSubSectionMiddle"><label class = "textSeperators">:</label></div>
							<div class = "contentSubSectionRight">
								<text class = "textContent"><?php echo $joinDate;?></text>
							</div>
						</div>
						<div class = "contentSections">
							<div class = "contentSubSectionLeft">
								<label class = "textLabels">Balance</label>
							</div>
							<div class = "contentSubSectionMiddle"><label class = "textSeperators">:</label></div>
							<div class = "contentSubSectionRight">
								<text class = "textContent"><?php echo $balance;?></text>
							</div>
						</div>
						<div id = "recentTransactions">
							<div id = "title">
								<i><label id = "titleContent" >Recent transactions made by the customer(max 5 tnx.):</label></i>
							</div>
							<?php
									$query = "SELECT * FROM Transactions WHERE Cust_ID = '{$custID}' ORDER BY Date_Time DESC LIMIT 5";
									$result = mysqli_query($con, $query);
									if($result){
										if (mysqli_num_rows($result) > 0){
											echo "<div id = \"searchResultsHeader\">";
												echo "<div id = \"Header1\">";
													echo "<text class = \"headerLabels\">Tnx No</text>";
												echo "</div>";
												echo "<div class = \"seperators\"></div>";
												echo "<div id = \"Header2\">";
													echo "<text class = \"headerLabels\">Date & Time</text>";
												echo "</div>";
												echo "<div class = \"seperators\"></div>";
												echo "<div id = \"Header3\">";
													echo "<text class = \"headerLabels\">Branch</text>";
												echo "</div>";
												echo "<div class = \"seperators\"></div>";
												echo "<div id = \"Header4\">";
													echo "<text class = \"headerLabels\">T.No</text>";
												echo "</div>";
												echo "<div class = \"seperators\"></div>";
												echo "<div id = \"Header5\">";
													echo "<text class = \"headerLabels\">Amount</text>";
												echo "</div>";
												echo "<div class = \"seperators\"></div>";
												echo "<div id = \"Header6\">";
													echo "<text class = \"headerLabels\">Status</text>";
												echo "</div>";
											echo "</div>";
											echo "<div id = \"searchResults\">";
											while($row = mysqli_fetch_assoc($result)){
												echo "<div class = \"results\">";
													echo "<div class = \"searchField1\">";
														echo "<text class = \"label1\">{$row["Trans_No"]}</text>";
													echo "</div>";
													echo "<div class = \"seperators\"></div>";
													echo "<div class = \"searchField2\">";
														echo "<text class = \"label2\">{$row["Date_Time"]}</text>";
													echo "</div>";
													echo "<div class = \"seperators\"></div>";
													echo "<div class = \"searchField3\">";
														echo "<text class = \"label3\">{$row["Location"]}</text>";
													echo "</div>";
													echo "<div class = \"seperators\"></div>";
													echo "<div class = \"searchField4\">";
														echo "<text class = \"label4\">{$row["Terminal_No"]}</text>";
													echo "</div>";
													echo "<div class = \"seperators\"></div>";
													echo "<div class = \"searchField5\">";
														echo "<text class = \"label5\">{$row["Amount"]}</text>";
													echo "</div>";
													echo "<div class = \"seperators\"></div>";
													echo "<div class = \"searchField6\">";
														echo "<text class = \"label6\">{$row["Status"]}</text>";
													echo "</div>";
												echo "</div>";
											}
											echo "</div>";
										}
										else
											echo "<h3>No Transactions are made yet!<h3>";
									}
									else
										echo "<h3>No Transactions are made yet!<h3>";
							?>
						</div>
					</div>
				</div>
			</div>
		</body>
	</center>
</html>
<?php
	session_start();
	if($_SESSION["loggedIn"] != true) {
		header("Location: http://www.rfid84.xyz/login.php?msg=Please 'Login' to access the WebPage!");
		exit();
	}
	$cidError = "";
	$balError = "";
	
	$con = mysqli_connect('182.50.151.70', 'RFID', 'RFID47');
	if(!$con){
		die("Connection failed: " .mysqli_error());
	}
	
	mysqli_select_db($con, "RFID");
	$query = "";
	$flag = false;
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(empty($_POST["cid"])){
			$cidError = "Please enter customer ID!";
		}
		else{
			$query = "SELECT * FROM Balance WHERE Cust_ID = '{$_POST["cid"]}'";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				if((int)$_POST["depositBal"] < 100){
					$balError = "Minimum deposit amount is Rs. 100";
				}
				else if((int)$_POST["depositBal"] + (int)$row["Bal"] > 10000){
					$temp = 10000 - (int)$row["Bal"];
					$balError = "Deposit amount exceeding Rs. 10000, Current depositable amount is : Rs. ".$temp;
				}
				else{
					$newBalance = (int)$_POST["depositBal"] + (int)$row["Bal"];
					$flag = true;
				}
			}
			else
				$cidError = "No records exist with Customer ID : ".$_POST["cid"];
		}
	}
	
	if($flag){
		$query = "UPDATE Balance SET Bal = '{$newBalance}' WHERE Cust_ID = '{$_POST["cid"]}'";
		if(mysqli_query($con, $query))
			echo '<script type="text/javascript">window.location = "http://www.rfid84.xyz/formSubmit.php?msg=Deposit Successful!"</script>';
		else
			echo '<script type="text/javascript">window.location = "http://www.rfid84.xyz/formSubmit.php?msg=Deposit Unsuccessful! Try Again!"</script>';
	}

?>
<html>
	<head>
		<title>Deposit</title>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/deposit.css"/>
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
				image.src = "http://www.rfid84.xyz/images/depositHover.png";
			}
			function hideSubmit(image) {
				image.src = "http://www.rfid84.xyz/images/deposit.png";
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
						<div id = "depositHeader">
							<text id = "depositHeaderText"> Customer Balance Deposit </text>
						</div>
						<div id = "depositForm">
							<form method = "POST" action = "http://www.rfid84.xyz/deposit.php">
								<div class = "depositFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "depositLabels">Customer ID :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = text class = "depositFields" name = "cid" value =
														"<?php
															if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["cid"]);
															else echo htmlspecialchars("");
														?>"
													/>
												</div>
												<div class = "spaceBarL"></div>
											</div>
										</div>
										<div class = "subSectionsLeft3">
										
										</div>
									</div>
									<div class = "sectionsRight">
										<div class = "subSectionsRight1">
										
										</div>
										<div class = "subSectionsRight2">
											<div class = "fieldSpaceR">
												<div class = "spaceBarR"></div>
												<div class = "inputFieldR">
													<span class = "error"><?php echo $cidError;?></span>
												</div>
												<div class = "spaceBarR"></div>
											</div>
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
								<div class = "depositFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "depositLabels">Deposit Amount :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = text class = "depositFields" name = "depositBal" value =
														"<?php
															if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["depositBal"]);
															else echo htmlspecialchars("");
														?>"
													/>
												</div>
												<div class = "spaceBarL"></div>
											</div>
										</div>
										<div class = "subSectionsLeft3">
										
										</div>
									</div>
									<div class = "sectionsRight">
										<div class = "subSectionsRight1">
										
										</div>
										<div class = "subSectionsRight2">
											<div class = "fieldSpaceR">
												<div class = "spaceBarR"></div>
												<div class = "inputFieldR">
													<span class = "error"><?php echo $balError;?></span>
												</div>
												<div class = "spaceBarR"></div>
											</div>
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
								<div class = "depositFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = "image" value = "submit" id = "deposit" src = "http://www.rfid84.xyz/images/deposit.png" onmouseenter =
														"displaySubmit(this)" onmouseleave = "hideSubmit(this)"/>
												</div>
												<div class = "spaceBarL"></div>
											</div>
										</div>
										<div class = "subSectionsLeft3">
										
										</div>
									</div>
									<div class = "sectionsRight">
										<div class = "subSectionsRight1">
										
										</div>
										<div class = "subSectionsRight2">
										
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</body>
	</center>
</html>
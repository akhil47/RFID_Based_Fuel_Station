<?php
	session_start();
	if($_SESSION["loggedIn"] != true) {
		header("Location: http://www.rfid84.xyz/login.php?msg=Please 'Login' to access the WebPage!");
		exit();
	}
	$nameError = "";
	$dobError = "";
	$mobilenoError = "";
	$addressError = "";
	$licensenoError = "";
	$cidError = "";
	$balanceError = "";
	
	$con = mysqli_connect('182.50.151.70', 'RFID', 'RFID47');
	
	if(!$con){
		die("Connection failed: " .mysqli_error());
	}
	
	$query = "USE RFID";
	mysqli_query($con, $query);
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$flag = true;
		if(empty($_POST["name"])){
			$nameError = "Please enter customer Full Name!";
			$flag = false;
		}
		else{
			$namePattern = '/^[a-zA-Z ]*$/';
			if(preg_match($namePattern, $_POST["name"]) == 0){
				$nameError = "Customer Full Name can consist only alphabets!";
				$flag = false;
			}
		}
		if(empty($_POST["dob"])){
			$dobError = "Please enter a valid Date of Birth!";
			$flag = false;
		}
		else{
			$dobPattern = '/^\d{2}[-]\d{2}[-]\d{4}$/';
			$day = (int)substr($_POST["dob"], 0, 2);
			$month = (int)substr($_POST["dob"], 3, 4);
			$year = (int)substr($_POST["dob"], 6, 9);
			if(preg_match($dobPattern, $_POST["dob"]) == 0){
				$dobError = "Please enter a valid Date of Birth!";
				$flag = false;
			}
			else if(!checkdate($month, $day, $year)){
				$dobError = "Please enter a valid Date of Birth!";
				$flag = false;
			}
		}
		if(empty($_POST["mobileno"])){
			$mobilenoError = "Please enter a 10 digit Mobile No.!";
			$flag = false;
		}
		else{
			$mobilenoPattern = '/^\d{10}$/';
			if(preg_match($mobilenoPattern, $_POST["mobileno"]) == 0){
				$mobilenoError = "Please enter a 10 digit Mobile No.!";
				$flag = false;
			}
		}
		if(empty($_POST["address"])){
			$addressError = "Please enter customer Address!";
			$flag = false;
		}
		if(empty($_POST["licenseno"])){
			$licensenoError = "Please enter customer License No.!";
			$flag = false;
		}
		else if(strlen($_POST["licenseno"]) != 16){
			$licensenoError = "Please enter a 16 - Char length valid License No!";
			$flag = false;
		}
		else{
			$temp = "SELECT * FROM Customers WHERE License_No = '".$_POST["licenseno"]."'";
			$result = mysqli_query($con, $temp);
			if(mysqli_num_rows($result) != 0){
				$licensenoError = "Account exists with License No : ".$_POST["licenseno"]."!";
				$flag = false;
			}
		}
		if(empty($_POST["cid"])){
			$cidError = "Please enter a valid customer ID!";
			$flag = false;
		}
		else if(strlen($_POST["cid"]) < 9 || strlen($_POST["cid"]) > 10){
			$cidError = "Please enter a 9 OR 10 - Char length valid customer ID!";
			$flag = false;
		}
		else{
			$temp = "SELECT * FROM Customers WHERE Cust_ID = '".$_POST["cid"]."'";
			$result = mysqli_query($con, $temp);
			if(mysqli_num_rows($result) != 0){
				$cidError = "Customer ID ".$_POST["cid"]." already in use!";
				$flag = false;
			}
		}
		if(empty($_POST["balance"])){
			$balanceError = "Please deposit a minimum of Rs. 100!";
			$flag = false;
		}
		else{
			$bal = (int) $_POST["balance"];
			if($bal < 100){
				$balanceError = "Please deposit a minimum of Rs. 100!";
				$flag = false;
			}
			else if($bal > 10000){
				$balanceError = "Maximum deposit is Rs.10000!";
				$flag = false;
			}
		}
		//Submitting form data to database
		if($flag){
			$query = "";
			$query .= "INSERT INTO Customers (Cust_ID, Name, DOB, Phone_No, Address, License_No) values (";
			$query .= "'".$_POST["cid"]."', ";
			$query .= "'".$_POST["name"]."', ";
			$query .= "'{$year}-{$month}-${day}', ";
			$query .= "'+91".$_POST["mobileno"]."', ";
			$query .= "'".$_POST["address"]."', ";
			$query .= "'".$_POST["licenseno"]."')";
			if(mysqli_query($con, $query)){
				$query = "INSERT INTO Balance (Cust_ID, Bal) values ('{$_POST["cid"]}', {$_POST["balance"]})";
				if(mysqli_query($con, $query)){
					echo '<script type="text/javascript">window.location = "http://www.rfid84.xyz/formSubmit.php?msg=Registration Successful!"</script>';
				}
				else{
					echo '<script type="text/javascript">window.location = "http://www.rfid84.xyz/formSubmit.php?msg=Registration Failed! Try Again!"</script>';
				}
			}
			else{
				echo '<script type="text/javascript">window.location = "http://www.rfid84.xyz/formSubmit.php?msg=Registration Failed! Try Again!"</script>';
			}
		}
	}
?>
<html>
	<head>
		<title>Registration</title>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/registration.css"/>
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
						<div id = "regHeader">
							<text id = "regHeaderText"> Customer Registration </text>
						</div>
						<div id = "regForm">
							<form method = "POST" action = "http://www.rfid84.xyz/registration.php">
								<div class = "regFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "regLabels">Full Name :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = text class = "regFields" name = "name" value =
														"<?php
															if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["name"]);
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
													<span class = "error"><?php echo $nameError;?></span>
												</div>
												<div class = "spaceBarR"></div>
											</div>
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
								<div class = "regFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "regLabels">Date of birth (dd-mm-yyyy) :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = text class = "regFields" name = "dob" value =
														"<?php
															if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["dob"]);
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
													<span class = "error"><?php echo $dobError;?></span>
												</div>
												<div class = "spaceBarR"></div>
											</div>
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
								<div class = "regFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "regLabels">Mobile No :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = text class = "regFields" name = "mobileno" value =
														"<?php
															if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["mobileno"]);
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
													<span class = "error"><?php echo $mobilenoError;?></span>
												</div>
												<div class = "spaceBarR"></div>
											</div>
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
								<div class = "regFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "regLabels">Address :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = text class = "regFields" name = "address" value =
														"<?php
															if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["address"]);
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
													<span class = "error"><?php echo $addressError;?></span>
												</div>
												<div class = "spaceBarR"></div>
											</div>
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
								<div class = "regFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "regLabels">License No :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = text class = "regFields" name = "licenseno" value =
														"<?php
															if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["licenseno"]);
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
													<span class = "error"><?php echo $licensenoError;?></span>
												</div>
												<div class = "spaceBarR"></div>
											</div>
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
								<div class = "regFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "regLabels">Customer ID :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = text class = "regFields" name = "cid" value =
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
								<div class = "regFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "regLabels">Balance (Rs. 100 - 10000) :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = text class = "regFields" name = "balance" value =
														"<?php
															if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["balance"]);
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
													<span class = "error"><?php echo $balanceError;?></span>
												</div>
												<div class = "spaceBarR"></div>
											</div>
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
								<div class = "regFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = "image" value = "submit" id = "register" src = "http://www.rfid84.xyz/images/submit.png" onmouseenter =
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
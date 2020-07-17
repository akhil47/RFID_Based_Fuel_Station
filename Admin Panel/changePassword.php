<?php
	session_start();
	if($_SESSION["loggedIn"] != true) {
		header("Location: http://www.rfid84.xyz/login.php?msg=Please 'Login' to access the WebPage!");
		exit();
	}
	$cPassError = "";
	$newPassError = "";
	
	$con = mysqli_connect('182.50.151.70', 'RFID', 'RFID47');
	if(!$con){
		die("Connection failed: " .mysqli_error());
	}
	
	mysqli_select_db($con, "RFID");
	$query = "";
	$flag = false;
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$query = "SELECT * FROM AdminPanel";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_assoc($result);
		
		if(empty($_POST["cPass"])){
			$cPassError = "Please enter Current Password!";
		}
		else if(empty($_POST["newPass"]) || empty($_POST["conformNewPass"])){
			$newPassError = "Please enter New Password and Conform Password!";
		}
		else if($row["Password"] != $_POST["cPass"]){
			$cPassError = "Wrong Password, Please try again!";
		}
		else if(strlen($_POST["newPass"]) < 8){
			$newPassError = "Password length should be minimum 8 characters!";
		}
		else{
			if($_POST["newPass"] != $_POST["conformNewPass"]){
				$newPassError = "Passwords do not match!";
			}
			else
				$flag = true;
		}
	}
	
	if($flag){
		$query = "UPDATE AdminPanel SET Password = '{$_POST["newPass"]}' WHERE Admin = 'RFID'";
		if(mysqli_query($con, $query))
			echo '<script type="text/javascript">window.location = "http://www.rfid84.xyz/formSubmit.php?msg=Password has been changed!"</script>';
		else
			echo '<script type="text/javascript">window.location = "http://www.rfid84.xyz/formSubmit.php?msg=Could not process your request! Please try again!"</script>';
	}
		
?>
<html>
	<head>
		<title>Change Password</title>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/changePassword.css"/>
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
				image.src = "http://www.rfid84.xyz/images/changeHover.png";
			}
			function hideSubmit(image) {
				image.src = "http://www.rfid84.xyz/images/change.png";
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
						<div id = "changePasswordHeader">
							<text id = "changePasswordHeaderText"> Change Password </text>
						</div>
						<div id = "changePasswordForm">
							<form method = "POST" action = "http://www.rfid84.xyz/changePassword.php">
								<div class = "changePasswordFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "changePasswordLabels">Current Password :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = password class = "changePasswordFields" name = "cPass"/>
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
													<span class = "error"><?php echo $cPassError;?></span>
												</div>
												<div class = "spaceBarR"></div>
											</div>
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
								<div class = "changePasswordFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "changePasswordLabels">New Password :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = password class = "changePasswordFields" name = "newPass"/>
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
													<span class = "error"><?php echo $newPassError;?></span>
												</div>
												<div class = "spaceBarR"></div>
											</div>
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
								<div class = "changePasswordFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
											<label class = "changePasswordLabels">Conform New Password :</label>
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = password class = "changePasswordFields" name = "conformNewPass"/>
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
												
												</div>
												<div class = "spaceBarR"></div>
											</div>
										</div>
										<div class = "subSectionsRight3">
										
										</div>
									</div>
								</div>
								<div class = "changePasswordFormSections">
									<div class = "sectionsLeft">
										<div class = "subSectionsLeft1">
										</div>
										<div class = "subSectionsLeft2">
											<div class = "spaceL"></div>
											<div class = "fieldSpaceL">
												<div class = "spaceBarL"></div>
												<div class = "inputFieldL">
													<input type = "image" value = "submit" id = "changePassword" src = "images/change.png" onmouseenter =
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
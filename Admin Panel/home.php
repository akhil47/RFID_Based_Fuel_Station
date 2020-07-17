<?php
	session_start();
	if($_SESSION["loggedIn"] != true) {
		header("Location: http://www.rfid84.xyz/login.php?msg=Please 'Login' to access the WebPage!");
		exit();
	}
?>
<html>
	<head>
		<title>Home</title>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/homePage.css"/>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/header.css"/>
		<script>
			function display(image) {
				image.src = "http://www.rfid84.xyz/images/HomeButtonHover.png";
			}									
			function hide(image) {
				image.src = "http://www.rfid84.xyz/images/HomeButton.png";
			}
		</script>
	</head>
	<center>
		<body>
			<div id = "mainContainer">
				<div id ="Header">
					<img id = "adminButton" src = "http://www.rfid84.xyz/images/adminButton.png"/>
					<a  class = "headerText" href="http://www.rfid84.xyz/logout.php"><text>Logout</text></a>
					<a  class = "headerText" href="http://www.rfid84.xyz/changePassword.php"><text>Change Password</text></a>
					<a  class = "headerText" href="http://www.rfid84.xyz/deposit.php"><text>Deposit</text></a>
					<a id = "homeButton" href="http://www.rfid84.xyz/home.php"><img src = "http://www.rfid84.xyz/images/HomeButton.png" onmouseenter =
						"display(this)" onmouseleave = "hide(this)"/></a>
				</div>
				<div id = "contentContainer">
					<div id = "logoSection">
						<img id = "logoBig" src = "http://www.rfid84.xyz/images/logoBig.png"/>
					</div>
					<div id = "buttonSection">
						<div class = "Bars">
							<div class = "mainBarIconSection">
								<img class = "mainBarIcon"src = "http://www.rfid84.xyz/images/registration1.png"/>
							</div>
							<div class = "mainBarTextSection">
								<a class = "mainSideBarText" href="http://www.rfid84.xyz/registration.php"><text class = "mainBarText" id = "mainBarReg">
									Registration</text></a>
							</div>
						</div>
						<div class = "Bars">
							<div class = "mainBarIconSection">
								<img class = "mainBarIcon"src = "http://www.rfid84.xyz/images/customerSearch1.png"/>
							</div>
							<div class = "mainBarTextSection">
								<a class = "mainSideBarText" href="http://www.rfid84.xyz/customerSearch.php"><text class = "mainBarText" id = "mainBarCS">
									Customer Search</text></a>
							</div>
						</div>
						<div class = "Bars">
							<div class = "mainBarIconSection">
								<img class = "mainBarIcon"src = "http://www.rfid84.xyz/images/transactionSearch1.png"/>
							</div>
							<div class = "mainBarTextSection">
								<a class = "mainSideBarText" href="http://www.rfid84.xyz/transactionSearch.php"><text class = "mainBarText" id = "mainBarTS">
									Transaction Search</text></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</body>
	</center>
</html>
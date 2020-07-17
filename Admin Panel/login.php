<?php
	$error = "";
	session_start();
	
	$con = mysqli_connect('182.50.151.70', 'RFID', 'RFID47');
	if(!$con){
		die("Connection failed: " .mysqli_error());
	}
	
	mysqli_select_db($con, 'RFID');
	$query = "";
	
	if($_GET){
		$error = $_GET["msg"];
	}

	if(!array_key_exists('loggedIn', $_SESSION)){
		
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
			$query = "SELECT * FROM AdminPanel WHERE Admin = '{$_POST["inputAdminID"]}'";
			$result = mysqli_query($con, $query);
			
			if($result){
				if (mysqli_num_rows($result) > 0){
					$row = mysqli_fetch_assoc($result);
					if(($row["Admin"] == $_POST["inputAdminID"]) && ($row["Password"] == $_POST["inputAdminPass"])){
						$_SESSION["loggedIn"] = true;
						header("Location: http://www.rfid84.xyz/home.php");
						exit();
					}
					else{
						header("Location: http://www.rfid84.xyz/login.php?msg=Invalid 'Username' or 'Password'!");
						exit();
					}
				}
				else{
					header("Location: http://www.rfid84.xyz/login.php?msg=Invalid 'Username' or 'Password'!");
					exit();
				}
				
			}
			else{
				header("Location: http://www.rfid84.xyz/login.php?msg=Invalid 'Username' or 'Password'!");
				exit();
			}
		}
	}
	else{
		header("Location: http://www.rfid84.xyz/home.php");
		exit();
	}
	
?>
<html>
	<head>
		<title>Login</title>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/login.css"/>
		<script>
			function displaySubmit(image) {
				image.src = "http://www.rfid84.xyz/images/loginHover.png";
			}
			function hideSubmit(image) {
				image.src = "http://www.rfid84.xyz/images/login.png";
			}
		</script>
	</head>
	<center>
		<body>
			<div id = "mainContainer">
				<div id = "contentContainer">
					<div id = "logoSection">
						<img id = "logoBig" src = "http://www.rfid84.xyz/images/logoBig.png"/>
					</div>
					<div id = "loginFormOuterContainer">
						<div id = "loginFormInnerContainer1"></div>
						<div id = "loginFormInnerContainer2">
							<div class = "loginLabel"><text  id = "errorSpan"><?php echo $error;?></text></div>
							<form method = "POST" action = "http://www.rfid84.xyz/login.php">
								<div class = "loginLabel">
									<label class = "inputLabels">Admin ID :</label>
								</div>
								<div class = "loginInput">
									<input name = "inputAdminID" type = text class = "inputAdmin" />
								</div>
								<div class = "loginLabel">
									<label class = "inputLabels">Password :</label>
								</div>
								<div class = "loginInput">
									<input name = "inputAdminPass" type = password class = "inputAdmin" />
								</div>
								<div id = "loginSubmit">
									<input type = "image" value = "submit" id = "submitButton" src = "http://www.rfid84.xyz/images/login.png" onmouseenter =
														"displaySubmit(this)" onmouseleave = "hideSubmit(this)"/>
								</div>
							</form>
						</div>
						<div id = "loginFormInnerContainer3"></div>
					</div>
				</div>
			</div>
		</body>
	</center>
</html>
<?php
	session_start();
	if($_SESSION["loggedIn"] != true) {
		header("Location: http://www.rfid84.xyz/login.php?msg=Please 'Login' to access the WebPage!");
		exit();
	}
?>
<html>
	<head>
		<title>Customer Search</title>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/customerSearch.css"/>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/header.css"/>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/sideBar.css"/>
		<script>
			function display(image) {
				image.src = "http://www.rfid84.xyz/images/HomeButtonHover.png";
			}									
			function hide(image) {
				image.src = "http://www.rfid84.xyz/images/HomeButton.png";
			}
			function searchDisplay(image) {
				image.src = "http://www.rfid84.xyz/images/searchHover.png";
			}
			function searchHide(image) {
				image.src = "http://www.rfid84.xyz/images/search.png";
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
						<form method = "POST" action = "http://www.rfid84.xyz/customerSearch.php">
							<div class = "CSsections">
							</div>
							<div class = "CSsections">
								<div class = "subSection1"></div>
								<div class = "subSection2">
									<div id = "SS2_1">
										<input type = "text" placeholder = "Enter Customer ID or Driving License No" name = "searchField" id = "search" value =
											"<?php if($_SERVER["REQUEST_METHOD"] == "POST")
												echo htmlspecialchars($_POST["searchField"]);
													else
														echo htmlspecialchars("");
											?>" />
									</div>
									<div id = "SS2_2">
										<input type = "image" value = "submit" id = "searchButton" src = "http://www.rfid84.xyz/images/search.png" onmouseenter =
												"searchDisplay(this)" onmouseleave = "searchHide(this)"/>
									</div>
								</div>
								<div class = "subSection3"></div>
							</div>
							<div class = "CSsections">
								<div class = "subSection1">
									<?php
										if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["choice"] != "custID"){
												echo "<input type = \"radio\" id = \"custID\" name = \"choice\" value = \"custID\" />    Customer ID
														<input type = \"radio\" id = \"DLno\" name = \"choice\" value = \"DLno\" checked/>    License No
														";
										}
										else{
											echo "<input type = \"radio\" id = \"custID\" name = \"choice\" value = \"custID\" checked/>    Customer ID
														<input type = \"radio\" id = \"DLno\" name = \"choice\" value = \"DLno\"/>    License No
														";
										}
									?>
								</div>
								<div class = "subSection2"></div>
								<div class = "subSection3"></div>
							</div>
						</form>
						<div id = "searchResultsSection">
							<?php
								$con = mysqli_connect('182.50.151.70', 'RFID', 'RFID47');
								if(!$con){
									die("Connection failed: " .mysqli_error());
								}
								
								mysqli_select_db($con, 'RFID');
								
								if($_SERVER["REQUEST_METHOD"] == "POST"){
									$queryType = $_POST["choice"];
									$queryValue = $_POST["searchField"];
									$query = "";
		
			
									if($queryType == "custID"){
										$query = "SELECT * FROM Customers WHERE Cust_ID = '{$queryValue}'";
										$result = mysqli_query($con, $query);
										if (mysqli_num_rows($result) > 0) {
											echo "<div id = \"searchResultsHeader\">
													<div id = \"Header1\">
														<text class = \"headerLabels\">Name</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header2\">
														<text class = \"headerLabels\">Customer ID</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header3\">
														<text class = \"headerLabels\">Joined On</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header4\">
														<text class = \"headerLabels\">Last Tnx</text>
													</div>
												</div>
												<div id = \"searchResults\">";
											while($row = mysqli_fetch_assoc($result)) {
												echo "<div class = \"results\">";
													echo "<div class = \"field1\">";
														echo "<text class = \"label1\">".$row["Name"]."</text>";
													echo "</div>";
													echo "<div class = \"seperators\"></div>";
													echo "<div class = \"field2\">";
														echo "<a class = \"viewProfile\" href=\"http://www.rfid84.xyz/viewProfile.php?Cust_ID={$row["Cust_ID"]}\"><text class = \"label2\">".$row["Cust_ID"]."</text></a>";
													echo "</div>";
													echo "<div class = \"seperators\"></div>";
													echo "<div class = \"field3\">";
														echo "<text class = \"label3\">".$row["Joining_Date"]."</text>";
													echo "</div>";
													echo "<div class = \"seperators\"></div>";
														$query = "SELECT * FROM Transactions WHERE Cust_ID = '{$queryValue}' ORDER BY Date_Time DESC";
														$lastTnx = mysqli_query($con, $query);
														if (mysqli_num_rows($lastTnx) > 0){
															$lastTnxrow = mysqli_fetch_assoc($lastTnx);
															echo "<div class = \"field4\">";
																echo "<text class = \"label4\">".$lastTnxrow["Date_Time"]."</text>";
															echo "</div>";
														}
														else{
															echo "<div class = \"field4\">";
																echo "<text class = \"label4\">N/A</text>";
															echo "</div>";
														}
												echo "</div>";
											}
											echo "</div>";
										} 
										else {
											echo "<h3>No matching results found!</h3>";
										}
									}
			
									else{
										$query = "SELECT * FROM Customers WHERE License_No = '{$queryValue}'";
										$result = mysqli_query($con, $query);
										if (mysqli_num_rows($result) > 0) {
											echo "<div id = \"searchResultsHeader\">
													<div id = \"Header1\">
														<text class = \"headerLabels\">Name</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header2\">
														<text class = \"headerLabels\">License No</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header3\">
														<text class = \"headerLabels\">Joined On</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header4\">
														<text class = \"headerLabels\">Last Tnx</text>
													</div>
												</div>
												<div id = \"searchResults\">";
											while($row = mysqli_fetch_assoc($result)) {
												echo "<div class = \"results\">";
													echo "<div class = \"field1\">";
														echo "<text class = \"label1\">".$row["Name"]."</text>";
													echo "</div>";
													echo "<div class = \"seperators\"></div>";
													echo "<div class = \"field2\">";
														echo "<a class = \"viewProfile\" href=\"http://www.rfid84.xyz/viewProfile.php?Cust_ID={$row["Cust_ID"]}\"><text class = \"label2\">".$row["License_No"]."</text></a>";
													echo "</div>";
													echo "<div class = \"seperators\"></div>";
													echo "<div class = \"field3\">";
														echo "<text class = \"label3\">".$row["Joining_Date"]."</text>";
													echo "</div>";
													echo "<div class = \"seperators\"></div>";
														$query = "SELECT * FROM Transactions WHERE License_No = '{$queryValue}' ORDER BY Date_Time DESC";
														$lastTnx = mysqli_query($con, $query);
														if (mysqli_num_rows($lastTnx) > 0){
															$lastTnxrow = mysqli_fetch_assoc($lastTnx);
															echo "<div class = \"field4\">";
																echo "<text class = \"label4\">".$lastTnxrow["Date_Time"]."</text>";
															echo "</div>";
														}
														else{
															echo "<div class = \"field4\">";
																echo "<text class = \"label4\">N/A</text>";
															echo "</div>";
														}
												echo "</div>";
											}
											echo "</div>";
										} 
										else {
											echo "<h3>No matching results found!</h3>";
										}
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</body>
	</center>
</html>
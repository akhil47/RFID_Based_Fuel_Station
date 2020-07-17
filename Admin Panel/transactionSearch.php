<?php
	session_start();
	if($_SESSION["loggedIn"] != true) {
		header("Location: http://www.rfid84.xyz/login.php?msg=Please 'Login' to access the WebPage!");
		exit();
	}

?>
<html>
	<head>
		<title>Transaction Search</title>
		<link rel = "stylesheet" type = "text/css" href = "http://www.rfid84.xyz/styleSheets/transactionSearch.css"/>
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
						<form method = "POST" action = "http://www.rfid84.xyz/transactionSearch.php">
							<div class = "CSsections">
							</div>
							<div class = "CSsections">
								<div class = "subSection1"></div>
								<div class = "subSection2">
									<div id = "SS2_1">
										<input type = "text" name = "queryField" id = "search" value = 
											"<?php
												if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["queryField"]);
												else echo htmlspecialchars("");
											?>"/>
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
										if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["choice"] == "custID"){
												echo "<input type = \"radio\" id = \"custID\" name = \"choice\" value = \"custID\" checked/>    Customer ID
														<input type = \"radio\" id = \"DLno\" name = \"choice\" value = \"DLno\" />    License No
														<input type = \"radio\" id = \"All\" name = \"choice\" value = \"All\" />    All
														";
										}
										else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["choice"] == "DLno"){
											echo "<input type = \"radio\" id = \"custID\" name = \"choice\" value = \"custID\" />    Customer ID
														<input type = \"radio\" id = \"DLno\" name = \"choice\" value = \"DLno\" checked/>    License No
														<input type = \"radio\" id = \"All\" name = \"choice\" value = \"All\" />    All
														";
										}
										else{
											echo "<input type = \"radio\" id = \"custID\" name = \"choice\" value = \"custID\" />    Customer ID
														<input type = \"radio\" id = \"DLno\" name = \"choice\" value = \"DLno\"/>    License No
														<input type = \"radio\" id = \"All\" name = \"choice\" value = \"All\" checked />    All
														";
										}
									?>
								</div>
								<div class = "subSection2"></div>
								<div class = "subSection3"></div>
							</div>
							<div class = "optionField">
								<div class = "field1"><label class = "optionLabel">From : </label></div>
								<div class = "field2"><input class = "field2" placeholder = "yyyy-mm-dd" name = "fromDate" type = "text" value =
									"<?php
										if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["fromDate"]);
										else echo htmlspecialchars("");
									?>"/>
								</div>
								<div class = "field3"><label class = "optionLabel">From : </label></div>
								<div class = "field4"><input class = "field4" placeholder = "hh:mm:ss" name = "fromTime" type = "text" value =
									"<?php
										if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["fromTime"]);
										else echo htmlspecialchars("");
									?>"/>
								</div>
								<div class = "field5"><label class = "optionLabel">Branch : </label></div>
								<div class = "field6"><input class = "field6" placeholder = "Branch Name" name = "Branch" type = "text" value =
									"<?php
										if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["Branch"]);
										else echo htmlspecialchars("");
									?>"/>
								</div>
							</div>
							<div id = "space"></div>
							<div class = "optionField">
								<div class = "field1"><label class = "optionLabel">To : </label></div>
								<div class = "field2"><input class = "field2" placeholder = "yyyy-mm-dd" name = "toDate" type = "text" value =
									"<?php
										if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["toDate"]);
										else echo htmlspecialchars("");
									?>"/>
								</div>
								<div class = "field3"><label class = "optionLabel">To : </label></div>
								<div class = "field4"><input class = "field4" placeholder = "hh:mm:ss" name = "toTime" type = "text" value =
									"<?php
										if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["toTime"]);
										else echo htmlspecialchars("");
									?>"/>
								</div>
								<div class = "field5"><label class = "optionLabel">T.No : </label></div>
								<div class = "field6"><input class = "field6" placeholder = "Terminal No" name = "tno" type = "text" value =
									"<?php
										if($_SERVER["REQUEST_METHOD"] == "POST") echo htmlspecialchars($_POST["tno"]);
										else echo htmlspecialchars("");
									?>"/>
								</div>
							</div>
						</form>
						<div id = "spaceBar"></div>
						<div id = "searchResultsSection">
							<?php
								if($_SERVER["REQUEST_METHOD"] == "POST"){
									
									$con = mysqli_connect('182.50.151.70', 'RFID', 'RFID47');
									if(!$con){
										die("Connection failed: " .mysql_error());
									}
									
									mysqli_select_db($con, 'RFID');
									
									$query = "SELECT * FROM Transactions";
									
									if($_POST["choice"] == "All" || $_POST["choice"] == "custID"){
										
										$flag = false;
										
										if($_POST["choice"] == "custID"){
											$query .= " WHERE Cust_ID = '".$_POST["queryField"]."' ";
											$flag = true;
										}
										if(!(empty($_POST["fromDate"]) || empty($_POST["toDate"])) && (empty($_POST["fromTime"]) && empty($_POST["toTime"]))){
											if(!$flag){
												$query .= " WHERE ";
												$flag = true;
												$fromStamp = $_POST["fromDate"]." "."00:00:00";
												$toStamp = $_POST["toDate"]." "."23:59:59";
												$query .= "Date_Time BETWEEN '".$fromStamp."' AND '".$toStamp."' ";
											}
											else{
												$fromStamp = $_POST["fromDate"]." "."00:00:00";
												$toStamp = $_POST["toDate"]." "."23:59:59";
												$query .= "AND Date_Time BETWEEN '".$fromStamp."' AND '".$toStamp."' ";
											}
										}
										if(!(empty($_POST["fromDate"]) || empty($_POST["toDate"]) || empty($_POST["fromTime"]) || empty($_POST["toTime"]))){
											if(!$flag){
												$query .= " WHERE ";
												$flag = true;
												$fromStamp = $_POST["fromDate"]." ".$_POST["fromTime"];
												$toStamp = $_POST["toDate"]." ".$_POST["toTime"];
												$query .= "Date_Time BETWEEN '".$fromStamp."' AND '".$toStamp."' ";
											}
											else{
												$fromStamp = $_POST["fromDate"]." ".$_POST["fromTime"];
												$toStamp = $_POST["toDate"]." ".$_POST["toTime"];
												$query .= "AND Date_Time BETWEEN '".$fromStamp."' AND '".$toStamp."' ";
											}
										}
										if(!empty($_POST["Branch"])){
											if(!$flag){
												$query .= " WHERE ";
												$flag = true;
												$query .= "Location = '".$_POST["Branch"]."' ";
											}
											else
												$query .= "AND Location = '".$_POST["Branch"]."' ";
										}
										if(!empty($_POST["tno"])){
											if(!$flag){
												$query .= " WHERE ";
												$flag = true;
												$query .= "Terminal_No = '".$_POST["tno"]."' ";
											}
											else
												$query .= "AND Terminal_No = '".$_POST["tno"]."' ";
										}
										$query .= " ORDER BY Date_Time DESC";
										$result = mysqli_query($con, $query);
										//echo $query;
										if (mysqli_num_rows($result) > 0){
											echo "<div id = \"searchResultsHeader\">
													<div id = \"Header1\">
														<text class = \"headerLabels\">Tnx No</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header2\">
														<text class = \"headerLabels\">Date & Time</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header3\">
														<text class = \"headerLabels\">Customer ID</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header4\">
														<text class = \"headerLabels\">Branch</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header5\">
														<text class = \"headerLabels\">T.No</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header6\">
														<text class = \"headerLabels\">Amount</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header7\">
														<text class = \"headerLabels\">Status</text>
													</div>
												</div>
												<div id = \"searchResults\">";
												while($row = mysqli_fetch_assoc($result)) {
													echo "<div class = \"results\">";
														echo "<div class = \"searchField1\">";
															echo "<text class = \"label1\">".$row["Trans_No"]."</text>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField2\">";
															echo "<text class = \"label2\">".$row["Date_Time"]."</text>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField3\">";
															echo "<a class = \"viewProfile\" href=\"http://www.rfid84.xyz/viewProfile.php?Cust_ID={$row["Cust_ID"]}\"><text class = \"label3\">".$row["Cust_ID"]."</text></a>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField4\">";
															echo "<text class = \"label4\">".$row["Location"]."</text>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField5\">";
															echo "<text class = \"label5\">".$row["Terminal_No"]."</text>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField6\">";
															echo "<text class = \"label6\">".$row["Amount"]."</text>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField7\">";
															echo "<text class = \"label7\">".$row["Status"]."</text>";
														echo "</div>";
													echo "</div>";
												}
												echo "</div>";
										}
										else
											echo "<h3>No matching results found!</h3>";
									}
									if($_POST["choice"] == "DLno"){
										
										$flag = false;
										$query .= " WHERE License_No = '".$_POST["queryField"]."' ";
										
										if(!(empty($_POST["fromDate"]) || empty($_POST["toDate"])) && (empty($_POST["fromTime"]) && empty($_POST["toTime"]))){
											if(!$flag){
												$query .= "AND ";
												$flag = true;
											}
											$fromStamp = $_POST["fromDate"]." "."00:00:00";
											$toStamp = $_POST["toDate"]." "."23:59:59";
											$query .= "Date_Time BETWEEN '".$fromStamp."' AND '".$toStamp."' ";
										}
										if(!(empty($_POST["fromDate"]) || empty($_POST["toDate"]) || empty($_POST["fromTime"]) || empty($_POST["toTime"]))){
											if(!$flag){
												$query .= "AND ";
												$flag = true;
											}
											$fromStamp = $_POST["fromDate"]." ".$_POST["fromTime"];
											$toStamp = $_POST["toDate"]." ".$_POST["toTime"];
											$query .= "Date_Time BETWEEN '".$fromStamp."' AND '".$toStamp."' ";
										}
										if(!empty($_POST["Branch"])){
												$query .= "AND Location = '".$_POST["Branch"]."' ";
										}
										if(!empty($_POST["tno"])){
												$query .= "AND Terminal_No = '".$_POST["tno"]."' ";
										}
										$query .= " ORDER BY Date_Time DESC";
										//echo $query;
										$result = mysqli_query($con, $query);
										if (mysqli_num_rows($result) > 0){
											echo "<div id = \"searchResultsHeader\">
													<div id = \"Header1\">
														<text class = \"headerLabels\">Tnx No</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header2\">
														<text class = \"headerLabels\">Date & Time</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header3\">
														<text class = \"headerLabels\">License No</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header4\">
														<text class = \"headerLabels\">Branch</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header5\">
														<text class = \"headerLabels\">T.No</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header6\">
														<text class = \"headerLabels\">Amount</text>
													</div>
													<div class = \"seperators\"></div>
													<div id = \"Header7\">
														<text class = \"headerLabels\">Status</text>
													</div>
												</div>
												<div id = \"searchResults\">";
												while($row = mysqli_fetch_assoc($result)) {
													echo "<div class = \"results\">";
														echo "<div class = \"searchField1\">";
															echo "<text class = \"label1\">".$row["Trans_No"]."</text>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField2\">";
															echo "<text class = \"label2\">".$row["Date_Time"]."</text>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField3\">";
															echo "<a class = \"viewProfile\" href=\"http://www.rfid84.xyz/viewProfile.php?Cust_ID={$row["Cust_ID"]}\"><text class = \"label3\">".$row["License_No"]."</text></a>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField4\">";
															echo "<text class = \"label4\">".$row["Location"]."</text>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField5\">";
															echo "<text class = \"label5\">".$row["Terminal_No"]."</text>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField6\">";
															echo "<text class = \"label6\">".$row["Amount"]."</text>";
														echo "</div>";
														echo "<div class = \"seperators\"></div>";
														echo "<div class = \"searchField7\">";
															echo "<text class = \"label7\">".$row["Status"]."</text>";
														echo "</div>";
													echo "</div>";
												}
												echo "</div>";
										}
										else
											echo "<h3>No matching results found!</h3>";
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
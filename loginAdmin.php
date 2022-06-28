<!--
PHP file for a COS10026 Project by React Lions
Author: 
Duy Khoa Pham (103515617)
Gurmehar Singh (103510447)
Anh Minh Nguyen (103178955)
Bradley Bowering (102673815)
Andrew Moutsos(103982376)
last modified: 27.05.2022 
 -->
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
    <meta name="description" content="COS10026 Assignment 2" />
    <meta name="keywords" content="HTML, CSS, JavaScript" />
    <meta name="author" content="React Lions" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/style.css"/>
    <link rel="icon" href="images/react.svg">
    <title>Supervisor login</title>
</head>

<body>
	<!--Header(with menu)-->
    <?php 
		if(isset($_SESSION['ADMIN'])){
			header('location: manage.php');
		}
        include ("header.inc");
        include ("menu.inc");
        echo menu("loginAdmin");
        echo "</header>"
    ?>
	<!-- main -->
	<article class='login-main'>
	<?php
	$errorHandler = "";
	// sanitise_input
	function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	// Security Handler
	function loginSecurityHandler($usernameInput,$username, $conn){
		$sql_table = 'logSecurity';
		$createdAt = "CREATED_AT";
		$attemptTime = "ATTEMPT_TIME";
		// create table if it not exists
		$create_table_query = "CREATE TABLE IF NOT EXISTS $sql_table( 
			$username VARCHAR (30) NOT NULL,
			$createdAt INT NOT NULL,
			$attemptTime INT NOT NULL,
			FOREIGN KEY ($username) REFERENCES admin($username)
		)";
		$result = mysqli_query($conn, $create_table_query);
		$query = "SELECT * FROM $sql_table WHERE $username = '$usernameInput'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		// check if there is attempt try to login admin on this account
		if(!isset($row[$attemptTime])){
			$tmpTime = time();
			$query = "INSERT INTO $sql_table VALUES ('$usernameInput', $tmpTime, 1);";
			$GLOBALS['errorHandler'] = "<p>Attempt left: 2, Bad credentail !</p>";
			$result = mysqli_query($conn, $query);
		}else if(time() - $row[$createdAt] >= 300){  // check if it has been already 5 minutes since then
			$tmpTime = time();
			$query = "UPDATE $sql_table
			SET $createdAt = $tmpTime,$attemptTime=1
			WHERE $username = '$usernameInput'
			";
			$result = mysqli_query($conn, $query);
		}else if($row[$attemptTime]<3){ // check if it has been already 5 minutes since then
			$tmpAttempt = $row[$attemptTime] + 1;
			$query = "UPDATE $sql_table
			SET $attemptTime = $tmpAttempt 
			WHERE $username = '$usernameInput'
			";
			$tmpAttempt = 3 - $tmpAttempt;
			$GLOBALS['errorHandler'] = "<p>Attempt left: $tmpAttempt, Bad credentail !</p>";
			$result = mysqli_query($conn, $query);
		}else if($row[$attemptTime]==3){  // check if it has been reached 3 times login to Admin
			$GLOBALS['errorHandler'] = "<p>Maximum of attempt to login this account</p>";
		}
	}
	// Handle Login
	function name_validate($name){
		$errMsg = "";
		if ($name =="") {
			$errMsg = $errMsg."<p>Incorrect username or password</p>";
		} else if (!preg_match("/^[a-zA-Z- ]{1,30}$/", $name)) {
			$errMsg = $errMsg. "<p>Incorrect username or password</p>";
		}
		return $errMsg;
	}
	function handleLogin($conn, $sql_table, $username){
		// input for username and password
        $usernameInput = sanitise_input($_POST['usernameAdmin']);
        $passwordInput = sanitise_input($_POST['passwordAdmin']);
		$attemptTime = "ATTEMPT_TIME";
		$createdAt = "CREATED_AT";
		// validate input
		if(name_validate($usernameInput) != ""){
			$GLOBALS['errorHandler'] = name_validate($usernameInput);
			return;
		}
		if(empty($passwordInput)){
			$GLOBALS['errorHandler'] = "<p>Incorrect username or password</p>";
			return;
		}
		$usernameSQuery = "SELECT * FROM $sql_table WHERE $username = '$usernameInput' LIMIT 1";
		$result = mysqli_query($conn, $usernameSQuery);
		$res = mysqli_fetch_assoc($result);
		// validate input
		if(!$res){
			$GLOBALS['errorHandler'] = "<p>Incorrect username or password</p>";
			return;
		}
		if($res['PASSWORD'] != $passwordInput){
			$GLOBALS['errorHandler'] = "<p>Incorrect username or password</p>";
			loginSecurityHandler($usernameInput,$username, $conn);
			return;
		}
		
		$sql_table = 'logSecurity';
		$query = "SELECT * FROM $sql_table WHERE $username = '$usernameInput'";
		$results = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($results);
		// check if it has already reached 3 times login or not
		if($row){
			if($row[$attemptTime] == 3){ // it has already reached 3 times login
				if(time()-$row[$createdAt] >= 300){  // check if it has already been 5 minutes from then
					$tmpTime = time();
					$query = "UPDATE $sql_table
					SET $createdAt = $tmpTime,$attemptTime=0
					WHERE $username = '$usernameInput'
					";
					mysqli_query($conn, $query);
				}else{
					$GLOBALS['errorHandler'] = "<p>Maximum of attempt to login this account</p>";
					return;
				}
			}else{ // it has not reached 3 times login yet
				$tmpTime = time();
				$query = "UPDATE $sql_table
				SET $createdAt = $tmpTime,$attemptTime=0
				WHERE $username = '$usernameInput'
				";
				mysqli_query($conn, $query);
			}
		}
		session_unset();
		$res = mysqli_fetch_assoc($result);
		// set session to let the manage.php authorize admin 
		$_SESSION["ADMIN"] = $usernameInput;	
		$_SESSION["time"] = time();
		$query = "DELETE FROM $sql_table WHERE $username = '$usernameInput'";
		$results = mysqli_query($conn, $query);
		header('location: manage.php');
    }
	if(isset($_POST['usernameAdmin']) || isset($_POST['passwordAdmin']) ){
		$errorHandler = "";
		$servername = "feenix-mariadb.swin.edu.au";
		$host = "s103515617";
		$password = "reactjs";
		$dbname = "s103515617_db";
		$sql_table = "admin";
		$username = "STUDENT_ID";


        $userID = "USER_ID";
        $usernameAdmin = "USER_NAME";
		$passwordAdmin = "PASSWORD";
		$conn = mysqli_connect($servername, $host, $password, $dbname);
		if (!$conn) {
			echo "<p>Connection failed: " . mysqli_connect_error()."</p>";
		}


		$create_table_query = "CREATE TABLE IF NOT EXISTS $sql_table(
			$userID INT NOT NULL UNIQUE,
			$username VARCHAR (30) NOT NULL PRIMARY KEY,
			$passwordAdmin VARCHAR (60) NOT NULL)";
		$result = mysqli_query($conn, $create_table_query);
        handleLogin($conn, $sql_table, $usernameAdmin);
    }
	?>
	<form method="POST" action="loginAdmin.php" class="login">
			<?php if(!empty($errorHandler)) 
			{ 
				echo "$errorHandler";
			} 
			?>
		<fieldset>
			<legend><h2> Supervisor Login </h2> </legend>
			<label for="usernameAdmin">@</label>
			<input type="text" name="usernameAdmin" id="usernameAdmin" placeholder="Admin ID"/><br/>
			<label for="passwordAdmin">🔒</label>
			<input type="password" name="passwordAdmin" id="passwordAdmin" placeholder="Password"/><br/>
			<input type="submit"/>
			<br/>
		</fieldset>
	</form>
	</article>

    <!--Footer-->
    <?php include_once 'footer.inc'; ?>
</body>
</html>
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
    <title>Login</title>
</head>

<body>
	<!--Header(with menu)-->
    <?php 
        include ("header.inc");
        include ("menu.inc");
        echo menu("login");
        echo "</header>"
    ?>
	<!-- main -->
	<article class='login-main'>
	<?php
	// check if already a student login
	if(isset($_SESSION['StudentID'])){
		header('location: checkattempts.php');
	}
	$errorHandler = "";
	// sanitise_input
	function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	// validation
	function studentid_validate($student_id){
		$errMsg = "";
		if ($student_id =="") {
			$errMsg = $errMsg. "<p>You must enter a student id</p>";
		} else if (!preg_match("/^(\d{7}|\d{10})$/", $student_id)) {
			$errMsg = $errMsg. "<p>Only 7 or 10 digits allowed in your student id.</p>";
		}
		return $errMsg;
	}
	function handleLogin($conn, $sql_table, $studentID, $passwordStudent){
        $username = sanitise_input($_POST['usernameLogin']);
        $password = sanitise_input($_POST['passwordLogin']);
		// check if input is valid or not
        if(studentid_validate($username)){
			$GLOBALS['errorHandler'] = studentid_validate($username);
			return;
		}
		if(empty($password)){
			$GLOBALS['errorHandler'] = "<p>Invalid password</p>";
			return;
		}
		if(strlen($password)<8){
			$GLOBALS['errorHandler'] = "<p>Invalid password</p>";
			return;
		}
		// finding user
		$usernameSQuery = "SELECT * FROM $sql_table WHERE $studentID = $username LIMIT 1";
		$result = mysqli_query($conn, $usernameSQuery);
		$res = mysqli_fetch_assoc($result);
		if(!$res){
			$GLOBALS['errorHandler'] = "<p>No Student ID is provided</p>";
			return;
		}
		if($res['PASSWORD'] != $password){
			$GLOBALS['errorHandler'] = "<p>Incorrect password!</p>";
			return;
		}
		// using session to store student information
		$_SESSION["StudentID"] = $username;
		$_SESSION["firstname"] = $res["FIRST_NAME"];
		$_SESSION["lastname"] = $res["LAST_NAME"];
		header('location: checkattempts.php');
    }
	// Check username and password
	if(isset($_POST['usernameLogin']) || isset($_POST['passwordLogin']) ){
		$errorHandler = "";
		$servername = "feenix-mariadb.swin.edu.au";
		$username = "s103515617";
		$password = "reactjs";
		$dbname = "s103515617_db";
		$sql_table = "students";
		$passwordStudent = "PASSWORD";
		$studentID = "STUDENT_ID";
		$firstname = "FIRST_NAME";
        $lastname = "LAST_NAME";
		// connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			echo "<p>Connection failed: " . mysqli_connect_error()."</p>";
		}
		// create table if it not exists
		$create_table_query = "CREATE TABLE IF NOT EXISTS $sql_table(
			$studentID VARCHAR(10) UNIQUE,
			$firstname VARCHAR (30) NOT NULL,
			$lastname VARCHAR (30) NOT NULL,
			$passwordStudent VARCHAR (60) NOT NULL,
			PRIMARY KEY($studentID)
		)";
		$result = mysqli_query($conn, $create_table_query);
		
        handleLogin($conn, $sql_table, $studentID, $passwordStudent);
    }
	?>
	<ul class="loginORsignup">
		<li><h2><a href="login.php" class='act'>Log In</a></h2></li>
		<li><h2><a href="register.php">Sign Up</a></h2></li>
	</ul>
	<form method="POST" action="login.php" class="login">
			<?php if(!empty($errorHandler)) 
			{ 
				echo "$errorHandler";
			} 
			?>
		<fieldset>
			<legend>Log In</legend>
			<label for="usernameL">@</label>
			<input type="text" name="usernameLogin" id="usernameL" placeholder="Student ID"/><br/><br/>
			<label for="passwordL">🔒</label>
			<input type="password" name="passwordLogin" id="passwordL" placeholder="Password"/><br/><br/>
			<input type="submit"/>
		</fieldset>
	</form>
	</article>

    <!--Footer-->
    <?php include_once 'footer.inc'; ?>
</body>
</html>
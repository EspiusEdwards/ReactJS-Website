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
    <title>Register</title>
</head>

<body>
    <!--Header(with menu)-->
    <?php 
        include ("header.inc");
        include ("menu.inc");
        echo menu("register");
        echo "</header>"
    ?>
	<article class='register-main'>
    <?php
        if(isset($_SESSION['StudentID'])){
            header('location: quiz.php');
        }
        function sanitise_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        function studentid_validate($student_id){
            $errMsg = "";
            if ($student_id =="") {
                $errMsg = $errMsg. "<p>You must enter a student id</p>";
            } else if (!preg_match("/^(\d{7}|\d{10})$/", $student_id)) {
                $errMsg = $errMsg. "<p>Only 7 or 10 digits allowed in your student id.</p>";
            }
            return $errMsg;
        }
        function name_validate($name){
            $errMsg = "";
            if ($name =="") {
                $errMsg = $errMsg."<p>You must enter a name. </p>";
            } else if (!preg_match("/^[a-zA-Z- ]{1,30}$/", $name)) {
                $errMsg = $errMsg. "<p>Only maximum of 30 alpha, space, hyphen characters allowed in your name.</p>";
            }
            return $errMsg;
        }

        function handleRegister($conn, $sql_table, $passwordStudent,$studentID ,$firstname ,$lastname){
            $username = sanitise_input($_POST['usernameRegister']);
            $password = sanitise_input($_POST['passwordRegister']);
            $firstnameRegister = sanitise_input($_POST['firstnameRegister']);
            $lastnameRegister = sanitise_input($_POST['lastnameRegister']);
            // echo studentid_validate($username);
            if(studentid_validate($username)){
                $GLOBALS['errorHandler'] = studentid_validate($username);
                return;
            }
            if(empty($password)){
                $GLOBALS['errorHandler'] = "<p>Invalid password</p>";
                return;
            }
            if(strlen($password)<8){
                $GLOBALS['errorHandler'] = "<p>Password must have more than 8 characters</p>";
                return;
            }
            if(name_validate($firstnameRegister)){
                $GLOBALS['errorHandler'] = name_validate($firstnameRegister);
                return;
            }
            if(name_validate($lastnameRegister)){
                $GLOBALS['errorHandler'] = name_validate($lastnameRegister);
                return;
            }
            $usernameSQuery = "SELECT * FROM $sql_table WHERE $studentID = $username LIMIT 1";
            $result = mysqli_query($conn, $usernameSQuery);
            $res = mysqli_fetch_assoc($result);
            if($res){
                $GLOBALS['errorHandler'] = "<p>Student ID is already taken</p>";
                return;
            }
            $registerQuery = "INSERT INTO $sql_table
            ($studentID, $passwordStudent, $firstname, $lastname)
            VALUES (
                '$username',
                '$password',
                '$firstnameRegister',
                '$lastnameRegister'
            )";
            // echo $registerQuery;
            $result = mysqli_query($conn,$registerQuery);
            $_SESSION["StudentID"] = $username;
            $_SESSION["firstname"] = $firstnameRegister;
            $_SESSION["lastname"] = $lastnameRegister;
            header('location: quiz.php');
        }
        if(isset($_POST['usernameRegister']) || isset($_POST['passwordRegister'])){
            $errorHandler = "";
            $servername = "feenix-mariadb.swin.edu.au";
            $username = "s103515617";
            $password = "reactjs";
            $dbname = "s103515617_db";
            $firstname = "FIRST_NAME";
            $lastname = "LAST_NAME";
            $sql_table = "students";
            $accountID = "ACCOUNT_ID";
            $passwordStudent = "PASSWORD";
            $studentID = "STUDENT_ID";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                echo "<p>Connection failed: " . mysqli_connect_error()."</p>";
            }

      
            $create_table_query = "CREATE TABLE IF NOT EXISTS $sql_table(
                $studentID VARCHAR(10) UNIQUE,
                $firstname VARCHAR (30) NOT NULL,
                $lastname VARCHAR (30) NOT NULL,
                $passwordStudent VARCHAR (60) NOT NULL,
                PRIMARY KEY($studentID)
            )";
            $result = mysqli_query($conn, $create_table_query);
            
            
            handleRegister($conn, $sql_table, $passwordStudent, $studentID,$firstname ,$lastname);
        }
    ?>
	<ul class="loginORsignup">
		<li><h2><a href="login.php">Log In</a></h2></li>
		<li><h2><a href="register.php" class='act'>Sign Up</a></h2></li>
	</ul>
	<form method="POST" action="register.php" class='register'>
            <?php if(!empty($errorHandler)) 
                { 
                    echo "$errorHandler";
                } 
			?>
		<fieldset>
			<legend>Register</legend>
			<label for="usernameR">Student ID</label>
			<input type="text" name="usernameRegister" id="usernameR"/><br/>
			<label for="passwordR">Password</label>
			<input type="password" name="passwordRegister" id="passwordR"/><br/>
            <label for="firstnameR">First Name</label>
			<input type="text" name="firstnameRegister" id="firstnameR"/><br/>
            <label for="lastnameR">Last Name</label>
			<input type="text" name="lastnameRegister" id="lastnameR"/><br/>
			<input type="submit"/>
		</fieldset>
	</form>
    </article>

    <!--Footer-->
    <?php include_once 'footer.inc'; ?>
</body>
</html>
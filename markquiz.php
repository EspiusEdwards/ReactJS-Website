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
    <title>MarkQuiz</title>
</head>
<body class='quiz-bg'>
    <!--Header(with menu)-->
    <?php 
        include ("header.inc");
        include ("menu.inc");
        echo menu("markquiz");
        echo "</header>"
    ?>
    <?php
    if(!isset($_SESSION['StudentID'])){  
		header('location: quiz.php');
	}
     // Create connection to server
    $servername = "feenix-mariadb.swin.edu.au";
    $username = "s103515617";
    $password = "reactjs";
    $dbname = "s103515617_db";

    $conn = @mysqli_connect(
            $servername, 
            $username, 
            $password, 
            $dbname
    );
    // Check connection
    if (!$conn) {
        echo "<p>Connection failed: " . @mysqli_connect_error()."</p>";
    } 
    // Successful connection
    else {
        //Check table if exists
        $sql_table = "attempts";
        // Create table if not exists
        $create_table_query = "CREATE TABLE IF NOT EXISTS $sql_table(
            ATTEMPT_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            STUDENT_ID VARCHAR(10) NOT NULL,
            FIRST_NAME VARCHAR(30) NOT NULL,
            LAST_NAME VARCHAR (30) NOT NULL,
            SCORE TINYINT NOT NULL,
            CREATED_AT DATETIME NOT NULL,
            ATTEMPT_NUMBER TINYINT NOT NULL,
            FOREIGN KEY(STUDENT_ID) REFERENCES students(STUDENT_ID)
        );";
        // Query
        $result = @mysqli_query($conn, $create_table_query);

        // Checking question
        $student_id =  $_SESSION["StudentID"];
        $firstname =  $_SESSION["firstname"];
        $lastname = $_SESSION["lastname"];
        if (isset ($_POST["q1"])) $q1 = $_POST["q1"];
        else
            $q1 = "";
        if (isset ($_POST["q2"])) $q2 = $_POST["q2"];
        else
            $q2 ="";
        if (isset ($_POST["q3"])) $q3 = $_POST["q3"];
        else 
            $q3 ="";
        if (isset ($_POST["q4"])) $q4 = $_POST["q4"];
        else 
            $q4 ="";
        if (isset ($_POST["q5"])) $q5 = $_POST["q5"];
        else 
            $q5 ="";
        if (isset ($_POST["q6"])) $q6 = $_POST["q6"];
        else 
            $q6 ="";

        // VALIDATION
        $errMsg = "";

        if ($q1==""){
            $errMsg .= "<p>You must answer question 1. </p>";}
        if ($q2==""){
            $errMsg .= "<p>You must answer question 2. </p>";}
        if ($q3==""){
            $errMsg .= "<p>You must answer question 3. </p>";}
        if (empty($q4) == 1){
            $errMsg .= "<p>You must answer question 4. </p>";}
        if ($q5==""){
            $errMsg .= "<p>You must answer question 5. </p>";}
        if (!preg_match("/^\d{3,4}$/", $q5)){
            $errMsg .= "<p>Only year with 3 or 4 digits allowed e.g: 2022.</p>";}
        if ($q6==""){
            $errMsg .= "<p>You must answer question 6. </p>";
        }

        if ($q1=="" && $q2=="" && $q3=="" && empty($q4) == 1 && $q5=="" && $q6==""){
            $errMsg = "<p>You must answer at least one question<br/>OR<br/>Attempt the <a href='quiz.php'>Quiz</a> if you came here by a link.</p>";
        }
        
        if ($errMsg != "") echo "<main class='full'>
        <section id='attempts'>
        <h2 class='heading-quiz'>Invalid Input!</h2><br/>
        $errMsg
        </section>
        </main>";
    
        else{
        // Sanitise input
        function sanitise_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $firstname = sanitise_input($firstname);
        $lastname = sanitise_input($lastname);
        $q1 = sanitise_input($q1);
        $q2 = sanitise_input($q2);
        $q3 = sanitise_input($q3);
        for ($i = 0; $i < count($q4); $i++) {
            $q4[$i] = sanitise_input($q4[$i]);
          }
        $q5 = sanitise_input($q5);
        $q6 = sanitise_input($q6);
        // Multi-select check
        $q4Answers = ["Open Source", "A framework for building web and mobile applications"];
        $q4mark = 0;
        if ($q4 == $q4Answers) {
            $q4mark = 1;
        }

        // Quiz Marking
        $q1right = false;
        $q2right = false;
        $q3right = false;
        $q4right = false;
        $q5right = false;
        $q6right = false;
        $mark = 0;
        if ($q1 == "JS") {
            $mark += 1;
            $q1right = true;
        }
        if ($q2 == "Jordan Walke") {
            $mark += 1;
            $q2right = true;
        }
        if ($q3 == "facebook") {
            $mark += 1;
            $q3right = true;
        }
        if ($q4mark) {
            $mark += $q4mark;
            $q4right = true;
        }
        if ($q5 == 2016) {
            $mark += 1;
            $q5right = true;
        }
        if ($q6 == "false") {
            $mark += 1;
            $q6right = true;
        }
        
        // Counting score
        $score = intval($mark / 6 * 100);
        if($score == 0){
            echo "<main class='full'>
            <section id='attempts'>
            <h2 class='heading-quiz'>Unsuccessful submission</h2><br/>
                <p>You just score 0!</p>
            </section>
            </main>";
            return;
        }
        $new_q4 = implode(', ', $q4);
        function is_right($var) {
            if ($var) {
                return "✅";
            } else {
                return "❌";
            }
        }
        
        // Create date and time when submit
        date_default_timezone_set('Australia/Melbourne');
        $formatted_time = date("Y-m-d H:i:s", time());

        // Check attempts left by Student ID
        $attempt = 1;
        $attempts_left_query = "SELECT ATTEMPT_NUMBER FROM attempts WHERE STUDENT_ID = '$student_id'";
        $data = mysqli_query($conn, $attempts_left_query);
        if (!$data) {
            echo "Error: " . $attempts_left_query . "<br>" . mysqli_error($conn);
        } else if (mysqli_num_rows($data) == 0) {
            $attempt = 2;
        } else {
            $attempts_left = 0;
            while($row = mysqli_fetch_assoc($data)) {
                $attempts_left = 2 - $row["ATTEMPT_NUMBER"];
            }
            if ($attempts_left > 0) {
                // Insert into table
                $insert_query = "INSERT INTO attempts (STUDENT_ID, FIRST_NAME, LAST_NAME, SCORE, CREATED_AT, ATTEMPT_NUMBER) 
                    VALUES ('$student_id', '$firstname',  '$lastname', $score, '$formatted_time', 2);";
                $result = mysqli_query($conn, $insert_query);
                $attempt = 0;
            
                echo "<article class='quiz undo'>";
                echo "<h2 class='heading-quiz'>Quiz Completed!</h2>";
                echo "<h2 class='info'>Student ID: $student_id</h2>";
                echo "<h2 class='info'>Name: $firstname $lastname</h2>";
                $q1c = is_right($q1right);
                echo "<h2 class='clearb'>Answer 1: $q1c</h2>";
                $q2c = is_right($q2right);
                echo "<h2 class='clearb'>Answer 2: $q2c</h2>";
                $q3c = is_right($q3right);
                echo "<h2 class='clearb'>Answer 3: $q3c</h2>";
                $q4c = is_right($q4right);
                echo "<h2 class='clearb'>Answer 4: $q4c</h2>";
                $q5c = is_right($q5right);
                echo "<h2 class='clearb'>Answer 5: $q5c</h2>";
                $q6c = is_right($q6right);
                echo "<h2 class='clearb'>Answer 6: $q6c</h2>";
                
                echo "<h2 class='clearb'>Final Score: $score%</h2>";
                echo "</article>";
            } else {
                header("Location: checkattempts.php");
                $attempt = 0;
            }
        }
        // free up the memory
        mysqli_free_result($data);
        // Check if attempt > 0
        if ($attempt > 0) { 
            echo "<article class='quiz'>";
            echo "<h2 class='heading-quiz'>Quiz Completed!</h2>";
            echo "<h2 class='info'>Student ID: $student_id</h2>";
            echo "<h2 class='info'>Name: $firstname $lastname</h2>";
            $q1c = is_right($q1right);
            echo "<h2 class='clearb'>Answer 1: $q1c</h2>";
            $q2c = is_right($q2right);
            echo "<h2 class='clearb'>Answer 2: $q2c</h2>";
            $q3c = is_right($q3right);
            echo "<h2 class='clearb'>Answer 3: $q3c</h2>";
            $q4c = is_right($q4right);
            echo "<h2 class='clearb'>Answer 4: $q4c</h2>";
            $q5c = is_right($q5right);
            echo "<h2 class='clearb'>Answer 5: $q5c</h2>";
            $q6c = is_right($q6right);
            echo "<h2 class='clearb'>Answer 6: $q6c</h2>";
            
            echo "<h2 class='clearb'>Final Score: $score%</h2>";
            // Insert into table
            $sql = "INSERT INTO attempts (STUDENT_ID, FIRST_NAME, LAST_NAME, SCORE, CREATED_AT, ATTEMPT_NUMBER) 
            VALUES ('$student_id', '$firstname', '$lastname', $score, '$formatted_time', 1);";
            
            if (mysqli_query($conn, $sql)) {
                $attempt-=1;
                echo "<h2 class='clearb'>You have another attmept left, <a href ='quiz.php'>retry</a>?</h2>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            echo "</article>";

        }
    }
        
        mysqli_close($conn);
    }

    //Footer
    include_once 'footer.inc'; 
    ?>
</body>
</html>
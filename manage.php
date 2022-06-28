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
    <title>Manage</title>
</head>

<body>
    <!--Header(with menu)-->
    <?php 
        include ("header.inc");
        include ("menu.inc");
        echo menu("manage");
        echo "</header>";
    ?>
    <!-- main -->
    <h3 id = "manage_header">Admin site</h3>
    <div id = "manage_container">
        <form id="item1" class="manage_form" method="get" action="manage.php">
            <fieldset class="fieldsetManage">
                <legend class="legendManage">All attempt for student</legend>
                <label for="Student-ID">Name or ID: </label><br/>
                <input class="manageText" id="Student-ID" name="all" type="text"/><br/>
                <input class="manageSubmit" type="submit" value="Submit"/>
            <br />
            </fieldset>
            <?php
            if(isset($_GET['all'])){
                $servername = "feenix-mariadb.swin.edu.au";
                $username = "s103515617";
                $password = "reactjs";
                $dbname = "s103515617_db";
                $firstname = "FIRST_NAME";
                $lastname = "LAST_NAME";
                $studentID = "STUDENT_ID";
                $score = "SCORE";
                $attempt_number = "ATTEMPT_NUMBER";
                $create_at = "CREATED_AT";
                $sql_table = 'attempts';
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                allHandler($conn, $sql_table,$firstname, $lastname, $studentID,$score,$create_at, $attempt_number);
            }
            ?>
        </form>
        <form id="item2" class="manage_form" method="post" action="manage.php">
            <fieldset class="fieldsetManage">
                <legend class="legendManage">Delete all attempts for a Student</legend>
                <label for="delete">Student ID: </label><br/>
                <input class="manageText" id="delete" name="deleteID" type="text"/><br/>
                <input class="manageSubmit" type="submit" value="Submit"/>
            </fieldset>     
            <?php
            if(isset($_POST['deleteID'])){
                $servername = "feenix-mariadb.swin.edu.au";
                $username = "s103515617";
                $password = "reactjs";
                $dbname = "s103515617_db";
                $studentID = "STUDENT_ID";
                $sql_table = 'attempts';
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                deleteHandler($conn ,$sql_table, $studentID);
            }
            ?>
        </form>
        <form id="item3" class="manage_form" method="post" action="manage.php">
            <fieldset class="fieldsetManage">
                <legend class="legendManage">Change the score for a quiz attempt</legend>
                <label for="changeID">Student ID: </label><br/>
                <input class="manageText" id="changeID" name="changeID" type="text"/><br/>
                <label for="Attempt">Attempt: </label><br/>
                <select class="manageSelect" name="changeAttempt" id="Attempt">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select><br/>
                <label for="changeScore">Score: </label><br/>
                <input class="manageText" id="changeScore" name="changeScore" type="text"/><br/>
                <input class="manageSubmit" type="submit" value="Submit"/>
            </fieldset>
        </form>
    </div>
    
    <?php
    
    if(!isset($_SESSION['ADMIN'])){
        header('location: loginAdmin.php');
    } else if(time() - $_SESSION['time'] >= 900) {
        header('location: logout.php');
    }
    $servername = "feenix-mariadb.swin.edu.au";
    $username = "s103515617";
    $password = "reactjs";
    $dbname = "s103515617_db";
    $AttemptID = "ATTEMPT_ID";
    $studentID = "STUDENT_ID";
    $firstname = "FIRST_NAME";
    $lastname = "LAST_NAME";
    $score = "SCORE";
    $create_at = "CREATED_AT";
    $attempt_number = "ATTEMPT_NUMBER";
    // validation
	function studentid_validate($student_id){
		$errMsg = "";
		if ($student_id =="") {
			$errMsg = $errMsg. "<p class='error'>You must enter a student id</p>";
		} else if (!preg_match('/^(\d{7}|\d{10})$/', $student_id)) {
			$errMsg = $errMsg. "<p class='error'>Only 7 or 10 digits allowed in your student id.</p>";
		}
		return $errMsg;
	}
    // displaytable after query information
    function displayTable($result){
        echo "<table class='manage_table'>";
        echo "<tr>"
        ."<th scope='col'>", $GLOBALS['AttemptID'], "</th>"
        ."<th scope='col'>", $GLOBALS['studentID'], "</th>"
        ."<th scope='col'>", $GLOBALS['firstname'], "</th>"
        ."<th scope='col'>", $GLOBALS['lastname'], "</th>"
        ."<th scope='col'>", $GLOBALS['score'], "</th>"
        ."<th scope='col'>", $GLOBALS['create_at'], "</th>"
        ."<th scope='col'>", $GLOBALS['attempt_number'], "</th>"
        ."</tr>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>"
            ."<td>", $row[$GLOBALS['AttemptID']], "</td>"
            ."<td>", $row[$GLOBALS['studentID']], "</td>"
            ."<td>", $row[$GLOBALS['firstname']], "</td>"
            ."<td>", $row[$GLOBALS['lastname']], "</td>"
            ."<td>", $row[$GLOBALS['score']], "</td>"
            ."<td>", $row[$GLOBALS['create_at']], "</td>"
            ."<td>", $row[$GLOBALS['attempt_number']], "</td>"
            ."</tr>";
        }
        echo "</table>";
    }
    // display student information for students who get lower than 50% on second attempt and 100% on the first attempt
    function displayTableStudent($result){
        echo "<table class='manage_table'>";
        echo "<tr>"
        ."<th scope='col'>", $GLOBALS['studentID'], "</th>"
        ."<th scope='col'>", $GLOBALS['firstname'], "</th>"
        ."<th scope='col'>", $GLOBALS['lastname'], "</th>"
        ."</tr>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>"
            ."<td>", $row[$GLOBALS['studentID']], "</td>"
            ."<td>", $row[$GLOBALS['firstname']], "</td>"
            ."<td>", $row[$GLOBALS['lastname']], "</td>"
            ."</tr>";
        }
        echo "</table>";
    }
    // sanitise input
    function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // display student information for searching purpose
    function displayTableStudentSearch($result){
        $row = mysqli_fetch_all($result);
        if(!sizeof($row)){
            echo "<p class='error'>No student is found</p>";
            return;
        }
        echo "<table class='manage_table'>";
        echo "<tr>"
        ."<th scope='col'>", $GLOBALS['firstname'], "</th>"
        ."<th scope='col'>", $GLOBALS['lastname'], "</th>"
        ."<th scope='col'>", $GLOBALS['studentID'], "</th>"
        ."<th scope='col'>", $GLOBALS['score'], "</th>"
        ."<th scope='col'>", $GLOBALS['create_at'], "</th>"
        ."<th scope='col'>", $GLOBALS['attempt_number'], "</th>"
        ."</tr>";
        $i = 0;
        while($i < sizeof($row)){
            echo "<tr>"
            ."<td>", $row[$i][0], "</td>"
            ."<td>", $row[$i][1], "</td>"
            ."<td>", $row[$i][2], "</td>"
            ."<td>", $row[$i][3], "</td>"
            ."<td>", $row[$i][4], "</td>"
            ."<td>", $row[$i][5], "</td>"
            ."</tr>";
            $i +=1;
        }
        echo "</table>";
    }




    // change score for an attempt of a student
    function changeAttemptHandler($conn, $sql_table, $score, $studentID, $attempt_number){
        //    input
       $id = sanitise_input($_POST['changeID']);
       $attempt = sanitise_input($_POST['changeAttempt']);  
       $newScore = sanitise_input($_POST['changeScore']);
        //    validate input
       if(studentid_validate($id)){
            echo studentid_validate($id);
            return;
        }
       if($newScore > 100 || $newScore < 0 || is_int($newScore)){ //only between 0 and 100
            echo "<p class='error'>The score need to be lower than 100 and higher or equal than 0</p>";
            return;
       }
       $searchQuery = "SELECT * FROM $sql_table WHERE $studentID = $id AND $attempt_number = $attempt";
       $resultSearch = mysqli_query($conn, $searchQuery);
       $check = mysqli_fetch_all($resultSearch);
       // finding student
       if(!sizeof($check)){
        mysqli_free_result($resultSearch);
        echo "<p class='error'>No student is found</p>";
        return;
       }
       $queryUpdate = "UPDATE $sql_table SET $score = $newScore WHERE $studentID = $id AND $attempt_number=$attempt ";
       $resultUpdate = mysqli_query($conn, $queryUpdate);
       $queryUpdateShow = "SELECT * FROM $sql_table WHERE $studentID = $id";
       $resultUpdateShow = mysqli_query($conn, $queryUpdateShow);
       displayTable($resultUpdateShow);
       mysqli_free_result($resultSearch);
       mysqli_free_result($resultUpdateShow);
    }

    // Delet all attempts of a student
    function deleteHandler($conn ,$sql_table, $studentID){
        // input
        $delete = sanitise_input($_POST['deleteID']); //student_id
        if(studentid_validate($delete)){
            echo studentid_validate($delete);
            return;
        }
        $searchQuery = "SELECT * FROM $sql_table WHERE $studentID = $delete"; // find student to check if there is a student there
        $resultSearch = mysqli_query($conn, $searchQuery);
        $check = mysqli_fetch_all($resultSearch);
        if(!sizeof($check)){
            mysqli_free_result($resultSearch);
            echo "<p class='error'>No student is found</p>";
            return;
        }
        $queryDelete = "DELETE FROM $sql_table WHERE $studentID = $delete"; //delete
        $resultDelete = mysqli_query($conn, $queryDelete);
        mysqli_free_result($resultSearch);
        echo "<p class='success'>Delete successfully</p>";
    }

    // finding all attempts information of a student
    function allHandler($conn, $sql_table,$firstname, $lastname, $studentID,$score,$create_at, $attempt_number){
        // input
        $search = sanitise_input($_GET['all']);
        if($search==''){
            echo "<p class='error'>No student's name or id is found</p>";
            return;
        }
        
        // Search name using LIKE
        $querySearch = "SELECT $firstname, $lastname,$studentID,$score, $create_at, $attempt_number FROM $sql_table
        WHERE CONCAT($firstname,' ',$lastname) = '$search' OR $firstname LIKE '%$search%'
        OR $lastname LIKE '%$search%' OR $studentID = '$search'";


        $resultSearch = mysqli_query($conn, $querySearch);
        $count = mysqli_fetch_lengths($resultSearch);
        displayTableStudentSearch($resultSearch);
        mysqli_free_result($resultSearch);
    }
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        echo "<p>Connection failed: " . mysqli_connect_error()."</p>";
    }
    // form hanlder
    $sql_table = 'attempts';
    if(isset($_POST['changeID']) && isset($_POST['changeAttempt']) && isset($_POST['changeScore'])){
        changeAttemptHandler($conn, $sql_table, $score, $studentID,  $attempt_number);
    }
    // All attempts
    echo '<form class="manage_form" method="get" id="sortManage" action="manage.php">
    <fieldset class="fieldsetManage">
    <legend class="legendManage">Sort by</legend>
            <label for="sort">Column</label><br/>
            <select class="manageSelect" id="sort" name="sortColumn">
                <option value="ATTEMPT_ID">Attempt ID</option>
                <option value="FIRST_NAME">First name</option>
                <option value="LAST_NAME">Last name</option>
                <option value="SCORE">Score</option>
            </select>
            <label for="sortDirection">Sort direction</label><br/>
            <select class="manageSelect" id="sortDirection" name="sortDirection">
                <option value="ASC">Arrange from smallest to the largest value</option>
                <option value="DESC">Arrange from largest to the smallest value</option>
            </select>
            <input class="manageSubmit" type="submit"/>
        </fieldset>
    </form>';
    echo "<h3 class='manage_all'>All quiz attempts</h3>";
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
    
    $result = mysqli_query($conn, $create_table_query);
    $query = "SELECT * FROM $sql_table";
    if(isset($_GET['sortColumn']) || isset($GET['sortDirection'])){
        $sortColumn = $_GET['sortColumn'];
        $sortDirection = strtoupper($_GET['sortDirection']);
        $query = $query." ORDER BY $sortColumn $sortDirection";
    }
    $result = mysqli_query($conn, $query);
    displayTable($result);
    // Who got 100%
    echo "<div class='manage_table_container'>";
    echo "<h3 class='manage_all'>All students who got 100% on their first attempt</h3>";
    $query = "SELECT $studentID, $firstname, $lastname  FROM $sql_table WHERE $attempt_number = 1 AND $score = 100";
    $result = mysqli_query($conn, $query);
    displayTableStudent($result);
    //Who got less than 50 on second attempt
    echo "<h3 class='manage_all'>All students who got less than 50% on their second attempt</h3>";
    $query = "SELECT $studentID, $firstname, $lastname  FROM $sql_table WHERE $attempt_number = 2 AND $score < 50";
    $result = mysqli_query($conn, $query);
    displayTableStudent($result);
    echo "</div>";
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
    <!--Footer-->
    <?php include_once 'footer.inc'; ?>
</body>
</html>

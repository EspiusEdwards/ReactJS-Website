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
    <title>Status</title>
</head>
<body>
    <!--Header(with menu)-->
    <?php 
        include ("header.inc");
        include ("menu.inc");
        echo menu("checkattempts");
        echo "</header>";
        
        if(!isset($_SESSION['StudentID'])){  
            header('location: login.php');
        }
    ?>
    <?php        
        // Create connection
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
            echo "<p>Connection failed: " . mysqli_connect_error()."</p>\n";
        } 
        // Create table
        $sql_table = "attempts";
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
        // Query statement
        $result = @mysqli_query($conn, $create_table_query);
        $sql_table = "attempts";
        $query = "SELECT * FROM $sql_table";
        $student_id =  $_SESSION["StudentID"];
        $attempt_query = "SELECT * FROM attempts WHERE ATTEMPT_NUMBER = 2 AND STUDENT_ID = '$student_id'";
        $result = mysqli_query($conn, $attempt_query);
        
        //checking if maximum attempts have been reached
        if ($result->num_rows == 0) {
            header('location: quiz.php');
        } else {
            echo "
            <main class='full'>
            <section id='attempts'>
            <h2>You have reached the maximum number of attempts for the Quiz.</h2>
            <p>You can not attempt the quiz again:</p>
                <ul>
                    <li>Explore the <a href='index.php'>website</a>!</li>
                    <li>View your progress <a href='status.php'>status</a> for attempts!</li>
                </ul>
            </section>
            </main>";
        }
            

        //Footer
        include_once 'footer.inc';
    ?>

</body>
</html>
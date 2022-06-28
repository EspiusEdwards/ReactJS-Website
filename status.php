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
        echo menu("status");
        echo "</header>"
    ?>
    <?php
    if(!isset($_SESSION['StudentID'])){  
		header('location: login.php');
	}
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
    // Successful connection
    else {
			$id = $_SESSION['StudentID'];
			$fname = $_SESSION["firstname"];
			$lname = $_SESSION["lastname"];
			$attempt_query = "SELECT * FROM attempts WHERE STUDENT_ID = $id";
            $result = mysqli_query($conn, $attempt_query);
			//put checking here later
			if (!$result) {
				echo "<p>You have not attempted the quiz yet</p>\n";
			} else {
					//section do we need this to fix the footer
					echo "<section id='status'>";
					//title
					echo "<h2 class='topic-h1'> Welcome $fname  $lname</h2>\n";				
					echo "<h2> Student ID: $id</h2>\n";
					//make table
					echo "<table id='statustable'>\n";
					//table & headings
					echo "<tr>\n"
						."<th scope='col'>Submission time</th>"
						."<th scope='col'>Attempt Number</th>\n"
						."<th scope='col'>Score</th>\n"
						."<th scope='col'>Feedback</th>\n";
					$attempt = "";
					while ($row = mysqli_fetch_assoc($result)) {
						//populate rows
						echo "<tr>\n";
						//fix date
						$date = strtotime($row["CREATED_AT"]);
						echo "<td>", date('g:i:s:A d-M-Y', $date), "</td>\n";
						echo "<td>", $row["ATTEMPT_NUMBER"], "</td>\n";
						echo "<td>", $row["SCORE"], "</td>\n";
						if ($row["SCORE"] < 50) {
						echo "<td>You answered more than half the questions wrong. Give the quiz another try after reading the topic page again.</td>";
						} else if ($row["SCORE"] < 99) {
							echo "<td>Well done, you passed! If you want you can give the test another go to achieve a perfect mark.</td>";
						} else {
							echo "<td>Amazing work! You answered every single question correctly.</td>";
						}
						$attempt = $row["ATTEMPT_NUMBER"];
					}
					echo "</table>";
					if ($attempt >= 2) {
						echo "<p>You have no quiz attempts left</p>";
					} else {
						echo "<p>You still have quiz attempt left. Click <a href='quiz.php'>here</a> to do the quiz.</p>";
					}
					echo "</section>";
					mysqli_free_result($result);

			}
            mysqli_close($conn);
        }
		// Footer
		include_once 'footer.inc';
    ?>

</body>
</html>
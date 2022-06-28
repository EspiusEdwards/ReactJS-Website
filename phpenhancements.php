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
    <title>Servers Enhancements</title>
</head>
<body>
    <!--Header(with menu)-->
    <?php 
        include ("header.inc");
        include ("menu.inc");
        echo menu("phpEnhancement");
        echo "</header>"
        ?>

    <!--Main-->
    <main id="enhancement">
        <?php 
            echo "<div id='gap'>

                </div>";
        ?>

        <?php
            echo "<div id='logo-enhance'>";
            $alpha = array('','a','b','c');
            for ($i=0; $i<4; $i++) {
                $z = $i + 1;
                echo "<div class='icon' id='i$z'>";
                if ($i>=1) {
                    for ($j=0; $j<$i; $j++) {
                        $k = $j+1;
                        echo "<div class='elip' id = '{$alpha[$i]}eli$k'></div>";
                    }
                }
                echo "<div class='ball'></div>";
                echo "</div>";
            }
            echo "</div>";
        ?>
        <!-- Content of page -->
        <?php
            echo "<section class='item'>
                    <h2>Student login and register system</h2>
                    <p>This system is created to store the first name, last name, and ID of students in a new table called students. It will require users to register before they do the quiz; therefore, each user only has one consistent account including their first name, last name, and ID.
                    Also, they can log in again with their account to continue doing the quiz or see their result on the status page. Furthermore, the system acts as a precursor to the enhancement of normalizing the attempt table. In particular, a primary-foreign key between attempts and students tables is implemented to link the data between them.</p>
                    <p>Student register will store student's information in students table and when they login, the system will compare the student ID and their password from this table to authenticate.</p>
                    <p>Click on the link here <a href='logoutEnhancements.php'>login & register</a> to move to the page</p>
                </section>";

            echo "<section class='item'>
                <h2>Admin login and security handler</h2>
                <p>To enable more secure access to the supervisor page, a security handler is created. In other words, if a user types a password incorrectly three times, the access to that account will be blocked for 5 minutes until it can be logged in again. Additionally, we create a table to store usernames and passwords accessing admin login to keep track of the time of wrong passwords.</p>
                <p>For technical detail, the security handler stores number of attempts trying to login that admin account. If the number of attempts accessing that account is greater than 3, it will be locked for 5 minutes.</p>
                <p>To access to admin login, click here: <a href='logoutAminEnhancements.php'>Supervisor login</a></p>
            </section>";

            echo "<section class='item'>
                <h2>Admin sort option</h2>
                <p>For the admin to easily follow, arrange, and analyze the data from users, we create sorting functions. The supervisor can sort the table according to different features such as score, attempt ID, first name, and last name, making it easier to manage the data. </p>
                <p>This enhancement is implemented by adding the \"ORDER BY\" keyword for query commands.</p>
                <p>To gain a closer insight into the enhancement, go to this link: <a href='./manage.php#sortManage'> Table sorting feature</a></p>
            </section>";

    
            
        ?>
    </main>
    
    <!--Footer-->
    <?php include_once 'footer.inc'; ?>
</body>
</html>
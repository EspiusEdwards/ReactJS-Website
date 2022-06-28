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
    <title>Quiz</title>
</head>
<body class="quiz-bg">
    <!--Header(with menu)-->
    <?php 
        include ("header.inc");
        include ("menu.inc");
        echo menu("quiz");
        echo "</header>"
    ?>
    <?php 
        if(!isset($_SESSION['StudentID'])){  
            header('location: login.php');
        }
    ?>
    <!--Quiz-->
    <article class="quiz">
        <h2 class="heading-quiz">Can you React?</h2>
        <?php
            if(isset($_SESSION['StudentID'])){  
                echo "<br/><h2>Welcome ", $_SESSION['firstname']," ",$_SESSION['lastname'], "</h2><br/>";
            }
        ?>
        <form method="post" action="markquiz.php" novalidate="novalidate">
            <fieldset class="fieldset_css" id="questions">
                <legend class="legend_css">Questions</legend>
                <!--Question 1-->
                <p class="labels">Question 1: In what programming language is ReactJS written in ?</p>
                <input type="radio" name="q1" id="js" value="JS" class="special-radio" required><label for="js" class="q1labels">JavaScript</label>&nbsp;
                <input type="radio" name="q1" id="cpp" value="C++" class="special-radio"><label for="cpp" class="q1labels">C++</label>&nbsp;
                <input type="radio" name="q1" id="py" value="Python" class="special-radio"><label for="py" class="q1labels">Python</label>&nbsp;
                <input type="radio" name="q1" id="rb" value="Ruby" class="special-radio"><label for="rb" class="q1labels">Ruby</label><br/><br/><br/>
                
                <!--Question 2-->
                <p class="labels">Question 2: Who created ReactJS ?</p>
                <input type="radio" name="q2" id="sj" value="Steve Jobs" class="special-radio" required><label for="sj" class="q2labels">Steve Jobs</label><br/>
                <input type="radio" name="q2" id="mz" value="Mark Zuckerberg" class="special-radio"><label for="mz" class="q2labels">Mark Zuckerberg</label><br/>
                <input type="radio" name="q2" id="jw" value="Jordan Walke" class="special-radio"><label for="jw" class="q2labels">Jordan Walke</label><br/>
                <input type="radio" name="q2" id="jh" value="John Hill" class="special-radio"><label for="jh" class="q2labels">John Hill</label><br/><br/><br/>
                
                <!--Question 3-->
                <p class="labels">Question 3: Which company is responsible for maintaining and licensing the ReactJS library ?</p>
                <select name="q3" id="own" required>
                    <option value="">Please select</option>
                    <option value="amazon">Amazon</option>
                    <option value="apple">Apple</option>
                    <option value="google">Google</option>
                    <option value="facebook">Meta (Facebook)</option>
                    <option value="microsoft">Microsoft</option>
                </select><br/><br/>
                
                <!--Question 4-->
                <p class="labels">Question 4: Which of the following statements are True for ReactJS ?</p>
                <input type="checkbox" name="q4[]" id="q4a" value="Open Source" class="q4checks"><label for="q4a" class="q4labels">Open Source</label><br/>
                <input type="checkbox" name="q4[]" id="q4b" value="Private and only in use by select groups" class="q4checks"><label for="q4b" class="q4labels">Private and only in use by select groups</label><br/>
                <input type="checkbox" name="q4[]" id="q4c" value="A framework for building web and mobile applications" class="q4checks"><label for="q4c" class="q4labels">A framework for building web and mobile applications</label><br/>
                <input type="checkbox" name="q4[]" id="q4d" value="Notoriously slow framework" class="q4checks"><label for="q4d" class="q4labels">Notoriously slow framework</label><br/>
                <input type="checkbox" name="q4[]" id="q4e" value="Flexible to use and Good for SEO (Search Engine Optimization)" class="q4checks"><label for="q4e" class="q4labels">Flexible to use and Good for SEO (Search Engine Optimization)</label><br/><br/><br/>

                
                <!--Question 5-->
                <p class="labels">Question 5: What year was ReactJS on mainstream?</p>
                <input type="number" min="100" max="2022" name="q5" class="text-input-long" required><br />

                <!--Question 6-->
                <p class="labels">Question 6: Out of ReactJS, Vue and Angular, ReactJS is the least popular framework ?</p>
                <input type="radio" name="q6" id="q6a" value="true" class="q6bool" required><label for="q6a" class="q6labels">True</label>
                <input type="radio" name="q6" id="q6b" value="false" class="q6bool"><label for="q6b" class="q6labels">False</label><br/>
            </fieldset>
            <input type="submit" value="Submit" class="submit-button">
        </form>
    </article>
    
    <!--Footer-->
    <?php include_once 'footer.inc'; ?>
</body>
</html>

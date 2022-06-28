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
    <title>ReactJS</title>
</head>
<body>
    <!--Header(with menu)-->
    <?php 
        include ("header.inc");
        include ("menu.inc");
        echo menu("index");
        echo "</header>"
    ?>

    <!-- main -->
    <?php 
        echo "<main id='index-main'>
                <section id='index-container'>
                    <h2>Welcome to ReactJS</h2>
                    <p>A JavaScript library for developing user interface</p>
                    <h3 id='video'>Click <a href='https://www.youtube.com/watch?v=xuMxhPYPIkA'>here</a> to view our Video</h3>
                </section>   
            </main>";
    ?>
    
    <!--Footer-->
    <?php include_once 'footer.inc'; ?>
</body>
</html>

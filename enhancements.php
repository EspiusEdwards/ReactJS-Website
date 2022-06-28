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
    <title>Enhancements</title>
</head>
<body>
    <!--Header(with menu)-->
    <?php 
        include ("header.inc");
        include ("menu.inc");
        echo menu("enhancements");
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
                    <h2>Responsive design</h2>
                    <p>The goal of responsive web design is to create web pages using HTML and CSS that appear nice on all devices such as desktops, tablets, and phones. A responsive web design will adapt to changing screen sizes and viewports automatically.</p>
                    <p>Required code: </p>
                    <p>In HTML, to make responsive website, developer need to use &lt;meta&gt; tag with name \"viewport\" and set initial-scale with 1.0</p>
                    <p>In CSS, for each viewports such developers need to build specific CSS selecters and property for each view port such as for tablet and smart phone the font size would be smaller and the content would be arranged to be a column instead of a row.
                        Using \"@media\" property and a specific max-width(size of viewport) for different viewports.
                    </p>
                    <p>In CSS, there are also grid and flow properties to manage reponsive design (divide a block to mutilple column and resize that with different viewports automatically)</p>
                    <p>For the small devices such as Mobile Phones and Tablets, we created a <strong>Hamburger menu</strong> as an innovation <em>without using JavaScript</em>, we used the <strong> :checked pseudo element </strong> in css and html as checkbox to make the menu visible when it is clicked.</p>
                </section>
                <section class='item'>
                    <h2>Animation</h2>
                    <p><strong>This is an Advance CSS</strong></p>
                    <p>An animation allows an element to transition from one style to another gradually. To utilise CSS animation, you must first define the animation's keyframes. Keyframes define the styles that an element will have at different points in time.</p>
                    <p>In CSS,there is a property called \"@keyframe\" to implement the animation spin the logo made by CSS 360 degree with a same speed from beginning to the end infinitely.
                    </p>
                    <p>In that logo, developer need to put an animation element (roll), so the element could know which animation it have to implement and how long it must occur.</p>
                    <p><a href='#gap'>Click here to View Infinitely-spinning logo</a></p> 
                    <p><a href='./index.php#index-container'>Click here to View Slide animation</a></p> 
                </section>";
        ?>
    </main>
    
    <!--Footer-->
    <?php include_once 'footer.inc'; ?>
</body>
</html>
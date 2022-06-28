<?php

    function menu($which) {
        session_start();
        $loggedIn = true;
        if(!isset($_SESSION["StudentID"])) { 
            $loggedIn = false;
        }
        $adminLoggedIn = false;
        if(isset($_SESSION['ADMIN'])){
            $adminLoggedIn = true;
        }
        function userdrop($loggedIn, $adminLoggedIn){
            $output = "";
            $output .= "<div class='user-dropdown'>";
            if ($loggedIn) {
                $output .= "<a href='status.php'>Status</a>";
                $output .= "<a href='logout.php'>Logout</a>";
            } else if ($adminLoggedIn) {
                $output .= "<a href='manage.php'>Manage</a>";
                $output .= "<a href='logout.php'>Logout</a>";
            } else {
                $output .= "<a href='login.php'>Login</a>";
                $output .= "<a href='loginAdmin.php'>Supervisor Login</a>";
            }
            $output .= "</div>";
            return $output;
        }
    
        $dropdownuser = userdrop($loggedIn, $adminLoggedIn);

        $result = "<nav class='navigation'>
                    <!--Checkbox for Hamburger menu in small screens for responsive-->
                    <input type='checkbox' id='checkburger'>
                    <label for='checkburger' class='hamburger'>&#9776;</label>
                    <!--Menu-->
                    <div class='menu'>
                    <ul class='nav-links'>";
        if ($which == "index") {
            $result = $result."<li><a href='index.php' class='this'>Home</a></li>
                <li><a href='topic.php'>Topic</a></li>
                <li><a href='checkattempts.php'>Quiz</a></li>
                <li><a href='enhancements.php'>Enhanced</a></li>
                <li><a href='phpenhancements.php'>PHP Enhanced</a></li>";
        } else if ($which == "topic") {
            $result = $result."<li><a href='index.php'>Home</a></li>
                <li><a href='topic.php' class='this'>Topic</a></li>
                <li><a href='checkattempts.php'>Quiz</a></li>
                <li><a href='enhancements.php'>Enhanced</a></li>
                <li><a href='phpenhancements.php'>PHP Enhanced</a></li>";
        } else if ($which == "quiz") {
            $result = $result."<li><a href='index.php'>Home</a></li>
                <li><a href='topic.php'>Topic</a></li>
                <li><a href='checkattempts.php' class='this'>Quiz</a></li>
                <li><a href='enhancements.php'>Enhanced</a></li>
                <li><a href='phpenhancements.php'>PHP Enhanced</a></li>";
        } else if ($which == "phpenhancements.php") {
            $result = $result."<li><a href='index.php'>Home</a></li>
                <li><a href='topic.php'>Topic</a></li>
                <li><a href='checkattempts.php'>Quiz</a></li>
                <li><a href='enhancements.php'>Enhanced</a></li>
                <li><a href='phpenhancements.php' class='this'>PHP Enhanced</a></li>";
        } else {
            $result = $result."<li><a href='index.php'>Home</a></li>
                <li><a href='topic.php'>Topic</a></li>
                <li><a href='checkattempts.php'>Quiz</a></li>
                <li><a href='enhancements.php'>Enhanced</a></li>
                <li><a href='phpenhancements.php'>PHP Enhanced</a></li>";
        }
        $result = $result."</ul></div>
            <div class='circlebg'><h2 class='usericon'>▼</h2>$dropdownuser</div></nav>";
        echo $result;
    }
?>

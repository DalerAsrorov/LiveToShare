<?php

require_once "db_connect.php";

session_start();

// adding user id to the session

if(empty($_SESSION['logged_in'])) {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['pass']);
    $password = hash('SHA512', $password);

    if (empty($username) || empty($password)) {
        echo "<div class='notice'>Please enter the required credentials! </div>";
        include "login.php";
        exit();
    } else {
        $sql = "SELECT *
                FROM users
                WHERE username = '$username'";

        $results = $mysqli->query($sql);
        if(!$results){
            exit($mysqli->error);
        }
        $user_id = -1;
        while($row = $results->fetch_array(MYSQLI_ASSOC)) {
            if ($row['username'] == $username) {
                $user_id = $row['user_id'];
                $profile_img = $row['profile_img'];
                break;
            };
        };

        if ($password == $row['password']) {
            // Logged IN
            $_SESSION['logged_in'] = true;
            $_SESSION['image'] = $profile_img;
            $_SESSION['user_id'] = $user_id; // get the user id from the row
            $_SESSION['username'] = $username;
        } else {
            echo "<div class='notice'>Invalid login information. </div>";
            include "login.php";
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LiveToShare</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/feed.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div id="wrapper">

    <a href="profile.php" class="btn btn-default" id="menu-toggle">
        <span id="sidenav-icon" class="glyphicon glyphicon-menu-hamburger"></span>
    </a>
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-nav-li">
                <a href="profile.php" id="profile"> <!-- 'Feeds' Section -->
                    <?php echo '<img class="profile-pic" src="data:image/jpeg;base64,' . $_SESSION['image']  . '" />'; ?>
                </a>
            </li>
            <li class="sidebar-brand">
                <a href="feed.php" id="feed"> <!-- 'Feeds' Section -->
                    <span class="glyphicon glyphicon-globe sidenav-icon"></span>
                </a>
            </li>
            <li class="sidebar-nav-li">
                <a href="list_of_items.php" id="feed"> <!-- 'Your Posts' Section -->
                    <span class="glyphicon glyphicon-align-justify sidenav-icon"></span>
                </a>
            </li>
            <li class="sidebar-nav-li"> <!-- 'Log Out' section -->
                <a href="logout.php">
                    <span class="glyphicon glyphicon-off sidenav-icon"></span>
                </a>
            </li>
            <li class="sidebar-nav-li">
                <a href="#left-toggle" class="hide-sidebar" id="left-toggle"> <!-- 'Hide Sidenav' section -->
                    <span class="glyphicon glyphicon-hand-left sidenav-icon"></span>
                </a>
            </li>
        </ul>
    </div> <!-- /#sidebar-wrapper -->


    <?php include 'templates/main.php' ?>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- Menu Toggle Script -->
<script src="../js/jquery-scripts.js"></script>

<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1SW1tz6LZeuoylTvzAEnagTCF7xu4yH8"> </script>
</body>


</html>




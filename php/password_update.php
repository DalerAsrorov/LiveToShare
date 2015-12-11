<?php
/**
 * Created by PhpStorm.
 * User: daler
 * Date: 11/11/15
 * Time: 9:45 PM
 */

require_once "db_connect.php";

session_start();

$password = $mysqli->real_escape_string($_POST['pass']);
$passwordTwo = $mysqli->real_escape_string($_POST['passTwo']);
$user_id = $_SESSION['user_id'];

$notHashed = $_POST['pass']; // not hashed password for email


if(empty($password) || empty($passwordTwo)) {
    echo "<div class='notice signup'>Some info is missing. </div>";
    include "password_edit.php"; //post_edit.php?post_id=12
    exit();
} else if ($password != $passwordTwo) {
    echo "<div class='notice signup'>The passwords do not match. </div>";
    include "password_edit.php"; //post_edit.php?post_id=12
    exit();
} else {
    $password = hash('SHA512', $password);

    $sql = "UPDATE users
               SET password = '$password'
             WHERE users.user_id = $user_id";
    $results = $mysqli->query($sql);

    $rowForEmail = $results->fetch_array(MYSQLI_ASSOC);

    if (!$results) {
        exit($mysqli->error . " Could not change the password. ");

    }

    generateEmail($rowForEmail['email'], $rowForEmail['username'], $notHashed);


    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
    session_destroy();
}

function generateEmail($to, $username, $password) {
    $to = $to;
    $subject = "Registration confirmation.";
    $msg = "Hey, " . $username . "! \r\n Your new password is " . $password . "
    \r\nYour password is " . $password . ". Feel free to contact us and ask questions! \n\n Best Regards, \n ShareToLive Administration";
    $header = "From:administrator@sharetolive.com";

    if( mail($to, $subject, $msg, $header) ){
        // successfully sent
    } else {
        echo "Error: Email not sent";
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
    <link rel="stylesheet" href="../css/feed-unique.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div id="wrapper">

    <a class="btn btn-default" id="menu-toggle">
        <span id="sidenav-icon" class="glyphicon glyphicon-menu-hamburger"></span>
    </a>
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="profile.php" id="profile"> <!-- 'Feeds' Section -->
                    <?php echo '<img class="profile-pic pass" src="data:image/jpeg;base64,' . $_SESSION['image']  . '" />'; ?>
                </a>
            </li>
            <li class="sidebar-nav-li">
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
                <a href="locations.php"> <!-- 'Location' section -->
                    <span class="glyphicon glyphicon-map-marker sidenav-icon"></span>
                </a>
            </li>
            <li class="sidebar-nav-li">
                <a href="#left-toggle" class="hide-sidebar" id="left-toggle"> <!-- 'Hide Sidenav' section -->
                    <span class="glyphicon glyphicon-hand-left sidenav-icon"></span>
                </a>
            </li>
            <li class="sidebar-nav-li">
                <a href="tutorial.php" >
                    <span class="glyphicon glyphicon-question-sign sidenav-icon"></span>
                </a>
            </li>
        </ul>
    </div> <!-- /#sidebar-wrapper -->


    <div class="container">
        <div class="row" style="margin-top: 200px; color: lightblue; text-align: center;">
            <h1 style="color: lightblue">Your password has been changed! </h1>
            <h2 style="color: lightblue"> Go back to <a href="login.php">Login</a> page to enter the app with the new password! </h2>
        </div>
    </div>


</div>
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
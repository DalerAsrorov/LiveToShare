<?php

$post_id = $_GET['post_id'];

require_once "db_connect.php";

session_start();


$sql_show = "SELECT *
               FROM posts
               WHERE post_id = $post_id";

$results_show = $mysqli->query($sql_show);

if(!$results_show){
    exit("SQL Error: " . $mysqli->error);
}
$row = $results_show->fetch_array(MYSQLI_ASSOC);


$sql = "DELETE FROM posts
        WHERE post_id = $post_id";

$results = $mysqli->query($sql);

if(!$results){
    exit("SQL Error: " . $mysqli->error);
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
                <a href="locations.php"> <!-- 'Location' section -->
                    <span class="glyphicon glyphicon-map-marker sidenav-icon"></span>
                </a>
            </li>
            <li class="sidebar-nav-li">
                <a href="#left-toggle" class="hide-sidebar" id="left-toggle"> <!-- 'Hide Sidenav' section -->
                    <span class="glyphicon glyphicon-hand-left sidenav-icon"></span>
                </a>
            </li>
        </ul>
    </div> <!-- /#sidebar-wrapper -->


    <div class="container">
        <div class="row" style="margin-top: 200px; color: lightblue; text-align: center;">
            <h1 style="color: lightblue"> <?php echo "The post with the title '" . $row['title'] . " has been deleted!" ?> </h1>
            <h2 style="color: lightblue"> Go back to <a style='color: white' href="list_of_items.php">your list of posts</a> to see the changes! </h2>
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

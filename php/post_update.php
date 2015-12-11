<?php

require_once "db_connect.php";

session_start();

echo  $_SESSION['post_id_edit'];

$post_id = $_SESSION['post_id_edit'];
$title = $_POST['title'];
$description = $_POST['description'];
$city =  $_POST['city'];
$tag_id = $_POST['tag_id'];
$category_id = $_POST['category_id'];
$video_link = $_POST['video_link'];


//echo $_SESSION['user_id'] .  " $email $city $country $state_id $bio";

if (empty($title) || empty($description) || empty($city) || empty($tag_id) || empty($category_id)) {
    echo "<div class='notice signup'>Some info is missing. </div>";
    include "post_edit.php?post_id=$post_id"; //post_edit.php?post_id=12
    exit();
} else {
    if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {

        // 2. Generate & Submit SQL.
        $city = str_replace(" ", "+", $city);
        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$city&sensor=false");
        $obj = json_decode($json);

        $description = $mysqli->real_escape_string($description);
        $lat = $obj->results[0]->geometry->location->lat;
        $long = $obj->results[0]->geometry->location->lng;

        $sql = "UPDATE posts
                   SET title = '$title', description='$description',
                                tag_id = $tag_id, geo_lat = $lat, geo_long = $long, category_id = $category_id, video_link = '$video_link'
                   WHERE posts.post_id = $post_id";

        $results = $mysqli->query($sql);

        if(!$results) {
            exit("SQL error with updating. Image didn't change error:  " . $mysqli->error);
        }
        $_SESSION['post_id_edit'] = -1;
    }
    else {
        // image changes
        $image = addslashes($_FILES['image']['tmp_name']); //SQL Injection defence!
        $imageName = addslashes($_FILES['image']['name']);
        $image = file_get_contents($image);
        $image = base64_encode($image);


        $city = str_replace(" ", "+", $city);
        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$city&sensor=false");
        $obj = json_decode($json);

        $description = $mysqli->real_escape_string($description);
        $lat = $obj->results[0]->geometry->location->lat;
        $long = $obj->results[0]->geometry->location->lng;

        // 2. Generate & Submit SQL.
        $sql = "UPDATE posts
                   SET title = '$title', description='$description',
                                tag_id = $tag_id, geo_lat = $lat, geo_long = $long, category_id = $category_id, video_link = '$video_link', post_img = '$image'
                   WHERE posts.post_id = $post_id";
        $results = $mysqli->query($sql);

        if(!$results){
            exit('Image did change error: ' . $mysqli->error);
        }
        $_SESSION['post_id_edit'] = -1;
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
    <!-- sidebar that shows up when the window gets wider -->
    <a href="profile.php" class="btn btn-default" id="menu-toggle">
        <span id="sidenav-icon" class="glyphicon glyphicon-menu-hamburger"></span>
    </a>
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-nav-li exception">
                <a href="profile.php" id="profile"> <!-- 'Feeds' Section -->
                    <?php echo '<img class="profile-pic" src="data:image/jpeg;base64,' . $_SESSION['image']  . '" />'; ?>
                </a>
            </li>
            <li class="sidebar-nav-li ">
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
                <a href="locations.php"  id="left-toggle"> <!-- 'Location' section -->
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


    <div id="page-content-wrapper" style="margin-left: -50px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                   <h1> The post has been updated! Please go <a href="list_of_items.php"> posts </a>  to see the changes!</h1>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- Menu Toggle Script -->
<script src="../js/jquery-scripts.js"></script>

</body>


</html>




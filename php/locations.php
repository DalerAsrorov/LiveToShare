<?php
    require_once "db_connect.php";

    session_start();

    $sql = "SELECT *
        FROM posts";

    $results = $mysqli->query($sql);

    if(!$results){
        exit($mysqli->error);
    }

    $array = [];

    while($row = $results->fetch_array(MYSQLI_ASSOC)) {
       $array[] = json_encode($row);
    };



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
            <li class="sidebar-brand">
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


    <div id="page-content-wrapper" style="margin-left: -50px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1> Popular Locations! </h1>
                    <p class="loc-desc">
                        Bellow is the map showing the most popular locations that people indicated in their posts. It kind of shows
                        you where people usually spend time at or where they have been while writing their new post. Just the idea of having
                        people from all over the world sharing their thoughts and events is amazing, so the map will give you a better understanding
                        of where people usually hang out!
                    </p>
                </div>
                <div class="col-lg-12 feeds-wrapper">
                    <div id="map-canvas"> </div>
                </div>
            </div>
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




<script>
    var jArray= <?php echo json_encode($array ); ?>;

    var newArray = new Array();

    for(var i=0;i < jArray.length;i++) {
       var object = JSON.parse(jArray[i]);
        newArray.push(object);
    }
    console.log(newArray);

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 8
    });

    var plotPoints = function(obj) {
        console.log(obj);
        var myLatlng = new google.maps.LatLng(parseFloat(obj.geo_lat), parseFloat(obj.geo_long));

        //created the new marker with animation and custom icon
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            animation: google.maps.Animation.DROP
        });

        map.setCenter(new google.maps.LatLng(parseFloat(obj.geo_lat),  parseFloat(obj.geo_long)));
    };

    newArray.forEach(function(object) {
        plotPoints(object);
    });

    map.setZoom(2);


</script>



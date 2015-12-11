<?php
/**
 * Created by PhpStorm.
 * User: daler
 * Date: 11/11/15
 * Time: 9:45 PM
 */

require_once "db_connect.php";

session_start();

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
            <li class=""sidebar-nav-li">
                <a href="tutorial.php" class="hide-sidebar" >
                    <span class="glyphicon glyphicon-question-sign sidenav-icon"></span>
                </a>
            </li>
        </ul>
    </div> <!-- /#sidebar-wrapper -->


        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-7 feeds-wrapper">
                        <div class="profile-wrapper">
                            <div class="col-lg-12"> <h1>Change of Password Request </h1> </div>
                            <form  role="form" method="post" action="password_update.php" enctype="multipart/form-data">
                                <div class="info">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <td class="profile-value">New Password: </td>
                                            <td class="profile-v">
                                                <input type="password" name="pass" placeholder="Enter Password" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="profile-value">Repeat New Password: </td>
                                            <td>
                                                <input type="password" name="passTwo" placeholder="Enter Password Again" class="form-control">
                                            </td>
                                        </tr>
                                        </tbody>
                                       </table>
                                        <br>
                                        <div class="form-group input-style " style="width: 100%;">
                                            <input class="btn btn-info" type="submit" style="width: 100%; font-size: 20px;" />
                                        </div>
                                        <div class="form-group input-style " style="width: 100%;">
                                            <a href="profile.php" class="btn btn-danger" type="cancel" style="width: 100%; font-size: 20px;">Cancel</a>
                                        </div>
                                     </div>
                                </form>
                            </div>
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
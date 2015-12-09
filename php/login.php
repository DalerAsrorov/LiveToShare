<?php

require_once "db_connect.php";

session_start();

// redirects back to the feeds page if the user
// manually enters the login.php page.

if ($_SESSION['logged_in'] == true) {
    header ('Location: feed.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LiveToShare</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/feed.css">
</head>

<body>


<?php
/**
 * Created by PhpStorm.
 * User: daler
 * Date: 10/29/15
 * Time: 11:22 PM
 */
date_default_timezone_set('UTC');


$date =  date('l jS, F Y');

include 'login_page.php';

?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>


</html>


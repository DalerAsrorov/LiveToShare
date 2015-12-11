<?php

session_start();
require_once "db_connect.php";

date_default_timezone_set('America/Los_Angeles');
$date = date('Y-m-d H:i:s');

$date = new DateTime($date);
$formattedDate =  $date->format('Y-m-d H:i:s');



$username = $_POST['username'];
$password = $mysqli->real_escape_string($_POST['pass']);
$passwordTwo =  $mysqli->real_escape_string($_POST['passTwo']);
$email = $_POST['email'];
$city = $_POST['city'];
$country =  $_POST['country'];
$state_id = $_POST['state_id'];
$bio =  $mysqli->real_escape_string($_POST['bio']);

$notHashed = $_POST['pass']; // not hashed password for email


if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
    echo "<div class='notice signup'>Please upload a profile image. </div>";
    include "sign_up.php";
    exit();
}

    $image = addslashes($_FILES['image']['tmp_name']); //SQL Injection defence!
    $imageName = addslashes($_FILES['image']['name']);
    $image = file_get_contents($image);
    $image = base64_encode($image);

//
$sql = "SELECT *
        FROM posts, users, categories, tags
        WHERE posts.category_id = categories.category_id
          AND posts.user_id = users.user_id
          AND posts.tag_id = tags.tag_id";


$results = $mysqli->query($sql);
if(!$results){
    exit("SQL Error: " . $mysqli->error);
}

while($row = $results->fetch_array(MYSQLI_ASSOC)) {
    if ($row['username'] == $username) {
        echo "<div class='notice signup'>Username already exists. </div>";
        include "sign_up.php";
        exit();
    }
    else if ($row['email'] == $email) {
        echo "<div class='notice signup'>User with this email already exists. </div>";
        include "sign_up.php";
        exit();
    }
};

if (empty($username) || empty($password) || empty($email) || empty($city) || empty($state_id) || empty($bio)) {
    echo "<div class='notice signup'>Some info is missing. </div>";
    include "sign_up.php";
    exit();
} else {
    if($password != $passwordTwo) {
        echo "<div class='notice signup'>Passwords do not match. </div>";
        include "sign_up.php";
        exit();
    } else if ($state_id == "empty") {
        echo "<div class='notice signup'>Some info is missing. </div>";
        include "sign_up.php";
        exit();
    } else {
        $password = hash('SHA512', $password);
        $sql_add = "INSERT INTO users (username, password, profile_img, city, email, bio, country, state_id, date_registered)
                          VALUES ('$username', '$password', '$image' , '$city', '$email', '$bio', '$country', $state_id, '$formattedDate');";
        $results_add = $mysqli->query($sql_add);
        if(!$results_add){
            exit($mysqli->error);
        }

        generateEmail($email, $username, $notHashed); // sends confirmation email after signup
    }
}

function generateEmail($to, $username, $password) {
    $to = $to;
    $subject = "Registration confirmation.";
    $msg = "Hey, " . $username . "! \r\n We are happy to inform you that you've been successfully added to our system!
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
</head>

<body>

<div class="container">
    <div class="row" style="margin-top: 200px; color: lightblue; text-align: center;">
        <h1 style="color: lightblue"> <?php echo "Congratulations, $username! You're now an official member of the LiveToShare!" ?> </h1>
        <h2 style="color: lightblue"> You can now <a href="login.php">log in</a> to the app! </h2>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>




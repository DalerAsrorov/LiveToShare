<?php

require_once "db_connect.php";

session_start();

$user_id = $_SESSION['user_id']; // get the user id
$email = $_POST['email'];
$city = $_POST['city'];
$country =  $_POST['country'];
$state_id = $_POST['state_id'];
$bio = $_POST['bio'];


//echo $_SESSION['user_id'] .  " $email $city $country $state_id $bio";

if (empty($email) || empty($city) || empty($state_id) || empty($bio)) {
    echo "<div class='notice signup'>Some info is missing. </div>";
    include "profile_edit_page.php";
    exit();
} else {
       if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
           $image = $_SESSION['image'];
           // 2. Generate & Submit SQL.
           $sql = "UPDATE users
                   SET email = '$email', city='$city', country='$country', state_id = $state_id, bio='$bio', profile_img = '$image'
                   WHERE users.user_id = $user_id";
           $results = $mysqli->query($sql);

           if(!$results){
               exit("SQL error with updating. Image didn't change error:  " . $mysqli->error);
           }
       }
       else {
           // image changes
           $image = addslashes($_FILES['image']['tmp_name']); //SQL Injection defence!
           $imageName = addslashes($_FILES['image']['name']);
           $image = file_get_contents($image);
           $image = base64_encode($image);

           $_SESSION['image'] = $image;

           // 2. Generate & Submit SQL.
           $sql = "UPDATE users
                   SET email = '$email', city='$city', country='$country', state_id = $state_id, bio='$bio', profile_img = '$image'
                   WHERE users.user_id = $user_id";
           $results = $mysqli->query($sql);

           if(!$results){
               exit('Image did change error: ' . $mysqli->error);
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
</head>

<body>

<div class="container">
    <div class="row" style="margin-top: 200px; color: lightblue; text-align: center;">
        <h1 style="color: lightblue"> <?php echo "Congratulations, $username! Your info has been changed." ?> </h1>
        <h2 style="color: lightblue"> Go back to <a href="profile.php">profile</a> to see the profile changes! </h2>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>




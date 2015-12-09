<?php
session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
session_destroy();

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
        <h1 style="color: lightblue"> <?php echo "Thanks for visiting us, $username!" ?> </h1>
        <h2 style="color: lightblue"> <?php echo " We are looking forward to see you again! <a href='login.php'>Log in</a> if you want to go back to LiveToShare!"; ?> </h2>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>



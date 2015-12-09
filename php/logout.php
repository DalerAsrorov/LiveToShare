<?php
session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
session_destroy();

echo "$username was logged out. His user id is $user_id <br>";
echo "<a href='login.php'>Log in </a> again to go back to return to the app!";

?>


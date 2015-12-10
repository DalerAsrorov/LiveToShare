<?php
    require_once "db_connect.php";

    session_start();

    date_default_timezone_set('UTC');

    $user_id = $_SESSION['user_id'];
    $description = $mysqli->real_escape_string($_POST['description']);
    $title =  $mysqli->real_escape_string($_POST['title']);
    $city = $_POST['city'];
    $tag_id = $_POST['tag_id'];
    $category_id = $_POST['category_id'];
    $video_link = $_POST['video_link'];

    if (empty($description) || empty($city) || empty($tag_id) || empty($category_id)) {
        echo "<div class='notice signup post'>Some info is missing. </div>";
        include "add_post.php";
        exit();
    }
    else if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
        echo "<div class='notice signup post'>Image is missing! </div>";
        include "add_post.php";
        exit();
    }
    else
    {
        $geo_lat = 0;
        $geo_long = 0;
        $date = date('Y-m-d', strtotime(str_replace('-', '/', date("Y/m/d")))); // get current date


        $city = str_replace(" ", "+", $city);
        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$city&sensor=false");
        $obj = json_decode($json);

        $lat = $obj->results[0]->geometry->location->lat;
        $long = $obj->results[0]->geometry->location->lng;


            // image changes
            $image = addslashes($_FILES['image']['tmp_name']); //SQL Injection defence!
            $imageName = addslashes($_FILES['image']['name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);


            // 2. Generate & Submit SQL.
            $sql = "INSERT INTO posts (post_img, description, geo_lat, geo_long, category_id, video_link, date, tag_id, user_id, likes, title)
                          VALUES ('$image', '$description', $lat, $long, $category_id, '$video_link', '$date', $tag_id, $user_id, 0, '$title');";

            $results = $mysqli->query($sql);

            if(!$results){
                exit($mysqli->error);
            }
    }
?>

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
        <h1 style="color: lightblue"> <?php echo "Your post was added, $username! " ?> </h1>
        <h2 style="color: lightblue"> Check it out in <a href="list_of_items.php">your list</a> of posts or <a href="feed.php">feed!</a> </h2>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>


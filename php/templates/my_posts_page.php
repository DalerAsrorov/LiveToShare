<?php
/**
 * Created by PhpStorm.
 * User: daler
 * Date: 12/9/15
 * Time: 5:45 AM
 */

require_once "db_connect.php";

session_start();

$user_id = $_SESSION['user_id'];

// 2. Generate & Submit SQL.
$sql = "SELECT *
        FROM users, posts
        WHERE users.user_id = $user_id
          AND   posts.user_id = users.user_id";

$results = $mysqli->query($sql);
if(!$results){
    exit("SQL Error: " . $mysqli->error);
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
                <div class="col-lg-9 feeds-wrapper" style="padding: 0;">
                    <a class="btn btn-info add-link-button" href="add_post.php" > <span class="glyphicons glyphicon glyphicon-plus"></span> </a>
                </div>
                <div class="">
                    <?php
                    while($row = $results->fetch_array(MYSQLI_ASSOC)) {
                        echo "<div class='panel panel-info my-posts col-lg-9'>";
                        echo "<div class='panel-heading post'><h1 class='h1-feed'>" . $row['title'] . "
                        <a class='btn btn-success pull-right right-buttons' href='post_edit.php?post_id=" . $row['post_id'] . "'>Edit</a>
                        <a class='btn btn-danger pull-right right-buttons' href='post_delete.php?post_id=" . $row['post_id'] . "' onclick='return confirm(\"Are you sure you want to delete the post: " . $row['title'] . "?\")'>Delete</a>
                        <br><div class='date-feed'>"
                            . date('m/d/Y', strtotime($row['date'])) . "</div></h1></div>";
                        echo "<div class='panel-body post-body'>";
                        echo "<div class='photo-wrapper'>";
                        echo '<img class="profile-pic" src="data:image/jpeg;base64,' . $row['post_img']  . '" />';
                        echo "</div>";

                        echo "<div class='description'>";
                        echo "<div>" . $row['description'] . "</div>";
                        echo "</div>";

                        echo "<div>";
                        echo "<div class='video-wrapper center'>";
                        $url = $row['video_link'];
                        preg_match(
                            '/[\\?\\&]v=([^\\?\\&]+)/',
                            $url,
                            $matches
                        );
                        $id = $matches[1];

                        $width = '450';
                        $height = '400';
                        echo '<object width="' . $width . '" height="' . $height . '"><param name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' . $width . '" height="' . $height . '"></embed></object>';

                        echo "</div>";
                        echo "</div>";

                        echo "</div>";

                        echo "<div class='panel-footer clearfix post-footer'>";
                        echo "<div class='pull-right'>";
                        echo "<a href=" . $row['category_id'] . " class='link link-category'>" . "Category: " . $row['category'] . "</a>";
                        echo "<a href=" . $row['tag_id'] . " class='link link-tag'>" . " Mood: " . $row['tag'] . "</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

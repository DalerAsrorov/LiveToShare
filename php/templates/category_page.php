<?php
/**
 * Created by PhpStorm.
 * User: daler
 * Date: 12/10/15
 * Time: 6:52 AM
 */
$category_id = $_GET['category_id'];


// 2. Generate & Submit SQL.
$sql = "SELECT *
        FROM posts, categories, tags
        WHERE posts.category_id = $category_id
          AND categories.category_id = $category_id
          AND posts.tag_id = tags.tag_id";

$results = $mysqli->query($sql);
if(!$results){
    exit("SQL Error: " . $mysqli->error);
}

?>



<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 feeds-wrapper">

                <?php
                while($row = $results->fetch_array(MYSQLI_ASSOC)) {
                    echo "<div class='panel panel-info post col-lg-4'>";
                    echo "<div class='panel-heading post'><h1 class='h1-feed'>" . $row['title'] . " <br><div class='date-feed'>" . date('m/d/Y', strtotime($row['date'])) .
                        "</div>" . "<br> <a class='username-link' href='profile_lookup.php?username=". $row['username'] . "'>" . $row['username'] . "</a></h1></div>";
                    echo "<div class='panel-body post-body'>";
                    echo "<div class='photo-wrapper-profile'>";
                    echo '<img class="profile-pic" src="data:image/jpeg;base64,' . $row['post_img']  . '" />';
                    echo "</div>";

                    echo "<div class='description'>";
                    echo "<div>" . $row['description'] . "</div>";
                    echo "</div>";

                    echo "<div class='map-wrapper'>";
                    echo "<div class='video-wrapper'>";
                    $url = $row['video_link'];
                    preg_match(
                        '/[\\?\\&]v=([^\\?\\&]+)/',
                        $url,
                        $matches
                    );
                    $id = $matches[1];

                    $width = '235';
                    $height = '200';
                    echo '<object class="youtube-video" width="' . $width . '" height="' . $height . '"><param name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' . $width . '" height="' . $height . '"></embed></object>';

                    echo "</div>";
                    echo "</div>";

                    echo "</div>";

                    echo "<div class='panel-footer clearfix post-footer'>";
                    echo "<div style='text-align: center;'>";
                    echo "<a class='link link-category ' href=" . "'list_of_categories.php?category_id=" . $row['category_id'] . "'>" . "Category:" . $row['category'] . "</a>";
                    echo "<a class='link link-tag pull-right' href=" . "'list_of_tags.php?tag_id=" . $row['tag_id'] . "'>" . "Mood:" . $row['tag'] . "</a>";
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

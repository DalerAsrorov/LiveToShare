<?php
/**
 * Created by PhpStorm.
 * User: daler
 * Date: 11/11/15
 * Time: 9:45 PM
 */

// 2. Generate & Submit SQL.
$sql = "SELECT *
        FROM posts, users, categories, tags
        WHERE posts.category_id = categories.category_id
          AND posts.user_id = users.user_id
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
                            echo "<div class='panel panel-info'>";
                                echo "<div class='panel-heading post'><h1>" . $row['title'] . "</h1></div>";
                                echo "<div class='panel-body'>";
                                    echo "<div class='photo-wrapper'>";
                                        echo "<img src=" . $row['post_img'] . "/>";
                                    echo "</div>";

                                    echo "<div class='description'>";
                                        echo "<div>" . $row['description'] . "</div>";
                                    echo "</div>";

                                    echo "<div class='map-wrapper'>";
                                        echo "<img src=" . $row['post_img'] . "/>";
                                    echo "</div>";

                                echo "</div>";

                                echo "<div class='panel-footer clearfix'>";
                                    echo "<div class='pull-right'>";
                                       echo "<a href=" . $row['category_id'] . " class='link link-category'>" . "Category: " . $row['category'] . "</a>";
                                       echo "<a href=" . $row['tag_id'] . " class='link link-category'>" . " Mood: " . $row['tag'] . "</a>";
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



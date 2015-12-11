<?php
/**
 * Created by PhpStorm.
 * User: daler
 * Date: 11/11/15
 * Time: 9:45 PM
 */

require_once "db_connect.php";

session_start();

$_SESSION['post_id_edit'] = $post_id;

// 2. Generate & Submit SQL.
$sql = "SELECT *
        FROM posts, categories, tags
        WHERE post_id = $post_id
          AND posts.category_id = categories.category_id
          AND posts.tag_id = tags.tag_id";

$results = $mysqli->query($sql);
if(!$results){
    exit("SQL Error: " . $mysqli->error);
}

$row = $results->fetch_array(MYSQLI_ASSOC);
$title = $row['title'];

// sql for tags
$sql_tags = "SELECT *
               FROM tags";

$results_tags = $mysqli->query($sql_tags);
if (!$results_tags){
    exit("SQL Error: " . $mysqli->error);
}

// sql for categories
$sql_categories = "SELECT *
               FROM categories";

$results_categories = $mysqli->query($sql_categories);
if (!$results_categories){
    exit("SQL Error: " . $mysqli->error);
}


$geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $row['geo_lat'] . ',' . $row['geo_long']  . '&sensor=false');

$output = json_decode($geocode);

$city = $output->results[0]->address_components[3]->long_name;


?>
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 feeds-wrapper">
                <div class="profile-wrapper">
                    <form  role="form" method="post" action="post_update.php" enctype="multipart/form-data">
                        <div class="image-wrapper profile-image-wrapper">
                            <?php echo '<img class="profile-picture"' . 'src="data:image/jpeg;base64,' .  $row['post_img']  . '" />'; ?>
                        </div>
                        <div class="form-group input-style ">
                            <span class="btn btn-default btn-file">
                                Change Image <input type="file" class="upload-image"  name="image" />
                            </span>
                            <span id="file-name" style="color: darkred;"></span>
                        </div>
                        <br>
                        <div class="info">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td class="profile-value">Title: </td>
                                    <td class="profile-v">
                                        <?php echo "<input type='text' name='title' value=' $title '>"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value">Content: </td>
                                    <td>
                                        <?php echo "<textarea style='width: 100%; height: 280px; font-size: 24px;' type='text' maxlength='1000' name='description'> " . $row['description'] . " </textarea>"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value">City: </td>
                                    <td class="profile-v">
                                        <?php echo "<input type='text' name='city' value='$city'>"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value"> Change Tag: </td>
                                    <td>
                                        <select name="tag_id" class="form-control">
                                            <oprion value = <?php $row['tag_id'];  ?>> <?php $row['tag'];  ?> </oprion>
                                            <?php
                                            while($row_tag = $results_tags->fetch_array(MYSQLI_ASSOC)){
                                                echo "<option value='" . $row_tag["tag_id"] . "'>" . $row_tag["tag"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value"> Change Category: </td>
                                    <td>
                                        <select name="category_id" class="form-control">
                                            <oprion value = <?php $row['category_id'];  ?>> <?php $row['category'];  ?> </oprion>
                                            <?php
                                            while($row_category = $results_categories->fetch_array(MYSQLI_ASSOC)){
                                                echo "<option value='" . $row_category ["category_id"] . "'>" . $row_category ["category"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value">Change video link: </td>
                                    <td class="profile-v">
                                        <?php echo "<input type='text' name='video_link' value= " . $row['video_link'].  ">"; ?>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
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

<script type="text/javascript">
    $(".upload-image").change(function() {
        console.log('image');
        var fileName = $(this).val();
        $("#file-name").html(fileName);
    });
</script>


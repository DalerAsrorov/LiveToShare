<?php
/**
 * Created by PhpStorm.
 * User: daler
 * Date: 12/9/15
 * Time: 6:43 AM
 */

require_once "db_connect.php";

session_start();

// 2. Generate & Submit SQL.
$sql_categories = "SELECT * FROM categories";

$results_categories = $mysqli->query($sql_categories );

if(!$results_categories){
    exit("SQL Error: " . $mysqli->error);
}

$sql_tags = "SELECT * FROM tags";

$results_tags = $mysqli->query($sql_tags);

if(!$results_tags){
    exit("SQL Error: " . $mysqli->error);
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 feeds-wrapper">
                <div class="profile-wrapper">
                    <form  role="form" method="post" action="add_submit.php" enctype="multipart/form-data">
                        <br>
                        <div class="info">
                        <div class="form-group input-style ">
                            <span class="btn btn-default btn-file">
                                Upload Image! <input type="file" class="upload-image" name="image" />
                            </span>
                            <span id="file-name" style="color: darkred;"></span>
                        </div>
                            <br><br>
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td class="profile-value">Title: </td>
                                    <td class="profile-v"> <input type="text" class="form-control" placeholder="Post's Title" name="title"> </td>
                                </tr>
                                <tr>
                                    <td class="profile-value">Content: </td>
                                    <td class="profile-v">
                                        <textarea style='width: 100%; height: 280px; font-size: 24px;' type='text' placeholder="Write your story..." maxlength='1000' name='description'></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value">City: </td>
                                    <td class="profile-v">
                                        <input type="text" class="form-control" placeholder="Enter city..." name="city">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value"> Choose Tag: </td>
                                    <td>
                                        <select name="tag_id" class="form-control">
                                            <oprion value="empty"></oprion>
                                            <?php
                                                while($row = $results_tags->fetch_array(MYSQLI_ASSOC)){
                                                    echo "<option value='" . $row["tag_id"] . "'>" . $row["tag"] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value"> Category: </td>
                                    <td>
                                        <select name="category_id" class="form-control">
                                            <oprion value="empty"></oprion>
                                            <?php
                                            while($row = $results_categories->fetch_array(MYSQLI_ASSOC)){
                                                echo "<option value='" . $row["category_id"] . "'>" . $row["category"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value">Video Link: </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Enter link to your video (required)..." name="video_link">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="form-group input-style " style="width: 100%;">
                                <input class="btn btn-info" type="submit" style="width: 100%; font-size: 20px;" />
                            </div>
                            <div class="form-group input-style " style="width: 100%;">
                                <a href="feed.php" class="btn btn-danger" type="cancel" style="width: 100%; font-size: 20px;">Cancel</a>
                            </div>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>

<script type="text/javascript">
    $(".upload-image").change(function() {
        console.log('image');
        var fileName = $(this).val();
        $("#file-name").html(fileName);
    });
</script>
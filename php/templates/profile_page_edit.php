<?php
/**
 * Created by PhpStorm.
 * User: daler
 * Date: 11/11/15
 * Time: 9:45 PM
 */

require_once "db_connect.php";

$user_id = $_SESSION['user_id'];

// 2. Generate & Submit SQL.
$sql = "SELECT *
        FROM users, states
        WHERE users.user_id = '$user_id'
          AND users.state_id = states.state_id";

$results = $mysqli->query($sql);
if(!$results){
    exit("SQL Error: " . $mysqli->error);
}

$row = $results->fetch_array(MYSQLI_ASSOC);


$sql_states = "SELECT *
               FROM states";

$results_states = $mysqli->query($sql_states);
if (!$results_states){
    exit("SQL Error: " . $mysqli->error);
}

?>
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 feeds-wrapper">
                <div class="profile-wrapper">
                    <form  role="form" method="post" action="profile_update.php" enctype="multipart/form-data">
                        <div class="image-wrapper profile-image-wrapper">
                            <?php echo '<img class="profile-picture"' . 'src="data:image/jpeg;base64,' .  $row['profile_img']  . '" />'; ?>
                        </div>
                        <div class="form-group input-style ">
                            <span class="btn btn-default btn-file">
                                Change Image <input type="file" name="image" />
                            </span>
                        </div>
                        <br>
                        <div class="info">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td class="profile-value">Username: </td>
                                    <td class="profile-v"><?php echo $row['username'] ?> <span style="font-size: 15px; color: red;"> (You can't change your username.)</span></td>
                                </tr>
                                <tr>
                                    <td class="profile-value">Email: </td>
                                    <td class="profile-v">
                                        <?php echo "<input type='text' name='email' value= " . $row['email'].  ">"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value">Country: </td>
                                    <td class="profile-v">
                                        <?php echo "<input type='text' name='country' value='" . $row['country'] .  "'>"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value">City: </td>
                                    <td class="profile-v">
                                        <?php echo "<input type='text' name='city' value='" . $row['city'] .  "'>"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value"> State: </td>
                                    <td>
                                        <select name="state_id" class="form-control">
                                            <oprion value="empty"></oprion>
                                            <?php
                                                while($row_states = $results_states->fetch_array(MYSQLI_ASSOC)){
                                                    echo "<option value='" . $row_states["state_id"] . "'>" . $row_states["state"] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-value">Bio: </td>
                                    <td>
                                        <?php echo "<textarea style='width: 100%; height: 280px; font-size: 24px;' type='text' maxlength='1000' name='bio'> " . $row['bio'] . " </textarea>"; ?>
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



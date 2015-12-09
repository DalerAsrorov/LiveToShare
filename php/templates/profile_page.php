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

?>
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 feeds-wrapper">

            <div class="profile-wrapper">
                <div class="image-wrapper profile-image-wrapper">
                    <?php echo '<img class="profile-picture"' . 'src="data:image/jpeg;base64,' .  $row['profile_img']  . '" />'; ?>
                </div>
                <br>
                <div class="info">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <td class="profile-value">Username: </td>
                            <td class="profile-v"><?php echo $row['username'] ?></td>
                        </tr>
                        <tr>
                            <td class="profile-value">Email: </td>
                            <td class="profile-v"><?php echo $row['email'] ?></td>
                        </tr>
                        <tr>
                            <td class="profile-value">Location: </td>
                            <td class="profile-v"><?php echo $row['city'] . ", " . $row['state']  ?></td>
                        </tr>
                        <tr>
                            <td class="profile-value">Bio: </td>
                            <td class="profile-v"><?php echo $row['bio'] ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
</div>



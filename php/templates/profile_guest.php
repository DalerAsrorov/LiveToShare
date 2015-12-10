<?php
/**
 * Created by PhpStorm.
 * User: daler
 * Date: 12/9/15
 * Time: 8:43 PM
 */

// wer are given $username

$sql = "SELECT *
        FROM users, states
        WHERE users.state_id = states.state_id
          AND users.username = '$username'";

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
                    <form method="POST" action="profile_edit.php" enctype="multipart/form-data">
                        <?php
                            if($username == $_SESSION['username']) {
                                echo "<input type = 'submit' class='btn btn-info profile-edit-button' value = 'Edit' />";
                            }
                         ?>
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
                                    <td class="profile-v"><?php echo $row['city'] . ", " . $row['state'] . ", " . $row['country']  ?></td>
                                </tr>
                                <tr>
                                    <td class="profile-value">Bio: </td>
                                    <td class="profile-v"><?php echo $row['bio'] ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

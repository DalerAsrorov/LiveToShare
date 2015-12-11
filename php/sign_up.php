<?php
    require_once "db_connect.php";

    session_start();
    // redirects back to the feeds page if the user
    // manually enters the login.php page.

    if ($_SESSION['logged_in'] == true) {
        header ('Location: feed.php');
    }

    $sql_states = "SELECT *
                    FROM states";

    $results_states = $mysqli->query($sql_states);

    if(!$results_states){
        exit("SQL Error: " . $mysqli->error);
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>LiveToShare</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/feed.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<body>

<div class="container">
    <div id="login-box signup" class="row">
        <form  role="form" method="post" action="sign_up_submit.php" enctype="multipart/form-data" class="col-lg-10 col-md-6 col-sm-8 col-xs-11 signup-form" id="login-form">
                <h1>Sign Up Form!</h1>
                <div class="form-group input-style usr" >
                    <label class="label signup" for="usr">Enter Your Username:</label>
                    <input  type="text" name="username"  class="form-control" id="username">
                </div>
                <div class="form-group input-style pas">
                    <label class="label signup" for="pwd">Enter Password:</label>
                    <input type="password" name="pass" class="form-control " id="pass">
                </div>
                <div class="form-group input-style pas">
                    <label class="label signup" for="pwd">Re-enter Password:</label>
                    <input type="password" name="passTwo" class="form-control " id="passTwo">
                </div>
                <div class="form-group input-style pas">
                    <label class="label signup" for="pwd">Enter Email:</label>
                    <input type="email" name="email" class="form-control " id="email">
                </div>
                <div class="form-group input-style pas">
                    <label class="label signup" for="pwd">Enter City:</label>
                    <input type="text" name="city" class="form-control " id="city">
                </div>
                <div class="form-group input-style pas">
                    <label class="label signup" for="pwd">Enter Country:</label>
                    <input type="text" name="country" class="form-control " id="country">
                </div>
                <div class="form-group input-style pas">
                    <label class="label signup" for="pwd">Select State:</label>
                    <select name="state_id" class="form-control">
                        <oprion value="empty"></oprion>
                        <?php
                            while($row = $results_states->fetch_array(MYSQLI_ASSOC)){
                                echo "<option value='" . $row["state_id"] . "'>" . $row["state"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group input-style pas">
                    <label class="label signup" for="pwd">Write something about yourself so people could learn more about you!</label>
                    <textarea class="form-control signup-bio" name="bio" placeholer="Bio" maxlength="1000"></textarea>
                </div>
                <div class="form-group input-style ">
                    <span class="btn btn-default btn-file">
                        Upload Profile Image <input type="file" class="upload-image" name="image" />
                        <br>
                    </span>
                    <span id="file-name" style="color: darkred;"></span>
                </div>
                <div class="form-group buttons">
                    <input type="submit" value="Register" name="submit" class="btn btn-info"></input>
                </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(".upload-image").change(function() {
        console.log('image');
        var fileName = $(this).val();
        $("#file-name").html(fileName);
    });
</script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>
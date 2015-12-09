<div class="container">
    <div id="date" >
        <h3 class="pull-right"><?php echo $date =  date('l jS, F Y'); ?></h3>
    </div>
    <div id="login-box" class="row">
        <form role="form" method="post"  action="feed.php" class="col-lg-5 col-md-6 col-sm-8 col-xs-11" id="login-form">
            <div class="box">
                <h1>LiveToShare</h1>
                <div class="form-group input-style usr" >
                    <label class="label" for="usr">Username:</label>
                    <input type="text" name="username"  class="form-control" id="username">
                </div>
                <div class="form-group input-style pas">
                    <label class="label" for="pwd">Password:</label>
                    <input type="password" name="pass" class="form-control " id="pass">
                </div>
                <div class="form-group buttons">
                    <button type="submit" value="Login" class="btn btn-info">Login</button>
                    <a href="sign_up.php" type="button" class="btn btn-primary" class="link">Sign Up </a>
                </div>
            </div>
        </form>
    </div>
</div>
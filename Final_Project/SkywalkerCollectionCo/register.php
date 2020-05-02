<?php
  include('./server.php');
  $page_title = "Register";
?>
<html>
<head>
    <title>
        Ramis Shop | <?php echo $page_title ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php include('./userControls/topScripts.php') ?>
</head>
<body>
    <div class="container pnl" style="margin-top: 14em;">
        <h1>Register</h1>
        <form method="post" action="">
            <div class="row">
                <div class="col-md-12" style="margin-top: 1em;">
                    <label>Username: </label>
                    <input class="form-control" type="text" name="username" autocomplete="off" />
                </div>
                <div class="col-md-12" style="margin-top: 1em;">
                    <label>Password: </label>
                    <input class="form-control" type="password" name="password_1" autocomplete="off" />
                </div>
                <div class="col-md-12" style="margin-top: 1em;">
                    <label>Confirm Password: </label>
                    <input class="form-control" type="password" name="password_2" autocomplete="off" />
                </div>
                <div class="col-md-12" style="margin-top: 1em;">
                    <label>Email: </label>
                    <input class="form-control" type="email" name="email" autocomplete="off" />
                </div>
                <div class="col-md-6" style="margin-top: 1em;">
                    <?php include('./errors.php') ?>
                </div>
                <div class="col-md-6 text-right" style="margin-top: 1em;">
                    <button type="submit" class="btn btn-outline-primary" name="reg_user">Register</button>

                    <p style="margin-top: 1em;">
                        Already a memeber?
                        <a href="../login.php">Login</a>
                    </p>
                </div>
            </div>
        </form>
    </div>

    <?php include('./userControls/bottomScripts.php') ?>
</body>
</html>

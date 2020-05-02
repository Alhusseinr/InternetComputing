<?php
include('./server.php');
$page_title = "Login";

?>
<html>
<head>
    <title>Ramis Shop | <?php echo $page_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php include('./userControls/topScripts.php') ?>
</head>
<body>
    <div class="container pnl" style="margin-top: 14em;">
        <h1>Login</h1>
        <form method="post" action="index.php">
            <div class="row">
                <div class="col-md-12">
                    <label>Username</label>
                    <input class="form-control" type="text" name="username" autocomplete="off" value="Ramial" />
                </div>
                <div class="col-md-12">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password" autocomplete="off" value="Hassan111" />
                </div>
                <div class="col-md-6" style="margin-top: 1em;">
                    <?php include('./errors.php') ?>
                </div>
                <div class="col-md-6 text-right" style="margin-top: 1em;">
                    <button type="submit" class="btn btn-outline-success" name="login_user">Login</button>

                    <p style="margin-top: 1em;">
                        Not yet a member?
                        <a href="./register.php">Sign up</a>
                    </p>
                </div>
            </div>
        </form>
    </div>

    <?php include('./userControls/bottomScripts.php') ?>
</body>
</html>

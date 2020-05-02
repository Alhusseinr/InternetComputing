<html>
  <head>
    <title>
      Rami Alhussein | Checkout
    </title>
    <?php
      include('./userControls/topScripts.php');
      include('./server.php');
    ?>
  </head>
  <body>
    <?php
      global $DB;
      $userId = $_SESSION['users_id'];

      $userInfo = "SELECT address1, address2, post_code, city, state, username, email FROM address a INNER JOIN users b ON a.users_id = b.users_id WHERE b.users_id = '$userId'";
      $run = mysqli_query($DB, $userInfo);
      $data = mysqli_fetch_assoc($run);
    ?>

    <form method="post" action="">
      <div class="container">
        <div class="jumbotron">
          <h1 class="display-4">Thank you for your purchase</h1>
          <p class="lead">Your order will be shipped to:</p>
          <p class="lead"><?php echo "Username: ".$data['username'];?></p>
          <p class="lead"><?php echo "Email: ".$data['email'];?></p>
          <p class="lead">Address: <?php echo $data['address1'].", ".$data['address2'] ?></p>
          <hr class="my-4">
          <p>Your order will be delivered within the next 3 - 5 business</p>
          <button class="btn btn-primary btn-lg" name="home" type="submit" role="button">Go Back Home</button>
        </div>
      </div>
    </from>

    <?php include('./userControls/bottomScripts.php'); ?>
  </body>
</html>

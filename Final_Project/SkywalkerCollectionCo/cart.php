<?php
$page_title = 'Cart';
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        Rami's Shop | <?php echo $page_title ?>
    </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.min.css">
    <link rel="stylesheet" href="styles.css">

    <?php
      include('./userControls/topScripts.php');
      include('./server.php');
     ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#qtyRemove').change(function () {
                // SELECTED VALUE
                var productQty = $(this).val();
                var proId = $('#proId').val();
                alert("Value in js: " + productQty + " and product Id: " + proId);

                // Ajax to call the PHP function
                $.post('server.php', { ProductQty: productQty, ProductId: proId }, function (data) {
                    alert('ajax completed. Response: ' + data);
                });
            });
        });
    </script>
</head>
<body class="container-fluid">

  <div class="android-header mdl-layout__header mdl-layout__header--waterfall" >
    <div class="mdl-layout__header-row" style="box-shadow: 0 8px 6px -6px #999;
      margin: 0 -15px;">
      <!-- Add spacer, to align navigation to the right in desktop -->
      <div class="android-header-spacer mdl-layout-spacer"></div>
      <!-- Navigation -->
      <div class="android-navigation-container">
        <nav class="android-navigation mdl-navigation">
          <a class="mdl-navigation__link mdl-typography--text-uppercase" href="./index.php">Home</a>
          <a class="mdl-navigation__link mdl-typography--text-uppercase" href="./cart.php">Cart</a>
          <a href="./index.php?logout='1'" class="mdl-navigation__link mdl-typography--text-uppercase">Logout</a>
        </nav>
      </div>
      <span class="android-mobile-title mdl-layout-title">
        <img class="android-logo-image" src="images/android-logo.png">
      </span>
    </div>
  </div>


    <?php
    global $DB;

    $userId = checkLoggedIn();
    $TotalItems = getItemsTotal();
    $TotalPrice = getTotalPrice();

    $getCart = "SELECT * FROM cart INNER JOIN cart_product INNER JOIN products ON cart.users_id = cart_product.userId AND cart_product.product_id = products.product_id ";

    $run = mysqli_query($DB, $getCart);

    ?>
    <div class="row" style="margin-top:4em;">
        <div class="col-md-8">
            <table style="width:100%;">
                <thead>
                    <tr class="row" style="margin-bottom: 1em;">
                        <th scope="col" style="text-align: left;" class="col-md-6 align-self-center"></th>
                        <th scope="col" style="text-align: center;" class="col-md-6 align-self-center">Price</th>
                        <!-- <th scope="col" style="text-align: center;" class="col-md-3 align-self-center">Quantity</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr class="row" style="margin-bottom: 1em;" >
                        <?php
                        if($run):
                            if(mysqli_num_rows($run) > 0):
                                while($data = mysqli_fetch_assoc($run)):
                        ?>

                        <td class="col-md-6 align-self-center" style="text-align: left; margin-bottom: 2.5em;">
                          <form method="post" action="">
                            <input type="hidden" name="proId" value="<?php echo $data['product_id'] ?>" />
                                <div class="row" style="margin-left: -15px; margin-right: -15px;">
                                    <div class="col-md-6" style="text-align: center;">
                                        <img src="<?php echo $data['pictureURL'] ?>" class="img-thumbnail" style="height: 10em;" /><input type="hidden" name="proId" value="<?php echo $data['product_id'] ?>" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                           <h4><?php echo $data['product_name'] ?></h4>
                                        </div>
                                        <div class="row">
                                          <p><?php echo $data['product_description'] ?></p>
                                        </div>
                                        <div class="row" style="margin-top: 1em;">
                                            <button name="remove" type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="col-md-6 align-self-center" style="text-align: center; margin-bottom: 2.5em;">$<?php echo $data['price'] ?> </td>
                        <?php
                                endwhile;
                            endif;
                        endif;
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4" style="text-align: left;">
            <h3>Subtotal ( <?php echo $TotalItems ?> items ): $<?php echo $TotalPrice ?> </h3>
            <form method="post" action="" >
                <input type="number" name="total" value="<?php echo $TotalPrice ?>" hidden />
                <div class="form-group" style="text-align: left;">
                    <label>Address 1:</label>
                    <input name="address1" class="form-control" />
                </div>
                <div class="form-group" style="text-align: left;">
                    <label>Address 2:</label>
                    <input name="address2" class="form-control" />
                </div>
                <div class="form-group" style="text-align: left;">
                    <label>Zip Code:</label>
                    <input name="post_code" class="form-control" />
                </div>
                <div class="form-group" style="text-align: left;">
                    <label>City:</label>
                    <input name="city" class="form-control" />
                </div>
                <div class="form-group" style="text-align: left;">
                    <label>State:</label>
                    <input name="state" class="form-control" />
                </div>
                <div class="form-group" style="text-align: left;">
                  <button type="submit" name="checkout" class="btn btn-success" >Checkout</button>
                </div>
            </form>
        </div>
    </div>
    <?php include('./userControls/bottomScripts.php'); ?>
</body>
</html>

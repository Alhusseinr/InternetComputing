<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Introducing Lollipop, a sweet new take on Android.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Android</title>
    <?php
      include('./server.php');
      checkLoggedIn();
      $query_getProducts = "SELECT * FROM products";
      $products = mysqli_query($DB, $query_getProducts);
    ?>

    <!-- Page styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
  </head>
  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <div class="android-header mdl-layout__header mdl-layout__header--waterfall">
        <div class="mdl-layout__header-row">
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

      <div class="android-content mdl-layout__content">
        <a name="top"></a>
        <div class="android-be-together-section mdl-typography--text-center">
          <div class="logo-font android-slogan">only a sith deals in absolutes</div>
          <div class="logo-font android-sub-slogan">In my experience there is no such thing as luck.</div>
        </div>
        <div class="android-customized-section">
          <div class="android-customized-section-text">
            <div class="mdl-typography--font-light mdl-typography--display-1-color-contrast" style="padding-bottom: 40px;">Customised by the force, for you</div>
          </div>
          <div class="android-customized-section-image"></div>
        </div>

        <div class="android-more-section">
          <div class="android-section-title mdl-typography--display-1-color-contrast">More from the force</div>
          <div class="android-card-container mdl-grid">
            <!-- This is where the loop to show all products would go -->
            <?php

              if($products):
                  if(mysqli_num_rows($products) > 0):
                      $count = 0;
                      while($count < 20 && $product = mysqli_fetch_assoc($products)):
            ?>
            <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
            <form method="post" action="index.php" style="width: 100%;">
                <input type="hidden" name="product_id_h" value="<?php echo $product['product_id'] ?>" />
                <input type="hidden" name="product_name_h" value="<?php echo $product['product_name']; ?>" />
                <input type="hidden" name="product_price_h" value="<?php echo $product['price']; ?>" />


                  <div class="mdl-card__media">
                    <img src="<?php echo $product['pictureURL']; ?>">
                  </div>
                  <div class="mdl-card__title">
                     <h4 class="mdl-card__title-text"><?php echo $product['product_name']; ?></h4>
                  </div>
                  <div class="mdl-card__supporting-text">
                    <span class="mdl-typography--font-light mdl-typography--subhead"><?php echo $product['product_description']; ?> </span>
                    <br />
                    <div class="mdl-typography--font-light mdl-typography--subhead" style="text-align: left;"><h4> $<?php echo $product['price']; ?></h4></div>
                  </div>
                  <div class="mdl-card__actions">
                     <button class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" name="add_to_cart">
                       Add to cart
                       <i class="material-icons">chevron_right</i>
                     </button>
                  </div>

            </form>
            </div>
            <?php
                          $count++;
                      endwhile;
                  endif;
              endif;
            ?>

          </div>
        </div>

        <footer class="android-footer mdl-mega-footer">
          <div class="mdl-mega-footer--top-section">
            <div class="mdl-mega-footer--right-section">
              <a class="mdl-typography--font-light" href="#top">
                Back to Top
                <i class="material-icons">expand_less</i>
              </a>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- <a href="https://github.com/google/material-design-lite/blob/mdl-1.x/templates/android-dot-com/" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">View Source</a> -->
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  </body>
</html>

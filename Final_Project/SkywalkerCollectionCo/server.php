<?php

isset($_SESSION['username']) ? '' : session_start();

$username;
$email;
$password;
$role;
$errors = array();

// My DB connection
// $dsn = "mysql:host=localhost;dbname=ramialhusseindatabase";
// $DB = new PDO ($dsn, "johnsmith", "johnsmithpass");

$DB = mysqli_connect("localhost","ramialhussein","ramialhusseinpass","ramialhusseindatabase");


// Register
if(isset($_POST['reg_user'])){
    global $DB;
    global $errors;

    $username = mysqli_real_escape_string($DB, $_POST['username']);
    $email = mysqli_real_escape_string($DB, $_POST['email']);
    $password = mysqli_real_escape_string($DB, $_POST['password_1']);

    empty($username) ? array_push($errors, 'Username is required') : '';

    empty($email) ? array_push($errors, 'Email is required') : '';

    empty($password) ? array_push($errors, 'Password is required') : '';

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($DB, $user_check_query);

    // If a user or email exists
    if ($result == true) {
      if(mysqli_num_rows($result)){
          $data = mysqli_fetch_assoc($result);
          $data['username'] === $username ? array_push($errors, "Username taken") : '';
          $data['email'] === $email ? array_push($errors, "Email taken") : '';
      }
    }

    if(count($errors) == 0){
        $hashed_password = md5($password);
        $addIntoDB = "INSERT INTO users (username, email, Password) VALUES('$username', '$email', '$hashed_password')";
        $run = mysqli_query($DB, $addIntoDB);

        if($run = true){
            header("location: ./login.php");
        }
    }
}


//Login
if(isset($_POST['login_user'])){
    $username = mysqli_real_escape_string($DB, $_POST['username']);
    $password = mysqli_real_escape_string($DB, $_POST['password']);

    empty($username) ?  array_push($errors, "Username is required") : '';
    empty($password) ? array_push($errors, "Password is required") : '';

    if(count($errors) == 0){
        $password = md5($password);
        $find_user_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1;";
        $results = mysqli_query($DB, $find_user_query);
        $userInfo = mysqli_fetch_assoc($results);

        if(mysqli_num_rows($results) == 1){
            $userId = $userInfo['users_id'];

            if(empty($userInfo['ip_address']) || is_null($userInfo['ip_address']) || $userInfo['ip_address'] == 0 && empty($userInfo['port']) || is_null($userInfo['port']) || $userInfo['port'] == 0){
                $ip = GetUserIp();

                if($ip != $userInfo['ip_address']){
                    $insert_ip = "UPDATE users SET ip_address='$ip' WHERE users_id='$userId' AND username='$username'";
                    $result = mysqli_query($DB, $insert_ip);
                }
            }

            $_SESSION['role'] = $userInfo['role'];
            $_SESSION['username'] = $username;
            $_SESSION['users_id'] = $userInfo['users_id'];
            $_SESSION['email'] = $userInfo['email'];

            header('location: ./index.php');
        }else{
            array_push($errors, "Wrong username/password combination");
        }
    }
}

//logout
if(isset($_GET['logout'])){
    session_destroy();

    unset($_SESSION['username']);
    unset($_SESSION['role']);
    unset($_SESSION['users_id']);
    unset($_SESSION['email']);
    unset($_SESSION['msg']);

    header('location: ./login.php');
}

// adding product into cart
if(isset($_POST['add_to_cart'])){
    $productId = mysqli_real_escape_string($DB, $_POST['product_id_h']);
    $product_name = mysqli_real_escape_string($DB, $_POST['product_name_h']);
    $product_price = mysqli_real_escape_string($DB, $_POST['product_price_h']);
    //$product_quantity = mysqli_real_escape_string($DB, $_POST['quantity']);
    $loggedInUsername = $_SESSION['username'];
    $loggedInUserId = $_SESSION['users_id'];

    $checkifCart = "SELECT * FROM cart WHERE users_id = '$loggedInUserId' LIMIT 1";
    $Cart = mysqli_query($DB, $checkifCart);

    if(mysqli_num_rows($Cart) > 0){
      addToCart($productId, $loggedInUserId);
    } else {
      $createCart = "INSERT INTO cart(users_id) VALUES('$loggedInUserId')";
      $create = mysqli_query($DB, $createCart);
      addToCart($productId, $loggedInUserId);
    }
}

if(isset($_POST['checkout'])){

    $userId = $_SESSION['users_id'];
    $orderTotal = mysqli_real_escape_string($DB, $_POST['total']);

    $address1 = mysqli_real_escape_string($DB, $_POST['address1']);
    $address2 = mysqli_real_escape_string($DB, $_POST['address2']);
    $post_code = mysqli_real_escape_string($DB, $_POST['post_code']);
    $city = mysqli_real_escape_string($DB, $_POST['city']);
    $state = mysqli_real_escape_string($DB, $_POST['state']);

    $checkForAdd = "SELECT users_id FROM address WHERE users_id = '$userId'";
    $run = mysqli_query($DB, $checkForAdd);

    if(mysqli_num_rows($run) > 0){
      header('location: ./checkout.php');
    } else {
      $insertIntoAddress = "INSERT INTO address(address1, address2, post_code, city, state, users_id) VALUES('$address1', '$address2', '$post_code', '$city', '$state', '$userId')";
      mysqli_query($DB, $insertIntoAddress);
    }

    header('location: ./checkout.php');
}

if(isset($_POST['remove'])){
    $productId = mysqli_real_escape_string($DB, $_POST['proId']);
    $delete = "DELETE FROM cart_product WHERE product_id='$productId'";
    $run = mysqli_query($DB, $delete);

}

if(isset($_POST['home'])){
  // Delete everything from the cart of the user
  global $DB;
  $userId = $_SESSION['users_id'];
  $deleteCart = "DELETE FROM cart_product WHERE userId = '$userId'";
  $delete = mysqli_query($DB, $deleteCart);
  header("location: ./index.php");
}

// Functions

function addToCart($proId, $userId){
  global $DB;
  $checkIfInCart = "SELECT product_id FROM cart_product WHERE userId='$userId' AND product_id='$proId' LIMIT 1";
  $checkCart = mysqli_query($DB, $checkIfInCart);
  if(mysqli_num_rows($checkCart) > 0){
    header('location: ./cart.php');
  } else {
    $addingIntoProduct = "INSERT INTO cart_product(product_id, quantity, cart_id, userId) VALUES('$proId', 1, 1, '$userId')";
    $run1 = mysqli_query($DB, $addingIntoProduct);
  }
}

function updateCart($newProductQty, $proId, $userId){
    global $DB;
    global $productPrice;

    if($newProductQty > 0){
        $proPrice = getCartPrice($newProductQty, $productPrice);
        $updateCart = "UPDATE cart_product SET cart_qty = cart_qty - '$newProductQty', cart_price = cart_price - '$proPrice' WHERE userId = '$userId' AND product_id = '$proId'";
        $run = mysqli_query($DB, $updateCart);
    }

}

function getCartPrice($product_quantity, $product_price){

    $productTotal =  $product_quantity * $product_price;

    return $productTotal;
}

function checkLoggedIn(){
    if(!isset($_SESSION['username']) && !isset($_SESSION['users_id'])){
        $_SESSION['msg'] = "You must be logged in to use this site";
        header('location: ./login.php');
    }
}

function GetUserIp(){

    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        // IP from shared internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //IP pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

function addProduct($product_name, $product_price, $product_quantity){
    $adding_into_product = "INSERT INTO cart_product(product_id, quantity, price)";
}

function getUserInfo($username, $email){
    global $DB;

    $query = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    $run = mysqli_query($DB, $query);
    $data = mysqli_fetch_assoc($run);

    return $data;
}

function getItemsTotal(){
    global $DB;

    $userInfo = getUserInfo($_SESSION['username'], $_SESSION['email']);
    $userId = $userInfo['users_id'];
    $getItemsQty = "SELECT * FROM cart_product WHERE userId = '$userId'";
    $getItems = mysqli_query($DB, $getItemsQty);

    $total = 0;

    if($getItems){
      while($data = mysqli_fetch_assoc($getItems)){
          $total += $data['quantity'];
      }
    }
    return $total;
}

function getTotalPrice(){
    global $DB;

    $userInfo = getUserInfo($_SESSION['username'], $_SESSION['email']);
    $userId = $userInfo['users_id'];
    $getItemsQty = "SELECT price FROM cart_product a INNER JOIN products b ON a.product_id = b.product_id WHERE a.userId = '$userId'";
    $getItems = mysqli_query($DB, $getItemsQty);

    $total = 0;

    if($getItems){
      while($data = mysqli_fetch_assoc($getItems)){
          $total += $data['price'];
      }
    }

    return $total;
}


?>

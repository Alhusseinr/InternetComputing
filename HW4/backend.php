<?php
    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "csit101";
    $errors = array();
    $fname = "";
    $lname = "";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    
    //Login
    if(isset($_POST['login_user'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        empty($email) ?  array_push($errors, "Email is required") : '';
        empty($password) ? array_push($errors, "Password is required") : '';
        
        if(count($errors) == 0){
            $find_user = "SELECT * FROM administrators WHERE email='$email' OR password='$password' LIMIT 1;";
            $results = mysqli_query($conn, $find_user);
            $userInfo = mysqli_fetch_assoc($results);
            
            if(mysqli_num_rows($results) == 1){
                $fname = $userInfo['firstname'];
                $lname = $userInfo['lastname'];
                
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
            } else {
                array_push($errors, '1');
            }
        }
    }
?>
<html>
    <body>
        <?php if(count($errors) == 0){ ?>
            <h1><?php echo 'Good job! '.$fname.' '.$lname.', successfully logged in!!' ?></h1>
        <?php } else { ?>
            <form action="backend.php" method="post">
                <h1>Welcome to CSIT website</h1>
                <h2>Please Login</h2>
                <label>Email: </label>
                <input type="email" name="email" id="email" required="required" />
                <br />
                           
                <label>Password: </label>
                <input type="password" name="password" id="password" required="required" />
                <br />
                           
                <input type="submit"  value="Login" name="login_user" />
                           
                           
                <p>Error: Invalid credintials, you must corretly login to view this site</p>
            </form>
    <?php }; ?>
    </body>
</html>

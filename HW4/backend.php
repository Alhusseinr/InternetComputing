<?php
    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "csit101";
    $errors = array();

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
            }
        }
    }

    
    

    
    
    
    
    
    
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * from administrators Where email=".$email." and password=".$password;
    if(mysqli_query($conn, $sql)){
        echo 'you logged in';
    }
    
?>

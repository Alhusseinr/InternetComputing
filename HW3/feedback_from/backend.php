<?php
    // get the data from the form
    $suffex = $_POST['test_text'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $rating = $_POST['ratingHidden'];
    $comments = $_POST['comments'];
    
?>






<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

    <p>Thank you <?php echo $suffex; ?><?php echo $name; ?>, for your comments </p>
    <p>Your email address is <?php echo $email; ?> and your phone number is: <?php echo $phone_number; ?></p>
    <p>You stated that you found his example to be <?php echo $rating; ?> and added:</p>
    <p><?php echo $comments; ?></p>
</body>
</html>


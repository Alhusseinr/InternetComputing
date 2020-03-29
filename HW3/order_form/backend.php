<?php
    // get the data from the form
    $unit_price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $discount = $_POST['discount'];
    $tax_rate = $_POST['tax'];
    $shipping = $_POST['shippingMethod'];
    $payments = $_POST['paymentsNum'];;
    
    $total_price = ($quantity * $unit_price - $discount + $shipping) * 1.08;
    $total_month = $total_price/$payments;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

    <div>
        <p>You have selected to purchase:</p>
        <p> <?php echo $quantity; ?> of widgest(s) at</p>
        <p>$<?php echo $unit_price; ?> price for each at</p>
        <p>$<?php echo $shipping; ?> shipping cost and a</p>
        <p><?php echo $tax_rate; ?> percent tax rate. </p>
        <p>After your $<?php echo $discount; ?> discount, the total cost is $ <?php echo $total_price; ?>.</p>
        <p>Divided over <?php echo $payments; ?> monthly payments, that would be $<?php echo $total_month; ?> each month.</p>

    </div>
</body>
</html>


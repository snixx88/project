<?php
session_start();
include 'connection.php';

// Redirect if not logged in
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Process checkout
if(isset($_POST['checkout'])) {
    $user_id = $_SESSION['user'];
    $payment_method = $_POST['payment_method'];
    $address = $_POST['address'];
    
    // Get cart items
    $cart_sql = "SELECT * FROM cart WHERE user_id = $user_id";
    $cart_result = $connect->query($cart_sql);
    
    if($cart_result->num_rows > 0) {
        // Calculate total
        $total = 0;
        while($item = $cart_result->fetch_assoc()) {
            $total += $item['price'] * $item['quantity'];
        }
        
        // Create order
        $order_sql = "INSERT INTO `order` (user_id, total_price, payment_method, delivery_address) 
                     VALUES ($user_id, $total, '$payment_method', '$address')";
        $connect->query($order_sql);
        $order_id = $connect->insert_id;
        
// Insert into checkout table

$checkout_sql = "INSERT INTO checkout (user_id, order_id, payment_method, address, total_price) 
                 VALUES ($user_id, $order_id, '$payment_method', '$address', $total)";
$connect->query($checkout_sql);


        // Add order details
        $cart_result->data_seek(0); // Reset pointer
        while($item = $cart_result->fetch_assoc()) {
            $detail_sql = "INSERT INTO order_details (order_id, car_id, quantity, price)
                          VALUES ($order_id, {$item['car_id']}, {$item['quantity']}, {$item['price']})";
            $connect->query($detail_sql);
        }
        
        // Clear cart
        $clear_sql = "DELETE FROM cart WHERE user_id = $user_id";
        $connect->query($clear_sql);
        
        // Redirect to confirmation
        header("Location: order_confirmation.php?order_id=$order_id");
        exit;
    }
}

// Get cart items and total
$total = 0;
$cart_items = [];
$sql = "SELECT c.*, car.car_name FROM cart c JOIN car ON c.car_id = car.car_id WHERE c.user_id = {$_SESSION['user']}";
$result = $connect->query($sql);

while($row = $result->fetch_assoc()) {
    $row['subtotal'] = $row['price'] * $row['quantity'];
    $total += $row['subtotal'];
    $cart_items[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - BMW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container py-5">
        <h1 class="mb-4">Checkout</h1>
        
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Order Summary</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($cart_items as $item): ?>
                                <tr>
                                    <td><?= $item['car_name'] ?></td>
                                    <td>$<?= number_format($item['price'], 2) ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>$<?= number_format($item['subtotal'], 2) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Payment Details</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="PayPal">PayPal</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Delivery Address</label>
                                <textarea name="address" class="form-control" required></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <h5>Total: $<?= number_format($total, 2) ?></h5>
                            </div>
                            
                            <button type="submit" name="checkout" class="btn btn-primary w-100">Complete Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
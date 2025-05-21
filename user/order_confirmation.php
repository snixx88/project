<?php
session_start();
include 'connection.php';

if(!isset($_GET['order_id'])) {
    header("Location: index.php");
    exit;
}

$order_id = $_GET['order_id'];
$user_id = $_SESSION['user'];

// Get order details
$order_sql = "SELECT * FROM `order` WHERE order_id = $order_id AND user_id = $user_id";
$order_result = $connect->query($order_sql);

if($order_result->num_rows == 0) {
    header("Location: index.php");
    exit;
}

$order = $order_result->fetch_assoc();

// Get order items
$items_sql = "SELECT od.*, car.car_name, car.car_image 
              FROM order_details od
              JOIN car ON od.car_id = car.car_id
              WHERE od.order_id = $order_id";
$items_result = $connect->query($items_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - BMW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container py-5">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h2>Order Confirmation</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-success">
                    Thank you for your order! Your order number is: <strong>#<?= $order_id ?></strong>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h4>Order Details</h4>
                        <p><strong>Order Date:</strong> <?= $order['order_date'] ?></p>
                        <p><strong>Payment Method:</strong> <?= $order['payment_method'] ?></p>
                        <p><strong>Delivery Address:</strong> <?= $order['delivery_address'] ?></p>
                        <p><strong>Status:</strong> <?= ucfirst($order['payment_status']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <h4>Order Summary</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($item = $items_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $item['car_name'] ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>$<?= number_format($item['price'], 2) ?></td>
                                </tr>
                                <?php endwhile; ?>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>$<?= number_format($order['total_price'], 2) ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="models.php" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
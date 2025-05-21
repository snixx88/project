<?php
include 'connection.php';

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user'];

// Get all orders for the user
$order_sql = "SELECT * FROM `order` WHERE user_id = $user_id ORDER BY order_id DESC";
$order_result = $connect->query($order_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders - BMW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h1 class="mb-4">My Orders</h1>

    <?php if ($order_result->num_rows === 0): ?>
        <div class="alert alert-info">You have no orders yet.</div>
    <?php else: ?>
        <?php while ($order = $order_result->fetch_assoc()): ?>
            <div class="card mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <strong>Order #<?= $order['order_id'] ?></strong>
                    <span class="badge bg-info text-dark">Status: <?= $order['status'] ?></span>
                </div>
                <div class="card-body">
                    <p><strong>Total:</strong> $<?= number_format($order['total_price'], 2) ?></p>
                    <p><strong>Payment Method:</strong> <?= $order['payment_method'] ?></p>
                    <p><strong>Delivery Address:</strong> <?= $order['delivery_address'] ?></p>

                    <h5 class="mt-4">Items:</h5>
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Car</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $order_id = $order['order_id'];
                        $detail_sql = "SELECT od.*, car.car_name 
                                       FROM order_details od
                                       JOIN car ON od.car_id = car.car_id
                                       WHERE od.order_id = $order_id";
                        $detail_result = $connect->query($detail_sql);
                        while ($item = $detail_result->fetch_assoc()):
                            $subtotal = $item['price'] * $item['quantity'];
                            ?>
                            <tr>
                                <td><?= $item['car_name'] ?></td>
                                <td>$<?= number_format($item['price'], 2) ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td>$<?= number_format($subtotal, 2) ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
</body>
</html>

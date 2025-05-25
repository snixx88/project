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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/order.css">
</head>
<body>
    <header>
    <div class="nav">
        <div class="logo">
               <a href="HOME.php"> <img src="../img/image.png" alt="BMW LOGO" width="65px" height="50px" id="logo"></a>
               <h1>
               <a href="HOME.php">BMW</a>
               </h1>
        </div>
<div class="extra-nav">
    <div class="dropdown">
        <?php if(isset($_SESSION['user'])): 
            $user_id = $_SESSION['user'];
            $user_query = "SELECT username FROM user WHERE user_id = $user_id";
            $user_result = $connect->query($user_query);
            $user = $user_result->fetch_assoc();
        ?>
            <button class="profile-btn" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle"></i>
                <span class="d-none d-md-inline"><?= substr($user['username'], 0, 12) ?></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" >
                <div class="dropdown_menu_end1">

                <li><a class="dropdown-item  text-secondary" href="profile.php">My Profile</a></li>
                <li><a class="dropdown-item  text-secondary" href="order.php">My Orders</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                </div>
            </ul>
        <?php else: ?>
            <button class="profile-btn" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle"></i>
                <span class="d-none d-md-inline">Account</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item text-secondary" href="login.php">Login</a></li>
                <li><a class="dropdown-item text-secondary" href="signup.php">Sign Up</a></li>
            </ul>
        <?php endif; ?>
    </div>
</div>
</div>
</div>
</header>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>

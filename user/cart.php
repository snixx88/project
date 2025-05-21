<?php
session_start();

include 'connection.php';

// Add to cart functionality
if(isset($_POST['add_to_cart']) && isset($_SESSION['user'])) {
    $car_id = $_POST['car_id'];
    $user_id = $_SESSION['user'];
    $price = $_POST['price'];
    
    // Check if item already in cart
    $check = "SELECT * FROM cart WHERE car_id = $car_id AND user_id = $user_id";
    $result = $connect->query($check);
    
    if($result->num_rows > 0) {
        // Update quantity if exists
        $update = "UPDATE cart SET quantity = quantity + 1 WHERE car_id = $car_id AND user_id = $user_id";
        $connect->query($update);
    } else {
        // Add new item to cart
        $insert = "INSERT INTO cart (car_id, user_id, price) VALUES ($car_id, $user_id, $price)";
        $connect->query($insert);
    }
}

// Remove from cart
if(isset($_GET['remove']) && isset($_SESSION['user'])) {
    $cart_id = $_GET['remove'];
    $delete = "DELETE FROM cart WHERE cart_id = $cart_id AND user_id = {$_SESSION['user']}";
    $connect->query($delete);
}

// Get cart items for current user
$cart_items = [];
$total = 0;
if(isset($_SESSION['user'])) {
    $sql = "SELECT c.*, car.car_name, car.car_image 
            FROM cart c 
            JOIN car ON c.car_id = car.car_id 
            WHERE c.user_id = {$_SESSION['user']}";
    $result = $connect->query($sql);
    
    while($row = $result->fetch_assoc()) {
        $row['subtotal'] = $row['price'] * $row['quantity'];
        $total += $row['subtotal'];
        $cart_items[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - BMW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container py-5">
        <h1 class="mb-4">Your Shopping Cart</h1>
        
        <?php if(empty($cart_items)): ?>
            <div class="alert alert-info">Your cart is empty</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cart_items as $item): ?>
                        <tr>
                            <td>
                                <img src="<?= $item['car_image'] ?>" width="100" class="me-3">
                                <?= $item['car_name'] ?>
                            </td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>$<?= number_format($item['subtotal'], 2) ?></td>
                            <td>
                                <a href="cart.php?remove=<?= $item['cart_id'] ?>" class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td colspan="2"><strong>$<?= number_format($total, 2) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
                
                <div class="text-end">
                    <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    
</body>
</html>
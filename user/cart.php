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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cart.css">
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
                 
<!-- Profile Dropdown -->
    <div class="dropdown">
        <?php if(isset($_SESSION['user'])): 
            // Get user info from database
            $user_id = $_SESSION['user'];
            $user_query = "SELECT username FROM user WHERE user_id = $user_id";
            $user_result = $connect->query($user_query);
            $user = $user_result->fetch_assoc();
        ?>
            <button class="profile-btn" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle"></i>
                <span class="d-none d-md-inline"><?= substr($user['username'], 0, 12) ?></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end "data-bs-theme="dark" >
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
</header>
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
    <div class="button-row">
        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
        <a href="models.php" class="btn btn-secondary">Continue Shopping</a>
    </div>

            </div>
        <?php endif; ?>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    
</body>
</html>
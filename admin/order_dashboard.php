<?php
include '../user/connection.php';

if (isset($_GET['page'])) {
    $page = $_GET['page']; 
} else {
    $page = 'dashboard'; 
}

// Fetch dashboard statistics
$total_cars = $connect->query("SELECT COUNT(*) as count FROM car")->fetch_assoc()['count'];
$total_orders = $connect->query("SELECT COUNT(*) as count FROM `order`")->fetch_assoc()['count'];
$pending_orders = $connect->query("SELECT COUNT(*) as count FROM `order` WHERE status = 'pending'")->fetch_assoc()['count'];

// Calculate total revenue
$revenue_result = $connect->query("
    SELECT SUM(od.price * od.quantity) as total 
    FROM order_details od
    JOIN `order` o ON od.order_id = o.order_id
    WHERE o.status = 'complete'
");
$total_revenue = $revenue_result->fetch_assoc()['total'] ?? 0;

if (!empty($_POST)) {
    $order_id = $_POST['order_id'];  

    if ($_POST['status'] == 'complete') {
        $new_status = 'complete';
    } else {
        $new_status = 'pending';
    }
    $connect->query("UPDATE `order` SET status = '$new_status' WHERE order_id = $order_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>BMW Admin</title>
  <link rel="stylesheet" href="Admindashboard.css" />
</head>
<body>
  <nav class="sidebar">
    <h2>BMW Admin</h2>
    <a href="?page=dashboard" <?php if ($page == 'dashboard') echo 'class="active"'; ?>>Dashboard</a>
    <a href="?page=orders" <?php if ($page == 'orders') echo 'class="active"'; ?>>Orders</a>
  </nav>

  <main class="main-content">

  <?php if ($page == 'dashboard') { ?>
    <h1>Dashboard</h1>
    <div class="cards">
      <div class="card"><h3>Total Cars</h3><p><?php echo $total_cars; ?></p></div>
      <div class="card"><h3>Total orders</h3><p><?php echo $total_orders; ?></p></div>
      <div class="card"><h3>Pending Orders</h3><p><?php echo $pending_orders; ?></p></div>
      <div class="card"><h3>Total Revenue</h3><p>$<?php echo number_format($total_revenue, 2); ?></p></div>
    </div>

  <?php } elseif ($page == 'orders') { ?>
    <h1>Orders</h1>

    <?php
    $orders_result = $connect->query("SELECT * FROM `order` ORDER BY order_id DESC");

    if ($orders_result && $orders_result->num_rows > 0) {
        while ($order = $orders_result->fetch_assoc()) {
            $order_id = $order['order_id'];

            $detail_sql = "SELECT od.price, od.quantity, car.car_name 
                           FROM order_details od
                           JOIN car ON od.car_id = car.car_id 
                           WHERE od.order_id = $order_id";
            $detail_result = $connect->query($detail_sql);

            $total_calculated = 0;
            while ($item = $detail_result->fetch_assoc()) {
                $total_calculated += $item['price'] * $item['quantity'];
            }
            $detail_result->data_seek(0);
    ?>

  <div class="order-card-clean">
  <div class="order-top">
    <strong>Order #<?php echo $order['order_id']; ?></strong>

    <form method="post">
      <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
      <label>Status:</label>
      <select name="status" onchange="this.form.submit()">
        <option value="pending" <?php if($order['status'] == 'pending') echo 'selected'; ?>>Pending</option>
        <option value="complete" <?php if($order['status'] == 'complete') echo 'selected'; ?>>Complete</option>
      </select>
    </form>
  </div>

      <div class="order-body">
        <p><strong>Total:</strong> $<?php echo number_format($total_calculated, 2); ?></p>
        <p><strong>Payment Method:</strong> <?php echo $order['payment_method']; ?></p>
        <p><strong>Delivery Address:</strong> <?php echo $order['delivery_address']; ?></p>)

        <h4 class="items-header">Items:</h4>
        <table class="order-table-clean">
          <thead>
            <tr>
              <th>Car</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($item = $detail_result->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $item['car_name']; ?></td>
              <td>$<?php echo number_format($item['price'], 2); ?></td>
              <td><?php echo $item['quantity']; ?></td>
              <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
  </div>
    <?php
        } 
    } else {
        echo "<p>No orders found.</p>";
    }
  } else {
    echo "<h1>Page not found</h1>";
  }
  ?>

  </main>
</body>
</html> 
<?php
session_start();

$alert = "";

if (isset($_POST['login'])) {
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $database = "bmw";

    $connect = mysqli_connect($localhost, $username, $password, $database);

    $email = mysqli_real_escape_string($connect, $_POST['username']);
    $pass = mysqli_real_escape_string($connect, $_POST['password']);

    $select = "SELECT * FROM admins WHERE admin_email = '$email' AND admin_password = '$pass'";
    $run_select = mysqli_query($connect, $select);

    if (mysqli_num_rows($run_select) > 0) {
        $fetch = mysqli_fetch_assoc($run_select);
        $_SESSION['admin_id'] = $fetch['admin_id'];
        header("Location: http://localhost/project/admin/order_dashboard.php");
        exit();
    } else {
        $alert = "Incorrect email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Login</title>
  <link rel="stylesheet" href="adminlogin.css" />
</head>
<body>

<div class="login-box">
  <h1>Admin Login</h1>

  <form action="" method="POST" novalidate class="login-form">
    <label for="username">Username</label><br />
    <input type="text" id="username" name="username" autocomplete="username" required autofocus /><br /><br />

    <label for="password">Password</label><br />
    <input type="password" id="password" name="password" autocomplete="current-password" required /><br /><br />

    <div class="options">
      <label><input type="checkbox" name="remember" /> Remember me</label>
      <a href="#" class="forgot">Forgot password?</a>
    </div><br />

    <button type="submit" name="login">Login</button>
  </form>

  <?php if ($alert): ?>
    <div class="alert"><?php echo htmlspecialchars($alert); ?></div>
  <?php endif; ?>
</div>

</body>
</html>
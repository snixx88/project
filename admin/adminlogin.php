
<?php
session_start();

include '../user/connection.php';

$alert = "";

if (isset($_POST['login'])) {
    $email = $_POST['username'];
    $pass = $_POST['password'];

    $select = "SELECT * FROM admins WHERE admin_email = '$email' AND admin_password = '$pass'";
    $run_select = mysqli_query($connect, $select);

        $row = mysqli_num_rows($run_select);

        if ($row > 0) {
            $fetch = mysqli_fetch_assoc($run_select);

            $id = $fetch['admin_id'];  
            $id= $_SESSION['user'] ;

            header("Location: http://localhost/project/admin/admindashboard.php");
            
        } else {
            $alert = "PLEASE ENTER CORRECT DATA";
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

<?php
include '../connection.php';


$alert = "";
if (isset($_POST['login'])) {
    $email = $_POST['admin_email']; // Changed to match your database field
    $pass = $_POST['password'];

    // This query already exists in your code - no need to add it
    $select = "SELECT * FROM admins WHERE admin_email = '$email' AND admin_password = '$pass'";
    $run_select = mysqli_query($connect, $select);

    if (mysqli_num_rows($run_select) > 0) {
        $fetch = mysqli_fetch_assoc($run_select);
        $_SESSION['admin_id'] = $fetch['admin_id'];
        header("Location: admin_dashboard.php"); // Set your actual destination
        exit();
    } else {
        $alert = "Incorrect email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>

  <div class="login-box">
    <h1>Admin Login</h1>

    <form action="adminlogin.php" method="POST">
      <label for="username">Username</label><br>
      <input type="text" id="username" name="username"><br><br>

      <label for="password">Password</label><br>
      <input type="password" id="password" name="password"><br><br>

      <div class="options">
        <label><input type="checkbox" name="remember"> Remember me</label>
        <a href="#" class="forgot">Forgot password?</a>
      </div><br>

      <button type="submit" name="login">Login</button>

      <?php if($alert) { ?>
        <p style="color:red; text-align:center; margin-top:10px;">
          <strong><?php echo $alert; ?></strong><br>
          Please check your information again.
        </p>
      <?php } ?>
    </form>
  </div>







  
</body>
</html>

<style>
body {
  margin: 0;
  padding: 0;
  background-color: #0d1b2a;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  font-family: Arial, sans-serif;
}

.login-box {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  width: 300px; 
}

.login-box h1 {
  text-align: center;
  margin-bottom: 20px;
}

input[type="text"],input[type="password"] {
  width: 100%;
  padding: 8px;
  margin-top: 5px;
  box-sizing: border-box;
}

.options {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
  margin-top: 5px;
}

.options a {
  text-decoration: none;
  color: #0d1b2a;
}

button {
  width: 100%;
  padding: 10px;
  margin-top: 15px;
  background-color: #0d1b2a;
  color: white;
  border: none;
  cursor: pointer;
}





</style>
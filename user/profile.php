<?php
include 'connection.php';
$id=isset($_SESSION['user']);

$select=" SELECT * from user where user_id = $id ";
$run_select=mysqli_query($connect,$select);

$fetch=mysqli_fetch_assoc($run_select);
$username=$fetch['username'];
$email=$fetch['email'];
$phone=$fetch['phone'];


if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Profile</title>
  <link rel="stylesheet" href="profile.css"/>
</head>

<body>

<header>
   <h2>Welcome <?php echo $username?></h2>
   <form method="post">
    <button type="submit" name="logout">Logout</button>
  </form>
</header>

<section class="main_info">
        <h2>My Information</h2>
        <p> Email: <?php echo $email ?> </p>
        <p> Phone: <?php echo $phone ?> </p>
</section>

</body>
</html>
<?php
include 'connection.php';

if(isset($_SESSION['user'])){
   $id=$_SESSION['user'];
}else{
  header('location:login.php');
  exit();
}

$select=" SELECT * from user where user_id = $id ";
$run_select=mysqli_query($connect,$select);

if($fetch=mysqli_fetch_assoc($run_select)){
$username=$fetch['username'];
$email=$fetch['email'];
$phone=$fetch['phone'];
}else{
  $username = "Unknown";
    $email = "N/A";
    $phone = "N/A";
}

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
  <link rel="stylesheet" href="css/profile.css"/>
</head>

<body>

<header>
  <div class="welcome">
  <a href="HOME.php"> Welcome, </a> <h2><?php echo $username?></h2>
  </div>
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
<style>

  *{
margin: 0;
padding: 0;
box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color:  rgb(135, 154, 160);
  color: #ffffff;
}

header {
  background-color:transparent;
  padding: 15px 30px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: fixed;
  width: 100%;
  top: 0;
  left: 0;
  z-index: 1000;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
}
.welcome{
display: flex;
gap: 5px;

}
.welcome a{
text-decoration: none;
 font-size: 1.5rem;
  color: #000000;
font-weight: bold;
}
header h2 {
  font-size: 1.5rem;
  color: #000000;
}

header form button {
  background-color: #000000;
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
  color: #fff;
  font-weight: bold;
  transition: background 0.3s;
}

header form button:hover {
  background-color: #ffffff;
  color: black;
}

.main_info {
  max-width: 600px;
  margin: 100px auto 0; 
  background-color: transparent;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 0 15px rgba(0,0,0,0.5);
  text-align: center;
}

.main_info h2 {
  font-size: 2rem;
  color: #000000;
  margin-bottom: 20px;
  font-style: italic;
}

.main_info p {
  font-size: 1.2rem;
  margin: 10px 0;
  color: #2a0808;
}

/* Responsive */
@media (max-width: 600px) {
  header {
    flex-direction: column;
    align-items: flex-start;
  }

  header form {
    margin-top: 10px;
  }

  .main_info {
    margin: 120px 20px 0;
  }
}
</style>

<?php 

include 'connection.php';
  
if(isset($_POST['add_to_cart']) && isset($_SESSION['user'])) {
    $car_id = $_POST['car_id'];
    $user_id = $_SESSION['user'];
    $price = $_POST['price'];
    
    
    $check = "SELECT * FROM cart WHERE car_id = $car_id AND user_id = $user_id";// Check if item exists in cart
    $result = $connect->query($check);
    
    if($result->num_rows > 0) {
       
        $update = "UPDATE cart SET quantity = quantity + 1 WHERE car_id = $car_id AND user_id = $user_id"; // Update quantity
        $connect->query($update);
    } else {
       
        $insert = "INSERT INTO cart (car_id, user_id, price) VALUES ($car_id, $user_id, $price)"; // Add new item
        $connect->query($insert);
    }
    
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/models.css">

</head>
<body>
    <header>
        <div class="container1"> 
            <div class="logo">
               <a href="HOME.php"> <img src="../img/image.png" alt="BMW LOGO" width="65px" height="50px" id="logo"></a>
               <h1>
               <a href="HOME.php">BMW</a>
               </h1>
            </div>
            
         <nav>
           <ul>  
              <li>
                 <a href="HOME.php">HOME</a>
              </li>
              <li>
                 <a href="ElectricFuture.php" >ELECTRIC FUTURE</a>
              </li>
              <li>
                 <a href="models.php" class="active">MODELS</a>
              </li>
           </ul>
         </nav>
  
          <div class="extra-nav">
              <a href="FAQ.php">FAQ</a>
   <a href="cart.php"><i class="fa-solid fa-cart-shopping"> </i> </a>







              
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


    </header>


    <section class="main">
      <div class="MD">
          <h2>FIND YOUR BMW</h2>
          <img src="../img/NEW MODELS.jpg" alt="BMW Model">
      </div>
  </section>





<!-- ------------------------------------------------------- -->
<div class="container">
   

<div class="ull">
 <li><a href="#i">i</a></li>
 <li><a href="#X">X</a></li>
 <li><a href="#M">M</a></li>
 <li><a href="#z">z</a></li>

</div>
</div>


    <?php
    

    $carTypes = ['i', 'X', 'M', 'Z'];
    
    foreach ($carTypes as $type) {
        echo '<section>';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<h1 style="color: rgba(126, 131, 136, 0.758);" id="'.$type.'">'.$type.'</h1>';
        
        // Get cars of this type from database
        $sql = "SELECT * FROM car WHERE car_type = '$type'";
        $result = $connect->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="box col-lg-3 col-md-3">';
                echo '<div class="card">';
                echo '<h2>'.$row["car_name"].'</h2>';
                
                // Display different info based on car type
                if ($type == 'i') {
                    echo '<p>Full Electric '.$row["car_hp"].' hp | '.$row["car_acceleration"].'</p>';
                } else {
                    echo '<p>'.$row["car_fuel_type"].' '.$row["car_hp"].' hp | '.$row["car_acceleration"].'</p>';
                }
                
                echo '<img src="'.$row["car_image"].'" alt="'.$row["car_name"].'" id="zoom">';



               echo '<form method="post">';
                echo '<input type="hidden" name="car_id" value="'.$row["car_id"].'">';
                echo '<input type="hidden" name="price" value="'.$row["car_price"].'">';
                echo '<input type="hidden" name="car_name" value="'.$row["car_name"].'">';
                echo '<input type="hidden" name="car_image" value="'.$row["car_image"].'">';
                echo '<button type="submit" name="add_to_cart" class="add-to-card">';
                echo '<i class="fas fa-shopping-cart"></i> Add to Cart';
                echo '</button>';
                echo '</form>';
                
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No '.$type.' series cars available at the moment.</p>';
        }
        
        echo '</div>';
        echo '</div>';
        echo '</section>';
    }
    
    ?>

    <footer>
        <div>
            <p>© BMW EG 2025</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="js/models.js" defer></script>
</body>
</html>









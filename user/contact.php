<?php 

include 'connection.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/contact.css">
    <title>BMW</title>
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
                 <a href="ElectricFuture.php"  >ELECTRIC FUTURE</a>
              </li>
              <li>
                 <a href="models.php">MODELS</a>
              </li>
           </ul>
         </nav>
  
          <div class="extra-nav">
              <a href="FAQ.php" class="active">FAQ</a>
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


    <section class="contact-img">
          <div class="contact-text">
            <h3>Contact</h3>
            <img src="https://www.mercedes-benz.com.eg/content/egypt/en/passengercars/services/support-contact/_jcr_content/root/responsivegrid/simple_stage.component.damq3.3403854301379.jpeg/Stage_picture_ContactUs.jpeg"alt=""  width="100%" height="70%"  id="blur">
          </div>
   </section>
   <br>
   <br>
   <section class="help">
      <h2>Help & Contact</h2>
   </section>
<section>
   <div class="cards">
      <div class="card">
         <div class="card-inner">
            <div class="card-front">
             <p>Would you rather write?</p>
             <img src="../img/email.jpg"  alt="">
          </div>
            <div class="card-back">
              <p> Here's our email: <a href="https://www.bmw-me.com/en/more-bmw/customer-support.html">customercare.me@bmw.com</a></p>
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-inner">
              <div class="card-front">
               <p>Questions, Suggestions or Requests</p>
               <img src="../img/1124994.jpg" alt="" >
            </div>
              <div class="card-back">Call us on: 19269 </div>
          </div>
      </div>
      <div class="card">
          <div class="card-inner">
              <div class="card-front">
                <p>Breakdown & Damage Assistance</p>
                <img src="../img/damage.jpg" alt="">
               </div>
              <div class="card-back">Call us on: 19269  </div>
          </div>
      </div>
  </div>
</section>


      <footer>
         <div>
            <p>©2025 BMW . All Rights Reserved.</p>
         </div>
      </footer>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
   </body>
   </html>
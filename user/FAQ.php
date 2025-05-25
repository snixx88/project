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
        <link rel="stylesheet" href="css/FAQ.css">

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





    <section class="main">
      <div class="FAQ">
         <p>
            Frequently Asked Questions
         </p>
         <img src="../img/faq.jpg" alt="" id="background_img">

      </div>
       
   </section>
    


   


  
  <section>
<div class="FAQ-topic">
    Frequently Asked Questions

</div>



      <section class="faq">
          <h3>What does BMW stand for?</h3>
          <p>BMW stands for Bayerische Motoren Werke, which translates to Bavarian Motor Works in English.</p>
      </section>

      <section class="faq">
          <h3>Where are BMW cars manufactured?</h3>
          <p>BMW vehicles are manufactured in multiple locations worldwide, including Germany, the USA, China, and South Africa.</p>
      </section>

      <section class="faq">
          <h3>What is BMW's warranty policy?</h3>
          <p>BMW offers a 4-year/50,000-mile New Vehicle Limited Warranty, including roadside assistance. Coverage may vary by region.</p>
      </section>

      <section class="faq">
          <h3>Does BMW offer electric vehicles?</h3>
          <p>Yes, BMW offers a range of electric and hybrid vehicles, including the BMW i series and plug-in hybrid models.</p>
      </section>

      <section class="faq">
        <h3> How does the screen mirroring work ?</h3>
        <p>It is worth mentioning that, it doesn't work while the vehicle is moving and it works with android phones only.</p>
    </section>

    <section class="faq">
        <h3> How sustainable is the production of high-voltage batteries for BMW electric vehicles?</h3>
        <p> BMW uses very advanced sustainable production processes to produce such high-voltage batteries.</p>
    </section>
    

    </section>
    <section class="contact">
        <div>
        <h2>For More Further Questions</h2>
        <button onclick="contact()">  Contact Us </button>
    </div> 
    </section>
     <br>
     <br>
     <br>

     <footer>
        <div>
           <p>©2025 BMW . All Rights Reserved.</p>
        </div>
     </footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
     <script src="js/faq.js"></script>
</body>
</html>








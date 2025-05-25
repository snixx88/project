<?php 

include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW</title>
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/ElectricFuture.css">
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
                 <a href="ElectricFuture.php" class="active" >ELECTRIC FUTURE</a>
              </li>
              <li>
                 <a href="models.php">MODELS</a>
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
   
      <div class="EF">
         <h2>Electric Future</h2>
         <img src="https://www.bmw-egypt.com/content/dam/bmw/marketEG/bmw-eg_com/fascination-bmw/electromobility2020-new/ix-StagePresentation_mobile.jpg/jcr:content/renditions/cq5dam.resized.img.485.low.time1697542337571.jpg"  alt="">
   
       </div>
   </section>
    
    

   <section class="Paragragh">
     <p>The engine of the future will be powered by electricity. And the future starts here and now. We invite you to take a glimpse at the innovations that will define our mobility. In doing so, we span the spectrum from today’s technologies to hydrogen and upcoming technologies. This electric future offers tremendous opportunities for a greener and more sustainable society.</p>
     <p id="date">20 December 2024</p>
   </section>

   <br>
   <br>

<section class="videos">
   <div class="video large">
     <video src="https://www.bmw.com/video/is/content/BMW/bmwcom/bmw_com/category/Automotive%20Life/ehack/eh-01-stage-hd2.mp4"  autoplay loop muted  ></video>
   </div>
   <div class="video">
     <video src="https://www.bmw.com/video/is/content/BMW/bmwcom/bmw_com/category/Design/i4-designelemente/i4de-01-stage-hd3.mp4" autoplay loop muted ></video>
   </div>
   <div class="video">
      <video src="https://www.bmw.com/video/is/content/BMW/bmwcom/bmw_com/category/sustainability/norway/i4n-01-stage-hd.mp4" autoplay loop muted ></video> 
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
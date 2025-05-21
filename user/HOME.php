
<?php 
include 'connection.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>BMW</title>
</head>
<body>
    
    <header >
    
      <div class="container" >
            
          <div class="logo">
              <a href="HOME.php"> <img src="img\image.png" alt="BMW LOGO" width="65px" height="50px"></a>
              <h1>
                <a href="HOME.php">BMW</a>
              </h1>
          </div>

          <input type="checkbox" id="check">
          <label for="check" class="menu">
            <i class="fa-solid fa-bars" id="menu-icon" ></i>
            <i class="fa-solid fa-xmark" id="close-icon"></i>
          </label>
        

        <nav>
                <ul>  
                  <li>
                     <a href="HOME.php" class="active">HOME</a>
                  </li>
                  <li>
                     <a href="ElectricFuture.php" >ELECTRIC FUTURE</a>
                  </li>
                  <li>
                     <a href="models.php">MODELS</a>
                  </li>
                </ul>
         </nav>
    
              <div class="extra-nav">
                <a href="FAQ.php">FAQ</a>
                <a href="contact.php"><button>Contact <i class="fa-solid fa-arrow-right"></i> </button></a>
                <a href="cart.php" id="cart-icon"><i class="fa-solid fa-cart-shopping"> </i> </a>

              </div>
           
          </div>

          <section class="main">
            
            <div class="slider">
                <img src="https://www.bmw.com/content/dam/bmw/marketBMWCOM/bmw_com/categories/automotive-life/bmwapp-wallpaper/bawp-79-media-hd.jpg.asset.1733225871134.jpg" alt="bmwcar" class="slide active">
                <img src="https://www.bmw.com/content/dam/bmw/marketBMWCOM/bmw_com/categories/automotive-life/bmwapp-wallpaper/bawp-67-media-hd.jpg.asset.1725271969177.jpg" alt="bmwcar2" class="slide">
                
                <img src="https://www.bmw.com/content/dam/bmw/marketBMWCOM/bmw_com/categories/automotive-life/bmwapp-wallpaper/bawp-41-media-hd.jpg.asset.1709892024506.jpg"alt="bmwcar3" class="slide" id="car3">
            
            </div>
            <button class="arrow prev" onclick="prevSlide()">&#10094;</button>
            <button class="arrow next" onclick="nextSlide()">&#10095;</button>
        
         </section>
        
        </header>

        <br>
        <br>
        
        <section class="section2">
          <div  class="M4">
             <h2>BMW M4</h2>
             <p>The BMW M4 is a high-performance version of the BMW 4 Series automobile developed by BMW's motorsport division, BMW M, that has been built since 2014. As part of the renumbering that splits the coupé and convertible variants of the 3 Series into the 4 Series, the M4 replaced those variants of the BMW M3. Upgrades over the standard BMW 4 Series include an upgraded engine, suspension, exhaust system, brakes and weight reduction measures including increased use of carbon fiber, such as on the roof of the car</p>
           </div>  
           <div class="img"> 
             <img src="img\image (1).png" width="700px" height="1000px">
          </div>
         </section>
        
    <section class="digital">
      <div class="ENGINE">
        <h4 contenteditable="true"  >BMW CARS</h4>
        <h2 >DIGITAL JOURNEY</h2>
      </div> 
      <video src="https://www.bmw.com/video/is/content/BMW/bmwcom/bmw_com/category/innovation/futureoftech/fot-00-teaser-hd.mp4" autoplay loop muted></video>

        
     </section>







<footer>
<div class="FOLLOW">
   <h1>FOLLOW</h1>
   <h1 class="FOLLOWBMW"> BMW</h1>
</div>

    

<div id="icon">
   <button onclick="insta()" ><i class="fa-brands fa-instagram"></i> </button>
   <button onclick="facebook()" ><i class="fa-brands fa-facebook"></i></button>
   <button onclick="X()"        ><i class="fa-brands fa-x-twitter"></i></button>
   <button onclick="linkedin()"  ><i class="fa-brands fa-linkedin"></i></button>
    <button onclick="youtube()" ><i class="fa-brands fa-youtube" ></i></button>
    <button onclick="tiktok()" ><i class="fa-brands fa-tiktok"></i></button>

</div>
<p>©2025 BMW . All Rights Reserved.</p>

</footer>



    <script src="script.js"></script>



</body>
</html>


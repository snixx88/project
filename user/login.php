<?php 
include 'connection.php';
$alert="";
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $select="select * from user where email='$email' and password='$password'";
    $run_select=mysqli_query($connect,$select); 
    $rows=mysqli_num_rows($run_select);
      if($rows<1){
        $alert="wrong data";
    }
    else{
        $fetch=mysqli_fetch_assoc($run_select);
        $id=$fetch['user_id'];
        $_SESSION['user']=$id;
        header("location:HOME.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="login.css">
</head>
<body>
      <section class="img"> <img src="https://www.bmw.com/content/dam/bmw/marketBMWCOM/bmw_com/categories/home/BMW_OG.jpg" alt=""></section>
<div class="container-fluid"> 


    
        <form class="form" method="POST">
    <p class="title">Login</p>     
    <label>Email
        <input required="" placeholder="" type="email"  name="email" class="input">
    </label> 
        
    <label>Password
        <input required="" placeholder="" type="password" name="password" class="input">
    </label>

<div class="remember-forgot" >
 
     <div class="remember">
      
        <label>Remember Me <input class="checkbox" type="checkbox">  </label>
       
     </div>


      <div>
        <a href="#">Forgot password?</a>
       </div>


    </div>

    <button class="submit" name="submit">submit</button>
    <div class="register-link">
        <p>Don't have an account? <a href="signup.php">Register</a></p>
         <?php if($alert){ ?>
     <div class="alert alert-danger text-center w-100 m-auto">
                            <strong><?php echo $alert ?></strong><br> Please Check your Information again.
                        </div>
                        <?php } ?>
   

   
                        
</form>
</body>
    
</html>




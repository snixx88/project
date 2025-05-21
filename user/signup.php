<?php
include 'connection.php';

$alert="";
if(isset($_POST['submit'])){
    $name = $_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
$con_pass = $_POST['confirm_password'];
    $phone=$_POST['phone'];

    if($password==$con_pass){
          $select="SELECT * from user where email='$email'";
    $run_select=mysqli_query($connect,$select);
    $rows=mysqli_num_rows($run_select);
    if($rows>0){
        $alert="email is already taken";
    }else{
   $insert="INSERT INTO user values(NULL,'$name','$email','$password','$phone')";
    $run_insert=mysqli_query($connect,$insert);
    $select="SELECT * from user where email='$email'";
    $run_select=mysqli_query($connect,$select);
    $fetch=mysqli_fetch_assoc($run_select);
    $id=$fetch['user_id'];
     $_SESSION['user']=$id;
      header("location:login.php");
    }
    }
    else{
        $alert="password doesn't match";
    }
    } 

    
   





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="signup.css">
</head>
<body>

    <section class="img"> <img src="https://www.bmw.com/content/dam/bmw/marketBMWCOM/bmw_com/categories/home/BMW_OG.jpg" alt=""></section>
<div class="container-fluid"> 



<form method="post" id="signup">
<div class="col-lg-sm-xl-6">


      
         <?php if($alert){ ?>
     <div >
        <strong><?php echo $alert ?></strong><br> Please Check your Information again.
     </div>
        
            <?php } ?>

                <h1>Register</h1>

    <div class="register-link">
<label>Username
            <input required placeholder="" type="text" class="input" name="username">
        </label>
    <label>Email
        <input required placeholder="" type="email" class="input" name="email">
    </label> 

    <label>Password
        <input required placeholder="" type="password" class="input" name="password">
    </label>
    <label>Confirm password
        <input required="" placeholder="" type="password" class="input" name="confirm_password">
    </label>
      <label>Phone
        <input required="" placeholder="" type="text" class="input" name="phone">
    </label> 
<br>
 
    <button class="submit" name="submit">Submit</button>
      <div class="p-link">
    <p class="signin">Already have an account ? <a href="login.php">Login</a> </p>
    </div>
    </div>
  </div>  
  </div>

  </form>
  <div id="confirmation-message">
    <p>Your account has been created. Thank you!</p>
  </div>
 
</body>
</html> 


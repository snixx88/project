
<?php
include '../user/connection.php';

$car_type="";
$car="";
$car_name="";
$car_speed="";
$car_hp="";
$car_price="";
$car_description="";
$car_fuel_type="";
$car_acceleration="";
$car_range="";

if(isset($_POST['add_car'])){
    
    $car_type=$_POST['car_type'];
    $car=$_POST['car'];
    $car_name=$_POST['car_name'];
    $car_speed=$_POST['car_speed'];
    $car_hp=$_POST['car_hp'];
    $car_price=$_POST['car_price'];
    $car_image=$_FILES['car_image']['name'];
    $car_description=$_POST['car_description'];
    $car_fuel_type=$_POST['car_fuel_type'];
    $car_acceleration=$_POST['car_acceleration'];
    $car_range=$_POST['car_range'];


$insert = "INSERT INTO car (car_type, car, car_name, car_speed, car_hp, car_price, car_image, car_description, car_fuel_type, car_acceleration, car_range) 
VALUES ('$car_type','$car','$car_name','$car_speed','$car_hp','$car_price','$car_image','$car_description','$car_fuel_type','$car_acceleration','$car_range')";
$run_insert=mysqli_query($connect,$insert);
move_uploaded_file($_FILES['car_image']['tmp_name'],"../images/".$car_image);  
}


if(isset($_GET['Edit'])){
    $id=$_GET['Edit'];
    $select="SELECT * FROM `car` WHERE `car_id`=$id";
    $run_select=mysqli_query($connect,$select);
    $array=mysqli_fetch_assoc($run_select);
    $car_type=$array['car_type'];
    $car=$array['car'];
    $car_name=$array['car_name'];
    $car_speed=$array['car_speed'];
    $car_hp=$array['car_hp'];
    $car_price=$array['car_price'];
    $car_image=$array['car_image'];
    $car_description=$array['car_description'];
    $car_fuel_type=$array['car_fuel_type'];
    $car_acceleration=$array['car_acceleration'];
    $car_range=$array['car_range'];
}

if(isset($_POST['update'])){
    $id = $_POST['car_id'];
    $type=$_POST['car_type'];
    $car=$_POST['car'];
    $name=$_POST['car_name'];
    $speed=$_POST['car_speed'];
    $hp=$_POST['car_hp'];
    $price=$_POST['car_price'];
    $image=$_FILES['car_image']['name'];
    $description=$_POST['car_description'];
    $fuel_type=$_POST['car_fuel_type'];
    $acceleration=$_POST['car_acceleration'];
    $range=$_POST['car_range'];

    if(empty($image)){

$update="UPDATE `car` SET `car_type`='$type',`car`='$car',`car_name`='$name',`car_speed`=$speed,`car_hp`=$hp,`car_price`=$price,
`car_description`='$description',`car_fuel_type`='$fuel_type',`car_acceleration`='$car_acceleration',`car_range`=$range WHERE `car_id`=$id ";
$run_update=mysqli_query($connect,$update);

header("location:localhost/project/admin/viewcar.php");

    }

else{

$update="UPDATE `car` SET `car_type`='$type',`car`='$car',`car_name`='$name',`car_speed`=$speed,`car_hp`=$hp,`car_price`='$price',`car_image`='$image',
`car_description`='$description',`car_fuel_type`='$fuel_type',`car_acceleration`='$car_acceleration',`car_range`='$range' WHERE `car_id`='$id' ";
$run_update=mysqli_query($connect,$update);

move_uploaded_file($_FILES['car_image']['tmp_name'],"../images/".$car_image); 

header("location:../admin/viewcar.php");

}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Add Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            direction: ltr;
            padding: 20px;
        }
        .admin-panel {
            background-color: #fff;
            max-width: 700px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .admin-panel h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
        .submit-btn {
            display: block;
            width: 100%;
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="admin-panel">
    <h2>Add New Car</h2>
    <form action="add_product.php" method="post" enctype="multipart/form-data">
        
    <?php if(isset($_GET['Edit'])): ?>
    <input type="hidden" name="car_id" value="<?php echo $_GET['Edit']; ?>">
    <?php endif; ?>


        <div class="form-group">
            <label for="car_type">Car Type</label>
            <input value="<?php echo $car_type;?>" type="text" id="car_type" name="car_type" required>
        </div>

        <div class="form-group">
            <label for="car">Car</label>
            <input value="<?php echo $car;?>"  type="text" id="car" name="car" required>
        </div>

        <div class="form-group">
            <label for="car_name">Car Name</label>
            <input value="<?php echo $car_name;?>"  type="text" id="car_name" name="car_name" required>
        </div>

        <div class="form-group">
            <label for="car_speed">Top Speed (km/h)</label>
            <input value="<?php echo $car_speed;?>"  type="number" id="car_speed" name="car_speed" required>
        </div>

        <div class="form-group">
            <label for="car_hp">Horsepower (HP)</label>
            <input value="<?php echo $car_hp;?>"  type="number" id="car_hp" name="car_hp" required>
        </div>

        <div class="form-group">
            <label for="car_price">Price (USD)</label>
            <input value="<?php echo $car_price;?>"  type="number" id="car_price" name="car_price" required>
        </div>

        <div class="form-group">
            <label for="car_image">Car Image</label>
            <input type="file" id="car_image" name="car_image" accept="image/*">
        </div>

        <div class="form-group">
            <label for="car_description">Car Description</label>
            <textarea value="<?php echo $car_description;?>"  id="car_description" name="car_description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="car_fuel_type">Fuel Type</label>
            <input value="<?php echo $car_fuel_type;?>"  type="text" id="car_fuel_type" name="car_fuel_type" required>
        </div>

        <div class="form-group">
            <label for="car_acceleration">Acceleration (0-100 km/h)</label>
            <input value="<?php echo $car_acceleration;?>"  type="text" id="car_acceleration" name="car_acceleration" required>
        </div>

        <div class="form-group">
            <label for="car_range">Range (km)</label>
            <input value="<?php echo $car_range;?>"  type="number" id="car_range" name="car_range" required>
        </div>

        <button type="submit" class="submit-btn" name="add_car">add_car</button>
        <button type="submit" class="submit-btn" name="update">update</button>
    </form>
</div>

</body>
</html>

























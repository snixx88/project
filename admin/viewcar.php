<?php
include '../user/connection.php';

$select="SELECT * FROM `car` ";
$run_select=mysqli_query($connect,$select);


if(isset($_GET['delete'])){
$id=$_GET['delete'];

$delete="DELETE FROM `car` WHERE `car_id`= $id ";
$run_delete = mysqli_query($connect,$delete);
header("location:localhost/project/admin/viewcar.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Cars</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 30px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        img {
            width: 100px;
            height: auto;
            border-radius: 6px;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-update {
            background-color: #28a745;
        }
    </style>
</head>
<body>

    <h1>Cars</h1>

    <table>
        <tr>
            <th>Car ID</th>
            <th>Car Name</th>
            <th>Car Image</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>

<?php foreach($run_select as $value){ ?>



        <tr>
            <td><?php echo $value['car_id']; ?></td>
            <td><?php echo $value['car_name']; ?></td>
            <td><img style="width:40px;height:40px;" src=" <?php echo"../images/". $value['car_image']; ?>" alt="pic"></td>
            <td><a href="../admin/viewcar.php?delete=<?php echo $value['car_id']; ?>">delete</a></td>
            <td><a href="../admin/add_product.php?Edit=<?php echo $value['car_id']; ?>">Edit</a></td>
        </tr>

    <?php   } ?>    
    </table>

</body>
</html>
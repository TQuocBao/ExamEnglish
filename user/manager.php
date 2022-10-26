
<?php session_start(); ?>
<?php include '../inc/header.php' ?>
<?php include '../inc/navbar1.php'?>
<?php 
    if(isset($_SESSION['users'])){
            $user = $_SESSION['users'];
        }
        else
            header('location:index.php');
 ?>
 <?php
    require '../database/database.class.php';

    $config = [
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'nameDB' => 'tienganh'
    ];
    $data = new database($config);
?>
<?php 
    $result =$data->ManipulationDB("select * from nguoidung where email ='".$user."'");
    $rows = mysqli_fetch_array($result);

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
	.adminpanel{
        text-align: center;
		color:#897073;
		margin:30px auto 0;
		padding:50px;
		border:2px solid #ddd;
		font-family: "Times New Roman", Georgia, Serif;
		font-size: 20px;
		}
</style>
</head>

<body>
    <div class="main">
        <div class="adminpanel">
            <h2>Hello <?php echo $rows['fullname']; ?></h2>
            
        </div>
    </div>

</body>

</html>
<?php include '../inc/footer.php' ?>
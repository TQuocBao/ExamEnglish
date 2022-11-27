<?php include '../inc/navbar.php'?>
<?php session_start(); ?>

<?php 
    if(isset($_SESSION['admin'])){
        $mail_admin = $_SESSION['admin'];
    }
    else
            header('location:../admin');
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
    $result =$data->ManipulationDB("select fullname_admin from admin where email_admin ='".$mail_admin."'");
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
            <h2>Hello Admin<?php echo @$rows['fullname_admin']; ?></h2>                    
        </div>
    </div>

</body>

</html>
<?php include '../inc/footer.php' ?>
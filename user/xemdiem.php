

<?php session_start(); ?>
<?php include '../inc/header.php' ?>
<?php include '../inc/navbar1.php'?>
<?php 
    if(isset($_SESSION['users'])){
            $noidung = $_SESSION['users'];
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


<?php include '../inc/footer.php' ?>

<?php require '../inc/navbar.php'?>
<?php session_start(); ?>
<?php 
	if(isset($_SESSION['admin'])){
            $admin = $_SESSION['admin'];
        }
        else
            header('location:../admin');
 ?>
<form method="post" action="">
	<?php
require '../database/database.class.php';
$config = [
	'host' => 'localhost',
	'user' => 'root',
	'pass' => '',
	'nameDB' => 'tienganh'
];
$data = new database($config);
if (isset($_GET['dethi'])) {
	$made = $_GET['dethi'];
} else
	$made = 0;

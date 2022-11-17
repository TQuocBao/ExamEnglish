<?php session_start(); ?>
<?php 
	if(isset($_SESSION['users'])){
            $user = $_SESSION['users'];
        }
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
 		if(isset($_GET['dethi'])){
 			$made = $_GET['dethi'];
 		}
 		else
 			$made = 0;

 		if(isset($_GET['socau'])){
 			$socau = $_GET['socau'];
 		}
 		else

 			$socau = 0;
 		if(isset($_GET['ketqua'])){
 			$ketqua = $_GET['ketqua'];
 		}
 		else
 			$ketqua = 0;
  ?>
 <?php 
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$time_now=getdate();
		$time=$time_now['hours'].':'.$time_now['minutes'].':'.$time_now['seconds'].'';
		$day=$time_now['mday'].'.'.$time_now['mon'].'.'.$time_now['year'];
?>
<?php session_start(); ?>
<?php date_default_timezone_set('Asia/Ho_Chi_Minh');
	$_SESSION['thoigianbatdau'] = time();
?>
<?php 
	if(isset($_SESSION['users'])){
            $user = $_SESSION['users'];
        }
        else
            header('location:index.php');
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
	?>
	// Lấy mã đề từ showde //
	<?php 
		$_SESSION['dethi'] = $made;
	 ?>
	 <?php 
	 	$get_thoigian = "select thoigianlam from dethi where made ='".$made."'";
	 	$result_thoigian=$data->ManipulationDB($get_thoigian);
	 	if($rows_thoigian = mysqli_fetch_array($result_thoigian)){
	 		$thoigianlam = $rows_thoigian['thoigianlam'];
	 	}
	 	$_SESSION['thoigianlam'] = $thoigianlam;
	 	
	  ?>
	  <?php 
	  		$nguoidung = "select * from nguoidung where email='".$user."'";
	  		$rows_nguoidung = mysqli_fetch_array($data->ManipulationDB($nguoidung));
	  		if($rows_nguoidung['ran'] == 0){
				// Lấy mã rand ngẫu nhiên 
	  			$Rand = rand(1,20);
	  			$update_rand = "update nguoidung set ran='".$Rand."' where email='".$user."'";
				$re_rand = $data->ManipulationDB($update_rand);
	  		}
	  		else
	  			$Rand = $rows_nguoidung['ran'];
	   ?>
	<?php
		header('location:BaiLam.php?dethi='.$made .'&STT=1&Rand='.$Rand.'');
	?>
</form>
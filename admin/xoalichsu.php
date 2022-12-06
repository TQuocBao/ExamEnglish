
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
 		if(isset($_GET['email'])){
 			$email = $_GET['email'];
 		}
 		else
 			$email = 0;
  ?>
 <?php 
 	$result = $data->ManipulationDB("delete from lichsu where email='".$email."'");
 	header('location:chitietUser.php?email='.$email.'');
  ?>
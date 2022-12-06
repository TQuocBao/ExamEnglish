<form action="" method="post">
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
			$made =0;
		
		if(isset($_GET['ma'])){
			$macauhoi = $_GET['ma'];
		}
		else
			$macauhoi =0;

 ?>
 <?php 
 		$delete_dapan = "delete from dapan where macauhoi ='".$macauhoi."'";
 		$delete_dapanchon = "delete from dapanchon where macauhoi ='".$macauhoi."'";
 		$delete_cauhoi = "delete from cauhoi where macauhoi='".$macauhoi."'";
 		$r_dapan = $data->ManipulationDB($delete_dapan);
 		$r_dapanchon = $data->ManipulationDB($delete_dapanchon);
 		$r_cauhoi = $data->ManipulationDB($delete_cauhoi);
 		header('location:chitietquiz.php?dethi='. $made .'');
  ?>
</form>
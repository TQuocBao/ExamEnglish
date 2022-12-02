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
<?php 
	$cauhoi = "select * from cauhoi where made ='".$made."'";
	$re_cauhoi = $data->ManipulationDB($cauhoi);

	while($rows_cauhoi = mysqli_fetch_array($re_cauhoi)){
		$macauhoi = $rows_cauhoi['macauhoi'];
		$dapan = "delete from dapan where macauhoi='".$macauhoi."'";
		$re_dapan = $data->ManipulationDB($dapan);

		$dapanchon = "delete from dapanchon where macauhoi='".$macauhoi."'";
		$re_dapanchon = $data->ManipulationDB($dapanchon);
	}
	$delete_cauhoi = "delete from cauhoi where made='".$made."'";
	$r_detelecauhoi = $data->ManipulationDB($delete_cauhoi);

	$delete_lichsu = "delete from lichsu where made='".$made."'";
	$re_lichsu = $data->ManipulationDB($delete_lichsu);

	$delete_dethi = "delete from dethi where made='".$made."'";
	$re_deletedethi = $data->ManipulationDB($delete_dethi);
	
	header('location:quesadd.php');
 ?>

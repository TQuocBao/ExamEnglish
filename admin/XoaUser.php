<?php
	require '../database/database.class.php';
	$config = [
		'host' => 'localhost',
		'user' => 'root',
		'pass' => '',
		'nameDB' => 'tienganh'
	];
		$data = new database($config);
		if (isset($_GET['email'])) {
			$email = $_GET['email'];
		} else
			$email=0;

			$result_delete_History = $data->ManipulationDB("delete from lichsu where email ='".$email."'");
			$result_deleteUser = $data->ManipulationDB("delete from nguoidung where email ='".$email."'");
			header('location:users.php');
?>
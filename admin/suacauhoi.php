<?php require '../inc/navbar.php' ?>
 <?php session_start(); ?>
<?php 
    if(isset($_SESSION['admin'])){
            $admin = $_SESSION['admin'];
        }
        else
            header('location:../admin');
 ?>
<style>
	form{
		margin: auto;
		width: 50%;
		padding: 10px;
		border: 1px solid #ccc;
	}
</style>
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
if (isset($_GET['dethi'])) {
	$made = $_GET['dethi'];
} else
	$made = 0;

if (isset($_GET['ma'])) {
	$macauhoi = $_GET['ma'];
} else
	$macauhoi = 0;

if (isset($_GET['STT'])) {
	$STT = $_GET['STT'];
} else
	$STT = 0;
?>
<?php
$show_question = "select* from cauhoi where made ='" . $made . "' and macauhoi='" . $macauhoi . "'";
$result_question = $data->ManipulationDB($show_question);
$rows = mysqli_fetch_array($result_question);
$noidungcauhoi = $rows['noidung'];
$dad = $rows['dad'];
?>
<form method="post" action="">
	<label>Câu <?php echo $STT; ?></label>
	<input style="width: 500px;" type="text" name="noidungcau" value="<?php echo $noidungcauhoi ?>"><br>
	<?php
	$show_dapan = "select * from dapan where macauhoi='" . $macauhoi . "'";
	$result_dapan = $data->ManipulationDB($show_dapan);
	?>
	<?php while ($rows_dapan = mysqli_fetch_array($result_dapan)) { ?>
		<?php
		$thutu = $rows_dapan['thutu'];
		$noidungda = $rows_dapan['noidungda'];
		?>
		<label><input class="with-gap" type="radio" name="c_<?php echo $macauhoi; ?>" value="<?php echo $thutu; ?>" <?php if ($dad == $thutu) { ?> checked="checked" <?php } ?>>
		<span><input style="width: 300px;" type="text" name="<?php echo $thutu; ?>" value="<?php echo $noidungda; ?>"></span></label><br>
	<?php } ?>
	<br>
	<input type="submit" name="sua" value="Cập nhật">
	<input type="submit" name="back" value="Quay lại">
	
</form>
	 <?php
if (isset($_POST['sua'])) {
	if (empty($_POST['A']) || empty($_POST['B']) || empty($_POST['C']) || empty($_POST['D']) || empty($_POST['noidungcau']) || empty($_POST['c_' . $macauhoi . ''])){
		echo ' <center><p style="color: red;">Bạn đang để trống thông tin!</p></center>';
	}

	else {

		
		$noidungCH = $_POST['noidungcau'];
		$noidungA = $_POST['A'];
		$noidungB = $_POST['B'];
		$noidungC = $_POST['C'];
		$noidungD = $_POST['D'];
		$dapan_right =  $_POST['c_' . $macauhoi . ''];
		$A = 'A';
		$B = 'B';
		$C = 'C';
		$D = 'D';

		$update_noidungCH = "update cauhoi set noidung ='" . $noidungCH . "', dad ='" . $dapan_right . "' where macauhoi ='" . $macauhoi . "'";
		$upnoidungA = "update dapan set noidungda ='" . $noidungA . "' where thutu ='" . $A . "' and macauhoi='" . $macauhoi . "'";
		$upnoidungB = "update dapan set noidungda ='" . $noidungB . "' where thutu ='" . $B . "' and macauhoi='" . $macauhoi . "'";
		$upnoidungC = "update dapan set noidungda ='" . $noidungC . "' where thutu ='" . $C . "' and macauhoi='" . $macauhoi . "'";
		$upnoidungD = "update dapan set noidungda ='" . $noidungD . "' where thutu ='" . $D . "' and macauhoi='" . $macauhoi . "'";

		$r1 = $data->ManipulationDB($update_noidungCH);
		$rA = $data->ManipulationDB($upnoidungA);
		$rB = $data->ManipulationDB($upnoidungB);
		$rC = $data->ManipulationDB($upnoidungC);
		$rD = $data->ManipulationDB($upnoidungD);
		
		header('location:suacauhoi.php?dethi=' . $made . '&ma=' . $macauhoi . '&STT='.$STT.'');
	}
}
?>
	<?php 
		if(isset($_POST['back'])){
			header('location:chitietquiz.php?dethi='.$made.'');
		}

	 ?>
<?php require '../inc/footer.php' ?>
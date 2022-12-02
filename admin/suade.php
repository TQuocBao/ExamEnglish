
<?php require '../inc/navbar.php' ?>
 <?php session_start(); ?>
<?php 
    if(isset($_SESSION['admin'])){
            $admin = $_SESSION['admin'];
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
	if (isset($_GET['dethi'])) {
		$made = $_GET['dethi'];
	} else
		$made = 0;
?>
<?php 
	$show_de = "select * from dethi where made ='".$made."'";
	$result = $data->ManipulationDB($show_de);
	while($rows = mysqli_fetch_array($result)){
		$mota = $rows['mota'];
		$thoigianlam = $rows['thoigianlam'];
	}
 ?>
<form action="" method="post">
	<center>
	<label>Mã đề <?php echo $made; ?></label><br>
	<label>Mô tả<input type="text" name="mota" value="<?php echo $mota; ?> "></label><br>
	<label>Thời gian làm<input type="text" name="thoigianlam" value=" <?php echo $thoigianlam ?> "></label><br>
	</center>
	<center><input type="submit" name="sua" value="Cập nhật"></center>
</form>
	<?php 
		if(isset($_POST['sua'])){
			if(empty($_POST['mota']) || empty($_POST['thoigianlam'])){
				echo ' <center><p style="color: red;">Xin hãy nhập đầy đủ!</p></center>';
			}
			else{
					$mota =$_POST['mota'];
					$thoigianlam =trim($_POST['thoigianlam']);
					if(is_numeric($thoigianlam)){
						$update = "update dethi set mota='".$mota."',thoigianlam='".$thoigianlam."' where made ='".$made."'";
						$result = $data->ManipulationDB($update);
						header('location:quesadd.php');
					}
					else
						echo ' <center><p style="color: red;">Định dạng thời gian không hợp lệ!</p></center>';
				}
			
		}
	 ?>
<?php require '../inc/footer.php' ?>
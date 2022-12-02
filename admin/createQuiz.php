<?php include '../inc/header.php'?>
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
	 ?>
<label>Mã đề   <input type="text" name="made"></label><br>
<label>Mô tả  <input type="text" name="mota"></label><br>
<label>Thời gian làm bài<input type="text" name="thoigian"></label><br>
<center><input type="submit" name="taode" value="Xác nhận tạo đề"></center>
		<?php 
			if(isset($_REQUEST['taode'])){ ?>
				<?php if(empty($_POST['made']) || empty($_POST['mota']) || empty($_POST['thoigian'])){ ?>
					<center><p style="color:red;"><?php echo'Bạn chưa nhập thông tin đầy đủ !';  ?></p></center>
				<?php } else{ ?> 
					<?php 
						$made =$_POST['made'];
						$mota =$_POST['mota'];
						$thoigian =trim($_POST['thoigian']);
					 ?>
					 <?php $check = $data->check("select * from dethi where made = '".$made."'") ?>
					 <?php if($check == false){ ?>
					 	<center><p style="color: red;">Mã đề này đã tồn tại xin chọn lại mã khác!</p></center>
					 <?php } else{ ?>
					<?php 
						if(is_numeric($thoigian)){
							$insert = "insert into dethi values('".$made."','".$mota."','".$thoigian."')";
							$ressult = $data->ManipulationDB($insert);
							header('location:quesadd.php');
						}
						else{
							echo ' <center><p style="color: red;">Định dạng thời gian không hợp lệ!</p></center>';
						}
					 ?>
					<?php } ?>
				<?php } ?>
			<?php } ?>

</form>
<?php include '../inc/footer.php'?>

<?php require '../inc/navbar.php'?>
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
		} 
		else
		  $made = 0;
  ?>
<form method="post" action="">
	<center>
<div>
	<label>Nội dung<input type="text" name="noidung"></label>
</div>
<div>
	<label>A<input type="radio" name="chon" value="A" checked="checked"><span><input type="text" name="noidungA"></span></label>
	<label>B<input type="radio" name="chon" value="B"><span><input type="text" name="noidungB"></span></label>
</div>
<div>
	<label>C<input type="radio" name="chon" value="C"><span><input type="text" name="noidungC"></span></label>
	<label>D<input type="radio" name="chon" value="D"><span><input type="text" name="noidungD"></span></label>
</div>
</center><br>
<div>
<center><input type="submit" name="taocauhoi" value="Xác nhận"></center>
</div>


		<?php if(isset($_POST['taocauhoi'])){ ?>
				<?php if(empty($_POST['noidung']) || empty($_POST['noidungA']) || empty($_POST['noidungB']) || empty($_POST['noidungC']) || empty($_POST['noidungD']))  { ?>
					<center><p style="color:red;"><?php echo'Bạn chưa nhập thông tin đầy đủ !';  ?></p></center>
				<?php } else{ ?> 

					<?php 
						$noidung =$_POST['noidung'];
						$dad = '';

						$noidungA = $_POST['noidungA'];
						$noidungB = $_POST['noidungB'];
						$noidungC = $_POST['noidungC'];
						$noidungD = $_POST	['noidungD'];

						$dA ='A';
						$dB='B';
						$dC ='C';
						$dD = 'D';
					 ?>
					
					<?php 
						$insert_cauhoi = "insert into cauhoi(noidung,dad,made) values('".$noidung."','".$dad."','".$made."')";
						$result_cauhoi = $data->ManipulationDB($insert_cauhoi);

						$get_macauhoi = "select * from cauhoi where made='".$made."'";
						$result_macuoi = $data->ManipulationDB($get_macauhoi);
						while($rows_macuoi = mysqli_fetch_array($result_macuoi)){
							$macuoi = $rows_macuoi['macauhoi'];
						}
						$temp = $macuoi;

						$insert_cautraloiA = "insert into dapan values('".$dA."','".$noidungA."','".$temp."')";
						$insert_cautraloiB = "insert into dapan values('".$dB."','".$noidungB."','".$temp."')";
						$insert_cautraloiC = "insert into dapan values('".$dC."','".$noidungC."','".$temp."')";
						$insert_cautraloiD = "insert into dapan values('".$dD."','".$noidungD."','".$temp."')";

						$rA = $data->ManipulationDB($insert_cautraloiA);
						$rB = $data->ManipulationDB($insert_cautraloiB);
						$rC = $data->ManipulationDB($insert_cautraloiC);
						$rD = $data->ManipulationDB($insert_cautraloiD);

						if(isset($_POST['chon'])){
							$right_A = "update cauhoi set dad='".$_POST['chon']."' where macauhoi='".$temp."'";
							$complete_A = $data->ManipulationDB($right_A);
						}
						
						header('location:chitietquiz.php?dethi='.$made.'');

					 ?>
					 
				<?php } ?>
			<?php } ?>

</form>
<?php include '../inc/footer.php' ?>

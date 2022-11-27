<?php require '../inc/navbar.php'?>
<?php session_start(); ?>
<?php 
	if(isset($_SESSION['admin'])){
            $admin = $_SESSION['admin'];
        }
        else
            header('location:../admin');
 ?>
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
			if (isset($_GET['email'])) {
				$email = $_GET['email'];
			} else
				$email=0;

			$show_all = $data->ManipulationDB("select * from lichsu where email = '".$email."'");
			$dem = mysqli_num_rows($show_all);
			$show_ten = $data->ManipulationDB("select fullname from nguoidung where email ='".$email."'");
			$rows_tenUser = mysqli_fetch_array($show_ten);
			$fullname = $rows_tenUser['fullname'];
	?>
	<center><h4><?php echo $fullname;  ?></h4></center>
		<table border="1">
			<tr>
				<td>Tên đề</td>
				<td>Số câu đúng</td>
				<td>Kết quả</td>
				<td>Vào lúc</td>
				<td>Ngày làm đề</td>
			</tr>
			<?php while ($rows_all = mysqli_fetch_array($show_all)){?>
				<?php 
					$made = $rows_all['made'];
					$giolam = $rows_all['giohoanthanh'];
					$ngaylam = $rows_all['ngaylam'];
					$socaudung = $rows_all['socaudung'];
					$diem = $rows_all['diem'];
					$show_tende = "select mota from dethi where made='".$made."'";
					$re_tende = $data->ManipulationDB($show_tende);
					$rows_tende = mysqli_fetch_array($re_tende);
				 ?>
				 <tr>
				 	<td><?php echo @$rows_tende['mota']; ?></td>
				 	<td><?php echo $socaudung; ?></td>
				 	<td><?php echo $diem; ?></td>
				 	<td><?php echo $giolam; ?></td>
				 	<td><?php echo $ngaylam; ?></td>
				 </tr>
		<?php } ?>	
		</table>
		<center><button <?php if($dem==0){ ?> hidden="non-display"<?php }?>><a href="xoalichsu.php?email=<?php echo $email; ?>">Xóa lịch sử</a></button></center>
	</form>
<?php require '../inc/footer.php'?>

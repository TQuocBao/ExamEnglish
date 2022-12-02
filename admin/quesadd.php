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
	@$dethi = $_GET['dethi'];
	@$ma = $_GET['ma'];
	?>
	<form action="" method="post">
		<table class="striped">
			<tr class="red-text">
				<th>Mã đề</th>
				<th>Mô tả</th>
				<th>Số câu</th>
				<th>Thời gian làm</th>
				<th>Xem</th>
				<th>Delete</th>
				<th>Edit</th>
				
			</tr>
			<?php
			$show_de = "select * from dethi";
			$result_show = $data->ManipulationDB($show_de);
			?>
			<?php while ($rows_show = mysqli_fetch_array($result_show)) { ?>
				<?php
				$made = $rows_show['made'];
				$mota = $rows_show['mota'];
				
				$thoigianlam = $rows_show['thoigianlam'];
				$demcau = "select * from cauhoi where made ='".$made."'";
				$count = mysqli_num_rows($data->ManipulationDB($demcau));
				?>
				<tr>
					<td><?php echo $made ?></td>
					<td><?php echo $mota ?></td>
					<td><?php echo $count ?></td>
					<td><?php echo $thoigianlam.' phút'; ?></td>
					<td><?php echo "<a href='chitietquiz.php?dethi={$made}'>Xem chi tiết</a>"; ?></td>
					<td><?php echo "<a href='deleteDeThi.php?dethi={$made}'>Xóa đề</a>"; ?></td>
					<td><?php echo "<a href='suade.php?dethi={$made}'>Sửa đề</a>"; ?></td>
				</tr>
			<?php } ?>
			<?php
			?>
	</table>
	<center><button class="align-center"><a href="createQuiz.php"/> Tạo đề thi</button></center>
</form>
<?php require '../inc/footer.php'?>
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


<form action="" method="post">
		<table class="striped">
			<tr class="red-text">
				<th>Email</th>
				<th>Mật khẩu</th>
				<th>Họ và tên</th>
			</tr>
			<?php
				$show_user = "select * from nguoidung";
				$result_show = $data->ManipulationDB($show_user);
			?>

			<?php while ($rows_show = mysqli_fetch_array($result_show)) { ?>
				<?php
				$email = $rows_show['email'];
				$matkhau = $rows_show['matkhau'];
				$fullname = $rows_show['fullname'];
				?>
				<tr>
					<td><?php echo $email ?></td>
					<td><?php echo $matkhau ?></td>
					<td><?php echo $fullname ?></td>
					<td><?php echo "<a href='chitietUser.php?email={$email}'>Xem chi tiết</a>"; ?></td>
					<td><?php echo "<a href='XoaUser.php?email={$email}'>Xóa người dùng</a>"; ?></td>
				</tr>
			<?php } ?>
			<?php
			?>
	</table>

</form>
<?php require '../inc/footer.php'?>
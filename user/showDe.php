<?php include '../inc/header.php' ?>
<?php session_start(); ?>
<?php 
	if(isset($_SESSION['users'])){
            $user = $_SESSION['users'];
        }
        else
            header('location:index.php');
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
			<th>Mã đề</th>
			<th>Mô tả</th>
			<th>Thời gian</th>
			<th>Action</th>
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
			?>			
			<tr>
				<td><?php echo $made ?></td>
				<td><?php echo $mota ?></td>				
				<td><?php echo $thoigianlam.' Phút';?></td>
				<td><?php echo "<a href='trunggian.php?dethi={$made}'>Start</a>"; ?></td>
			</tr>
		
		<?php } ?>
	</table>
</form>
<?php include '../inc/footer.php' ?>
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
 	if(isset($_GET['Rand'])){
		$Rand = $_GET['Rand'];
	}
	else
		$Rand = 0;
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
$count = 0;
$ketqua = 0;
$tongcau =0;
$numberr=0;
if (isset($_GET['dethi'])) {
	$made = $_GET['dethi'];
} else
	$made = 0;
?>
<form method="post" action="">
	<?php
		$question = "select * from cauhoi where made='".$made."' ORDER BY RAND('".$Rand."') limit 20";
	?>
	<center>
		<h2>Bảng kết quả</h2>
	</center>
	
	<table class="striped">
		<tr>
			<th>STT</th>
			<th>Nội dung</th>
			<th>Đáp án đúng</th>
			<th>Đáp án bạn chọn</th>
		</tr>
		<?php 
			$result_table_dad = $data->ManipulationDB($question); 
			$rows_socau = mysqli_num_rows($result_table_dad);
			$diemmoicau = (float)(10/$rows_socau);
		?>
		<?php while ($table_question = mysqli_fetch_array($result_table_dad)) {?>
			<?php $tongcau++; ?>
			<?php
			$dadd = $table_question['dad'];
			$numberr++;
			$contentt = $table_question['noidung'];
			$macauhoi =$table_question['macauhoi'];
			?>
			<?php 
				$dapandung = "select noidungda from dapan  where thutu ='".$dadd."' and macauhoi = '".$macauhoi."'";
				$re_noidung = $data->ManipulationDB($dapandung);
				$rows_dung = mysqli_fetch_array($re_noidung);
				$dapandung = $rows_dung['noidungda'];
			?>
			<?php
				$dapanchon = "select * from dapanchon  where macauhoi = '".$macauhoi."' and email='".$user."'";
				$re_chon = $data->ManipulationDB($dapanchon);
				$rows_chon = mysqli_fetch_array($re_chon);
				@$dapan_chon = $rows_chon['noidungdachon'];
				@$dac = $rows_chon['thutu'];
			  ?>
					<?php if(empty($dac)){ ?>
						<tr>
							<td><?php echo "Câu ".''.$numberr;?></td>
							<td><?php echo $contentt;?></td>
							<td><?php echo $dadd.'. '.$dapandung; ?></td>
							<td><?php echo "Chưa chọn"; ?></td>
						</tr>
					<?php }else{ if($dadd == $dac){ ?>
							<?php 
								$count++;
								$ketqua = (float)$count*$diemmoicau;
							?>
						<tr class="green-text">
							<td><?php echo "Câu ".''.$numberr;?></td>
							<td><?php echo $contentt;?></td>
							<td><?php echo $dadd.'. '.$dapandung; ?></td>
							<td><?php echo $dac.'. '.$dapan_chon; ?></td>
						</tr><?php } else{ ?>
						<tr class="red-text">
							<td><?php echo "Câu ".''.$numberr;?></td>
							<td><?php echo $contentt;?></td>
							<td><?php echo $dadd.'. '.$dapandung; ?></td>
							<td><?php echo $dac.'. '.$dapan_chon; ?></td>
						</tr>
						<?php } ?>

					<?php }?>
		<?php } ?>
	</table>
	<center>
	 <h3>Số câu đúng là:<?php echo $count."/".$tongcau." câu"; ?></h3>
	 <h4>Kết quả đạt được: <?php echo $ketqua." điểm"; ?></h4>
	</center>
	<center>
		<button><a href='trunggian1.php?dethi=<?php echo $made;?>&socau=<?php echo $count;?>&ketqua=<?php echo $ketqua; ?>'>Làm lại</a></button>
		<button><a href='trunggian2.php?dethi=<?php echo $made;?>&socau=<?php echo $count;?>&ketqua=<?php echo $ketqua; ?>'>Thoát khỏi hệ thống</a></button>
		<button><a href='trunggian3.php?dethi=<?php echo $made;?>&socau=<?php echo $count;?>&ketqua=<?php echo $ketqua; ?>'>Quay lại trang chủ</a></button>
	</center>
</form>

<?php include '../inc/footer.php' ?>
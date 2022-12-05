<?php require '../inc/navbar.php'?>
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
if (isset($_GET['dethi'])) {
	$made = $_GET['dethi'];
} else
	$made = 0;
?>
<form method="post" action="">
	<?php
		$question = "select * from cauhoi where made='".$made."'";
		$numberr = 0;
	?>
	<?php 
		$result_demcau = $data->ManipulationDB($question);
		$demsocau = mysqli_num_rows($result_demcau);
	 ?>
	 <?php 
	 	$name_quiz = mysqli_fetch_array($data->ManipulationDB("select * from dethi where made='".$made."'"));
	  ?>
	  <h4 style="text-align: center;"><?php echo $name_quiz['mota']; ?></h4>
	<table border="1">
		<tr>
			<td><font size="4" style="color: #003399" style="font-weight: bold;">STT</font></td>
			<td><font size="4" style="color: #003399" style="font-weight: bold;">Nội dung</font></td>
			<td colspan="2"><font size="4" style="color: #003399" style="font-weight: bold;">Chức năng</font></td>

		</tr>
		<?php $result_table_dad = $data->ManipulationDB($question); ?>
		<?php while ($table_question = mysqli_fetch_array($result_table_dad)) {?>
			<?php
			$dadd = $table_question['dad'];
			$numberr++;
			$contentt = $table_question['noidung'];
			$macauhoi =$table_question['macauhoi'];
			?>
			<tr>
				<td><font size="3" color="#330033" ><?php echo "Câu ".''.$numberr;?></font></td>
				<td><font size="3" color="#330033" ><?php echo $contentt;?></font></td>
				<td><a href='suacauhoi.php?dethi=<?php echo $made;?>&ma=<?php echo $macauhoi;?>&STT=<?php echo $numberr;?>'>Sửa</a></td>
				<td><a href='xoacauhoi.php?dethi=<?php echo $made; ?>&ma=<?php echo $macauhoi; ?>'>Xóa</a></td>
			</tr>
		<?php } ?>
	</table>
	<center><button><a href="themcauhoi.php?dethi=<?php echo $made; ?>">Thêm câu hỏi</a></button></center>
	 <center><p style="font-weight: bold;"><?php echo $demsocau."/".$demsocau; ?></p></center>
	</form>
<?php require '../inc/footer.php'?>

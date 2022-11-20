

<?php session_start(); ?>
<?php include '../inc/header.php' ?>
<?php include '../inc/navbar1.php'?>
<?php 
    if(isset($_SESSION['users'])){
            $noidung = $_SESSION['users'];
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


<?php
	$sodong=5;
	if(isset($_GET['trang']))
	{
		$trangchon=$_GET['trang'];
		
	}
	else
	{
		$trangchon=0;
	}
	$sql=$data->ManipulationDB("select * from lichsu where email like '%$noidung%'");
	$sodongdl=mysqli_num_rows($sql);
	$sotrangdl=$sodongdl/$sodong;
	$vtbd=$trangchon*$sodong;
	$kqpt=$data->ManipulationDB("select * from lichsu where email like '%$noidung%' limit $vtbd,$sodong ");
	$stt=1;
	echo "<table align='center' border='1'>";
	echo "<tr><td><b>STT</b></td><td><b>Mã đề</b></td><td><b>Số câu đúng</b></td><td><b>Điểm</b></td><td><b>Giờ hoàn thành</b></td><td><b>Ngày làm</b></td></tr>";
	while($row=mysqli_fetch_array($kqpt))
	{
		echo "<tr><td>".$stt."</td><td>".$row['made']."</td><td>".$row['socaudung']."</td><td>".$row['diem']."</td><td>".$row['giohoanthanh']."</td><td>".$row['ngaylam']."</td></tr>";
		$stt++;
	}
	echo "</table>";
	echo "<p align='center'>";
	for($page=0; $page <= $sotrangdl ; $page++)
	{
		
			
			$trht=$page+1;
			echo "<a href='xemdiem.php?trang=$page'>Trang: $trht>></a>";
		
			
	}
	echo "</p>";


?>
<?php include '../inc/footer.php' ?>

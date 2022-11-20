<?php include '../inc/header.php' ?>
<?php session_start(); ?>
<?php 
	if(isset($_SESSION['users'])){
            $user = $_SESSION['users'];
        }
        else
            header('location:index.php');
 ?>
 <style>
	form {
		margin: auto;
		padding: 10px;
		width: 50%;
		border: 1px solid #ccc;
	}

	.btn {
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.btn input {
		padding: 7px;
		margin: 50px;
	}
</style>
<?php include'time.php';?>
<?php 
	if (isset($_GET['dethi'])) {
		$made = $_GET['dethi'];
	} else
		$made = 0;

	if(isset($_GET['start'])){
		$start = $_GET['start'];
	}
	else
		$start = 0;
	if(isset($_GET['STT'])){
		$STT = $_GET['STT'];
	}
	else
		$STT = 1;
	// Lấy mã Rand ngẫu nhiên từ trunggian.php //
	if(isset($_GET['Rand'])){
		$Rand = $_GET['Rand'];
	}
	else
		$Rand = 0;

 ?>

<?php

	if(isset($_SESSION['hetgio'])){
		$t=$_SESSION['hetgio'];
		if($t==0)
		{
			header('location:result.php?dethi=' . $made . '&Rand='.$Rand.'');
		}
	}
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

	//Hiển thị
	$temp = '';
	$nd = '';
	?>
	<?php 
		$sodong = 1;
	 ?>
	<?php
		// Trộn câu hỏi đổ ra ngẫu nhiên có mã Rand //
		$cauhoi = "select * from cauhoi where made = '". $made ."' ORDER BY RAND('".$Rand."') LIMIT {$start},{$sodong} ";
		$result_cauhoi = $data->ManipulationDB($cauhoi);
	?>

	
	<?php while ($rows_cauhoi = mysqli_fetch_array($result_cauhoi)) { ?>
		<?php
		$macauhoi = $rows_cauhoi['macauhoi'];
		$noidungcauhoi = $rows_cauhoi['noidung'];
		$dad = $rows_cauhoi['dad'];
		?>
		<h6> Câu hỏi <?php echo $STT . " "; ?>:<?php echo $noidungcauhoi; ?></h6>
		<?php
		$cautl = " select * from dapan where macauhoi = '" . $macauhoi . "'";
		$result_cautl = $data->ManipulationDB($cautl);
		?>
		<?php while ($rows_cautl = mysqli_fetch_array($result_cautl)) {  ?>
			<?php
			$noidungcautl = $rows_cautl['noidungda'];
			$thutu = $rows_cautl['thutu'];
			?>
			<?php
			$show_dachon = "select thutu from dapanchon where macauhoi='" . $macauhoi . "' and email='".$user."'";
			$r_dapanchon = $data->ManipulationDB($show_dachon);
			$rows_dachon = mysqli_fetch_array($r_dapanchon);
			@$daht = $rows_dachon['thutu'];
			?>
			<label>
				<input class="with-gap" type="radio" name="<?php echo $macauhoi ?>" value="<?php echo $thutu; ?>" <?php if ($thutu == $daht) { ?> checked="checked" <?php } ?> /><span><?php echo $thutu . ". " . $noidungcautl; ?></span><br />
			</label>
			<?php @$temp = $_POST[$macauhoi]; ?>
		<?php } ?>
	<?php } ?>

	<?php
		@$get_nd = "select noidungda from dapan where thutu ='" . $temp . "' and macauhoi='" . $macauhoi . "'";
		@$result_dac = $data->ManipulationDB($get_nd);
		$rows_dapanchon = mysqli_fetch_array($result_dac);
		@$nd = $rows_dapanchon['noidungda'];
		if (@isset($_REQUEST[$macauhoi])) {
			$format = "delete from dapanchon where macauhoi = '" . $macauhoi . "' and email ='".$user."'";
			@$result_format = $data->ManipulationDB($format);
			$update_answers = "insert into dapanchon values('" . $temp . "','" . $nd . "','" . $macauhoi . "','" . $user . "')";
			$result_update = $data->ManipulationDB($update_answers);
		}
		
	?>

	<?php
		// Show ra STT 20 câu hỏi với mã đề tương ứng //
		$show_STT = "select * from cauhoi where made ='" . $made . "' limit 20";
		$result_Show = $data->ManipulationDB($show_STT);
		$socau = mysqli_num_rows($result_Show);
	?>
	<div class="btn">
		<input type='submit' name='abcz' value='Prev' <?php if($STT==1){ ?> style="visibility:hidden" <?php } ?>>
		<span style="font-weight: bold;"><?php echo $STT . "/" .$socau. " câu";  ?></span>

		<input type='submit' name='abc' value='Next'<?php if($STT==$socau){ ?> style="visibility:hidden" <?php 	} ?> >
	</div>
	<input type='submit' name='hoanthanh' value='Nộp bài' >
</form>
	<?php
	if (isset($_REQUEST['hoanthanh'])) {
		$_SESSION['hetgio'] = 0;
		header('location:result.php?dethi=' . $made . '&Rand='.$Rand.'');
	}
	?>
	<?php
	if (!empty($_REQUEST['abc'])) {
		
			$start+=1;
			$STT+=1;
			header('location:BaiLam.php?dethi='.$made .'&start='.$start.'&STT='.$STT.'&Rand='.$Rand.'');
			if ($_GET['STT'] == $socau) {
				header('location:result.php?dethi=' . $made . '&Rand='.$Rand.'');
			}
	}
	//Chuyển đổi câu hỏi //
	if (!empty($_REQUEST['abcz'])) {
		if (isset($_GET['start']) && $_GET['start'] > 0) {
			$start-=1;
			$STT-=1;
			header('location:BaiLam.php?dethi='.$made.'&start='.$start.'&STT='.$STT.'&Rand='.$Rand.'');
		} else {
			$start = 0;
			$STT = 1;
		}
	}
	?>
<?php include '../inc/footer.php' ?>
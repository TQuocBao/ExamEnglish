<?php
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	date_default_timezone_get();
	if(isset($_SESSION['thoigianbatdau']) && isset($_SESSION['thoigianlam'])){
		$startTime = $_SESSION['thoigianbatdau'];
		$duringTime = $_SESSION['thoigianlam'];
	}
	//$duringTime = 30;
	
	$t = $startTime+$duringTime*60 - time();
	if($t>0){
	    $m=($t-$t%60)/60;
	    $s=$t%60;
	    $msg = $m ."phút" . $s. "giây";
	    echo $msg;
	}
	else{
		echo '<span style="color: red;">Hết giờ!</span>';
		$_SESSION['hetgio'] = 0;
	}

?>

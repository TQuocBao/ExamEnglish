<script src="https://code.jquery.com/jquery-latest.js"></script>
<script>
	$(document).ready(function() {
		$('#time').load('runtime.php');
	});
	var refreshId = setInterval(function() {
		$('#time').load('runtime.php');
	},1000);
	
</script>
<div align="center"> Thời gian: <span id="time"></span></div>
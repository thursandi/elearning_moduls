<?php
	$awal = date('Y-m-01 00:00:00');
	$akhir = date('Y-m-31 00:00:00');

	echo $awal." ".$akhir."<br>";
	echo date('Y-m-d',strtotime('+ 3 day'));

	echo "<br>".strtotime(date('Y-m-d H:i:s'));
?>
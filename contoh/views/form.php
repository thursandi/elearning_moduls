<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
	 <div id="main-content">
	 	<div class="row-fluid">
	 	<div class="span12">
	 	<?php
			echo form_open($this->uri->uri_string());
				
				for($i = 0; $i < 10; $i++){
					echo '<input type="text" name="nama[]"></input>';
					echo '<input type="radio" name="jurusan['.$i.']" value="1">Aya</input>';
					echo '<input type="radio" name="jurusan['.$i.']" value="2">SiJi</input>';
					echo '<input type="radio" name="jurusan['.$i.']" value="3">KK</input>';
					echo '<input type="radio" name="jurusan['.$i.']" value="4">Ena</input><br>';
				}

					echo '<input type="submit" value="ok">';
			echo form_close();
		?>
		</div>
		</div>	
	 </div>
</html>

<?php
require('functions.php');
session_start();
is_logged();



?>
<html lang="es">
	<head>
	
		<link rel="stylesheet" type="text/css" href="styles.css">
		<title>Buscar hoteles</title>
	</head>
	
	<body>
		<div class="bar-user">
		  <label>Bienvenido <?php echo  $_SESSION['username'];?></label>		  
		  <a href=logout.php><button class="button_userbar" type="button"> Cerrar Sesion</button></a>
		</div>
		
		<div class="serch-page">
			<form action="results.php" method="GET" class="form">
				<div class="div_title"> <label > Búsqueda de hoteles </label></div>
						
				<div>
					<label for="destination" class="label_textbox"> Destino </label>
					<input id="destination" name="destination" type="text"  class="text_box" required >
				</div>
				
				<div>
					<label for="checkin" class="label_textbox"> Fecha checkin </label>
					<input id="checkin" name="checkin" type="date" class="text_box" placeholder="Destino" required>
				</div>
				
				<div>
					<label for="checkout" class="label_textbox"> Fecha checkout </label>
					<input id="checkout" name="checkout" type="date" class="text_box" required>
					</div>
				
				<div>
					<label for="guests" class="label_textbox"> Cant. viajeros </label>
					<input id="guests" name="guests" type="number"  class="text_box" required min="1" >
				</div>
				<br />
				<div><button name="search" type="submit" value="BUSCAR" class="button_submit" >BUSCAR</button> </div> 
			</form> 
			
		<div>
	</body>
</html>


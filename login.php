<?php
require('functions.php');
$aerolineas=get_AirlinesDisplayName();
session_start();
if(isset($_SESSION['error'])){
        $error=$_SESSION['error'];
 }
?>

<html lang="es">
	<head>
	
		<link rel="stylesheet" type="text/css" href="styles.css">
		<title>Login</title>
	</head>
	
	<body>
		<div class="login-page">
			<form action="checklogin.php" method="post" class="form"> 
				<div><input id="username" name="username" type="text" placeholder="username" class="text_box" required></div>
				<br />
				<div><input id="password" name="password" type="password" placeholder="password" class="text_box" required></div>
				<br />
				<div>							
					<select id="airline" name="airline">
					  <?php echo $aerolineas; ?>
					</select>
				</div> 
				<br />
				<div><span>Remember me <input id="remember_me" name="remember_me" type="checkbox" checked> </span> </div>
				<br />
				<div><input name="login" type="submit" value="INGRESAR" class="button_submit" ></div> 
				
				<div style = "font-size:16px; color:#cc0000; text-align:center"><?php echo isset($error) ? $error : '' ; ?></div>
			</form> 
			
			
			
		</div>
	</body>
</html>
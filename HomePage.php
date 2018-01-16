<?php
	include 'list.php';
	$pokeList = $_SESSION['PokeList'];
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/design.css">
		<font size = 5><strong><center>Welcome to PokeBreeder</center></strong></font>
	</head>
	<body>
		<center>
		<select>
			<?php			
				$pokeList->DisplayPokeHTML();
			?>
		</select>
		
		<select>
			<?php			
				$pokeList->DisplayPokeHTML();
			?>
		</select>	
		</center>
		
		<!-- Submit button -->
		<center><Input type = "submit" value = "Submit" onclick=""></center>
		
		<div id="BreedList">
		<font size = 4><center>Breed List</center></font>
		</div>
	</body>
</html>
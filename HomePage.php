<?php
	include 'list.php';
	$pokeList = $_SESSION['PokeList'];
?>

<html>
	<head>
	<script src="jquery-3.3.1.min.js"></script>
	<script  type="text/javascript">
	$(document).ready(function() {
		$("#submitPoke").click(function() {  // when submitPoke is clicked
		
			// toggle div tags 
			$("#submitPoke").toggle();
			$("#loading").toggle();
			$("#BreedList").toggle();
			
			var list1Poke = $("select[name='list1']").val();  // get value of list1
			var list2Poke = $("select[name='list2']").val();  // get value of list2
			
			// ajax 
			$.ajax({
				type: "POST",
				url: "BreedList.php",
				data: {
					Poke1: list1Poke, 
					Poke2: list2Poke,
				},
				success: function(result){
					$("#loading").toggle();
					$("#submitPoke").toggle();
					$("#BreedList").toggle();
					$("#BreedList").html(result);  // display in BreedList div tag
				}
			});
			
		});
	});
	</script>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/design.css">
		<font size = 5><strong><center>Welcome to PokéBreeder</center></strong></font>
	</head>
	<body>
		<center>Select two Pokémon to compare egg groups</center>
		<center>A list will be returned with the Pokémon they can <b>both</b> breed with</center>
		<center>
		
		<select name="list1" id="list1">
			<?php			
				$pokeList->DisplayPokeHTML();
			?>
		</select>
		
		<select name="list2" id="list2">
			<?php			
				$pokeList->DisplayPokeHTML();
			?>
		</select>	
		</center>
		
		<!-- Submit button -->
		<center><Input type="submit" id="submitPoke" class="btn btn-primary" 
		data-toggle="tooltip" data-placement="bottom" title="Click to begin search" 
		value="Submit"></center>
		
		<div id="loading" style="display: none;">
			<center><font size = 3>Searching...Please Wait</font></center>
		</div>
		
		<div id="BreedList"></div>
	</body>
</html>
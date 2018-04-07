<?php

	include 'list.php';
	$pokeList = $_SESSION['PokeList'];
	$EggNames1 = Array();
	$EggNames2 = Array();
	
	if(!empty($_POST)) {
		echo "<font size = 4><center>Shared Breed List</center></font>";
		
		// get pokemon species URL to look up pokemon in egg group 
		$PokeSpecies1 = $pokeList->findPokeSpeciesURL($_POST["Poke1"]);
		$PokeSpecies2 = $pokeList->findPokeSpeciesURL($_POST["Poke2"]);
		
		// get list of pokemon from group
		for($i = 0; $i < count($PokeSpecies1['egg_groups']); $i++) {
			$linkCont = file_get_contents($PokeSpecies1['egg_groups'][$i]['url']);
			$link = json_decode($linkCont, true);
			
			// pass name contents in species to array 
			for($j = 0; $j < count($link['pokemon_species']); $j++) {
				array_push($EggNames1, $link['pokemon_species'][$j]['name']);
			}
		}
		
		for($i = 0; $i < count($PokeSpecies2['egg_groups']); $i++) {
			$linkCont = file_get_contents($PokeSpecies2['egg_groups'][$i]['url']);
			$link = json_decode($linkCont, true);
			
			// pass name contents in species to array 
			for($j = 0; $j < count($link['pokemon_species']); $j++) {
				array_push($EggNames2, $link['pokemon_species'][$j]['name']);
			}
		}
		
		// intersect both array for any pokemon in common		
		$result = array_intersect($EggNames1, $EggNames2);		
		$result = array_unique($result);
		
		if(empty($result)) {
			echo '<center> Empty </center>';
		}
		
		// echo out result 
		echo '<center>';
		foreach($result as $r) {
			echo $r . '<br>';
		}
		echo '</center>';
	}
?>
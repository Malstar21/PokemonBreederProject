<?php
	class PokemonList {
		private $pokemonInfo = [];
		
		// add pokemon to array 
		public function addEntry($name, $url) {
			$this->pokemonInfo[] = [
				'pokeName' => $name,
				'pokeURL' => $url
				];
		}
		
		// display all pokemon in array 
		public function displayEntries() {
			foreach($this->pokemonInfo as $pokeInfo) {
				echo ($pokeInfo['pokeName']. "<br />");
				echo ($pokeInfo['pokeURL']. "<br />");
			}
		}
		
		public function getFirstEntry() {
			return $this->pokemonInfo[0]['pokeURL'];
		}
		
		public function DisplayPokeHTML() {
			foreach($this->pokemonInfo as $pokeInfo) {
				echo '<option value="volvo">';
				echo $pokeInfo['pokeName'];
				echo '</option>';
			}
		}
	}
	
	$pokeList = new PokemonList();
	$numPoke = 0;
	$id = 5;
	
	// maybe change this for a class like i did for the list of all pokemon 
	$eggGroupArray = array();
	$eggGroupURL = array();
	
	// maybe not use limit and use a different way to avoid having to go back and change this
	// number each time the database gets updated with more pokemon, the api has another way to do it
	// for now doing it this way for testing 
	$pokemons = file_get_contents("http://pokeapi.co/api/v2/pokemon/?limit=949");
	$rPokemons = json_decode($pokemons, true);

	// get all pokemon 
	while($numPoke < $rPokemons['count']) {
		$name = $rPokemons['results'][$numPoke]['name'];
		$url = $rPokemons['results'][$numPoke]['url'];
		$pokeList->addEntry($name, $url);
		$numPoke++;
	}
	
	// will display all pokemon from arary
	// can use it for displaying a list of names to choose from 
	// in front end development
	//$pokeList->displayEntries();
	
	
	//$pokemon = file_get_contents("http://pokeapi.co/api/v2/pokemon/".$id);
	
	// get first entry to just test using class 
	$pokemon = file_get_contents($pokeList->getFirstEntry());
	
	if($pokemon != "") {
		$rPokemon = json_decode($pokemon, true);
		//echo ("Pokemon Species: ".$rPokemon['species']['url']."<br />");
		$pokemonSpecies = file_get_contents($rPokemon['species']['url']);		
		$rPokemonSpecies = json_decode($pokemonSpecies, true);
		
		$numEggs = 0;
		while($numEggs < count($rPokemonSpecies['egg_groups'])) {
			// store egg groups in array name,url
			$eggGroupArray[] = $rPokemonSpecies['egg_groups'][$numEggs]['name'];
			$eggGroupURL[] = $rPokemonSpecies['egg_groups'][$numEggs]['url'];
			$numEggs++;
		}
		
		// Display egg groups and pokemon
		$numEggs = 0;		
		while($numEggs < sizeof($eggGroupArray)) {
			echo("Egg group: ".$eggGroupArray[$numEggs]."<br />");
			
			$PokemonGroup = file_get_contents($eggGroupURL[$numEggs]);
			$rPokemonGroup = json_decode($PokemonGroup, true);
			
			foreach($rPokemonGroup['pokemon_species'] as $PG) {
				echo ($PG['name']."<br />");
			}
			echo "<br />";
			$numEggs++;
		}
	}
	else {
		die("No pokemon found");		
	}
?>
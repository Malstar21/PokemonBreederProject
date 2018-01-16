<?php
	session_start();
	
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
        
		public function DisplayPokeHTML() {
            foreach($this->pokemonInfo as $pokeInfo) {
                echo '<option value="'. $pokeInfo['pokeName'] .'">';
                echo $pokeInfo['pokeName'];
                echo '</option>';
			}
        }
		
	}


	$pokeList = new PokemonList();
	$numPoke = 0;


	$pokemons = file_get_contents("http://pokeapi.co/api/v2/pokemon/?limit=949");
	$rPokemons = json_decode($pokemons, true);
	
	while($numPoke < $rPokemons['count']) {
			$name = $rPokemons['results'][$numPoke]['name'];
			$url = $rPokemons['results'][$numPoke]['url'];
			$pokeList->addEntry($name, $url);
			$numPoke++;
		}
	
	$_SESSION['PokeList'] = $pokeList;
?>


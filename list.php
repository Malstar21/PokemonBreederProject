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
		
		// this will return the ID of the pokemon given the pokemon's name
		// allowing us to use the ID
		// returns pokemon's ID given name
		public function findPokeID($pokeName) {
			foreach($this->pokemonInfo as $pokeInfo) {
				if($pokeInfo['pokeName'] == $pokeName) {
					// get url contents GET ID from url
					$pokeURLCont = file_get_contents($pokeInfo['pokeURL']);
					$pokeURL = json_decode($pokeURLCont, true);
					
					return $pokeURL['id'];				
					break;
				}
			}
		}
		
		// given pokemon name will return the link the pokemon species link 
		public function findPokeSpeciesURL($pokeName) {
			foreach($this->pokemonInfo as $pokeInfo) {
				if($pokeInfo['pokeName'] == $pokeName) {
					// get url contents GET ID from url
					$pokeURLCont = file_get_contents($pokeInfo['pokeURL']);
					$pokeURL = json_decode($pokeURLCont, true);
					
					return $pokeURL;				
					break;
				}
			}
		}
	}


	$pokeList = new PokemonList();
	$numPoke = 0;
	
	$count = file_get_contents("http://pokeapi.co/api/v2/pokemon-species/");
	$count = json_decode($count, true);
	
	$pokemons = file_get_contents("http://pokeapi.co/api/v2/pokemon-species/?limit=" . $count['count']);
	$rPokemons = json_decode($pokemons, true);
	
	while($numPoke < $rPokemons['count']) {
			$name = $rPokemons['results'][$numPoke]['name'];
			$url = $rPokemons['results'][$numPoke]['url'];
			$pokeList->addEntry($name, $url);
			$numPoke++;
		}
	
	$_SESSION['PokeList'] = $pokeList;
?>


<?php

 class writeWordToDiplay
{
	$translationArray = array(
             "ā" => "a",
             "ē" => "e",
             "ī" => "i",
             "ō" => "o",
             "ū" => "u",
             "Ā" => "a",
             "Ē" => "e",
             "Ī" => "i",
             "Ō" => "o",
             "Ū" => "u",

             "a" => "a",
             "b" => "b",
             "c" => "c",
             "d" => "d",
             "e" => "e",
             "f" => "f",
             "g" => "g",
             "h" => "h",
             "i" => "i",
             "j" => "j",
             "k" => "k",
             "l" => "l",
             "m" => "m",
             "n" => "n",
             "o" => "o",
             "p" => "p",
             "q" => "q",
             "r" => "r",
             "s" => "s",
             "t" => "t",
             "u" => "u",
             "v" => "v",
             "w" => "w",
             "x" => "x",
             "y" => "y",
             "z" => "z",
             "A" => "a",
             "B" => "b",
             "C" => "c",
             "D" => "d",
             "E" => "e",
             "F" => "f",
             "G" => "g",
             "H" => "h",
             "I" => "i",
             "J" => "j",
             "K" => "k",
             "L" => "l",
             "M" => "m",
             "N" => "n",
             "O" => "o",
             "P" => "p",
             "Q" => "q",
             "R" => "r",
             "S" => "s",
             "T" => "t",
             "U" => "u",
             "V" => "v",
             "W" => "w",
             "X" => "x",
             "Y" => "y",
             "Z" => "z"
         );
	public function writeInitialWordToDisplay($originalWord){
		for($i=1; $i<=$wordBeingGuessedLength; $i++){
			$wordToDisplay .= "_ ";
			}
	}
	public function returnWordToDisplayGameInProgress($originalWord){	 
		return $translationArray[$letter];
    }
}

?>
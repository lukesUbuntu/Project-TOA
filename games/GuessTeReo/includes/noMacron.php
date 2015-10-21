<?php class noMacron
{
    public function removeMacron($letter) {
        $translationArray = array
        (
            "?" => "a",
            "?" => "e",
            "?" => "i",
            "?" => "o",
            "?" => "u",

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
        );
    }
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
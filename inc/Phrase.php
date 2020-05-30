<?php

class Phrase {

    //An string containing the current phrase to be used in the game
    private $currentPhrase;
    //An array of letters the user has guessed. Initialize the property to an empty array
    private $selected = array();

    public function __construct($phrase = null, $selected = []){

        if(!empty($phrase)){
            $this->currentPhrase = $phrase;
        }
        if(!empty($selected)){
            $this->selected[] = $selected;
        }

    }
}

?>
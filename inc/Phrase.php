<?php

class Phrase {

    //An string containing the current phrase to be used in the game
    private $currentPhrase;
    //An array of letters the user has guessed. Initialize the property to an empty array
    private $selected = array();
    //public $phrase;

    //This is the constuctor that when we create object of this class, we can pass these valus directly
    public function __construct($phrase = null, $selected = []){

        if(!empty($phrase)){
            $this->currentPhrase = $phrase;
        }
        if(!empty($selected)){
            $this->selected[] = $selected;
        }
        
        //$this->phrase = "dream big";

    }

    //This method adds letter placeholders to the display when the game starts
    public function addPhraseToDisplay(){

        //first I need to split the string then loop each character in the foreach loop to print each letter individualy
        $characters = str_split(strtolower($this->currentPhrase));
        
        $output = '';
        $output .= '<div id="phrase" class="section">';
        $output .= '<ul>';
        foreach($characters as $char){
            if($char == " "){
                $output .= '<li class="space '.$char.'">'.$char.'</li>';
            }else{
                $output .= '<li class="hide letter '.$char.'">'.$char.'</li>';
            }
            
        }
        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }

    public function checkLetter($singleLetter){

        //array of unique lowercase letters only in the currentPhrase
        $characters = array_unique(str_split(str_replace(' ', '', strtolower($this->currentPhrase))));


        if(in_array($singleLetter, $characters)){
            echo $singleLetter;
            return true;
        }else{
            return false;
        }

    }

    
}

?>
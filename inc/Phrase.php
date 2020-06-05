<?php

class Phrase {

    //An string containing the current phrase to be used in the game
    public $currentPhrase;
    //An array of letters the user has guessed. Initialize the property to an empty array
    public $selected = array();
    public $phrases = [
        'Boldness be my friend',
        'Leave no stone unturned',
        'Broken crayons still color',
        'The adventure begins',
        'Dream without fear',
        'Love without limits',
    ];

    public $incorrectSelectArray = array();
    public $correctSelectArray = array();

    public $incorrectSelect = 0;

    //This is the constuctor that when we create object of this class, we can pass these valus directly
    public function __construct($phrase = null, $selected = []){

        //I'm shuffiling the array to get random value
        if($phrase == null){
            shuffle($this->phrases);
            $this->currentPhrase = $this->phrases[0];
        }else{
            $this->currentPhrase = $phrase;
        }
        if(!empty($selected)){
            $this->selected[] = $selected;
        }
        
        //echo($this->currentPhrase);

    }

    public function setCurrentPhrase($currentPhrase){
        $this->currentPhrase = $currentPhrase;
    }

    public function getCurrentPhrase(){
        return $this->currentPhrase;
    }

    public function setSelected($selected){
        $this->selected[] = $selected;
    }

    public function getSelected(){
        return $this->selected;
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
                if($this->checkLetter($char)){
                    $output .= '<li class="show letter '.$char.'">'.$char.'</li>';
                }else{
                    $output .= '<li class="hide letter '.$char.'">'.$char.'</li>';
                }
            }  
        }
        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }

    public function checkLetter($singleLetter){

        if(in_array($singleLetter, $this->getLetterArray()) && in_array($singleLetter, $_SESSION['selected'])){
            return true;
        }else{

            return false;
        }

    }
    public function getLetterArray(){

        //array of unique lowercase letters only in the currentPhrase
        $characters = array_unique(str_split(str_replace(' ', '', strtolower($this->currentPhrase))));
        return $characters;
        
    }

    public function numberLost(){

        foreach($_SESSION['selected'] as $selected)
        if(!in_array($selected, $this->getLetterArray())){
            /*
            if($this->incorrectSelect > 4){
                header('Location: index.html');
            }
            */
            array_push($this->incorrectSelectArray, $selected);
            
            /*
            I don't why incorrectSelect didn't send the value to Game.php in checkForLose function
            */
            $this->incorrectSelect += 1;
            $_SESSION['countLost'] = $this->incorrectSelect;

        }

    } 
    
}

?>
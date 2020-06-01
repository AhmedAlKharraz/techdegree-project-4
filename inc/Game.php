<?php

class Game {

    //we assign $phrase to the $currentPhrase in Phrase class
    private $phrase;
    private $live = 5;

    private $allPressedKey = array();

    //This is the constuctor that when we create object of this class, we can pass these valus directly
    public function __construct($phrase){
        $this->phrase = $phrase;
    }

    //This function for displaying keyboard on the sceen
    public function displayKeyboard(){

        $output = '';

        //for each form they have to be method and action
        //and each element inside it have to have name that will be after questionmark play.php?name= and value that will hold.
        $output .= '<form method="post" action="play.php">';
        $output .= '<div id="qwerty" class="section">';

        $output .= '<div class="keyrow">';
        $output .= '<button class="key" name="key" value="q"'.$this->handleLetterKey('q').'>q</button>';
        $output .= '<button class="key" name="key" value="w"'.$this->handleLetterKey('w').'>w</button>';
        $output .= '<button class="key" name="key" value="e"'.$this->handleLetterKey('e').'>e</button>';
        $output .= '<button class="key" name="key" value="r"'.$this->handleLetterKey('r').'>r</button>';
        $output .= '<button class="key" name="key" value="t"'.$this->handleLetterKey('t').'>t</button>';
        $output .= '<button class="key" name="key" value="y"'.$this->handleLetterKey('y').'>y</button>';
        $output .= '<button class="key" name="key" value="u"'.$this->handleLetterKey('u').'>u</button>';
        $output .= '<button class="key" name="key" value="i"'.$this->handleLetterKey('i').'>i</button>';
        $output .= '<button class="key" name="key" value="o"'.$this->handleLetterKey('o').'>o</button>';
        $output .= '<button class="key" name="key" value="p"'.$this->handleLetterKey('p').'>p</button>';
        $output .= '</div>';

        $output .= '<div class="keyrow">';
        $output .= '<button class="key" name="key" value="a"'.$this->handleLetterKey('a').'>a</button>';
        $output .= '<button class="key" name="key" value="s">s</button>';
        $output .= '<button class="key" name="key" value="d">d</button>';
        $output .= '<button class="key" name="key" value="f">f</button>';
        $output .= '<button class="key" name="key" value="g">g</button>';
        $output .= '<button class="key" name="key" value="h">h</button>';
        $output .= '<button class="key" name="key" value="j">j</button>';
        $output .= '<button class="key" name="key" value="k">k</button>';
        $output .= '<button class="key" name="key" value="l">l</button>';
        $output .= '</div>';

        $output .= '<div class="keyrow">';
        $output .= '<button class="key" name="key" value="z">z</button>';
        $output .= '<button class="key" name="key" value="x">x</button>';
        $output .= '<button class="key" name="key" value="c">c</button>';
        $output .= '<button class="key" name="key" value="v">v</button>';
        $output .= '<button class="key" name="key" value="b">b</button>';
        $output .= '<button class="key" name="key" value="n">n</button>';
        $output .= '<button class="key" name="key" value="m">m</button>';
        $output .= '</div>';
        
        $output .= '</div>';
        $output .= '</form>';

        return $output;
    }

    //This method in displaying the score
    public function displayScore(){

        $output = '';

        $output .= '<div id="scoreboard" class="section">';

        $output .= '<ol>';
        $output .= '<li class="tries"><img src="images/lostHeart.png" height="35px" widght="30px"></li>';
        $output .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
        $output .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
        $output .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
        $output .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
        $output .= '</ol>';

        $output .= '</div>';

        return $output;
    }

    public function handleLetterKey($pressedKey){
        
        /*
        foreach($_SESSION['selected'] as $char){
            if($pressedKey == $char){
                return 'style="background-color: red" disabled';
                echo 'letter a';
            }else{
                return "Try Again"; 
            }
        }
        */

        
        if(in_array($pressedKey, $_SESSION['selected'])){
            echo"wajfekghvdkf";
            return 'style="background-color: red" disabled';
            
        }else{
            return "Try Again"; 
        }
        

        /*
        $characters = array_unique(str_split(str_replace(' ', '', strtolower($_SESSION['phrase']))));

        if(array_intersect($characters, $_SESSION['selected'])){
            array_push($this->incorrectLetter, array_intersect($characters, $_SESSION['selected']));
        }
        */
    
    }
    
}

?>
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
        $output .= '<input type="submit" name="key" value="q"'.$this->handleLetterKey('q').'></input>';
        $output .= '<input type="submit" name="key" value="w"'.$this->handleLetterKey('w').'></input>';
        $output .= '<input type="submit" name="key" value="e"'.$this->handleLetterKey('e').'></input>';
        $output .= '<input type="submit" name="key" value="r"'.$this->handleLetterKey('r').'></input>';
        $output .= '<input type="submit" name="key" value="t"'.$this->handleLetterKey('t').'></input>';
        $output .= '<input type="submit" name="key" value="y"'.$this->handleLetterKey('y').'></input>';
        $output .= '<input type="submit" name="key" value="u"'.$this->handleLetterKey('u').'></input>';
        $output .= '<input type="submit" name="key" value="i"'.$this->handleLetterKey('i').'></input>';
        $output .= '<input type="submit" name="key" value="o"'.$this->handleLetterKey('o').'></input>';
        $output .= '<input type="submit" name="key" value="p"'.$this->handleLetterKey('p').'></input>';
        $output .= '</div>';

        $output .= '<div class="keyrow">';
        $output .= '<input type="submit" name="key" value="a"'.$this->handleLetterKey('a').'></input>';
        $output .= '<input type="submit" name="key" value="s"'.$this->handleLetterKey('s').'></input>';
        $output .= '<input type="submit" name="key" value="d"'.$this->handleLetterKey('d').'></input>';
        $output .= '<input type="submit" name="key" value="f"'.$this->handleLetterKey('f').'></input>';
        $output .= '<input type="submit" name="key" value="g"'.$this->handleLetterKey('g').'></input>';
        $output .= '<input type="submit" name="key" value="h"'.$this->handleLetterKey('h').'></input>';
        $output .= '<input type="submit" name="key" value="j"'.$this->handleLetterKey('j').'></input>';
        $output .= '<input type="submit" name="key" value="k"'.$this->handleLetterKey('k').'></input>';
        $output .= '<input type="submit" name="key" value="l"'.$this->handleLetterKey('l').'></input>';
        $output .= '</div>';

        $output .= '<div class="keyrow">';
        $output .= '<input type="submit" name="key" value="z"'.$this->handleLetterKey('z').'></input>';
        $output .= '<input type="submit" name="key" value="x"'.$this->handleLetterKey('x').'></input>';
        $output .= '<input type="submit" name="key" value="c"'.$this->handleLetterKey('c').'></input>';
        $output .= '<input type="submit" name="key" value="v"'.$this->handleLetterKey('v').'></input>';
        $output .= '<input type="submit" name="key" value="b"'.$this->handleLetterKey('b').'></input>';
        $output .= '<input type="submit" name="key" value="n"'.$this->handleLetterKey('n').'></input>';
        $output .= '<input type="submit" name="key" value="m"'.$this->handleLetterKey('m').'></input>';
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
        $output .= '<li class="tries"><img src="images/'.$this->checkForLose(1).'.png" height="35px" widght="30px"></li>';
        $output .= '<li class="tries"><img src="images/'.$this->checkForLose(2).'.png" height="35px" widght="30px"></li>';
        $output .= '<li class="tries"><img src="images/'.$this->checkForLose(3).'.png" height="35px" widght="30px"></li>';
        $output .= '<li class="tries"><img src="images/'.$this->checkForLose(4).'.png" height="35px" widght="30px"></li>';
        $output .= '<li class="tries"><img src="images/'.$this->checkForLose(5).'.png" height="35px" widght="30px"></li>';
        $output .= '</ol>';

        $output .= '</div>';

        return $output;
    }

    public function handleLetterKey($pressedKey){
        
        if($this->phrase->checkLetter($pressedKey)){
            return 'class="correct" disabled';

        }elseif(in_array($pressedKey, $_SESSION['selected'])){
            return 'class="incorrect" disabled';
        }
    
    }

    public function checkForLose($num){

        /*
        !! Question: I tried to use this code insted of session, $this->phrase->incorrectSelect, 
        to check the number that I saved it in phrase but it always return zero, may I know what was the issue ?
        */

        if($num <= $_SESSION['countLost']){
            return 'lostHeart';
        }else{
            return 'liveHeart';
        }
    }

    public function gameOver(){
        $output = '';

        if($_SESSION['countLost'] > 4){
            $output .= '<div id="overlay" class="lose">';
            $output .= '<h2>Phrase Hunter</h2><br>';
            $output .= '<h1 id="game-over-message">The phrase was: "'.$_SESSION['phrase'].'". Better luck next time!</h1>';
            $output .= '<form action="play.php" method="post">';
            $output .= '<input id="btn__reset" type="submit" name="start" value="Start Game" />';
            $output .= '</form>';
        }elseif(count(array_diff($this->phrase->getLetterArray(), $_SESSION['selected'])) == 0){
            $output .= '<div id="overlay" class="win">';
            $output .= '<h2>Phrase Hunter</h2><br>';
            $output .= '<h1 id="game-over-message">The phrase was: "The adventure begins". Better luck next time!</h1>';
            $output .= '<form action="play.php" method="post">';
            $output .= '<input id="btn__reset" type="submit" name="start" value="Start Game" />';
            $output .= '</form>';
        }
        
        $output .= '</div>';
        echo $output;
    }
    
}

?>
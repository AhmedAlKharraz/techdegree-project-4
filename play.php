<?php
session_start();
//session_destroy();

// Report simple running errors
error_reporting(E_ALL);
// Make sure they're on screen
ini_set('display_errors', 1);
// HTML formatted errors
ini_set("html_errors", 1);

//after setting the session
//var_dump($_SESSION);

//I'm unset all data when the game started from index.html
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['start'])){
    unset($_SESSION['phrase']);
    unset($_SESSION['selected']);
    unset($_SESSION['countLost']);
    //$_POST['key'] = ''; //check about this code it it's right, becuase it assing empty value to $_SESSION['selected'] array
}

//I set the selected session so I can save the key that player pressed.
if(!isset($_SESSION['selected'])) {
    $_SESSION['selected'] = array();
}

if(!isset($_SESSION['countLost'])) {
    $_SESSION['countLost'] = 0;
}

//my issue was adding the key to the 'selected' array after the HTML had been displayed. Not when the $_POST happens
if(isset($_POST['key'])){
    $_SESSION['selected'][] = $_POST['key'];
}

include("inc/Game.php");
include("inc/Phrase.php");

//I instantiate the classes, and passed the requirement of Phrase constructor with SESSION
$phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
$game = new Game($phrase);


if(!isset($_SESSION['phrase'])) {
    $_SESSION['phrase'] = $phrase->currentPhrase;
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Phrase Hunter</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/styles.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	</head>

	<body>
		<div class="main-container">
            <h2 class="header">Phrase Hunter</h2>

            <?php 

            echo $phrase->addPhraseToDisplay(); 
            echo $game->displayKeyboard(); 
            
            $phrase->getLetterArray();
            $game->handleLetterKey($_POST['key']);
            $phrase->numberLost();
            //I chsnged the location of display function to get thr session value after I add it in numberLost function.
            echo $game->displayScore(); 
            
            $game->gameOver();

            ?>

		</div>

	</body>
</html>


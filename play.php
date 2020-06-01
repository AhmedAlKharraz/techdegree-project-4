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

//I set the phrase session so I can save the phrase and key that player pressed.
if (!isset($_SESSION['phrase'])) {
    $_SESSION['phrase'] = 'start small';
}

if (!isset($_SESSION['selected'])) {
    $_SESSION['selected'] = array();
}

include("inc/Game.php");
include("inc/Phrase.php");

//I instantiate the classes, and passed the requirement of Phrase constructor with SESSION
$phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
$game = new Game($phrase);

//var_dump($phrase);
//var_dump($game);


print_r(end($_SESSION['selected']));

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
            $index;
            echo ($_POST['key']);

            echo $phrase->addPhraseToDisplay(); 
            echo $game->displayKeyboard(); 
            echo $game->displayScore(); 

            if(!isset($_POST['key'])){
                $_POST['key'] = '';
            }

            $key = $_POST['key'];            
            //I add each pressed key in $_SESSION['selected'] array
            array_push($_SESSION['selected'], $key);

            //var_dump($phrase->checkLetter($key));
            $game->handleLetterKey($key);
            ?>

		</div>

	</body>
</html>


<?php 
require_once("classes/Card.php");
require_once("classes/Deck.php");
require_once("classes/Hand.php");
require_once("classes/DiscardPile.php");
require_once("classes/GameManager.php");
$game = new GameManager(2);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pesten</title>
        <link rel="stylesheet" href="stylesheet.css" />
    </head>
    <body>
        <?php
            $game->show();
        ?>
    </body>
</html>
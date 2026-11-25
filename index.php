<?php
require_once("classes/Card.php");
require_once("classes/Deck.php");
require_once("classes/Hand.php");
require_once("classes/DiscardPile.php");
require_once("classes/GameManager.php");

session_start();

if (isset($_GET['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$playerCount = 4;

if (isset($_SESSION['Game'])) {
    $game = $_SESSION['Game'];
} else {
    $game = new GameManager($playerCount);
}

if (isset($_GET['Card'])) {
    $game->click($_GET['Card']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pesten</title>
        <link rel="stylesheet" href="stylesheet.css" />
    </head>
    <body>
        <a href="index.php?reset=1" class="reset-btn">Reset Game</a>
        <?php
            $game->show();
            $_SESSION['Game'] = $game;
        ?>
    </body>
</html>
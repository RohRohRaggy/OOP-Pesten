<?php 
require_once("classes/Card.php");
require_once("classes/Deck.php");
require_once("classes/Hand.php");

$Deck = new Deck();
$player1 = new Hand(0);
$player2 = new Hand(1);
$cardCount = 7;
for($I = 0; $I < $cardCount; $I++){
    $card = $Deck->Draw();
    $player1->addToHand($card);
    $card = $Deck->Draw();
    $player2->addToHand($card);
}
$D = count($Deck->Cards); if($D > 21){$D = 21;}
$PC1 = count($player1->Cards);
$PC2 = count($player2->Cards);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pesten</title>
    </head>
    <body>
        <?php
            $player1->showHand();
            echo "<table>";
            $Deck->ShowDeck();
            echo "</table>";
            $player2->showHand();
        ?>
    </body>
</html>
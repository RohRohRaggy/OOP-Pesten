<?php
class GameManager{
public $deck;
public $discardPile;
public $players;
private $turn;

function __construct($playerCount){
    $this->deck = new Deck();
    $this->deck->Shuffle();
    $this->discardPile = new DiscardPile();
    $this->players = array();

    for($i = 0; $i < $playerCount; $i++){
        $this->players[$i] = new Hand($i);
    }

    $cardCount = 7;
    for($i = 0; $i < $cardCount; $i++){
        for($p = 0; $p < $playerCount; $p++){
            $card = $this->deck->Draw();
            $this->players[$p]->addToHand($card);
        }
    }

    $startCard = $this->deck->Draw();
    $this->discardPile->placeCard($startCard);

    $this->turn = rand(1, $playerCount);
}

public function nextPlayer(){
    if($this->turn == count($this->players)){
        $this->turn = 1;
    } else {
        $this->turn++;
    }
}

public function show(){
    for($i = 0; $i < count($this->players); $i++){
        $this->players[$i]->showHand($this->turn);
    }
    echo "<board>";
    $this->deck->ShowDeck();
    $this->discardPile->showDiscardPile();
    echo "</board>";
}
}
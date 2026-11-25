<?php
class GameManager{
public $deck;
public $discardPile;
public $players;
private $turn;

function __construct($playerCount){
    $this->deck = new Deck();
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
    $this->discardPile->addCard($startCard);

    $this->turn = rand(1, $playerCount);
}

public function nextPlayer(){

}

public function show(){

}
}
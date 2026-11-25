<?php
class GameManager{
public $deck;
public $discardPile;
public $players;
private $turn;
private $LR = true;

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
public function click($value){
    if($value == "draw"){
        $this->drawCard();
        $this->nextPlayer();
    } else {
        $this->playCard($value);
    }
}

private function playCard($cardId){
    $topDiscard = $this->discardPile->Cards[count($this->discardPile->Cards) - 1];
    $playedCard = $this->players[$this->turn]->Cards[$cardId];

    if(empty($this->discardPile->Cards)
        || $playedCard->GetVaulue() == $topDiscard->GetValue() 
        || $playedCard->GetSuit() == $topDiscard->GetSuit()
        || $playedCard->GetValue() == 'J'
        )
        {
            $card = $this->players[$this->turn]->removeFromHand($cardId);

            switch($card->GetValue()){
                case '2':
                    break;
                default:
                    $this->nextPlayer();
                    break;
            }
            $this->discardPile->placeCard($card);
        }
}

public function nextPlayer(){
    if($this->turn == count($this->players)){
        $this->turn = 1;
    } else {
        $this->turn++;
    }
}

private function drawCard(){
    $card = $this->deck->Draw();
    $this->players[$this->turn]->addToHand($card);
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
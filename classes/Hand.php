<?php

class Hand{
    public $Cards;
    private $playerNr;
    
    function __construct($playerNr){
        $this->Cards = array();
        $this->playerNr;
    }

    public function addToHand($card){
        array_push($this->Cards,$card);
    }

    public function showHand(){
        echo "<hand class='P".$this->playerNr."'>";
        foreach($this->Cards as $card){
            echo "<card>";
            $card->ShowCard();
            echo "</card>";
        }
        echo "</hand>";
    }

}
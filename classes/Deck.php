<?php

class Deck{
    public $Cards;
    private $values;
    private $suits;
    function __construct(){
        $this->Cards = array();
        $this->values = array("A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K");
        $this->suits = array("H", "S", "R", "K");
        $this->makeNewDeck();
    }

    private function makeNewDeck(){
        $nr = 0;
        for($T=0; $T < count($this->suits); $T++){
            for($W=0; $W < count($this->values); $W++){
                $this->Cards[$nr] = new Card($this->values[$W], $this->suits[$T]);
                $nr++;
            }
        }
    }

    public function ShowDeck(){
        echo "<deck>";
        foreach ($this->Cards as $card){
            echo "<card>";
            $card->showCard();
            echo "</card>";
        }
        echo "</deck>";
    }

    public function Draw(){
        return array_shift($this->Cards);
    }
}
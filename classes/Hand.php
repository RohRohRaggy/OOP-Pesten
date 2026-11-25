<?php

class Hand{
    public $Cards;
    private $playerNr;
    
    function __construct($playerNr){
        $this->Cards = array();
        $this->playerNr = $playerNr;
    }

    public function addToHand($card){
        array_push($this->Cards,$card);
    }

    public function showHand($turn) {
        echo "<hand class='P" . $this->playerNr . "'>";
        foreach ($this->Cards as $key => $card) {
            if ($this->playerNr == $turn) {
                echo "<card onclick='window.location.href=`index.php?Card=" . $key . "`;'>";
                $card->showCard(true);
            } else {
                echo "<card>";
                $card->showCard();
            }
            echo "</card>";
        }
        echo "</hand>";
    }

    public function removeFromHand($id){
        $card = $this->Cards[$id];
        unset($this->Cards[$id]);
        $this->rearrangeHand();
        return $card;
    }
    private function rearrangeHand(){
        $nr = 0;
        $tempDeck = $this->Cards;
        $this->Cards = array();
        foreach($tempDeck as $card){
            $this->Cards[$nr] = $card;
            $nr++;
        }
    }

}
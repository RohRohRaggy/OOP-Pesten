<?php

class DiscardPile {
    public $Cards;

    function __construct() {
        $this->Cards = array();
    }

    public function placeCard($card) {
        array_push($this->Cards, $card);
    }

    public function giveAllCards() {
        $allCards = array();
        $topIndex = count($this->Cards) - 1;

        foreach ($this->Cards as $key => $card) {
            if ($key != $topIndex) {
                array_push($allCards, $card);
                unset($this->Cards[$key]);
            }
        }
        $this->Cards = array_values($this->Cards);
        return $allCards;
    }

    public function showDiscardPile() {
        echo "<discardpile>";
        foreach ($this->Cards as $card) {
            echo "<card>";
            $card->showCard(true);
            echo "</card>";
        }
        echo "</discardpile>";
    }
}
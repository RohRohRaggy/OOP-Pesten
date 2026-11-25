<?php

class Card{
    private $value;
    private $suit;
    function __construct($value, $suit){
        $this->value = $value;
        $this->suit = $suit;
    }

    public function GetValue(){return $this->value;}
    public function GetSuit(){return $this->suit;}

    public function showCard(){
        echo "<img src='img/" . $this->suit . $this->value . ".svg' alt='" . $this->suit . $this->value . "' />";
    }
}
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

    public function showCard($visible = false){
        if($visible){
            echo "<img src='img/" . $this->suit . $this->value . ".svg' alt='" . $this->suit . $this->value . "' />";
        }else{
            echo "<img src='img/blauw.svg' alt='back' />";
        }
        
    }
}
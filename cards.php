<?php
Class card{
    private $value;
    private $suit;
    function __construct($value,$suit){
        $this->value = $value;
        $this->suit = $suit;
    }


    public function getValue(){return $this->value;}
    public function getSuit(){return $this->suit;}

    public function showCard(){
        echo $this->value . " of " . $this->suit;
    }
}
Class Deck{
    public $cards;
    private $values; //('2' t/m '10','J,'Q','K','A')
    private $suits; //('H','S','R','K')
    function __construct()
    {
        $this->cards = array();
        $this->values = array('2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A');
        $this->suits = array('H', 'S', 'R', 'K');
    }

    private function makeNewDeck(){
        $nr = 0;
        for($T=0; $T < count($this->suits))
    }
}


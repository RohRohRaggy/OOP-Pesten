<?php

class GameManager {
    public $deck;
    public $discardPile;
    public $players;
    private $turn;
    private $LR = true;

    function __construct($playerCount) {
        $this->deck = new Deck();
        $this->deck->Shuffle();
        $this->discardPile = new DiscardPile();
        $this->players = array();

        for ($i = 0; $i < $playerCount; $i++) {
            $this->players[$i] = new Hand($i);
        }

        $cardCount = 7;
        for ($i = 0; $i < $cardCount; $i++) {
            for ($p = 0; $p < $playerCount; $p++) {
                $card = $this->deck->Draw();
                $this->players[$p]->addToHand($card);
            }
        }

        $startCard = $this->deck->Draw();
        $this->discardPile->placeCard($startCard);

        $this->turn = 0;
    }

    public function click($value) {
        if ($value == "draw") {
            $this->drawCard();
            if (count($this->deck->Cards) < 3) {
                $cards = $this->discardPile->giveAllCards();
                foreach ($cards as $card) {
                    array_push($this->deck->Cards, $card);
                }
                $this->deck->Shuffle();
            }
            $this->nextPlayer();
        } else {
            $this->playCard($value);
        }
    }

    private function playCard($cardId) {
        $this->checkWin();

        if (!isset($this->players[$this->turn]->Cards[$cardId])) {
            return;
        }

        $topDiscard = $this->discardPile->Cards[count($this->discardPile->Cards) - 1];
        $playedCard = $this->players[$this->turn]->Cards[$cardId];

        if (empty($this->discardPile->Cards)
            || $playedCard->GetValue() == $topDiscard->GetValue()
            || $playedCard->GetSuit() == $topDiscard->GetSuit()
            || $playedCard->GetValue() == 'J'
        ) {
            $card = $this->players[$this->turn]->removeFromHand($cardId);

            switch ($card->GetValue()) {
                case '2':
                    $this->nextPlayer();
                    $this->players[$this->turn]->addToHand($this->deck->Draw());
                    $this->players[$this->turn]->addToHand($this->deck->Draw());
                    break;
                case '8':
                    $this->nextPlayer();
                    $this->nextPlayer();
                    break;
                case '10':
                    $passedCards = array();
                    for ($i = 0; $i < count($this->players); $i++) {
                        $randIndex = rand(0, count($this->players[$i]->Cards) - 1);
                        $passedCards[$i] = $this->players[$i]->removeFromHand($randIndex);
                    }
                    for ($i = 0; $i < count($this->players); $i++) {
                        $target = $this->LR ? ($i + 1) % count($this->players) : ($i - 1 + count($this->players)) % count($this->players);
                        $this->players[$target]->addToHand($passedCards[$i]);
                    }
                    $this->nextPlayer();
                    break;
                case 'K':
                    break;
                case 'A':
                    $this->LR = !$this->LR;
                    $this->nextPlayer();
                    break;
                default:
                    $this->nextPlayer();
                    break;
            }
            $this->discardPile->placeCard($card);
        }
    }

    private function checkWin() {
        if (count($this->players[$this->turn]->Cards) == 1) {
            $lastCardValue = $this->players[$this->turn]->Cards[0]->GetValue();
            $specialCards = array("2", "8", "10", "J", "K", "A");
            if (in_array($lastCardValue, $specialCards)) {
                $this->drawCard();
                $this->drawCard();
            }
        }
    }

    private function nextPlayer() {
        if ($this->LR) {
            $this->turn++;
        } else {
            $this->turn--;
        }

        if ($this->turn == count($this->players)) {
            $this->turn = 0;
        }
        if ($this->turn == -1) {
            $this->turn = count($this->players) - 1;
        }
    }

    private function drawCard() {
        $card = $this->deck->Draw();
        $this->players[$this->turn]->addToHand($card);
    }

    public function show() {
        for ($i = 0; $i < count($this->players); $i++) {
            $this->players[$i]->showHand($this->turn);
        }
        echo "<board>";
        $this->deck->ShowDeck();
        $this->discardPile->showDiscardPile();
        echo "</board>";
    }
}
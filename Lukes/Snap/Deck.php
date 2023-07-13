<?php

namespace Lukes\Snap;

class Deck
{
    private array $cards = [];

    public function __construct()
    {
        $suits = ['Hearts', 'Diamonds', 'Spades', 'Clubs'];
        $values = ['Ace', '2', '3', '4', '5', '6', '7', '8', '9', '10',
            'Jack', 'Queen', 'King'];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $this->cards[] = new Card($suit, $value);
            }
        }
    }

    public function getCards(): array
    {
        return $this->cards;
    }

}
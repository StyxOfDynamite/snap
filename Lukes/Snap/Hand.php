<?php

namespace Lukes\Snap;

class Hand
{
    private array $cards;

    public function __construct(array $cards = [])
    {
        $this->cards = $cards;
    }

    public function addCard(Card $card): void
    {
        $this->cards[] = $card;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function getTopCard(): ?Card
    {
        return count($this->cards) ? array_shift($this->cards) : null;
    }

    public function addCards(array $cards): void
    {
        $this->cards = array_merge($this->cards, $cards);
    }

    public function hasCards(): bool
    {
        return count($this->cards) > 0;
    }
}
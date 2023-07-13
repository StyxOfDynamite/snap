<?php

namespace Lukes\Snap;

use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{
    public function testDeckHas52Cards(): void
    {
        $deck = new Deck();
        $this->assertCount(52, $deck->getCards());
    }

    public function testDeckHas13Hearts(): void
    {
        $deck = new Deck();
        $hearts = array_filter($deck->getCards(), function (Card $card) {
            return $card->getSuit() === 'Hearts';
        });
        $this->assertCount(13, $hearts);
    }
}

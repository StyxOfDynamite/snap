<?php

namespace Lukes\Snap\Strategies;

use Lukes\Snap\Card;

class SuitOnly implements Snappable
{

    public function snap(Card $one, Card $two): bool
    {
        return $one->getSuit() === $two->getSuit();
    }
}
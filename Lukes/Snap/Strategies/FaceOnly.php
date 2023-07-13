<?php

namespace Lukes\Snap\Strategies;

use Lukes\Snap\Card;

class FaceOnly implements Snappable
{

    public function snap(Card $one, Card $two): bool
    {
        return $one->getValue() === $two->getValue();
    }
}
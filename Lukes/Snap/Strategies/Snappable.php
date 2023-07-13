<?php

namespace Lukes\Snap\Strategies;

use Lukes\Snap\Card;

interface Snappable
{
    public function snap(Card $one, Card $two): bool;
}
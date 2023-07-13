<?php

namespace Lukes\Snap;

class Player
{
    private string $name;
    private Hand $hand;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->hand = new Hand();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHand(): Hand
    {
        return $this->hand;
    }
}
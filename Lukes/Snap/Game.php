<?php

namespace Lukes\Snap;

use Lukes\Snap\Strategies\Snappable;

class Game
{
    /**
     * Players in the game
     * @var Player[]
     */
    private array $players = [];
    private array $deck = [];
    private Snappable $strategy;

    public function __construct(Snappable $strategy, $decks = 1)
    {
        $this->strategy = $strategy;
        for ($i = 1; $i <= $decks; $i++) {
            $this->deck = array_merge($this->deck, (new Deck())->getCards());
        }
        shuffle($this->deck);
    }

    public function addPlayer(Player $player): void
    {
        $this->players[] = $player;
    }

    public function dealCards(): void
    {
        echo "Dealing cards...\n";


        // Deal cards to players.
        while (count($this->deck) > 0) {
            foreach ($this->players as $player) {
                if ($card = array_shift($this->deck)) {
                    $player->getHand()->addCard($card);
                }
            }
        }
    }

    public function play()
    {
        echo "Playing game...\n";
        $lastPlayedCards = [];
        $lastPlayedCard = null;

        while (!$this->gameOver()) {
            foreach ($this->players as $player) {

                if (!$player->getHand()->hasCards()) {
                    break 2;
                }

                $card = $player->getHand()->getTopCard();

                echo "{$player->getName()} plays {$card}\n";

                $lastPlayedCards[] = $card;

                if ($lastPlayedCard !== null) {
                    if ($this->strategy->snap($card, $lastPlayedCard)) {
                        echo "Snap! {$player->getName()} wins!\n";
                        echo "{$player->getName()} wins " . count($lastPlayedCards) . " cards:\n";
                        $player->getHand()->addCards($lastPlayedCards);
                        $lastPlayedCards = [];
                        $lastPlayedCard = null;
                        break;
                    }
                }
                $lastPlayedCard = $card;
            }
        }

        echo "Game over!\n";

        // sprt players by number of cards in hand
        usort($this->players, function (Player $a, Player $b) {
            return count($a->getHand()->getCards()) <=> count($b->getHand()->getCards());
        });

        // rank players last to first
        $rank = count($this->players);
        foreach ($this->players as $player) {
            echo "{$player->getName()} came in position {$rank}\n";
            $rank--;
        }
    }

    private function gameOver(): bool
    {
        $gameOver = false;

        foreach ($this->players as $player) {
            if (!$player->getHand()->hasCards()) {
                $gameOver = true;
            }
        }

        return $gameOver;
    }

    public function getWinner(): ?Player
    {
        return $this->gameOver() ? array_pop($this->players) : null;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function getDeck()
    {
        return $this->deck;
    }

    public function getLoser(): ?Player
    {
        return $this->gameOver() ? $this->players[0] : null;
    }

}
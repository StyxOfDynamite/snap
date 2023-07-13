<?php

namespace Lukes\Snap;

use Lukes\Snap\Strategies\SuitOnly;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testGameHasTwoPlayers(): void
    {
        $strategy = new SuitOnly();
        $game = new Game($strategy);
        $player1 = new Player('Player 1');
        $player2 = new Player('Player 2');
        $game->addPlayer($player1);
        $game->addPlayer($player2);
        $this->assertCount(2, $game->getPlayers());
    }

    public function testGameHas52Cards(): void
    {
        $strategy = new SuitOnly();
        $game = new Game($strategy);
        $this->assertCount(52, $game->getDeck());
    }

    public function testGameDealsCards(): void
    {
        $strategy = new SuitOnly();
        $game = new Game($strategy);
        $player1 = new Player('Player 1');
        $player2 = new Player('Player 2');
        $game->addPlayer($player1);
        $game->addPlayer($player2);
        $game->dealCards();
        $this->assertCount(26, $player1->getHand()->getCards());
        $this->assertCount(26, $player2->getHand()->getCards());
    }

    public function testNewGameHasNoWinner(): void
    {
        $strategy = new SuitOnly();
        $game = new Game($strategy);
        $this->assertNull($game->getWinner());
    }

    public function testGamePlays(): void
    {
        $strategy = new SuitOnly();
        $game = new Game($strategy);
        $player1 = new Player('Player 1');
        $player2 = new Player('Player 2');
        $game->addPlayer($player1);
        $game->addPlayer($player2);
        $game->dealCards();
        $game->play();

        $winner = $game->getWinner();
        $loser = $game->getLoser();

        $winnerCards = count($winner->getHand()->getCards());
        $loserCards = count($loser->getHand()->getCards());
        $this->assertNotNull($winner);
        $this->assertNotNull($loser);
        $this->assertEquals(0, $loserCards);
        $this->assertGreaterThan(0, $winnerCards);
    }
}
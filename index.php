<?php

// Userland code for snap card game

use Lukes\Snap\Game;
use Lukes\Snap\Player;
use Lukes\Snap\Strategies\FaceAndSuit;
use Lukes\Snap\Strategies\FaceOnly;
use Lukes\Snap\Strategies\SuitOnly;

require_once __DIR__ . '/vendor/autoload.php';

$strategy = new SuitOnly();
$game = new Game($strategy, 3);

$player1 = new Player('Player 1');
$player2 = new Player('Player 2');
$player3 = new Player('Player 3');
$player4 = new Player('Player 4');

$game->addPlayer($player1);
$game->addPlayer($player2);
$game->addPlayer($player3);
$game->addPlayer($player4);

$game->dealCards();

$game->play();

$winner = $game->getWinner();

echo "The winner is {$winner->getName()}!\n";
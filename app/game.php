<?php

namespace App;

use \App\Board;
use \App\HumanPlayer;
use \App\ComputerPlayer;

class Game {
	private static $board;
	private static $currentPlayer;
	private static $players;

	public function __construct($board = null, $human = null, $computer = null) {
		self::$board = $board ? $board : new \App\Board;
		$humanPlayer = $human ? $human : new \App\HumanPlayer('Human');
		$computerPlayer = $computer ? $computer : new \App\ComputerPlayer('Computer');
		self::$currentPlayer = 0;
		self::$players = [$humanPlayer, $computerPlayer];
	}

	private static function gameLoop() {
		echo(self::$players[self::$currentPlayer]->name ."'s turn\n");
		echo(self::$board->printBoard());
		$spot = self::$players[self::$currentPlayer]->selectSpace(self::$board);
		echo(self::$players[self::$currentPlayer]->name . " has selected spot " . $spot . "\n");
		self::$board->set($spot, self::$players[self::$currentPlayer]->token[self::$currentPlayer]);
		self::$currentPlayer = self::nextPlayer();
		return self::$board->gameOver();
	}

	public static function main() {
		do {
			$winner = self::gameLoop();
		} while (!$winner);

		echo("\nFinal Board\n");
		echo(is_bool($winner) ? "Game is a draw\n" : "Player " . $winner . " wins\n");
		echo(self::$board->printBoard());
		echo("Game over\n");
	}

	private static function nextPlayer() {
		return self::$currentPlayer == 0 ? 1 : 0;
	}

}

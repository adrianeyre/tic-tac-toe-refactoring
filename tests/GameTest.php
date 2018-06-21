<?php

namespace App;

require_once("./app/game.php");
use \App\Game;

class GameTest extends \PHPUnit\Framework\TestCase
{
	public $board;
	public $humanPlayer;
	public $computerPlayer;


	public function setUp() {
		$this->board = \Mockery::mock('\App\Board');
		$this->board->shouldReceive('printBoard')->andReturn("** BOARD **\n");
		$this->board->shouldReceive('set')->andReturn();

		$this->humanPlayer = \Mockery::mock('\App\HumanPlayer');
		$this->humanPlayer->name = 'Player 1';
		$this->humanPlayer->token = ['X', 'O'];

		$this->computerPlayer = \Mockery::mock('\App\ComputerPlayer');
		$this->computerPlayer->name = 'Player 2';
		$this->computerPlayer->token = ['X', 'O'];
	}

	public function testHumanTakesOneRound() {
		$this->humanPlayer->shouldReceive('selectSpace')->once()->andReturn(0);
		$this->board->shouldReceive('gameOver')->once()->andReturn(true);

		$game = new \App\Game($this->board, $this->humanPlayer, $this->computerPlayer);
		$result = "Player 1's turn\n** BOARD **\nPlayer 1 has selected spot 0\n\nFinal Board\nGame is a draw\n** BOARD **\nGame over\n";
		$this->assertEquals($game->main(), $this->expectOutputString($result));
	}

	public function testComputerTakesOneRound() {
		$this->humanPlayer->shouldReceive('selectSpace')->once()->andReturn(0);
		$this->board->shouldReceive('gameOver')->once()->andReturn(false);

		$this->computerPlayer->shouldReceive('selectSpace')->once()->andReturn(1);
		$this->board->shouldReceive('gameOver')->andReturn(true);

		$game = new \App\Game($this->board, $this->humanPlayer, $this->computerPlayer);
		$result = "Player 1's turn\n** BOARD **\nPlayer 1 has selected spot 0\nPlayer 2's turn\n** BOARD **\nPlayer 2 has selected spot 1\n\nFinal Board\nGame is a draw\n** BOARD **\nGame over\n";
		$this->assertEquals($game->main(), $this->expectOutputString($result));
	}

}
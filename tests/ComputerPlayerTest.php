<?php

namespace App;

require_once("./app/computer-player.php");

class ComputerPlayerTest extends \PHPUnit\Framework\TestCase
{
	public $player;
	public $spaces;
	public $board;

	public function setUp() {
		$this->player = new \App\ComputerPlayer('User');
	}

	public function testConstructor() {
		$this->assertEquals($this->player->name, 'User');
		$this->assertEquals($this->player->token[0], 'X');
		$this->assertEquals($this->player->token[1], 'O');
	}

	public function testComputersFirstMoveEmptyBoard() {
		$board = \Mockery::mock('\App\Board');
		$board->shouldReceive('get')->with(4)->andReturn("4");

		$this->assertEquals($this->player->selectSpace($board), 4);
	}

	public function testComputersGetsEmptySpace() {
		$board = \Mockery::mock('\App\Board');
		$spaces = array("X", "X", "X", "X", "X", "X", "X", "X", "8");

		foreach (["0", "1", "2", "3", "4", "5", "6", "7", "8"] as $space) {
			$board->shouldReceive('get')->with($space)->andReturn($spaces[intval($space)]);
			$board->shouldReceive('set')->with(intval($space), $space);
			$board->shouldReceive('set')->with(intval($space), "X");
			$board->shouldReceive('set')->with(intval($space), "O");
		}
		$board->shouldReceive('gameOver')->andReturn(false);
		$board->shouldReceive('get')->andReturn(array("X", "X", "X", "X", "X", "X", "X", "X", "8"));

		$this->assertEquals($this->player->selectSpace($board), 8);
	}

	public function testComputersGetsGoesForWin() {
		$board = \Mockery::mock('\App\Board');
		$spaces = array("X", "X", "X", "X", "X", "X", "X", "X", "8");

		foreach (["0", "1", "2", "3", "4", "5", "6", "7", "8"] as $space) {
			$board->shouldReceive('get')->with($space)->andReturn($spaces[intval($space)]);
			$board->shouldReceive('set')->with(intval($space), $space);
			$board->shouldReceive('set')->with(intval($space), "X");
			$board->shouldReceive('set')->with(intval($space), "O");
		}
		$board->shouldReceive('gameOver')->andReturn(false);
		$board->shouldReceive('get')->andReturn(array("X", "X", "X", "X", "X", "X", "X", "X", "8"));

		$this->assertEquals($this->player->selectSpace($board), 8);
	}

}
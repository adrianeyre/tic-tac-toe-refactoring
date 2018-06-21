<?php

namespace App;

require_once("./app/board.php");

class BoardPlayerTest extends \PHPUnit\Framework\TestCase
{
	public $board;

	public function setUp() {
		$this->board = new \App\Board();
	}

	public function testConstructor() {
		$this->assertEquals($this->board->board, array("0", "1", "2", "3", "4", "5", "6", "7", "8"));
		$this->assertEquals($this->board->winningLines, array([0,1,2],[3,4,5],[6,7,8],[0,3,6],[1,4,7],[2,5,8],[0,4,8],[2,4,6]));
	}

	public function testGetSpaces() {
		foreach(["0", "1", "2", "3", "4", "5", "6", "7", "8"] as $space) {
			$this->assertEquals($this->board->get(intval($space)), $space);
		}
	}

	public function testSetSpaces() {
		foreach([0, 1, 2, 3, 4, 5, 6, 7, 8] as $space) {
			$this->board->set($space, '@');
			$this->assertEquals($this->board->board[$space], '@');
		}
	}
	
	public function testForNoWinningLines() {
		$this->assertEquals($this->board->gameOver(), false);
	}

	public function testForWinningHorizontalLine() {
		$this->board->board = ["X", "X", "X", "3", "4", "5", "6", "7", "8"];
		$this->assertEquals($this->board->gameOver(), "X");
	}

	public function testForWinningVerticalLine() {
		$this->board->board = ["X", "1", "2", "X", "4", "5", "X", "7", "8"];
		$this->assertEquals($this->board->gameOver(), "X");
	}

	public function testForWinningDiagonalLine() {
		$this->board->board = ["X", "1", "2", "3", "X", "5", "6", "7", "X"];
		$this->assertEquals($this->board->gameOver(), "X");
	}

	public function testForGameTie() {
		$this->board->board = ["X", "X", "O", "O", "O", "X", "X", "O", "X"];
		$this->assertEquals($this->board->gameOver(), true);
	}

	public function testPrintBoard() {
		$result = " 0 | 1 | 2\n===.===.===\n 3 | 4 | 5\n===.===.===\n 6 | 7 | 8\n\n";
		$this->assertEquals($this->board->printBoard(), $result);
	}

}
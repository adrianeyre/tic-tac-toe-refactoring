<?php

namespace App;

require_once("./app/human-player.php");

class HumanPlayerTest extends \PHPUnit\Framework\TestCase
{
	public $player;
	public $spaces;
	public $board;
	public $errorMessage;

	public function setUp() {
		$this->player = new \App\HumanPlayer('User');
		$this->spaces = array("0", "1", "2", "3", "4", "5", "6", "7", "8");
		$this->board = \Mockery::mock('\App\Board');
		$this->board->shouldReceive('get')->once()->andReturn($this->spaces);
		$this->errorMessage = "Enter [0-8]: Invalid space or that space has already been taken, please select another space\nEnter [0-8]: ";
	}

	public function tearDown() {
		if (file_exists("test.txt")) {
			unlink('test.txt');
		}
	}

	private function setInputValue($value) {
		$stream = fopen('test.txt', 'w');
		fputs($stream, $value);
		fclose($stream);
	}

	private function getInputStream() {
		$stream = fopen('test.txt', 'r');
		return $stream;
	}

	public function testConstructor() {
		$this->assertEquals($this->player->name, 'User');
		$this->assertEquals($this->player->token[0], 'X');
		$this->assertEquals($this->player->token[1], 'O');
	}

	public function testValidateSpaces() {
		foreach($this->spaces as $space) {
			$this->setInputValue($space);
			$inputStream = $this->getInputStream();
			
			$this->assertEquals($this->player->selectSpace($this->board, $inputStream), intval($space));
			fclose($inputStream);
		}
	}

	public function testInvalidNegativeSpaces() {
		$this->setInputValue("-1");
		$inputStream = $this->getInputStream();

		$this->assertEquals($this->player->selectSpace($this->board, $inputStream), $this->expectOutputString($this->errorMessage));
		fclose($inputStream);
	}

	public function testInvalidPostitiveSpaces() {
		$this->setInputValue("9");
		$inputStream = $this->getInputStream();

		$this->assertEquals($this->player->selectSpace($this->board, $inputStream), $this->expectOutputString($this->errorMessage));
		fclose($inputStream);
	}

	public function testStringValueConvertsToInteger() {
		$this->setInputValue("@");
		$inputStream = $this->getInputStream();

		$this->assertEquals($this->player->selectSpace($this->board, $inputStream), 0);
		fclose($inputStream);
	}

	public function testForSpaceAlreadyTaken() {
		$board = \Mockery::mock('\App\Board');
		$board->shouldReceive('get')->once()->andReturn(array("X"));
		$this->setInputValue("4");
		$inputStream = $this->getInputStream();

		$this->assertEquals($this->player->selectSpace($board, $inputStream), $this->expectOutputString($this->errorMessage));
		fclose($inputStream);
	}
}
<?php

namespace App;

require_once("./app/player.php");

class PlayerTest extends \PHPUnit\Framework\TestCase
{
	public $player;
	public $spaces;
	public $board;

	public function setUp() {
		$this->player = new \App\Player('User');
	}

	public function testConstructor() {
		$this->assertEquals($this->player->name, 'User');
		$this->assertEquals($this->player->token[0], 'X');
		$this->assertEquals($this->player->token[1], 'O');
	}
}
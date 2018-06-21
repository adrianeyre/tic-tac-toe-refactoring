<?php

namespace App;

class Player {

	public $token;
	public $name;

	public function __construct($name = 'Player', $tokens = ['X', 'O']) {
		$this->name = $name;
		$this->token = $tokens;
	}

	protected function validateSpot($board, $spot) {
		if ($spot < 0 || $spot >= count($board->get())) return false;

		return $board->get($spot) != $this->token[0] && $board->get($spot) != $this->token[1];
	}
}

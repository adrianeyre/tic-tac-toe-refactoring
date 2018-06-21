<?php

namespace App;

class Board {

	public $board = array("0", "1", "2", "3", "4", "5", "6", "7", "8");
	public $winningLines = array([0,1,2],[3,4,5],[6,7,8],[0,3,6],[1,4,7],[2,5,8],[0,4,8],[2,4,6]);

	public function get($space = null) {
		return $space !== null ? $this->board[(int) $space] : $this->board;
	}

	public function set(int $space, $value) {
		$this->board[$space] = $value;
	}

	function mapWinningLine($line) {
		return $this->board[$line[0]] == $this->board[$line[1]] && $this->board[$line[0]] == $this->board[$line[2]] ? $this->board[$line[0]] : null;
	}

	private function winningLine() {
		$result =  array_filter(array_map(array($this, 'mapWinningLine'), $this->winningLines), 'strlen');
		return count($result) > 0 ? reset($result) : false;
	}

	private function tie() {
		return preg_match('/\d/', implode('', $this->board)) == 0;
	}

	public function gameOver() {
		$winningLine = $this->winningLine();
		return $winningLine ? $winningLine : $this->tie();
	}

	public function printBoard() {
		return " " . $this->board[0] . " | " . $this->board[1] . " | " . $this->board[2] . "\n===.===.===\n " .
			$this->board[3] . " | " . $this->board[4] . " | " . $this->board[5] . "\n===.===.===\n " .
			$this->board[6] . " | " . $this->board[7] . " | " . $this->board[8] . "\n\n";
	}
}

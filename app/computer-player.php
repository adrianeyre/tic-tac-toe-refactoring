<?php

namespace App;

class ComputerPlayer extends Player {

	private function checkLine($board, $spot, $player) {
		return !$board->set(intval($spot), $player) && $board->gameOver() ? intval($spot) : $board->set(intval($spot), $spot);
	}

	private function checkWinningLine($board, $availableSpaces, $player) {
		foreach ($availableSpaces as $spot) {
			$result = $this->checkLine($board, $spot, $player);
			if ($result) return $result;
		}

		return null;
	}

	private function mapavailableSpaces($space) {
		return $space != $this->token[0] && $space != $this->token[1] ? $space : null;
	}

	private function getBestMove($board) {
		$availableSpaces = array_diff(array_map(array($this, 'mapavailableSpaces'), $board->get()), array(''));

		foreach (array_reverse($this->token, true) as $key => $token) {
			if ($winningOrBlockingLine = $this->checkWinningLine($board, $availableSpaces, $this->token[$key])) break;
		}

		return $winningOrBlockingLine ? $winningOrBlockingLine : intval(reset($availableSpaces));
	}

	public function selectSpace($board) {
		$spot = $board->get(4) == "4" ? 4 : $this->getBestMove($board);
		return $spot;
	}
}

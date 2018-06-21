<?php

namespace App;

class HumanPlayer extends Player {

	public function selectSpace($board, $inputStream = STDIN) {
		do {
			echo("Enter [0-8]: ");
			$spot = intval(stream_get_line($inputStream, 1024, PHP_EOL));
			$validInput = $this->validateSpot($board, $spot);

			if (!$validInput) {
				echo("Invalid space or that space has already been taken, please select another space\n");
			}
		} while (!$validInput);

		return $spot;
	}
}

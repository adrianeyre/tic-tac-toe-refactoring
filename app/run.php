<?php

namespace App;

require_once("game.php");
require_once("board.php");
require_once("player.php");
require_once("human-player.php");
require_once("computer-player.php");

$game = new \App\Game();
$game::main();

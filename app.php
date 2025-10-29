<?php
require __DIR__ . '/vendor/autoload.php';

use Chess\Board;
use Chess\Position;
use Chess\Player;
use Chess\Pieces\Bishop;
use Chess\Pieces\Knight;

try {
    $board = new Board();

    $white = new Player("white");
    $black = new Player("black");

    $board->placePiece(new Bishop($white), new Position(2, 0));
    $board->placePiece(new Knight($white), new Position(1, 0));
    $board->placePiece(new Bishop($black), new Position(5, 7));
    $board->placePiece(new Knight($black), new Position(6, 7));

    $board->display();

    $players = [$white, $black];
    $currentTurn = 0;

    while (true) {
        $currentPlayer = $players[$currentTurn % 2];
        echo ucfirst($currentPlayer->getName()) . "'s turn. Enter move (e.g. b1 c3) or 'exit': ";

        $input = trim(fgets(STDIN));
        if (strtolower($input) === 'exit') {
            echo "Game over.\n";
            break;
        }

        if (!preg_match('/^[a-h][1-8]\s[a-h][1-8]$/', $input)) {
            echo "Invalid format. Please enter like 'b1 c3'.\n";
            continue;
        }

        [$fromStr, $toStr] = explode(' ', $input);
        $from = new Position(ord($fromStr[0]) - ord('a'), (int)$fromStr[1] - 1);
        $to = new Position(ord($toStr[0]) - ord('a'), (int)$toStr[1] - 1);

        try {
            $board->movePiece($from, $to, $currentPlayer);
            echo "Move successful.\n";
            $board->display();
            $currentTurn++;
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}

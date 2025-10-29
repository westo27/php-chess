<?php

namespace Chess\Pieces;

use Chess\Board;
use Chess\Position;

/**
 * Class Bishop
 *
 * Represents a bishop piece in the chess game. The bishop can move diagonally across the board
 * as long as its path is not blocked by other pieces. The direction of movement is checked using
 * the `isDiagonalTo()` and `isPathClear()` methods.
 *
 * @package Chess\Pieces
 */
class Bishop extends Piece
{
    /**
     * Get the symbol representing the bishop on the board.
     *
     * This method returns the appropriate symbol for the bishop based on the player's color.
     * White bishop is represented by "♗", and black bishop is represented by "♝".
     *
     * @return string The symbol for the bishop piece.
     */
    public function getSymbol(): string
    {
        return $this->owner->getName() === "white" ? "♗" : "♝";
    }

    /**
     * Check if the bishop can move from one position to another.
     *
     * The bishop can move diagonally as long as the path is clear. This method checks whether
     * the destination is diagonal to the starting position and if the path between the two
     * positions is clear.
     *
     * @param Board $board The chessboard object.
     * @param Position $from The starting position of the bishop.
     * @param Position $to The destination position the bishop is trying to move to.
     * @return bool True if the bishop can legally move to the target position, false otherwise.
     */
    public function canMove(Board $board, Position $from, Position $to): bool
    {
        // Bishop moves diagonally, check if the path is clear
        if (!$from->isDiagonalTo($to)) {
            return false;
        }
        return $board->isPathClear($from, $to);
    }
}
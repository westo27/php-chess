<?php

namespace Chess\Pieces;

use Chess\Board;
use Chess\Position;

/**
 * Class Knight
 *
 * Represents a knight piece in the chess game. The knight moves in an L-shape:
 * two squares in one direction and one square in a perpendicular direction.
 * Knights are unique in that they can "jump" over other pieces.
 *
 * @package Chess\Pieces
 */
class Knight extends Piece
{
    /**
     * Get the symbol representing the knight on the board.
     *
     * This method returns the appropriate symbol for the knight based on the player's color.
     * White knight is represented by "♘", and black knight is represented by "♞".
     *
     * @return string The symbol for the knight piece.
     */
    public function getSymbol(): string
    {
        return $this->owner->getName() === "white" ? "♘" : "♞";
    }

    /**
     * Check if the knight can move from one position to another.
     *
     * The knight can move in an L-shape: two squares in one direction and one square
     * in a perpendicular direction, or one square in one direction and two squares in a
     * perpendicular direction.
     *
     * @param Board $board The chessboard object.
     * @param Position $from The starting position of the knight.
     * @param Position $to The destination position the knight is trying to move to.
     * @return bool True if the knight can legally move to the target position, false otherwise.
     */
    public function canMove(Board $board, Position $from, Position $to): bool
    {
        $dx = abs($from->getX() - $to->getX());
        $dy = abs($from->getY() - $to->getY());

        // Knight can move in an "L" shape: two squares in one direction, one square in a perpendicular direction
        return ($dx === 2 && $dy === 1) || ($dx === 1 && $dy === 2);
    }
}
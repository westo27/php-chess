<?php

namespace Chess\Pieces;

use Chess\Board;
use Chess\Player;
use Chess\Position;

/**
 * Class Piece
 *
 * Abstract class representing a chess piece. All specific pieces (e.g., Bishop, Knight)
 * should extend this class and implement their own movement rules and symbols.
 *
 * @package Chess\Pieces
 */
abstract class Piece
{
    /**
     * @var Player The player that owns the piece (either white or black).
     */
    protected Player $owner;

    /**
     * Piece constructor.
     *
     * @param Player $owner The player who owns the piece (either white or black).
     */
    public function __construct(Player $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get the owner of the piece.
     *
     * @return Player The player who owns this piece.
     */
    public function getOwner(): Player
    {
        return $this->owner;
    }

    /**
     * Get the symbol of the piece (e.g., '♗' for Bishop).
     *
     * @return string The symbol representing the piece.
     */
    abstract public function getSymbol(): string;

    /**
     * Determine if the piece can move from one position to another.
     *
     * This method will be implemented by each specific piece (e.g., Bishop, Knight)
     * to define their movement rules.
     *
     * @param Board $board The chessboard on which the piece is placed.
     * @param Position $from The starting position of the piece.
     * @param Position $to The destination position of the piece.
     * @return bool True if the piece can move to the destination position, false otherwise.
     */
    abstract public function canMove(Board $board, Position $from, Position $to): bool;
}
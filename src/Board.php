<?php

namespace Chess;

use Chess\Pieces\Piece;

/**
 * Class Board
 *
 * Represents a chessboard and provides functionality to place, move, and display pieces.
 * It handles board size constraints, piece placement, and movement validation.
 *
 * @package Chess
 */
class Board
{
    /**
     * @var int The size of the board (typically 8 or 20).
     */
    private int $boardSize;

    /**
     * @var array A 2D array representing the chessboard grid. Each element holds a piece or null.
     */
    private array $grid;

    /**
     * The maximum allowed board size.
     */
    const int MAX_BOARD_SIZE = 20;

    /**
     * Board constructor.
     *
     * Initializes the chessboard with a specified size. It validates that the size is even
     * and does not exceed the maximum allowed size.
     *
     * @param int $boardSize The size of the board (default is 8).
     * @throws \InvalidArgumentException If the board size is odd or exceeds the maximum allowed size.
     */
    public function __construct(int $boardSize = 8)
    {
        if ($boardSize % 2 !== 0) {
            throw new \InvalidArgumentException('Board size must be even');
        }
        if ($boardSize > self::MAX_BOARD_SIZE) {
            throw new \InvalidArgumentException('Board size exceeds maximum allowed size of ' . self::MAX_BOARD_SIZE);
        }
        $this->grid = array_fill(0, $boardSize, array_fill(0, $boardSize, null));
        $this->boardSize = $boardSize;
    }

    /**
     * Places a piece on the board at a specified position.
     *
     * @param Piece $piece The piece to be placed on the board.
     * @param Position $position The position on the board where the piece should be placed.
     */
    public function placePiece(Piece $piece, Position $position) : void
    {
        $this->grid[$position->getY()][$position->getX()] = $piece;
    }

    /**
     * Retrieves the piece at a specified position on the board.
     *
     * @param Position $position The position to check.
     * @return Piece|null The piece at the specified position or null if empty.
     */
    public function getPieceAtPosition(Position $position) : ?Piece
    {
        $piece = $this->grid[$position->getY()][$position->getX()] ?? null;

        return $piece;
    }

    /**
     * Moves a piece from one position to another on the board.
     *
     * This method validates that the move is legal and updates the board accordingly.
     *
     * @param Position $from The starting position of the piece.
     * @param Position $to The destination position of the piece.
     * @param Player $player The player attempting to move the piece.
     * @throws \Exception If the move is invalid (e.g., no piece at the starting position, invalid move).
     */
    public function movePiece(Position $from, Position $to, Player $player): void
    {
        $piece = $this->getPieceAtPosition($from);

        if (!$piece) {
            throw new \Exception("No piece at starting position.");
        }

        if ($piece->getOwner()->getName() !== $player->getName()) {
            throw new \Exception("That piece does not belong to you.");
        }

        $targetPiece = $this->getPieceAtPosition($to);
        if ($targetPiece && $targetPiece->getOwner()->getName() === $player->getName()) {
            throw new \Exception("Cannot capture your own piece.");
        }

        // Capturing opponent piece is handled by simply replacing it in the grid.

        if (!$piece->canMove($this, $from, $to)) {
            throw new \Exception("That piece can't move like that.");
        }

        $this->grid[$to->getY()][$to->getX()] = $piece;
        $this->grid[$from->getY()][$from->getX()] = null;
    }

    /**
     * Displays the current state of the board in a human-readable format.
     */
    public function display(): void
    {
        for ($y = $this->boardSize - 1; $y >= 0; $y--) {
            echo ($y + 1) . " ";
            for ($x = 0; $x < $this->boardSize; $x++) {
                $piece = $this->grid[$y][$x];
                echo $piece ? $piece->getSymbol() . " " : ". ";
            }
            echo PHP_EOL;
        }

        echo "  ";
        for ($x = 0; $x < $this->boardSize; $x++) {
            echo chr(97 + $x) . " ";
        }
        echo PHP_EOL;
    }

    /**
     * Checks if the path between two positions is clear (for diagonal movement).
     *
     * This method is used by the bishop to verify if it can move along a diagonal path.
     *
     * @param Position $from The starting position of the piece.
     * @param Position $to The destination position.
     * @return bool True if the path is clear, false if there are pieces blocking the path.
     */
    public function isPathClear(Position $from, Position $to): bool
    {
        $dx = $to->getX() - $from->getX();
        $dy = $to->getY() - $from->getY();

        if (abs($dx) !== abs($dy)) {
            return false; // Not diagonal
        }

        $stepX = $dx < 0 ? -1 : 1;
        $stepY = $dy < 0 ? -1 : 1;

        $x = $from->getX() + $stepX;
        $y = $from->getY() + $stepY;

        while ($x !== $to->getX() && $y !== $to->getY()) {
            if ($this->grid[$y][$x] !== null) {
                return false;
            }
            $x += $stepX;
            $y += $stepY;
        }

        return true;
    }
}